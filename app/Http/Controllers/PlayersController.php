<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Players;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\DB;

class PlayersController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('arma');

		$this->middleware('admin', ['except' => ['index', 'show']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param Guard $auth
	 * @return Response
	 */
	public function index(Guard $auth)
	{
		$players = DB::table('players')->where('playerid', $auth->user()->arma)->first();
		$gang = DB::table('gangs')->where('owner', $auth->user()->arma)->first();

		$vehicles_cars = DB::table('vehicles')->where('pid', $auth->user()->arma)->where('type', 'Car')->get();
		$vehicles_airs = DB::table('vehicles')->where('pid', $auth->user()->arma)->where('type', 'Air')->get();
		$vehicles_ships = DB::table('vehicles')->where('pid', $auth->user()->arma)->where('type', 'Ship')->get();

		// dd($gang);

		switch ($players->coplevel) {
			case 1:
				$coplevel = env('POLICE_GRADE_1');
				break;
			case 2:
				$coplevel = env('POLICE_GRADE_2');
				break;
			case 3:
				$coplevel = env('POLICE_GRADE_3');
				break;
			case 4:
				$coplevel = env('POLICE_GRADE_4');
				break;
			case 5:
				$coplevel = env('POLICE_GRADE_5');
				break;
			case 6:
				$coplevel = env('POLICE_GRADE_6');
				break;
			case 7:
				$coplevel = env('POLICE_GRADE_7');
				break;
			case 8:
				$coplevel = env('POLICE_GRADE_8');
				break;
		}

		switch ($players->mediclevel) {
			case 1:
				$mediclevel = env('POMPIER_GRADE_1');
				break;
			case 2:
				$mediclevel = env('POMPIER_GRADE_2');
				break;
			case 3:
				$mediclevel = env('POMPIER_GRADE_3');
				break;
			case 4:
				$mediclevel = env('POMPIER_GRADE_4');
				break;
			case 5:
				$mediclevel = env('POMPIER_GRADE_5');
				break;
		}

		switch($players->adminlevel){
			case 0:
				$rank = env('ADMIN_GRADE_0');
				break;
			case 1:
				$rank = env('ADMIN_GRADE_1');
				break;
			case 2:
				$rank = env('ADMIN_GRADE_2');
				break;
			case 3:
				$rank = env('ADMIN_GRADE_3');
				break;
		}

		return view('players.index', compact('players', 'mediclevel', 'coplevel', 'rank', 'gang', 'vehicles_cars', 'vehicles_airs', 'vehicles_ships'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
