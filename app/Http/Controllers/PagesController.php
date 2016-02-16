<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Requests\PagesRequest;
use App\Pages;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class PagesController extends Controller {

	private $auth;

	public function __construct(Guard $auth)
	{
		// Permissions
		$this->middleware('auth', ['except' => ['index_home', 'show']]);
		$this->middleware('owner', ['except' => ['show']]);

		$this->auth = $auth;
	}

	/**
	 * Vue Admin accueil
	 */
	public function index()
	{
		$user = $this->auth->user();
		$pages = Pages::orderBy('id', 'DESC')->paginate(15);
		return view('admin.pages.index', compact('pages', 'user'));
	}

	/**
	 * Vue de la création d'une page
	 */
	public function create()
	{
		$user = $this->auth->user();
		$pages = new Pages();
		return view('admin.pages.create', compact('pages', 'user'));
	}

	/**
	 * Création d'une page en DB
	 */
	public function store(PagesRequest $request)
	{
		Pages::create($request->only('name', 'slug', 'content'));
		return redirect(action('PagesController@index'))->with('success', 'La page à bien été créée');

	}


	/**
	 * Vue d'une page
     */
	public function show($slug)
	{
		$page = Pages::where('slug', $slug)->firstOrFail();
		return view('pages.show', compact('page'));
	}


	/**
	 * Vue d'édition d'une page
	 */
	public function edit($id)
	{
		$user = $this->auth->user();
		$pages = Pages::findOrFail($id);
		return view('admin.pages.edit', compact('pages', 'user'));
	}

	/**
	 * Edition d'une page en DB
	 */
	public function update($id, PagesRequest $request)
	{
		$pages = Pages::findOrFail($id);
		$pages->update($request->only('name', 'slug', 'content'));
		return redirect(action('PagesController@index'))->with('success', 'La page à bien été modifiée');
	}

	/**
	 * Supression d'une page
	 */
	public function destroy($id)
	{
		$pages = Pages::findOrFail($id);
		$pages->delete();
		return redirect(action('PagesController@index'))->with('success', 'La page à bien été supprimé');
	}

}
