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
	public function __construct()
	{
		$this->middleware('auth', ['except' => ['index', 'show']]);
		$this->middleware('admin', ['except' => ['index', 'show']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$news = News::all();
		return view('news.index', compact('news'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$news = new News();
		return view('news.create', compact('news'));
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
		$news = News::findOrFail($id);
		return view('news.edit', compact('news'));
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
		return redirect(action('NewsController@index'))->with('success', 'Le streamer à bien été supprimé');
	}

}
