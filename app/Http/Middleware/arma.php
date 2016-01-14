<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;
use ReflectionMethod;
use Illuminate\Contracts\Auth\Guard;

class Arma {

	/**
	 * Admin constructor.
	 * @param Guard $auth
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		if (empty($this->auth->user()->arma))
		{
			if ($request->ajax())
			{
				return Response::view('errors.401', array(), 401);
			}
			else
			{
				return redirect('/profil')->with('error', 'Veuillez indiquez votre ID Arma 3');
			}
		}

		return $next($request);
	}

}
