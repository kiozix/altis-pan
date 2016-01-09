<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShopsRequest;

use App\Shops;
use Illuminate\Http\Request;

class ShopsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$shops = Shops::all();
		return view('shops.index', compact('shops'));
	}

	/**
	 * @return \Illuminate\View\View
     */
	public function accepted()
	{
		return view('shops.accepted');
	}

	/**
	 * @return \Illuminate\View\View
     */
	public function failed()
	{
		return view('shops.failed');
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$shops = new Shops();
		return view('shops.create', compact('shops'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ShopsRequest $request)
	{
		Shops::create($request->only('name', 'time', 'content', 'price', 'image'));
		return redirect(action('ShopsController@index'))->with('success', 'L\'offre à bien été ajouter');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$shops = Shops::findOrFail($id);
		return view('shops.edit', compact('shops'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, ShopsRequest $request)
	{
		$shops = Shops::findOrFail($id);
		$shops->update($request->only('name', 'time', 'content', 'price', 'image'));
		return redirect(action('ShopsController@index'))->with('success', 'L\'offre à bien été modifiée');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$shops = Shops::findOrFail($id);
		$shops->delete();
		return redirect(action('ShopsController@index'))->with('success', 'L\'offre à bien été supprimé');
	}

}
