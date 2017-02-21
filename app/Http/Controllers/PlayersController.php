<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Players;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

use App\Refund;
use App\Supports;
use App\AltisPan\Gang;
class PlayersController extends Controller {

	private $auth;

	public function __construct(Guard $auth)
	{
		// Permissions
		$this->middleware('auth');
		$this->middleware('arma');
		$this->middleware('ban');
		$this->auth = $auth;
	}

	/**
	 * Affiche le joueur connecté
	 */
	public function index(Guard $auth)
	{
		$players = DB::table('players')->where('playerid', $auth->user()->arma)->first();
		if(empty($players)){
			abort(403);
		}
		$allPlayers = DB::table('players')->get();
		$refunds = DB::table('refunds')->where('playerid', $auth->user()->arma)->orderBy('id', 'desc')->get();

		$gang = DB::table('gangs')->where('owner', $auth->user()->arma)->first();

		if($gang) {

			$suppr = array("\"", "`", "[", "]");
			$lineGang = str_replace($suppr, "", $gang->members);
			$ArrayGang = preg_split("/,/", $lineGang);
			$gangMembers = array();

			foreach ($ArrayGang as $member) {
				$gangMembers[$member] = DB::table('players')->where('playerid', $member)->first();
			}
		}

		$vehicles_cars = DB::table('vehicles')->where('pid', $auth->user()->arma)->where('type', 'Car')->get();
		$vehicles_airs = DB::table('vehicles')->where('pid', $auth->user()->arma)->where('type', 'Air')->get();
		$vehicles_ships = DB::table('vehicles')->where('pid', $auth->user()->arma)->where('type', 'Ship')->get();

		$ranks_cop = DB::table('ranks')->where('side', 'COP')->get();
		$ranks_medic = DB::table('ranks')->where('side', 'MEDIC')->get();

		$cop = DB::table('ranks')->where('side', 'COP')->where('value_associated', $players->coplevel)->first();
		$medic = DB::table('ranks')->where('side', 'MEDIC')->where('value_associated', $players->mediclevel)->first();
		$admin = DB::table('ranks')->where('side', 'ADMIN')->where('value_associated', $players->adminlevel)->first();

		$insure = DB::table('settings')->where('name', 'insure')->first();

		$licensesName = DB::table('settings')->where('action', 'LICENSES')->get();

		if($gang) {
			return view('players.index', compact('insure', 'licensesName', 'admin', 'cop', 'medic' ,'ranks_cop','ranks_medic', 'refunds', 'allPlayers', 'players', 'mediclevel', 'coplevel', 'rank', 'gang', 'vehicles_cars', 'vehicles_airs', 'vehicles_ships', 'gangMembers'));
		} else {
			return view('players.index', compact('insure', 'licensesName', 'admin', 'cop', 'medic' ,'ranks_cop','ranks_medic', 'refunds', 'players', 'mediclevel', 'coplevel', 'rank', 'gang', 'vehicles_cars', 'vehicles_airs', 'vehicles_ships'));

		}

	}

	/**
	 * Vue de création d'une demande de remboursement
	 */
	public function refundsView(){
		return view('players.refunds.create');
	}

	/**
	 *	Création d'une demande de remboursement en DB
	 */
	public function refunds(Request $request, Guard $auth){

		$this->validate($request, [
			'amount' => 'required|min:1|numeric',
			'content' => 'required|min:10'
		]);

		$amount = $request->get('amount');
		$content = $request->get('content');

		if(DB::table('refunds')->where('playerid', $auth->user()->arma)->where('status', 0)->first()) {
			return redirect(action('PlayersController@index'))->with('error', 'Vous avez déjà une demande de remboursement en attente');
		}

		$player = DB::table('players')->where('playerid', $auth->user()->arma)->first();

		$refunds = New Refund();
		$refunds->playerid = $auth->user()->arma;
		$refunds->name = $player->name;
		$refunds->amount = $amount;
		$refunds->content = $content;
		$refunds->status = 0;
		$refunds->save();

		return redirect(action('PlayersController@index'))->with('success', 'La demande de remboursement à bien été envoyer');

	}

	/**
	 * Supression d'un joueur dans un gang
     */
	public function deleteGang(Request $request, Guard $auth)
	{
		if($request->isMethod('POST')){
			$userId = $request->get("userId");
			$groupId = $request->get("groupId");
			$gang = DB::table('gangs')->where('id', $groupId)->first();

			if($auth->user()->arma == $gang->owner) {
				$Gang = new Gang();
				$Gang->DelMember($userId, $groupId);
			}
		}
		return response()->json(['status' => 'success']);
	}

