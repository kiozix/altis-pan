<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic;
use Base32\Base32;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'confirmation_token', 'firstname', 'lastname', 'avatar', 'arma'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function player() {
        return $this->belongsTo('App\Players', 'arma', 'playerid');
    }

	public function getAvatarAttribute($avatar){
		if($avatar){
			return "/img/avatars/{$this->id}.jpg";
		}
		return false;
	}

	public function setAvatarAttribute($avatar){
		if(is_object($avatar) && $avatar->isValid()){
			ImageManagerStatic::make($avatar)->fit(150,150)->save(public_path() . "/img/avatars/{$this->id}.jpg");
			$this->attributes['avatar'] = true;
		}
	}

	public function getLvladminAttribute() {
    	if($this->rank == 0) {
			echo 'Joueur';
		}elseif($this->rank == 1) {
			echo 'Support';
		}elseif($this->rank == 2) {
			echo 'Modérateur';
		}elseif($this->rank == 3) {
			echo 'Administrateur';
		}
	}

	public function getTagsAttribute() {
		$tags = array();
		if($this->rank == 0) {
			$tags[] = '<span class="label label-success">Joueur</span>';
		}elseif($this->rank == 1) {
			$tags[] = '<span class="label label-warning">Support</span>';
		}elseif($this->rank == 2) {
			$tags[] = '<span class="label label-info">Modérateur</span>';
		}elseif($this->rank == 3) {
			$tags[] = '<span class="label label-danger">Administrateur</span>';
		}

		if ($this->arma) {
			$player = DB::table('players')->where('playerid', $this->arma)->first();
			$gangs = DB::table('gangs')->get();
			$PlayerGang = null;
			foreach ($gangs as $gang) {
				$suppr = array("\"", "`", "[", "]");
				$lineGang = str_replace($suppr, "", $gang->members);
				$ArrayGang = preg_split("/,/", $lineGang);
				$gangMembers = array();

				foreach ($ArrayGang as $member) {
					$gangMembers[] = $member;
				}

				foreach ($gangMembers as $gangMember) {
					if($gangMember == $player->playerid) {
						$tags[] = "<span class='label label-success'>$gang->name</span>";
					}
				}
			}

			if($PlayerGang != null) {
				$tags[] = $PlayerGang;
			}

			if($player->coplevel != 0) {
				$tags[] = '<span class="label label-primary">Gendarme</span>';
			}
			if($player->mediclevel != 0) {
				$tags[] = '<span class="label label-primary">Pompier</span>';
			}
		}

		return $tags;
	}
}
