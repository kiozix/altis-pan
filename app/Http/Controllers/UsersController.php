<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class UsersController extends Controller {

	private $auth;

	public function __construct(Guard $auth){
		$this->middleware('auth');
		$this->auth = $auth;
	}

	public function edit(){
		$user = $this->auth->user();
		return view('users.edit', compact('user'));
	}

	public function update(Guard $auth, Request $request){
		$user = $this->auth->user();
		$this->validate($request, [
			'name' => "required|unique:users,name,{$user->id}|min:2",
            'arma' => "required|unique:users,arma,{$user->id}|numeric",
			'avatar' => "image"
		]);

		$user->update($request->only('name', 'firstname', 'lastname', 'avatar', 'arma'));
		return view('users.edit', compact('user'));
		return redirect()->back()->with('success', 'Votre profil a bien été modifié');
	}

}
