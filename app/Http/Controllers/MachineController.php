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

    public function getMachineAndTroubleshooting()
    {
        $machines = DB::table('machines')
        ->leftjoin('troubleshooting_reports', function ($join){
            $join->on('troubleshooting_reports.id_machine', '=', 'machines.id')
            ->where('troubleshooting_reports.resolved', '=', false);
        })
        ->leftjoin('maintainers', 'maintainers.id', '=', 'troubleshooting_reports.id_maintainer')
        ->select('machines.*',
                 'troubleshooting_reports.id as troubleshooting_reports_id',
                 'troubleshooting_reports.resolved',
                 'troubleshooting_reports.id_maintainer',
                 'maintainers.name as maintainer_name')
        ->get();

        $response["machines"] = $machines;
        $response["success"] = 1;

        return response()->json($response);
    }

    public function updateMachine(Request $request, $id)
    {
        $machine = DB::table('machines')->where('id', $id)->update([
            'name' => $request['name'],
            'state' => $request['state'],
            'location' => $request['location']
            ]);

        $response["machine"] = $machine;
        $response["success"] = 1;
        return response()->json($response);
    }
}
