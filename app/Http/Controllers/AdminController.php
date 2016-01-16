<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

use App\Paypal;
use App\Players;
use Illuminate\Support\Facades\DB;
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
	public function index()
	{
		$user = $this->auth->user();

		return view('admin.index', compact('user'));
	}

	public function joueur()
	{
		$user = $this->auth->user();
		$players = DB::table('players')->get();
		return view('admin.players.index', compact('user', 'players'));
	}

	public function joueur_show($id)
	{
		$user = $this->auth->user();

		$player = DB::table('players')->where('playerid', $id)->first();
		$vehicles_car = DB::table('vehicles')->where('pid', $id)->where('type', 'Car')->get();
		$vehicles_air = DB::table('vehicles')->where('pid', $id)->where('type', 'Air')->get();
		$vehicles_ship = DB::table('vehicles')->where('pid', $id)->where('type', 'Ship')->get();

		$gang = DB::table('gangs')->where('owner', $id)->first();

		switch ($player->coplevel) {
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

		switch ($player->mediclevel) {
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

		switch($player->adminlevel){
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

		return view('admin.players.show', compact('user', 'player', 'vehicles_car', 'vehicles_air', 'vehicles_ship', 'coplevel', 'mediclevel', 'rank', 'gang'));
	}

	public function paypal()
	{
		$user = $this->auth->user();
		$logs = Paypal::all();

		return view('admin.paypal.index', compact('user', 'logs'));
	}

}
