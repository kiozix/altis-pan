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
		$streams = Streams::all();
		return view('streams.index', compact('streams'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$streams = new Streams();
		return view('streams.create', compact('streams'));
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
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$streams = Streams::findOrFail($id);
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
		$streams = Streams::findOrFail($id);
		return view('streams.edit', compact('streams'));
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
		$streams->update($request->only('name', 'slug', 'contents'));
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
