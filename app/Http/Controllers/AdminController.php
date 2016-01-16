<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Input;

use App\Paypal;
use App\Players;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller {

	private $auth;

	public function __construct(Guard $auth){
		$this->middleware('auth');
		$this->middleware('admin');
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
		$players = DB::table('players')->count();
		$players_last = DB::table('players')->take(5)->get();
		$users = DB::table('users')->count();
		$news = DB::table('news')->count();

		return view('admin.index', compact('user', 'players', 'players_last', 'users', 'news'));
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

		return view('admin.players.show', compact('user', 'player', 'vehicles_car', 'vehicles_air', 'vehicles_ship', 'gang'));

	}

	public function search()
	{
		$q = Input::get('q');
		$user = $this->auth->user();

		if(empty($q)){
			return view('admin.index', compact('user'))->with('error', 'Le champ de recherche est vide');
		}

		$players = DB::table('players')->where('name', 'LIKE', '%' . $q . '%')->get();

		return view('admin.players.search', compact('user', 'players', 'q'));
	}

	public function update_joueur()
	{

	}


	public function paypal()
	{
		$user = $this->auth->user();
		$logs = Paypal::all();

		return view('admin.paypal.index', compact('user', 'logs'));
	}

}
