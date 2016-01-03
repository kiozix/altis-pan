<?php namespace App\Http\Middleware;

use Closure;
use ReflectionMethod;
use Illuminate\Contracts\Auth\Guard;

class Admin {

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
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
		/*$controller_name = explode('@', $request->route()->getAction()['uses'])[0];
		$controller = app($controller_name);
		$reflectionMethod = new ReflectionMethod($controller_name, 'getResource');
		$resource = $reflectionMethod->invokeArgs($controller, $request->route()->parameters());*/

		if ($this->auth->user()->admin != true)
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return response('Unauthorized.', 403);
			}
		}

		return $next($request);
	}

}
