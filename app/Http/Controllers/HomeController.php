<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$rows = DB::table('players')->get();

		foreach ($rows as $row) {

			$timestamp = time() - (60 * 60 * 24 * $row->duredon);

			if ($row->timestamp != 0){
				if($row->timestamp < $timestamp) {
					DB::table('players')->where('timestamp', $row->timestamp)->where('duredon', $row->duredon)->update(array('donorlevel' => 0, 'duredon' => 0, 'timestamp' => 0));
				}
			}

		}

		return view('home');
	}

}
