<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;


class ShoutBoxController extends Controller {

    public function index() {
        $swID = rand(1, 87);
        $swChar = json_decode(file_get_contents('https://swapi.co/api/people/'.$swID.'/'));
        $userName = $swChar->name;
        $chatPort = \Request::input("p");
        $chatPort = $chatPort ?: 9090;
        return view('shoutbox.shoutbox', compact("chatPort", "userName"));
    }

}