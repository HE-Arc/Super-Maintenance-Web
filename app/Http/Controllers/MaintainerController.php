<?php

namespace App\Http\Controllers;

use App\Maintainer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class MaintainerController extends Controller{

    public function createMaintainer(Request $request){
        $maintainer = Maintainer::create($request->all());

        return response()->json($maintainer);
    }

    public function updateMaintainer(Request $request, $id){
        $maintainer  = DB::table('maintainers')->where('pid', $request->input('pid'))->get();

        $maintainer->lastname = $request->input('lastname');
        $maintainer->firstname = $request->input('firstname');
        $maintainer->save();

        $response["maintainers"] = $maintainer;
        $response["success"] = 1;

        return response()->json($response);
    }  

    public function deleteMaintainer($id){
        $maintainer = DB::table('maintainers')->where('pid', $request->input('pid'))->get();
        $maintainer->delete();

        return response()->json('Removed successfully.');
    }

    public function index(){
        $maintainers  = Maintainer::all();

        $response["maintainers"] = $maintainers;
        $response["success"] = 1;

        return response()->json($response);
    }

}