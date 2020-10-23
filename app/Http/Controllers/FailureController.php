<?php

namespace App\Http\Controllers;

use App\Failure;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class FailureController extends Controller{

    public function createFailure(Request $request){
        $failure = Failure::create($request->all());

        return response()->json($failure);
    }

    public function updateFailure(Request $request, $id){
        $failure  = DB::table('failures')->where('pid', $request->input('pid'))->get();

        //$failure->lastname = $request->input('lastname');
        //$failure->firstname = $request->input('firstname');
        $failure->save();

        $response["failures"] = $failure;
        $response["success"] = 1;

        return response()->json($response);
    }  

    public function deleteFailure($id){
        $failure = DB::table('failures')->where('pid', $request->input('pid'))->get();
        $failure->delete();

        return response()->json('Removed successfully.');
    }

    public function index(){
        $failures  = Failure::all();

        $response["failures"] = $failures;
        $response["success"] = 1;

        return response()->json($response);
    }

}
