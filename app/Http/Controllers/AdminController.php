<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Input;

use App\Paypal;
use App\Players;
use App\Ranks;
use App\Settings;
use App\Supports;
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
		$players_money = DB::table('players')->orderBy('bankacc', 'desc')->take(15)->get();
		$users = DB::table('users')->count();
		$news = DB::table('news')->count();

		$paypal = DB::table('paypals')->orderBy('id', 'desc')->take(4)->get();

		return view('admin.index', compact('user', 'players', 'players_last', 'users', 'news', 'paypal', 'players_money'));
	}

	public function joueur()
	{
		$user = $this->auth->user();
		$players = DB::table('players')->orderBy('uid', 'desc')->paginate(15);
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
		$offenses = DB::table('offenses')->where('arma_id', $id)->get();

		$vehicles_cars = DB::table('vehicles')->where('pid', $id)->where('type', 'Car')->get();
		$vehicles_airs = DB::table('vehicles')->where('pid', $id)->where('type', 'Air')->get();
		$vehicles_ships = DB::table('vehicles')->where('pid', $id)->where('type', 'Ship')->get();

		$ranks_cop = DB::table('ranks')->where('side', 'COP')->get();
		$ranks_medic = DB::table('ranks')->where('side', 'MEDIC')->get();
		$ranks_admin = DB::table('ranks')->where('side', 'ADMIN')->get();

		$insure = DB::table('settings')->where('name', 'insure')->first();
		$alias = DB::table('settings')->where('name', 'alias')->first();

		$houses = DB::table('houses')->where('pid', $id)->get();

		$licensesName = DB::table('settings')->where('action', 'LICENSES')->get();


		$gang = DB::table('gangs')->where('owner', $id)->first();

		return view('admin.players.show', compact('alias','houses', 'licensesName', 'insure', 'ranks_admin', 'ranks_cop', 'ranks_medic', 'offenses', 'user', 'player', 'vehicles_cars', 'vehicles_airs', 'vehicles_ships', 'gang', 'user_show'));

	}

	public function updatePlayer($id, Request $request)
	{
		if($request->get("give")){
			if($request->get("give") >= 1) {
				$amount = $request->get("give");


				$user_show = DB::table('players')->where('playerid', $id)->first();

				$amount = $user_show->bankacc + $amount;

				DB::table('players')
					->where('playerid', $id)
					->update(array(
						'bankacc' => $amount
					));
				return redirect(url('admin/player/' . $id))->with('success', 'L\'argent à bien été créditer');
			}else {
				return redirect(url('admin/player/' . $id))->with('error', 'Veuillez saisir un nombre positif');
			}
		}elseif($request->get("take")){
			if($request->get("take") >= 1) {
				$amount = $request->get("take");

				$user_show = DB::table('players')->where('playerid', $id)->first();

				$amount = $user_show->bankacc - $amount;

				if($amount <= 0){
					$amount = 0;
				}

				DB::table('players')
					->where('playerid', $id)
					->update(array(
						'bankacc' => $amount
					));

				return redirect(url('admin/player/' . $id))->with('success', 'L\'argent à bien été retiré');
			}else {
				return redirect(url('admin/player/' . $id))->with('error', 'Veuillez saisir un nombre positif');
			}
		}else {
			$admin = $request->get("admin");
			$policier = $request->get("policier");
			$medic = $request->get("medic");
			$donator = $request->get("donator");
			$duredon = $request->get("duredon");


			$user_show = DB::table('players')->where('playerid', $id)->first();

			if($duredon != $user_show->duredon){
				$timestamp = time();
			}else{
				$timestamp = $user_show->timestamp;
			}

			$alias = DB::table('settings')->where('name', 'alias')->first();

			if($alias && $alias->value_associated == 1){
				$username = $request->get("username");
				$username = rtrim($username);

				if(env('DB_EXTDB') == 2){
					$alias_name = '"[["' . $username . '"]]"';
				}elseif(env('DB_EXTDB') == 1){
					$alias_name = '"[`' . $username . '`]"';
				}

				DB::table('players')
					->where('playerid', $id)
					->update(array(
						'name' => $username,
						'adminlevel' => $admin,
						'coplevel' => $policier,
						'mediclevel' => $medic,
						'donatorlvl' => $donator,
						'duredon' => $duredon,
						'timestamp' => $timestamp,
						'aliases' => $alias_name
					));
			}else{
				DB::table('players')
					->where('playerid', $id)
					->update(array(
						'adminlevel' => $admin,
						'coplevel' => $policier,
						'mediclevel' => $medic,
						'donatorlvl' => $donator,
						'duredon' => $duredon,
						'timestamp' => $timestamp
					));
			}

			return redirect(url('admin/player/' . $id))->with('success', 'Le joueur à bien été modifié');
		}
	}

	public function search()
	{
		$q = Input::get('q');
		if (empty($q)) {
			return redirect(action('AdminController@index'))->with('error', 'Le champ de recherche est vide');
		}
		$user = $this->auth->user();

		if (filter_var($q, FILTER_VALIDATE_EMAIL)) {
			$user_show = DB::table('users')->where('email', $q)->first();

			if(empty($user_show)){
				return redirect(action('AdminController@index'))->with('error', 'Aucun utilisateur n\'a été trouver');
			}

			return redirect(url('admin/user/' . $user_show->id));
		}else {
			$players = DB::table('players')->where('name', 'LIKE', '%' . $q . '%')->OrWhere('playerid', $q)->paginate(10);

			return view('admin.players.search', compact('user', 'players', 'q'));
		}
	}

	public function users()
	{
		$user = $this->auth->user();
		$users = DB::table('users')->orderBy('id', 'desc')->paginate(15);
		return view('admin.users.index', compact('user', 'users'));
	}

	public function userShow($id)
	{
		$user = $this->auth->user();
		$user_show = DB::table('users')->where('id', $id)->first();

		return view('admin.users.show', compact('user', 'user_show'));
	}

	public function userUpdate($id, Request $request)
	{
		$name = $request->get("username");
		$firstname = $request->get("firstname");
		$lastname = $request->get("lastname");
		$email = $request->get("email");
		$admin = $request->get("rank_website");
		$arma = $request->get("arma");

		if(empty($email)){
			return redirect(url('admin/user/' . $id))->with('error', 'Le champs email est vide !');
		}else{

			DB::table('users')
				->where('id', $id)
				->update(array(
					'name' => $name,
					'firstname' => $firstname,
					'lastname' => $lastname,
					'email'=> $email,
					'admin' => $admin,
					'arma' => $arma
				));

			return redirect(url('admin/user/' . $id))->with('success', 'L\'utilisateur à bien été modifié');
		}


	}

	public function paypal()
	{
		$user = $this->auth->user();
		$logs = Paypal::all();

		return view('admin.paypal.index', compact('user', 'logs'));
	}

	public function updateUser($id, Request $request)
	{
		$admin = $request->get("rank_website");
		$id_user = $request->get('id');

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
		$gangs = DB::table('gangs')->orderBy('id', 'desc')->paginate(15);
		$PlayersName = DB::table('players')->get();
		return view('admin.gangs.index', compact('user', 'gangs', 'PlayersName'));
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
			if(env('DB_EXTDB') == 1) {
				$gangMembersString = '[';
			}elseif(env('DB_EXTDB') == 2){
				$gangMembersString = '""[';
			}
			$gangList = "";
			foreach ($gangMembers as $gangMember) {
				if ($gangMember != $userId) {
					$gangList .= "`" . $gangMember . "`,";
				}
			}
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
			$group = $request->get('group');

			if (is_numeric($status) == false || is_numeric($pid) == false) {
				echo "2;not a number !";
				exit();
			}

			if ($status == 0) {
				$status = $status + 1;
			} else {
				$status = $status - 1;
			}

			$rows = DB::table('players')->where('playerid', $pid)->first();

			if($group == 'civ'){
				$table = $rows->civ_licenses;
				$line = 'civ_licenses';
			}elseif($group == 'cop') {
				$table = $rows->cop_licenses;
				$line = 'cop_licenses';
			}elseif($group == 'med'){
				$table = $rows->med_licenses;
				$line = 'med_licenses';
			}

			$suppr = array("\"", "`", "[", "]");
			$lineLicenses = str_replace($suppr, "", $table);
			$arrayLicenses = preg_split("/,/", $lineLicenses);
			$totarrayLicenses = count($arrayLicenses);
			$y = 0;
			$n = 0;

			if($totarrayLicenses == 2) {
				$licenses = "[[\"$arrayLicenses[0],$status]]";
			}else {
				for ($i = 1; $y < $totarrayLicenses; $i++) {

					if ($n == $id && $y == 0) {
						if(env('DB_EXTDB') == 1) {
							$licenses_arma[] = "[[`" . $arrayLicenses[$y] . "`," . $status . "],";
						}elseif(env('DB_EXTDB') == 2){
							$licenses_arma[] = "\"[[`" . $arrayLicenses[$y] . "`," . $status . "],";
						}
					} elseif ($n == 0 && $id !== $n) {
						if(env('DB_EXTDB') == 1) {
							$licenses_arma[] = "[[`" . $arrayLicenses[$y] . "`," . $arrayLicenses[$i] . "],";
						}elseif(env('DB_EXTDB') == 2){
							$licenses_arma[] = "\"[[`" . $arrayLicenses[$y] . "`," . $arrayLicenses[$i] . "],";
						}

					}

					if ($n == $id && $n !== 0 && $y !== ($totarrayLicenses - 2)) {
						$licenses_arma[] = "[`" . $arrayLicenses[$y] . "`," . $status . "],";
					} elseif ($n !== $id && $y !== 0 && $y !== ($totarrayLicenses - 2)) {
						$licenses_arma[] = "[`" . $arrayLicenses[$y] . "`," . $arrayLicenses[$i] . "],";
					}

					if ($n == $id && $y == ($totarrayLicenses - 2)) {
						if(env('DB_EXTDB') == 1) {
							$licenses_arma[] = "[`" . $arrayLicenses[$y] . "`," . $status . "]]";
						}elseif(env('DB_EXTDB') == 2){
							$licenses_arma[] = "[`" . $arrayLicenses[$y] . "`," . $status . "]]\"";
						}
					} elseif ($n !== $id && $y == ($totarrayLicenses - 2)) {
						if(env('DB_EXTDB') == 1) {
							$licenses_arma[] = "[`" . $arrayLicenses[$y] . "`," . $arrayLicenses[$i] . "]]";
						}elseif(env('DB_EXTDB') == 2){
							$licenses_arma[] = "[`" . $arrayLicenses[$y] . "`," . $arrayLicenses[$i] . "]]\"";
						}
					}

					$y = $y + 2;
					$i = $i + 1;
					$n = $n + 1;
				}
				$licenses = implode($licenses_arma);
			}

			DB::table('players')
				->where('playerid', $pid)
				->update(array(
					$line => $licenses,
				));


			if ($status == 0) {
				echo $status . ";non actif -> $pid | ID -> $id";
			} elseif ($status == 1) {
				echo $status . ";actif -> $pid | ID -> $id";
			} elseif (empty($status)) {
				echo 1;
			}

		}
	}

	public function refunds()
	{
		$user = $this->auth->user();
		$refunds = DB::table('refunds')->orderBy('id', 'desc')->paginate(15);

		return view('admin.refunds.index', compact('user', 'refunds'));
	}

	public function refundsShow($id)
	{
		$user = $this->auth->user();
		$refund = DB::table('refunds')->where('id', $id)->first();


		return view('admin.refunds.show', compact('user', 'refund'));
	}

	public function refundsUpdate($id, Request $request)
	{
		$user = $this->auth->user();
		$refund = DB::table('refunds')->where('id', $id)->first();
		$player = DB::table('players')->where('playerid', $refund->playerid)->first();

		if($request->get('status') == 2){
			$amount = $player->bankacc + $refund->amount;

			DB::table('players')
				->where('playerid', $refund->playerid)
				->update(array(
					'bankacc' => $amount,
				));

			DB::table('refunds')
				->where('id', $id)
				->update(array(
					'status' => 2,
				));

			return redirect(url('admin/remboursement/'))->with('success', 'Remboursement effectué');

		}elseif($request->get('status') == 1){
			DB::table('refunds')
				->where('id', $id)
				->update(array(
					'status' => 1,
				));
			return redirect(url('admin/remboursement/'))->with('error', 'Remboursement refusé');
		}

		return view('admin.refunds.show', compact('user', 'refund'));
	}

	public function vehicule($id){
		$user = $this->auth->user();

		$vehicule = DB::table('vehicles')->where('id', $id)->first();
		$owner = DB::table('players')->where('playerid', $vehicule->pid)->first();
		$allPlayers = DB::table('players')->get();

		return view('admin.vehicles.show', compact('vehicule', 'user', 'allPlayers', 'owner'));
	}

	public function vehicule_update($id, Request $request){
		$new_owner = $request->get("playerid");
		$vehicule = DB::table('vehicles')->where('id', $id)->first();
		DB::table('vehicles')
			->where('id', $id)
			->update(array(
				'pid' => $new_owner,
			));

		return redirect(url('admin/player/'. $vehicule->pid))->with('success', 'Véhicule transférer !');
	}

	public function vehicule_delete(Request $request){
		$id = $request->get("id");
		$vehicule = DB::table('vehicles')->where('id', $id)->first();

		DB::table('vehicles')->where('id', $id)->delete();

		return redirect(url('admin/player/'. $vehicule->pid))->with('success', 'Véhicule supprimer !');
	}

	public function settings(){
		$user = $this->auth->user();
		$ranks_cop = DB::table('ranks')->where('side', 'COP')->get();
		$ranks_medic = DB::table('ranks')->where('side', 'MEDIC')->get();
		$ranks_admin = DB::table('ranks')->where('side', 'ADMIN')->get();

		$licenses = DB::table('settings')->where('action', 'LICENSES')->get();
		$insure = DB::table('settings')->where('name', 'insure')->first();
		$alias = DB::table('settings')->where('name', 'alias')->first();

		return view('admin.settings.index', compact('alias', 'licenses', 'insure', 'ranks_admin', 'user', 'ranks_cop', 'ranks_medic'));
	}

	public function settingsUpdate(Request $request){
		if($request->get("side")){
			$value = $request->get("value_associated");
			$name = $request->get("name");
			$side = $request->get("side");

			$ranks = New Ranks();
			$ranks->side = $side;
			$ranks->value_associated = $value;
			$ranks->name = $name;
			$ranks->save();

			return redirect(action('AdminController@settings'))->with('success', 'Le grade à bien été créer');

		}elseif($request->get("action") == 'LICENSES'){

				$value = $request->get("value_associated");
				$name = $request->get("name");
				$action = $request->get("action");
				$settings = New Settings();
				$settings->action = $action;
				$settings->value_associated = $value;
				$settings->name = $name;
				$settings->save();

			return redirect(action('AdminController@settings'))->with('success', 'L\'action à bien été effectuer');

		}

	}

	public function settingParam(Request $request)
	{
		$value = $request->get('insure_var');

		$insure = DB::table('settings')->where('name', 'insure')->first();

		if($insure && $insure->value_associated == 1 OR $insure && $insure->value_associated == 0){

			if($value){
				DB::table('settings')
					->where('name', 'insure')
					->update(array(
						'value_associated' => 1,
					));
			}else{
				DB::table('settings')
					->where('name', 'insure')
					->update(array(
						'value_associated' => 0,
					));
			}

		}else{
			$settings = New Settings();
			$settings->action = 'SETTINGS';
			$settings->value_associated = $value;
			$settings->name = 'insure';
			$settings->save();
		}

		$alias_name = $request->get('alias_name');
		$alias = DB::table('settings')->where('name', 'alias')->first();

		if($alias && $alias->value_associated == 1 OR $alias && $alias->value_associated == 0){

			if($alias_name){
				DB::table('settings')
					->where('name', 'alias')
					->update(array(
						'value_associated' => 1,
					));
			}else{
				DB::table('settings')
					->where('name', 'alias')
					->update(array(
						'value_associated' => 0,
					));
			}

		}else{
			$settings = New Settings();
			$settings->action = 'SETTINGS';
			$settings->value_associated = $alias_name;
			$settings->name = 'alias';
			$settings->save();
		}

		return redirect(action('AdminController@settings'))->with('success', 'L\'action à bien été effectuer');

	}

	public function settingDestroy($id, Request $request)
	{
		if($request->get("action") == 'ranks'){

			$rank = Ranks::findOrFail($id);
			$rank->delete();
			return redirect(action('AdminController@settings'))->with('success', 'Le grade à bien été supprimer');
		}elseif($request->get("action") == 'settings'){

			$setting = Settings::findOrFail($id);
			$setting->delete();
			return redirect(action('AdminController@settings'))->with('success', 'L\'action à bien été effectuer');
		}
	}

	public function removePlayer(Request $request){
		$pid = $request->get("pid");

		if(env('DB_EXTDB') == 1) {
			$gear = '[]';
		}elseif(env('DB_EXTDB') == 2){
			$gear = '"[]"';
		}

		DB::table('players')
			->where('playerid', $pid)
			->update(array(
				'civ_gear' => $gear,
			));

		return redirect(url('admin/player/' . $pid))->with('success', 'L\'inventaire civil à bien été vider !');
	}

	public function house()
	{
		$user = $this->auth->user();
		$PlayersName = DB::table('players')->get();
		$houses = DB::table('houses')->orderBy('id', 'desc')->paginate(15);

		return view('admin.houses.index', compact('user', 'PlayersName', 'houses'));
	}

	public function support(){
		$user = $this->auth->user();
		$Allusers = DB::table('users')->get();
		$supports = DB::table('supports')->orderBy('id', 'desc')->where('message', 1)->paginate(15);

		return view('admin.supports.index', compact('user', 'supports', 'Allusers'));
	}

	public function support_show($id){
		$user = $this->auth->user();
		$ticket = DB::table('supports')->where('id', $id)->where('message', 1)->first();
		$Allusers = DB::table('users')->get();
		$responses = Supports::where('reply', 1)->where('associated', $id)->get();

		return view('admin.supports.show', compact('ticket', 'user', 'Allusers', 'responses'));
	}

	public function close($id){
		DB::table('supports')
			->where('id', $id)
			->update(array(
				'etat' => 2,
			));
		return redirect(url('admin/support/' . $id))->with('success', 'Le ticket à bien été fermer !');
	}

	public function open($id){
		DB::table('supports')
			->where('id', $id)
			->update(array(
				'etat' => 1,
			));
		return redirect(url('admin/support/' . $id))->with('success', 'Le ticket à bien été réouvert !');
	}

	public function reply($id, Request $request){
		$content = $request->get("content");

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
		return redirect(url('admin/support/' . $id))->with('success', 'La réponse à bien été envoyer !');
	}

}
