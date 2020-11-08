<?php

namespace App\Http\Controllers;

use App\Models\Task;

use Illuminate\Http\Request;
use DB;

class TaskController extends Controller{

	public function getTaskByMachineId(Request $request, $id_machine)
	{
		$tasks = DB::table('tasks')->where('id_machine', $id_machine)->get();

		$response["tasks"] = $tasks;
		$response["success"] = 1;

		return response()->json($response);
	}
}
