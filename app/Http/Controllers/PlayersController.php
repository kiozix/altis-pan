<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Players;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\DB;

class PlayersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @param Guard $auth
	 * @return Response
	 */
	public function index(Guard $auth)
	{
		$players = DB::table('players')->where('playerid', $auth->user()->arma)->first();

		// $vehicles = DB::table('vehicles')->where('pid', $auth->user()->arma)->get();

		switch ($players->coplevel) {
			case 1:
				$coplevel = 'Recrue';
				break;
			case 2:
				$coplevel = 'Brigadier';
				break;
			case 3:
				$coplevel = 'Brigadier Chef';
				break;
			case 4:
				$coplevel = 'Adjudant';
				break;
			case 5:
				$coplevel = 'Adjudant Chef';
				break;
			case 6:
				$coplevel = 'Lieutenant';
				break;
			case 7:
				$coplevel = 'Capitaine';
				break;
			case 8:
				$coplevel = 'Commandant';
				break;
		}

		switch ($players->mediclevel) {
			case 1:
				$mediclevel = 'Sapeur';
				break;
			case 2:
				$mediclevel = 'Caporal';
				break;
			case 3:
				$mediclevel = 'Caporal Chef';
				break;
			case 4:
				$mediclevel = 'Lieutenant colonel';
				break;
			case 5:
				$mediclevel = 'Adjudant Chef';
				break;
		}

		return view('players.index', compact('players', 'mediclevel', 'coplevel', 'vehicles'));
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
