<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;
use ReflectionMethod;
use Illuminate\Contracts\Auth\Guard;

class Admin {

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

		if ($this->auth->user()->admin != true)
		{
			if ($request->ajax())
			{
				return Response::view('errors.401', array(), 401);
			}
			else
			{
				return Response::view('errors.403', array(), 403);
			}
		}

		return $next($request);
	}

}
