<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Offenses;
use App\Http\Requests\OffensesRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\DB;

class OffensesController extends Controller {

	/**
	 * NewsController constructor.
     */
	public function __construct(Guard $auth)
	{
		$this->middleware('auth', ['except' => ['index_home', 'show']]);
		$this->middleware('admin', ['except' => ['index_home', 'show']]);

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
		$offenses = Offenses::orderBy('id', 'DESC')->paginate(15);
		return view('admin.offenses.index', compact('offenses', 'user'));
	}

	public function index_home()
	{
		// $news = News::orderBy('id', 'DESC')->paginate(10);
		// return view('news.index', compact('news'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = $this->auth->user();
		$allPlayers = DB::table('players')->get();
		$offenses = new Offenses();
		return view('admin.offenses.create', compact('offenses', 'user','allPlayers'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(OffensesRequest $request)
	{
		Offenses::create($request->only('arma_id', 'content', 'sanction', 'author', 'author_id'));
		return redirect(action('OffensesController@index'))->with('success', 'L\'infraction à bien été sauvegarder');

	}


	/**
	 * @param $slug
	 * @return \Illuminate\View\View
     */
	public function show($slug)
	{
		// $news = News::where('slug', $slug)->firstOrFail();
		// return view('news.show', compact('news'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = $this->auth->user();
		$allPlayers = DB::table('players')->get();
		$offenses = Offenses::findOrFail($id);
		return view('admin.offenses.edit', compact('offenses', 'user', 'allPlayers'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, OffensesRequest $request)
	{
		$offenses = Offenses::findOrFail($id);
		$offenses->update($request->only('arma_id', 'content', 'sanction', 'author', 'author_id'));
		return redirect(action('OffensesController@index'))->with('success', 'L\'infraction à bien été modifiée');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$offenses = Offenses::findOrFail($id);
		$offenses->delete();
		return redirect(action('OffensesController@index'))->with('success', 'La news à bien été supprimé');
	}

}
