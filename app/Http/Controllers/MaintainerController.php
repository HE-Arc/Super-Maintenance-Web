<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maintainer;
use DB;

class MaintainerController extends Controller{

    public function getMaintainerById(Request $request, $id)
    {
        $maintainer = DB::table('maintainers')->where('id', $id)->get();

        $response["maintainer"] = $maintainer;
        $response["success"] = 1;

        return response()->json($response);
    }
    
    public function createMaintainer(Request $request){
        $maintainer = new Maintainer($request->all());
        $maintainer->save();

        return response()->json($maintainer);
    }

    public function updateMaintainer(Request $request, $id){
        $maintainer = DB::table('maintainers')->where('id', $id)->update([
                        'name' => $request['name'],
                        'first_name' => $request['first_name'],
                        ]);

        $response["maintainer"] = $maintainer;
        $response["success"] = 1;

        return response()->json($response);
    }  

    public function deleteMaintainer($id){
        $maintainer = DB::table('maintainers')->where('id', $id)->delete();

        return response()->json('Removed successfully.');
    }

    public function index(){
        $maintainers = DB::table('maintainers')->get();

        $response["maintainers"] = $maintainers;
        $response["success"] = 1;

        return response()->json($response);
    }

}
