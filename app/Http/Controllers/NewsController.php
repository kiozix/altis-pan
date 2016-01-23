<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Requests\NewsRequest;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class NewsController extends Controller {

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
		$news = News::orderBy('id', 'DESC')->paginate(15);
		return view('admin.news.index', compact('news', 'user'));
	}

	public function index_home()
	{
		$news = News::orderBy('id', 'DESC')->paginate(10);
		return view('news.index', compact('news'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = $this->auth->user();
		$news = new News();
		return view('admin.news.create', compact('news', 'user'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(NewsRequest $request)
	{
		News::create($request->only('name', 'slug', 'content'));
		return redirect(action('NewsController@index'))->with('success', 'La news à bien été créée');

	}


	/**
	 * @param $slug
	 * @return \Illuminate\View\View
     */
	public function show($slug)
	{
		$news = News::where('slug', $slug)->firstOrFail();
		return view('news.show', compact('news'));
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
		$news = News::findOrFail($id);
		return view('admin.news.edit', compact('news', 'user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, NewsRequest $request)
	{
		$news = News::findOrFail($id);
		$news->update($request->only('name', 'slug', 'content'));
		return redirect(action('NewsController@index'))->with('success', 'La news à bien été modifiée');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$news = News::findOrFail($id);
		$news->delete();
		return redirect(action('NewsController@index'))->with('success', 'La news à bien été supprimé');
	}

}
