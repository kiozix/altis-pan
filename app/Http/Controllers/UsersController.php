<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller {

	private $auth;

	public function __construct(Guard $auth){
		$this->middleware('auth');
		$this->middleware('ban');
		$this->auth = $auth;
	}

	public function edit(){
		$user = $this->auth->user();
		return view('users.edit', compact('user'));
	}

	public function update(Guard $auth, Request $request){
		$user = $this->auth->user();

		if(empty($user->arma)) {
			$this->validate($request, [
				'name' => "required|unique:users,name,{$user->id}|min:2",
				'arma' => "required|unique:users,arma,{$user->id}|numeric|min:17",
				'avatar' => "image"
			]);
			$user->update($request->only('name', 'firstname', 'lastname', 'avatar', 'arma'));
		} else {
			$this->validate($request, [
				'name' => "required|unique:users,name,{$user->id}|min:2",
				'avatar' => "image"
			]);
			$user->update($request->only('name', 'firstname', 'lastname', 'avatar'));
		}


		return view('users.edit', compact('user'));
		return redirect()->back()->with('success', 'Votre profil a bien été modifié');
	}

}
