<?php

namespace App\Http\Controllers;

use App\Maintain;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class MaintainController extends Controller{

    public function createMaintain(Request $request){
        $maintain = Maintain::create($request->all());

        return response()->json($maintain);
    }

    public function updateMaintain(Request $request, $id){
        $maintain  = DB::table('maintains')->where('pid', $request->input('pid'))->get();

        //$maintain->lastname = $request->input('lastname');
        //$maintain->firstname = $request->input('firstname');
        $maintain->save();

        $response["maintains"] = $maintain;
        $response["success"] = 1;

        return response()->json($response);
    }  

    public function deleteMaintain($id){
        $maintain = DB::table('maintains')->where('pid', $request->input('pid'))->get();
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
