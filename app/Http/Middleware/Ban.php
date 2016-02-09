<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Auth\Guard;

class Ban {

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

		if ($this->auth->user()->ban == true)
		{
			if ($request->ajax())
			{
				return Response::view('errors.401', array(), 401);
			}
			else
			{
				return Response::view('errors.ban', array(), 403);
			}
		}

		return $next($request);
	}

}
