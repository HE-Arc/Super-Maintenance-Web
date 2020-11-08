<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maintain;
use DB;

class MaintainController extends Controller{

    public function createMaintain(Request $request){
        // $maintain = Maintain::create($request->all());
        // return response()->json($maintain);
        $maintain = new Maintain();
        $maintain->id_machine = $request['id_machine'];
        $maintain->id_maintainer = $request['id_maintainer'];
        $maintain->start_date = $request['start_date'];
        $maintain->end_date = $request['end_date'];
        $maintain->save();

        $response["maintains"] = $maintain;
        $response["success"] = 1;

        return response()->json($response);
    }

    public function updateMaintain(Request $request, $id){
        DB::table('maintains')->where('id', $id)->update([
            'id_machine' => $request['id_machine'],
            'id_maintainer' => $request['id_maintainer'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date']
            ]);

        $response["maintain"] = DB::table('maintains')->where('id', $id)->get();
        $response["success"] = 1;
        return response()->json($response);
    }  

    public function deleteMaintain($id){
        $maintain = DB::table('maintains')->where('id', $request->input('id'))->get();
        $maintain->delete();

        return response()->json('Removed successfully.');
    }

    public function index(){
        $maintains  = Maintain::all();

        $response["maintains"] = $maintains;
        $response["success"] = 1;

        return response()->json($response);
    }

}
