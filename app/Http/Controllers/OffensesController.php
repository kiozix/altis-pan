<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Offenses;
use App\Http\Requests\OffensesRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\DB;

class OffensesController extends Controller {

	private $auth;

	public function __construct(Guard $auth)
	{
		// Permissions
		$this->middleware('auth');
		$this->middleware('admin');

		$this->auth = $auth;
	}

	/**
	 * Vue d'accueil
	 */
	public function index()
	{
		$user = $this->auth->user();
		$offenses = Offenses::orderBy('id', 'DESC')->paginate(15);
		$PlayersName = DB::table('players')->get();
		return view('admin.offenses.index', compact('offenses', 'user', 'PlayersName'));
	}

	/**
	 * Vue de création d'une infraction
	 */
	public function create()
	{
		$user = $this->auth->user();
		$allPlayers = DB::table('players')->get();
		$offenses = new Offenses();
		return view('admin.offenses.create', compact('offenses', 'user','allPlayers'));
	}

	/**
	 * Création d'une infraction en DB
	 */
	public function store(OffensesRequest $request)
	{
		Offenses::create($request->only('arma_id', 'content', 'sanction', 'author', 'author_id'));
		return redirect(action('OffensesController@index'))->with('success', 'L\'infraction à bien été sauvegarder');

	}


	/**
	 * Vue d'édition d'une infraction
	 */
	public function edit($id)
	{
		$user = $this->auth->user();
		$allPlayers = DB::table('players')->get();
		$offenses = Offenses::findOrFail($id);
		return view('admin.offenses.edit', compact('offenses', 'user', 'allPlayers'));
	}

	/**
	 * Edition d'une infraction en DB
	 */
	public function update($id, OffensesRequest $request)
	{
		$offenses = Offenses::findOrFail($id);
		$offenses->update($request->only('arma_id', 'content', 'sanction', 'author', 'author_id'));
		return redirect(action('OffensesController@index'))->with('success', 'L\'infraction à bien été modifiée');
	}

	/**
	 * Supréssion d'une infraction
	 */
	public function destroy($id)
	{
		$offenses = Offenses::findOrFail($id);
		$offenses->delete();
		return redirect(action('OffensesController@index'))->with('success', 'L\'infraction à bien été supprimé');
	}

}
