<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;
use ReflectionMethod;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\DB;

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

		if ($this->auth->user()->arma)
		{
			$players = DB::table('players')->where('playerid', $this->auth->user()->arma)->first();

			if(empty($players)){
				if ($request->ajax())
				{
					return Response::view('errors.401', array(), 401);
				}
				else
				{
					return redirect('/profil')->with('error', 'L\'ID Arma que vous avez renseigné est invalide, veuillez contacter un support pour effectuer le changement');
				}
			}
		}

		return $next($request);
	}

}
