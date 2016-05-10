<?php namespace App\Services;

use App\User;
use Illuminate\Contracts\Mail\Mailer;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * @var Mailer
	 */
	private $mailer;

	public function __construct(Mailer $mailer){
		$this->mailer = $mailer;
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255|alpha_num|unique:users',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
			'g-recaptcha-response' => 'required|captcha',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		$token = str_random(60);
		$user = User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'confirmation_token' => $token,
			'password' => bcrypt($data['password']),
		]);
		$this->mailer->send(['emails.register', 'emails.register-text'], compact('token', 'user'), function($message) use ($user){
			$message->to($user->email)->subject('Confirmation de votre compte');
		});
		return $user;
	}

}
