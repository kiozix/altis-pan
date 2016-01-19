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

	public function index()
	{
		$user = $this->auth->user();
		$players = DB::table('players')->count();
		$players_last = DB::table('players')->orderBy('uid', 'desc')->take(5)->get();
		$users = DB::table('users')->count();
		$news = DB::table('news')->count();

		$paypal = DB::table('paypals')->orderBy('id', 'desc')->take(4)->get();

		return view('admin.index', compact('user', 'players', 'players_last', 'users', 'news', 'paypal'));
	}

	public function joueur()
	{
		$user = $this->auth->user();
		$players = DB::table('players')->orderBy('uid', 'desc')->paginate(10);
		return view('admin.players.index', compact('user', 'players'));
	}

	public function joueur_show($id)
	{
		$user = $this->auth->user();

		$player = DB::table('players')->where('playerid', $id)->first();
		if(empty($player)){
			return redirect(url('admin'))->with('error', 'Le joueur demander n\'à pas été trouver');
		}

		$user_show = DB::table('users')->where('arma', $id)->first();

		$vehicles_cars = DB::table('vehicles')->where('pid', $id)->where('type', 'Car')->get();
		$vehicles_airs = DB::table('vehicles')->where('pid', $id)->where('type', 'Air')->get();
		$vehicles_ships = DB::table('vehicles')->where('pid', $id)->where('type', 'Ship')->get();

		$gang = DB::table('gangs')->where('owner', $id)->first();

		return view('admin.players.show', compact('user', 'player', 'vehicles_cars', 'vehicles_airs', 'vehicles_ships', 'gang', 'user_show'));

	}

	public function updatePlayer($id)
	{
		$admin = $_POST['admin'];
		$policier = $_POST['policier'];
		$medic = $_POST['medic'];
		$donator = $_POST['donator'];

		DB::table('players')
			->where('playerid', $id)
			->update(array(
				'adminlevel' => $admin,
				'coplevel' => $policier,
				'mediclevel' => $medic,
				'donatorlvl' => $donator
			));

		return redirect(url('admin/player/'. $id))->with('success', 'Le joueur à bien été modifié');
	}

	public function search()
	{
		$q = Input::get('q');
		$user = $this->auth->user();

		if(empty($q)){
			return view('admin.index', compact('user'))->with('error', 'Le champ de recherche est vide');
		}

		$players = DB::table('players')->where('name', 'LIKE', '%' . $q . '%')->OrWhere('playerid', $q)->paginate(10);

		return view('admin.players.search', compact('user', 'players', 'q'));
	}

	public function paypal()
	{
		$user = $this->auth->user();
		$logs = Paypal::all();

		return view('admin.paypal.index', compact('user', 'logs'));
	}

	public function updateUser($id)
	{
		$admin = $_POST['rank_website'];
		$id_user = $_POST['id'];

		DB::table('users')
			->where('id', $id_user)
			->update(array(
				'admin' => $admin,
			));

		return redirect(url('admin/player/'. $id))->with('success', 'Le joueur à bien été modifié');
	}

}
