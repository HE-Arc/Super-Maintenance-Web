<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maintain;
use Illuminate\Support\Facades\Validator;
use DB;

class MaintainController extends Controller{

    public function getMaintainById($id)
    {
        if(ctype_digit($id))
        {
            $maintain = DB::table('maintains')
                ->join('machines', 'maintains.id_machine', '=', 'machines.id')
                ->select('maintains.*', 'machines.name as machine_name')
                ->where('maintains.id', $id)
                ->get();

            $response["maintain"] = $maintain;
            $response["success"] = 1;
        }
        else
        {
            $response["success"] = 0;
        }

        return response()->json($response);
    }

    public function createMaintain(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'id_machine' => 'required|integer',
            'id_maintainer' => 'required|integer',
            'start_date' => 'nullable|date',
            'start_date' => 'nullable|date',
            'planned_at' => 'required|date'
        ]);

        if ($validator->fails()) {
            $response["success"] = 0;
            return response()->json($response);
        }

        $maintain = Maintain::create($request->all());

        $response["maintains"] = $maintain;
        $response["success"] = 1;

        return response()->json($response);
    }

    public function updateMaintain(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_machine' => 'required|integer',
            'id_maintainer' => 'required|integer',
            'start_date' => 'nullable|date',
            'start_date' => 'nullable|date',
            'planned_at' => 'required|date'
        ]);

        if ($validator->fails() || !ctype_digit($id))
        {
            $response["success"] = 0;
            return response()->json($response);
        }

        $maintain = DB::table('maintains')->where('id', $id)->update([
            'id_machine' => $request['id_machine'],
            'id_maintainer' => $request['id_maintainer'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'planned_at' => $request['planned_at']
            ]);

        $response["success"] = 1;

        return response()->json($response);
    }  

    public function deleteMaintain($id)
    {
        if (ctype_digit($id))
        {
            $maintain = DB::table('maintains')->where('id', $id)->delete();
            $response["success"] = 1;
        }
        else
        {
            $response["success"] = 0;
        }

        return response()->json($response);
    }

    public function getMaintainsByMachine($id)
    {
        if(ctype_digit($id))
        {
            $maintains = DB::table('maintains')->where('id_machine', $id)->orderBy('planned_at', 'desc')->get();

            $response["maintains"] = $maintains;
            $response["success"] = 1;
        }
        else
        {
            $response["success"] = 0;
        }

        return response()->json($response);
    }

    public function index()
    {
        $maintains = DB::table('maintains')
            ->join('machines', 'maintains.id_machine', '=', 'machines.id')
            ->select('maintains.*', 'machines.name as machine_name')
            ->orderBy('planned_at', 'desc')
            ->get();

        $response["maintains"] = $maintains;
        $response["success"] = 1;

        return response()->json($response);
    }

    public function getUnresolvedMaintainByMaintainerId($id_maintainer)
    {
        
        if (ctype_digit($id_maintainer))
        {
            $maintains = DB::table('maintains')
            ->join('machines', 'maintains.id_machine', '=', 'machines.id')
            ->where('end_date', null)
            ->where('id_maintainer', $id_maintainer)
            ->select('maintains.*', 'machines.name as machine_name')
            ->get();

            $response["maintains"] = $maintains;
            $response["success"] = 1;
        }
        else
        {
            $response["success"] = 0;
        }

        return response()->json($response);
    }

}
