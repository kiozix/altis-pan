<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Intervention\Image\ImageManagerStatic;

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
}
