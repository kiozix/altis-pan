<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Requests\NewsRequest;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class NewsController extends Controller {

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
		$news = News::orderBy('id', 'DESC')->paginate(15);
		return view('admin.news.index', compact('news', 'user'));
	}

	/**
	 * Vue utilisateur acceuil
	 */
	public function index_home()
	{
		$news = News::orderBy('id', 'DESC')->paginate(10);
		return view('news.index', compact('news'));
	}

	/**
	 * Vue de la création d'une news
	 */
	public function create()
	{
		$user = $this->auth->user();
		$news = new News();
		return view('admin.news.create', compact('news', 'user'));
	}

	/**
	 * Création d'une news en DB
	 */
	public function store(NewsRequest $request)
	{
		News::create($request->only('name', 'slug', 'content'));
		return redirect(action('NewsController@index'))->with('success', 'La news à bien été créée');

	}


	/**
	 * Vue d'une news
     */
	public function show($slug)
	{
		$news = News::where('slug', $slug)->firstOrFail();
		return view('news.show', compact('news'));
	}


	/**
	 * Vue d'édition d'une news
	 */
	public function edit($id)
	{
		$user = $this->auth->user();
		$news = News::findOrFail($id);
		return view('admin.news.edit', compact('news', 'user'));
	}

	/**
	 * Edition d'une news en DB
	 */
	public function update($id, NewsRequest $request)
	{
		$news = News::findOrFail($id);
		$news->update($request->only('name', 'slug', 'content'));
		return redirect(action('NewsController@index'))->with('success', 'La news à bien été modifiée');
	}

	/**
	 * Supression d'une news
	 */
	public function destroy($id)
	{
		$news = News::findOrFail($id);
		$news->delete();
		return redirect(action('NewsController@index'))->with('success', 'La news à bien été supprimé');
	}

}
