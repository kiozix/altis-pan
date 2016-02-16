<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Requests\StreamsRequest;
use App\Streams;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class StreamsController extends Controller {

	private $auth;

	public function __construct(Guard $auth)
	{
		// Permissions
		$this->middleware('auth', ['except' => ['index_home', 'show']]);
		$this->middleware('owner', ['except' => ['index_home', 'show']]);

		$this->auth = $auth;
	}

	/**
	 * Vue Admin accueil
	 */
	public function index()
	{
		$user = $this->auth->user();
		$streams = Streams::orderBy('id', 'DESC')->paginate(15);
		return view('admin.streams.index', compact('streams', 'user'));
	}

	/**
	 * Vue utilisateur acceuil
	 */
	public function index_home()
	{
		$streams = Streams::orderBy('id', 'DESC')->paginate(4);
		return view('streams.index', compact('streams'));
	}


	/**
	 * Vue de la création d'un streamer
	 */
	public function create()
	{
		$user = $this->auth->user();

		$streams = new Streams();
		return view('admin.streams.create', compact('streams', 'user'));
	}

	/**
	 * Création d'un streamer en DB
	 */
	public function store(StreamsRequest $request)
	{
		Streams::create($request->only('name', 'slug', 'content', 'tips'));
		return redirect(action('StreamsController@index'))->with('success', 'Le streamer à bien été ajouter');
	}

	/**
	 * Vue d'un streamer
	 */
	public function show($slug)
	{
		$streams = Streams::where('slug', $slug)->firstOrFail();
		return view('streams.show', compact('streams'));
	}

	/**
	 * Vue d'édition d'un streamer
	 */
	public function edit($id)
	{
		$user = $this->auth->user();
		$streams = Streams::findOrFail($id);
		return view('admin.streams.edit', compact('streams', 'user'));
	}

	/**
	 * Edition d'un streamer en DB
	 */
	public function update($id, StreamsRequest $request)
	{
		$streams = Streams::findOrFail($id);
		$streams->update($request->only('name', 'slug', 'content', 'tips'));
		return redirect(action('StreamsController@index'))->with('success', 'Le streamer à bien été modifié');
	}

	/**
	 * Supression d'un streamer
	 */
	public function destroy($id)
	{
		$streams = Streams::findOrFail($id);
		$streams->delete();
		return redirect(action('StreamsController@index'))->with('success', 'Le streamer à bien été supprimé');
	}

}
