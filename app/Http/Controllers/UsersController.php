<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Otp\GoogleAuthenticator;
use Otp\Otp;
use Base32\Base32;

class UsersController extends Controller {

	private $auth;

	public function __construct(Guard $auth){
		// Permissions
		$this->middleware('auth');
		$this->middleware('ban');
		$this->auth = $auth;
	}

	/**
	 * Vue d'édition de l'utilisateur en cour
	 */
	public function edit(){
		$user = $this->auth->user();
		return view('users.edit', compact('user'));
	}

	/**
	 * Edition de l'utilisateur en DB
	 */
	public function update(Guard $auth, Request $request){
		$user = $this->auth->user();

		if(empty($user->arma)) {
			$this->validate($request, [
				'name' => "required|unique:users,name,{$user->id}|min:2",
				'arma' => "required|unique:users,arma,{$user->id}|numeric|min:17",
				'avatar' => "image"
			]);
			$user->update($request->only('name', 'firstname', 'lastname', 'avatar', 'arma'));
		} else {
			$this->validate($request, [
				'name' => "required|unique:users,name,{$user->id}|min:2",
				'avatar' => "image"
			]);
			$user->update($request->only('name', 'firstname', 'lastname', 'avatar'));
		}


		return view('users.edit', compact('user'));
		return redirect()->back()->with('success', 'Votre profil a bien été modifié');
	}

	/**
	 * Vue L'authentification à 2 facteurs
	 */
	public function totp(){
		$user = $this->auth->user();

		if($user->totp_key != ''){
			return redirect(url('profil'))->with('error', 'L\'authentification à 2 facteurs est déjà activer');
		}

		$secret = GoogleAuthenticator::generateRandom();
		$site_name = env('SITE_NAME', 'AltisPan');
		$qrcode = GoogleAuthenticator::getQrCodeUrl('totp', "$site_name - $user->name", $secret);
		Session::put('secret', $secret);

		return view('users.totp', compact('qrcode'));
	}

	/**
	 * Ajout de $secret en DB et activation l'authentification à 2 facteurs
	 */
	public function totp_post(Request $request){
		$otp = new Otp();
		$secret = session()->get('secret');
		$key = $request->get("code");
		$user = $this->auth->user();

		if ($otp->checkTotp(Base32::decode($secret), $key)) {

			DB::table('users')
				->where('id', $user->id)
				->update(array(
					'totp_key' => $secret
				));
			Session::forget('code');
			return redirect(url('profil'))->with('success', 'L\'authentification à 2 facteurs à bien été activer');
		}else {
			return redirect(url('profil/totp'))->with('error', 'Ce code ne correspond pas, veuillez recommencer l\'opération');
		}
	}

	/**
	 * Supression de l'authentification à 2 facteurs
	 */
	public function totp_delete(){

		$user = $this->auth->user();

		DB::table('users')
			->where('id', $user->id)
			->update(array(
				'totp_key' => null
			));

		return redirect(url('profil'))->with('success', 'L\'authentification à 2 facteurs à bien été déactiver');
	}

}
