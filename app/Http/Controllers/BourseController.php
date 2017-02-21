<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BourseController extends Controller {

	public function index() {
		$bourse_db = DB::table('dynmarket')->get();
        $suppr = array("\"", "\"", "[", "]");
        $lineBourse = str_replace($suppr, "", $bourse_db[0]->prices);
        $arrayBourse = preg_split("/,/", $lineBourse);
		$totarraybourse = count($arrayBourse);
        $y = 0;
        $n = 2;
		$bourse = array();
        for($i = 1; $y < $totarraybourse; $i++){
			$bourse[$y]['name'] = $arrayBourse[$y];
			$bourse[$y]['actual'] = $arrayBourse[$i];
			$bourse[$y]['deuxieme'] = $arrayBourse[$n];

			$y = $y + 3;
			$i = $i + 2;
			$n = $n + 3;
		}
		return view('bourse.index', compact('bourse'));
	}
}
