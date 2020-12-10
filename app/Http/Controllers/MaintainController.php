<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maintain;
use DB;

class MaintainController extends Controller{

    public function getMaintainById(Request $request, $id)
    {
        $maintain = DB::table('maintains')
            ->join('machines', 'maintains.id_machine', '=', 'machines.id')
            ->select('maintains.*', 'machines.name as machine_name')
            ->where('maintains.id', $id)
            ->get();

        $response["maintain"] = $maintain;
        $response["success"] = 1;

        return response()->json($response);
    }

    public function createMaintain(Request $request)
    {
        $maintain = Maintain::create($request->all());
        //$maintain->save();

        $response["maintains"] = $maintain;
        $response["success"] = 1;

        return response()->json($response);
    }

    public function updateMaintain(Request $request, $id)
    {
        $maintain = DB::table('maintains')->where('id', $id)->update([
            'id_machine' => $request['id_machine'],
            'id_maintainer' => $request['id_maintainer'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'planned_at' => $request['planned_at']
            ]);

        $response["maintain"] = $maintain;
        $response["success"] = 1;
        return response()->json($response);
    }  

    public function deleteMaintain($id)
    {
        $maintain = DB::table('maintains')->where('id', $id)->delete();

        return response()->json('Removed successfully.');
    }

    public function getMaintainsByMachine($id)
    {
        $maintains = DB::table('maintains')->where('id_machine', $id)->get();

        $response["maintains"] = $maintains;
        $response["success"] = 1;

        return response()->json($response);
    }

    public function index()
    {
        // $maintains  = Maintain::all();
        $maintains = DB::table('maintains')
            ->join('machines', 'maintains.id_machine', '=', 'machines.id')
            ->select('maintains.*', 'machines.name as machine_name')
            ->get();

        $response["maintains"] = $maintains;
        $response["success"] = 1;

        return response()->json($response);
    }

    public function getUnresolvedMaintainByMaintainerId(Request $request, $id_maintainer)
    {
        $maintains = DB::table('maintains')
            ->join('machines', 'maintains.id_machine', '=', 'machines.id')
            ->where('end_date', null)
            ->where('id_maintainer', $id_maintainer)
            ->select('maintains.*', 'machines.name as machine_name')
            ->get();

        $response["maintains"] = $maintains;
        $response["success"] = 1;

        return response()->json($response);
    }

}
