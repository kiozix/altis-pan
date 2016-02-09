<?php namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Otp\Otp;
use Base32\Base32;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	public function postRegister(Request $request)
	{
		$validator = $this->registrar->validator($request->all());

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}
		$this->registrar->create($request->all());
		return redirect('/')->with('success', 'Votre compte a bien été créé, mais vous devez le valider');
	}

	public function getConfirm(Request $request, $user_id, $token){
		$user = User::findOrFail($user_id);
		if($user->confirmation_token == $token && $user->confirmed == false){
			$user->confirmation_token = null;
			$user->confirmed = true;
			$user->save();
		} else {
			return abort(500);
		}
		$this->auth->login($user);
		return redirect('/')->with('success', 'Votre compte a bien été confirmé');
	}

	public function postLogin(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'password' => 'required',
		]);

		$user = User::where('name', $request->get('name'))->orWhere('email', $request->get('name'))->first();

		if($user->confirmed != 1){
			return redirect('/auth/login')->with('error', 'Vous devez confirmer votre compte');
		}

		if ($user && Hash::check($request->get('password'), $user->password))
		{
			if($user->totp_key != ''){
				Session::put('user_id', $user->id);
				return redirect(action('Auth\AuthController@totp'))->with('error', 'Ce compte à activer l\'authentification à 2 facteurs');
			}else {
				$this->auth->login($user, $request->has('remember'));
				return redirect()->intended($this->redirectPath());
			}
		}

		return redirect($this->loginPath())
			->withInput($request->only('name', 'remember'))
			->with('error', Lang::get('site.loginfailed'));
	}

	public function totp(Request $request){
		$user_id = session()->get('user_id');
		$key = $request->get("code");

		if(empty($user_id)){
			return redirect('/auth/login');
		}

		$otp = New Otp();
		$user = User::where('id', $user_id)->first();

		if($key){
			if ($otp->checkTotp(Base32::decode($user->totp_key), $key)) {
				$this->auth->login($user, $request->has('remember'));
				return redirect()->intended($this->redirectPath());
			}else {
				return redirect(url('totp'))->with('error', 'Ce code ne correspond pas, veuillez recommencer l\'opération');
			}
		}

		return view('auth.totp')->with('error', 'Ce compte à activer \'authentification à 2 facteurs');

	}



}
