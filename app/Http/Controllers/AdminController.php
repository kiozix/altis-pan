<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class AdminController extends Controller {

	private $auth;

	public function __construct(Guard $auth){
		$this->middleware('auth');
		$this->auth = $auth;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Guard $auth)
	{
		$user = $this->auth->user();

		return view('admin.index', compact('user'));
	}

	public function dev(Guard $auth)
	{
		$user = $this->auth->user();
		return view('admin.news.form', compact('user'));
	}

}
