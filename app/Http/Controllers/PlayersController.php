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
class PlayersController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('arma');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param Guard $auth
	 * @return Response
	 */
	public function index(Guard $auth)
	{
		$players = DB::table('players')->where('playerid', $auth->user()->arma)->first();
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

		switch ($players->coplevel) {
			case 1:
				$coplevel = env('POLICE_GRADE_1');
				break;
			case 2:
				$coplevel = env('POLICE_GRADE_2');
				break;
			case 3:
				$coplevel = env('POLICE_GRADE_3');
				break;
			case 4:
				$coplevel = env('POLICE_GRADE_4');
				break;
			case 5:
				$coplevel = env('POLICE_GRADE_5');
				break;
			case 6:
				$coplevel = env('POLICE_GRADE_6');
				break;
			case 7:
				$coplevel = env('POLICE_GRADE_7');
				break;
			case 8:
				$coplevel = env('POLICE_GRADE_8');
				break;
		}

		switch ($players->mediclevel) {
			case 1:
				$mediclevel = env('POMPIER_GRADE_1');
				break;
			case 2:
				$mediclevel = env('POMPIER_GRADE_2');
				break;
			case 3:
				$mediclevel = env('POMPIER_GRADE_3');
				break;
			case 4:
				$mediclevel = env('POMPIER_GRADE_4');
				break;
			case 5:
				$mediclevel = env('POMPIER_GRADE_5');
				break;
		}

		switch($players->adminlevel){
			case 0:
				$rank = env('ADMIN_GRADE_0');
				break;
			case 1:
				$rank = env('ADMIN_GRADE_1');
				break;
			case 2:
				$rank = env('ADMIN_GRADE_2');
				break;
			case 3:
				$rank = env('ADMIN_GRADE_3');
				break;
		}

		if($gang) {
			return view('players.index', compact('refunds', 'allPlayers', 'players', 'mediclevel', 'coplevel', 'rank', 'gang', 'vehicles_cars', 'vehicles_airs', 'vehicles_ships', 'gangMembers'));
		} else {
			return view('players.index', compact('refunds', 'players', 'mediclevel', 'coplevel', 'rank', 'gang', 'vehicles_cars', 'vehicles_airs', 'vehicles_ships'));

		}
	}

	public function refundsView(){
		return view('players.refunds');
	}

	public function refunds(Request $request, Guard $auth){

		$this->validate($request, [
			'g-recaptcha-response' => 'required',
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
	 * @param Request $request
	 * @param Guard $auth
	 * @return mixed
     */
	public function deleteGang(Request $request, Guard $auth)
	{
		if($request->isMethod('POST')){
			$userId = $request->get("userId");
			$groupId = $request->get("groupId");

			$gang = DB::table('gangs')->where('id', $groupId)->first();

			if($auth->user()->arma == $gang->owner) {

				$suppr = array("\"", "`", "[", "]");
				$lineGang = str_replace($suppr, "", $gang->members);
				$ArrayGang = preg_split("/,/", $lineGang);
				$gangMembers = array();

				foreach ($ArrayGang as $member) {
					$gangMembers[] = $member;
				}
				unset($gangMembers[$userId]);
				$gangMembersString = '"[';
				$gangList = "";
				foreach ($gangMembers as $gangMember) {
					if ($gangMember != $userId) {
						$gangList .= "`" . $gangMember . "`,";
					}
				}
				$gangList = rtrim($gangList, ",");
				$gangMembersString .= $gangList;
				$gangMembersString .= ']"';

				DB::table('gangs')
					->where('id', $groupId)
					->update(array(
						'members' => $gangMembersString,
					));
			}
		}
		return response()->json(['status' => 'success']);
	}

	/**
	 * @param Request $request
	 * @param Guard $auth
	 * @return \Illuminate\Http\RedirectResponse
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

					$gangMembersString = '"[';
					$gangList = "";
					foreach ($gangMembers as $gangMember) {
						$gangList .= "`" . $gangMember . "`,";
					}
					$gangList .= "`" . $playerId . "`,";
					$gangList = rtrim($gangList, ",");
					$gangMembersString .= $gangList;
					$gangMembersString .= ']"';

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

}
