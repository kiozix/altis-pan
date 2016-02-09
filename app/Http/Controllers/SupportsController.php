<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Guard;
use App\Supports;

class SupportsController extends Controller {

	private $auth;

	public function __construct(Guard $auth)
	{
		$this->middleware('auth');
		$this->middleware('ban');
		$this->auth = $auth;
	}

	public function index()
	{

		$tickets = Supports::orderBy('id', 'DESC')->where('id_author', $this->auth->user()->id)->where('message', 1)->where('id_refunds', '0')->get();
		return view('supports.index', compact('tickets'));
	}

	public function show($id)
	{
		$ticket = Supports::where('id', $id)->where('message', '1')->where('id_refunds', '0')->first();
		$users = DB::table('users')->get();
		$responses = Supports::where('reply', 1)->where('associated', $id)->get();
		if($ticket) {
			if ($this->auth->user()->id == $ticket->id_author) {
				return view('supports.show', compact('ticket', 'users', 'responses'));
			} else {
				abort(403, 'Unauthorized action.');
			}
		}else{
			abort(404, 'File Not Found');
		}
	}

	public function reply($id, Request $request){
		$content = $request->get("content");
		$this->validate($request, [
			'content' => 'required|min:2',
		]);

		$ticket = Supports::where('id', $id)->where('id_author', $this->auth->user()->id)->where('message', '1')->first();
		$last_reply = Supports::where('associated', $id)->where('reply', '1')->orderBy('id', 'desc')->first();

		if($last_reply) {
			if ($this->auth->user()->id == $ticket->id_author) {
				if ($last_reply->id_author == $ticket->id_author) {
					return redirect(url('support/' . $id))->with('error', 'Veuillez attendre la réponse d\'un admin !');
				} else {
					$supports = New Supports();
					$supports->id_author = $this->auth->user()->id;
					$supports->reply = 1;
					$supports->associated = $id;
					$supports->content = $content;
					$supports->save();
				}
				return redirect(url('support/' . $id))->with('success', 'La réponse à bien été envoyer !');
			} else {
				abort(403, 'Unauthorized action.');
			}
		}else {
			return redirect(url('support/' . $id))->with('error', 'Veuillez attendre la réponse d\'un admin !');
		}


	}

	public function close($id){
		$ticket = Supports::where('id', $id)->where('id_author', $this->auth->user()->id)->where('message', '1')->first();
		if($this->auth->user()->id == $ticket->id_author) {
			DB::table('supports')
				->where('id', $id)
				->update(array(
					'etat' => 2,
				));
			return redirect(url('support/' . $id))->with('success', 'Le ticket à bien été fermer !');
		}else{
			return redirect(url('/'))->with('danger', 'Interdiction de faire ça ! xD');
		}
	}

	public function create(){
		return view('supports.create');
	}

	public function open(Request $request){
		$this->validate($request, [
			'content' => 'required|min:2',
			'title' => 'required|min:5'
		]);

		$title = $request->get("title");
		$content = $request->get("content");


		$supports = New Supports();
		$supports->id_author = $this->auth->user()->id;
		$supports->message = 1;
		$supports->title = $title;
		$supports->content = $content;
		$supports->etat = 0;
		$supports->id_refunds = 0;
		$supports->save();

		return redirect(url('/support'))->with('success', 'Le ticket à bien été ouvert');
	}

}
