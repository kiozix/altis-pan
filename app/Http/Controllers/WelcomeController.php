<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
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

		return view('welcome');
	}

}
