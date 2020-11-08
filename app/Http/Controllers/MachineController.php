<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Machine;
use DB;

class MachineController extends Controller{

    public function getMachineById(Request $request, $id)
    {
        $machine = DB::table('machines')->where('id', $id)->get();

        $response["machine"] = $machine;
        $response["success"] = 1;

        return response()->json($response);
	}
	
	public function index()
    {
        $machines = DB::table('machines')->get();

        $response["machines"] = $machines;
        $response["success"] = 1;

        return response()->json($response);
    }
}
