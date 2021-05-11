<?php

use Illuminate\Http\Request;


class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function agruparAsociadas()
	{
		$asociadas = Input::get("data");

		$dist = [];
		foreach($asociadas as $a => $d ){
			if(!key_exists($d,$dist)){
				$dist[$d] = [];
			}
			array_push($dist[$d],$a);
		}

		return $dist;
	}



	public function inegi()
	{
		$data = Input::get("data");
		$minYear = 9999;
		$maxYear = 0;
		$livePeople = [];
		$maxLive = 0;
		foreach($data as $years){
			$minYear = min($minYear, $years[0]);
			$maxYear = max($maxYear, $years[1]);
		}
		for($year = $minYear; $year <= $maxYear ; $year++){
			$livePeople[$year] = 0;
			foreach($data as $years) {
				if(   $year >= $years[0] && $year<= $years[1] ){
					$livePeople[$year] ++ ;
				}
			}
			$maxLive = max($maxLive, $livePeople[$year]);
		}

		foreach( $livePeople as $year => $people ){
			if($people == $maxLive){
				return ["result"=>$year];
			}
		}
	}

}
