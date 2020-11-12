<?php

namespace App\Http\Controllers;

use App\Models\Statistic;

use Illuminate\Http\Request;
use DB;

class StatisticController extends Controller{

	public function getStatisticByMachineId(Request $request, $id_machine)
	{
		$statistics = DB::table('statistics')->where('id_machine', $id_machine)->get();

		$response["statistics"] = $statistics;
		$response["success"] = 1;

		return response()->json($response);
	}

	public function getStatisticById(Request $request, $id)
	{
		$statistic = DB::table('statistics')->where('id', $id)->get();

		$response["statistic"] = $statistic;
		$response["success"] = 1;

		return response()->json($response);
	}
	
}