	/**
	 * Ajout d'un jouer dans un gang
	 */
	public function addUserGang(Request $request, Guard $auth)
	{
		if($request->isMethod('POST')){
			$playerId = $request->get("playerid");
			$groupId = $request->get("groupId");

			$gang = DB::table('gangs')->where('id', $groupId)->first();

			$suppr = array("\"", "`", "[", "]");
			$lineGang = str_replace($suppr, "", $gang->members);
			$ArrayGang = preg_split("/,/", $lineGang);
			$gangMembers = array();

			if($auth->user()->arma == $gang->owner) {
				if(count($ArrayGang) <= $gang->maxmembers) {

					foreach ($ArrayGang as $member) {
						$gangMembers[] = $member;
					}

					if(env('DB_EXTDB') == 1) {
						$gangMembersString = '[';
					}elseif(env('DB_EXTDB') == 2){
						$gangMembersString = '"[';
					}

					$gangList = "";
					foreach ($gangMembers as $gangMember) {
						$gangList .= "`" . $gangMember . "`,";
					}
					$gangList .= "`" . $playerId . "`,";
					$gangList = rtrim($gangList, ",");
					$gangMembersString .= $gangList;
					if(env('DB_EXTDB') == 1) {
						$gangMembersString .= ']';
					}elseif(env('DB_EXTDB') == 2){
						$gangMembersString .= ']"';
					}

					DB::table('gangs')
						->where('id', $groupId)
						->update(array(
							'members' => $gangMembersString,
						));

					return redirect(url('player'))->with('success', 'Le joueur à bien rajouté au gang');
				}else{
					return redirect(url('player'))->with('error', 'Vous avez atteint le nombre maximum de membres');
				}
			}else {
				return Response::view('errors.403', array(), 403);
			}
		}
	}

	/**
	 * Affiche une demande de remboursement
	 */
	public function show_refunds($id){
		$refund = DB::table('refunds')->where('id', $id)->first();

		$ticket = DB::table('supports')->where('message', 1)->where('id_refunds', $id)->first();
		$users = DB::table('users')->get();
		if($ticket){
			$responses = Supports::where('reply', 1)->where('associated', $ticket->id)->get();
		}else{
			$responses = null;
		}


		return view('players.refunds.show', compact('refund', 'ticket', 'users', 'responses'));

	}

	/**
	 * Répondre à un ticket ouvert dans une demande de remboursement
	 */
	public function reply_refunds($id, Request $request){
		$content = $request->get("content");
		$this->validate($request, [
			'content' => 'required|min:2',
		]);

		$ticket = Supports::where('id', $id)->where('id_author', $this->auth->user()->id)->where('message', '1')->first();
		$last_reply = Supports::where('associated', $id)->where('reply', '1')->orderBy('id', 'desc')->first();
		$sup = DB::table('supports')->where('id', $id)->first();

		if($last_reply) {
			if ($this->auth->user()->id == $ticket->id_author) {
				if ($last_reply->id_author == $ticket->id_author) {
					return redirect(url('remboursement/' . $sup->id_refunds))->with('error', 'Veuillez attendre la réponse d\'un admin !');
				} else {
					$supports = New Supports();
					$supports->id_author = $this->auth->user()->id;
					$supports->reply = 1;
					$supports->associated = $id;
					$supports->content = $content;
					$supports->save();

					DB::table('supports')
					->where('id', $id)
					->update(array(
						'etat' => 1,
					));
				}
				return redirect(url('remboursement/' . $sup->id_refunds))->with('success', 'La réponse à bien été envoyer !');
			} else {
				abort(403, 'Unauthorized action.');
			}
		}else {
			$supports = New Supports();
			$supports->id_author = $this->auth->user()->id;
			$supports->reply = 1;
			$supports->associated = $id;
			$supports->content = $content;
			$supports->save();

			DB::table('supports')
			->where('id', $id)
			->update(array(
				'etat' => 1,
			));

			return redirect(url('remboursement/' . $sup->id_refunds))->with('success', 'La réponse à bien été envoyer !');
		}
	}

	public static function inGang($playerid, $gang_id) {
		$player = DB::table('players')->where('playerid', $playerid)->first();
		$gang = DB::table('gangs')->where('id', $gang_id)->first();
		if(empty($player) || empty($gang)){
			return false;
		}

		$suppr = array("\"", "`", "[", "]");
		$lineGang = str_replace($suppr, "", $gang->members);
		$ArrayGang = preg_split("/,/", $lineGang);
		$gangMembers = array();

		foreach ($ArrayGang as $member) {
			$gangMembers[] = $member;
		}

		foreach ($gangMembers as $gangMember) {
			if($gangMember == $player->playerid) {
				return true;
			}
		}

		return false;
	}

}
