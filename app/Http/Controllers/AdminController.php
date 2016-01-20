<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Input;

use App\Paypal;
use App\Players;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller {

	private $auth;

	public function __construct(Guard $auth){
		$this->middleware('auth');
		$this->middleware('admin');
		$this->auth = $auth;
	}

	public function index()
	{
		$user = $this->auth->user();
		$players = DB::table('players')->count();
		$players_last = DB::table('players')->orderBy('uid', 'desc')->take(5)->get();
		$users = DB::table('users')->count();
		$news = DB::table('news')->count();

		$paypal = DB::table('paypals')->orderBy('id', 'desc')->take(4)->get();

		return view('admin.index', compact('user', 'players', 'players_last', 'users', 'news', 'paypal'));
	}

	public function joueur()
	{
		$user = $this->auth->user();
		$players = DB::table('players')->orderBy('uid', 'desc')->paginate(10);
		return view('admin.players.index', compact('user', 'players'));
	}

	public function joueurShow($id)
	{
		$user = $this->auth->user();

		$player = DB::table('players')->where('playerid', $id)->first();
		if(empty($player)){
			return redirect(url('admin'))->with('error', 'Le joueur demander n\'à pas été trouver');
		}

		$user_show = DB::table('users')->where('arma', $id)->first();

		$vehicles_cars = DB::table('vehicles')->where('pid', $id)->where('type', 'Car')->get();
		$vehicles_airs = DB::table('vehicles')->where('pid', $id)->where('type', 'Air')->get();
		$vehicles_ships = DB::table('vehicles')->where('pid', $id)->where('type', 'Ship')->get();

		$gang = DB::table('gangs')->where('owner', $id)->first();

		return view('admin.players.show', compact('user', 'player', 'vehicles_cars', 'vehicles_airs', 'vehicles_ships', 'gang', 'user_show'));

	}

	public function updatePlayer($id)
	{
		$admin = $_POST['admin'];
		$policier = $_POST['policier'];
		$medic = $_POST['medic'];
		$donator = $_POST['donator'];

		DB::table('players')
			->where('playerid', $id)
			->update(array(
				'adminlevel' => $admin,
				'coplevel' => $policier,
				'mediclevel' => $medic,
				'donatorlvl' => $donator
			));

		return redirect(url('admin/player/'. $id))->with('success', 'Le joueur à bien été modifié');
	}

	public function search()
	{
		$q = Input::get('q');
		$user = $this->auth->user();

		if(empty($q)){
			return view('admin.index', compact('user'))->with('error', 'Le champ de recherche est vide');
		}

		$players = DB::table('players')->where('name', 'LIKE', '%' . $q . '%')->OrWhere('playerid', $q)->paginate(10);

		return view('admin.players.search', compact('user', 'players', 'q'));
	}

	public function paypal()
	{
		$user = $this->auth->user();
		$logs = Paypal::all();

		return view('admin.paypal.index', compact('user', 'logs'));
	}

	public function updateUser($id)
	{
		$admin = $_POST['rank_website'];
		$id_user = $_POST['id'];

		DB::table('users')
			->where('id', $id_user)
			->update(array(
				'admin' => $admin,
			));

		return redirect(url('admin/player/'. $id))->with('success', 'Le joueur à bien été modifié');
	}

	public function gangs()
	{
		$user = $this->auth->user();
		$gangs = DB::table('gangs')->orderBy('id', 'desc')->paginate(10);

		return view('admin.gangs.index', compact('user', 'gangs'));
	}

	public function gangShow($id)
	{
		$user = $this->auth->user();
		$allPlayers = DB::table('players')->get();
		$gang = DB::table('gangs')->where('id', $id)->first();

		$suppr = array("\"", "`", "[", "]");
		$lineGang = str_replace($suppr, "", $gang->members);
		$ArrayGang = preg_split("/,/", $lineGang);
		$gangMembers = array();

		foreach($ArrayGang as $member) {
			$gangMembers[$member] = DB::table('players')->where('playerid', $member)->first();
		}

		return view('admin.gangs.show', compact('user', 'gang', 'allPlayers', 'gangMembers'));
	}

	public function deleteGang(Request $request)
	{
		if($request->isMethod('POST')){
			$userId = $request->get("userId");
			$groupId = $request->get("groupId");

			$gang = DB::table('gangs')->where('id', $groupId)->first();

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
				))
			;
		}
		return response()->json(['status' => 'success']);
	}

	public function addUserGang(Request $request)
	{
		if($request->isMethod('POST')){
			$playerId = $request->get("playerid");
			$groupId = $request->get("groupId");

			$gang = DB::table('gangs')->where('id', $groupId)->first();

			$suppr = array("\"", "`", "[", "]");
			$lineGang = str_replace($suppr, "", $gang->members);
			$ArrayGang = preg_split("/,/", $lineGang);
			$gangMembers = array();

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

				// dd($gangMembersString);

				DB::table('gangs')
					->where('id', $groupId)
					->update(array(
						'members' => $gangMembersString,
					));

				return redirect(url('admin/gang/'. $groupId))->with('success', 'Le joueur à bien rajouté au gang');
			}else{
				return redirect(url('admin/gang/'. $groupId))->with('error', 'Vous avez atteint le nombre maximum de membres');
			}

		}
	}

	public function setLicenses(Request $request)
	{
		if($request->isMethod('POST')) {

			$status = $request->get("type");
			$pid = $request->get("pid");
			$id = $request->get("id");

			// Tests
			if (is_numeric($status) == false || is_numeric($pid) == false) {
				echo "2;not a number !";
				exit();
			}

			// On inverse le choix à modifier
			if ($status == 0) {
				$status = $status + 1;
			} else {
				$status = $status - 1;
			}
			// MAJ BDD
			$rows = DB::table('players')->where('playerid', $pid)->first();

			// Gestion du parse
			$suppr = array("\"", "`", "[", "]");
			$lineLicenses = str_replace($suppr, "", $rows->civ_licenses);
			$arrayLicenses = preg_split("/,/", $lineLicenses);
			$totarrayLicenses = count($arrayLicenses);
			$y = 0;
			$n = 0;

			// test
			for ($i = 1; $y < $totarrayLicenses; $i++) {
				// Reconstruction du contenu de civ_licenses pour Arma

				// Début
				if ($n == $id && $y == 0) {
					$licenses_arma[] = "\"[[`" . $arrayLicenses[$y] . "`," . $status . "],";
				} elseif ($n == 0 && $id !== $n) {
					$licenses_arma[] = "\"[[`" . $arrayLicenses[$y] . "`," . $arrayLicenses[$i] . "],";
				}

				// Millieux
				if ($n == $id && $n !== 0 && $y !== ($totarrayLicenses - 2)) {
					$licenses_arma[] = "[`" . $arrayLicenses[$y] . "`," . $status . "],";
				} elseif ($n !== $id && $y !== 0 && $y !== ($totarrayLicenses - 2)) {
					$licenses_arma[] = "[`" . $arrayLicenses[$y] . "`," . $arrayLicenses[$i] . "],";
				}

				// Fin
				if ($n == $id && $y == ($totarrayLicenses - 2)) {
					$licenses_arma[] = "[`" . $arrayLicenses[$y] . "`," . $status . "]]\"";
				} elseif ($n !== $id && $y == ($totarrayLicenses - 2)) {
					$licenses_arma[] = "[`" . $arrayLicenses[$y] . "`," . $arrayLicenses[$i] . "]]\"";
				}

				// Pair
				$y = $y + 2;
				// Impair
				$i = $i + 1;
				// Normal
				$n = $n + 1;
			}
			// transformation de l'array en chaîne
			// die('implode');
			$civ_licenses = implode($licenses_arma);

			// var_dump($civ_licenses);die();
			// Maj
			DB::table('players')
				->where('playerid', $pid)
				->update(array(
					'civ_licenses' => $civ_licenses,
				));

			// Retour
			if ($status == 0) {
				echo $status . ";non actif -> $pid | ID -> $id";
			} elseif ($status == 1) {
				echo $status . ";actif -> $pid | ID -> $id";
			} elseif (empty($status)) {
				echo 1;
			}

		}
	}
}
