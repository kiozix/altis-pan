<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Requests\StreamsRequest;
use App\Streams;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class StreamsController extends Controller {

	/**
	 * StreamsController constructor.
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
		$streams = Streams::orderBy('id', 'DESC')->paginate(15);
		return view('admin.streams.index', compact('streams', 'user'));
	}

	public function index_home()
	{
		$streams = Streams::orderBy('id', 'DESC')->paginate(4);
		return view('streams.index', compact('streams'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = $this->auth->user();

		$streams = new Streams();
		return view('admin.streams.create', compact('streams', 'user'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(StreamsRequest $request)
	{
		Streams::create($request->only('name', 'slug', 'content'));
		return redirect(action('StreamsController@index'))->with('success', 'Le streamer à bien été ajouter');
	}

	/**
	 * Display the specified resource.
	 * @param $slug
	 * @return Response
	 */
	public function show($slug)
	{
		$streams = Streams::where('slug', $slug)->firstOrFail();
		return view('streams.show', compact('streams'));
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
		$streams = Streams::findOrFail($id);
		return view('admin.streams.edit', compact('streams', 'user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, StreamsRequest $request)
	{
		$streams = Streams::findOrFail($id);
		$streams->update($request->only('name', 'slug', 'content'));
		return redirect(action('StreamsController@index'))->with('success', 'Le streamer à bien été modifié');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$streams = Streams::findOrFail($id);
		$streams->delete();
		return redirect(action('StreamsController@index'))->with('success', 'Le streamer à bien été supprimé');
	}

}
