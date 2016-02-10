<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Requests\PagesRequest;
use App\Pages;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class PagesController extends Controller {

	/**
	 * PagesController constructor.
     */
	public function __construct(Guard $auth)
	{
		$this->middleware('auth', ['except' => ['index_home', 'show']]);
		$this->middleware('owner', ['except' => ['show']]);

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
		$pages = Pages::orderBy('id', 'DESC')->paginate(15);
		return view('admin.pages.index', compact('pages', 'user'));
	}
	
	/*
	public function index_home()
	{
		$pages = Pages::orderBy('id', 'DESC')->paginate(10);
		return view('pages.index', compact('pages'));
	}
	*/

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = $this->auth->user();
		$pages = new Pages();
		return view('admin.pages.create', compact('pages', 'user'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(PagesRequest $request)
	{
		Pages::create($request->only('name', 'slug', 'content'));
		return redirect(action('PagesController@index'))->with('success', 'La page à bien été créée');

	}


	/**
	 * @param $slug
	 * @return \Illuminate\View\View
     */
	public function show($slug)
	{
		$page = Pages::where('slug', $slug)->firstOrFail();
		return view('pages.show', compact('page'));
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
		$pages = Pages::findOrFail($id);
		return view('admin.pages.edit', compact('pages', 'user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, PagesRequest $request)
	{
		$pages = Pages::findOrFail($id);
		$pages->update($request->only('name', 'slug', 'content'));
		return redirect(action('PagesController@index'))->with('success', 'La page à bien été modifiée');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$pages = Pages::findOrFail($id);
		$pages->delete();
		return redirect(action('PagesController@index'))->with('success', 'La page à bien été supprimé');
	}

}
