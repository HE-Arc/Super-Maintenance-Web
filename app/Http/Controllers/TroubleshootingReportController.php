<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TroubleshootingReport;
use DB;

class TroubleshootingReportController extends Controller{

	public function getTroubleshootingReportById($id)
    {
        $troubleshootingReport = DB::table('troubleshooting_reports')
            ->join('machines', 'troubleshooting_reports.id_machine', '=', 'machines.id')
            ->select('troubleshooting_reports.*', 'machines.name as machine_name')
            ->where('troubleshooting_reports.id', $id)
            ->get();

        $response["troubleshootingReport"] = $troubleshootingReport;
        $response["success"] = 1;

        return response()->json($response);
	}
	
	public function createTroubleshootingReport(Request $request)
    {
        $validated = $request->validate([
            'id_machine' => 'required|integer',
            'id_maintainer' => 'required|integer',
            'end_date' => 'nullable|date',
            'troubleshooting_description' => 'nullable|string',
            'troubleshooting_hypotesis' => 'nullable|string',
            'troubleshooting_check' => 'nullable|string',
            'repairs_actions' => 'nullable|string',
            'piece_to_change' => 'nullable|string',
            'piece_photo' => 'nullable|string',
            'resolved' => 'nullable|bool',
        ]);
        $troubleshootingReport = new TroubleshootingReport($request->all());
        $troubleshootingReport->save();

        $response["troubleshootingReport"] = $troubleshootingReport;
        $response["success"] = 1;

        return response()->json($response);
	}

	public function updateTroubleshootingReport(Request $request, $id)
    {
        $validated = $request->validate([
            'id_machine' => 'required|integer',
            'id_maintainer' => 'required|integer',
            'end_date' => 'nullable|date',
            'troubleshooting_description' => 'nullable|string',
            'troubleshooting_hypotesis' => 'nullable|string',
            'troubleshooting_check' => 'nullable|string',
            'repairs_actions' => 'nullable|string',
            'piece_to_change' => 'nullable|string',
            'piece_photo' => 'nullable|string',
            'resolved' => 'nullable|bool',
        ]);

        DB::table('troubleshooting_reports')->where('id', $id)->update([
            'id_machine' => $request['id_machine'],
            'id_maintainer' => $request['id_maintainer'],
            'start_date' => $request['start_date'],
			'end_date' => $request['end_date'],
			'troubleshooting_description' => $request['troubleshooting_description'],
			'troubleshooting_hypotesis' => $request['troubleshooting_hypotesis'],
			'troubleshooting_check' => $request['troubleshooting_check'],
			'repairs_actions' => $request['repairs_actions'],
			'piece_to_change' => $request['piece_to_change'],
			'piece_photo' => $request['piece_photo'],
			'resolved' => $request['resolved']
            ]);

        $response["troubleshootingReport"] = DB::table('troubleshooting_reports')->where('id', $id)->get();
        $response["success"] = 1;
        return response()->json($response);
    } 


	public function deleteTroubleshootingReport($id)
    {
        DB::table('troubleshooting_reports')->where('id', $id)->delete();

        return response()->json('Removed successfully.');
    }

    public function getTroubleshootingReportsByMachine($id)
    {
        $troubleshootingReports = DB::table('troubleshooting_reports')->where('id_machine', $id)->orderBy('start_date', 'desc')->get();

        $response["troubleshooting_reports"] = $troubleshootingReports;
        $response["success"] = 1;

        return response()->json($response);
    }
	
	public function index()
    {
        $troubleshootingReports = DB::table('troubleshooting_reports')->orderBy('start_date', 'desc')->get();

        $response["troubleshooting_reports"] = $troubleshootingReports;
        $response["success"] = 1;

        return response()->json($response);
    }

    public function getUnresolvedTRByMaintainerId($id_maintainer)
    {
        $troubleshootingReports = DB::table('troubleshooting_reports')
            ->join('machines', 'troubleshooting_reports.id_machine', '=', 'machines.id')
            ->where('resolved', false)
            ->where('id_maintainer', $id_maintainer)
            ->select('troubleshooting_reports.*', 'machines.name as machine_name')
            ->get();

        $response["troubleshooting_reports"] = $troubleshootingReports;
        $response["success"] = 1;

        return response()->json($response);
    }

    public function getUnresolvedTRByMachineId($id_machine)
    {
        $troubleshootingReports = DB::table('troubleshooting_reports')
            ->where('resolved', false)
            ->where('id_machine', $id_machine)
            ->limit(1)
            ->get();

        $response["troubleshooting_reports"] = $troubleshootingReports;
        $response["success"] = 1;

        return response()->json($response);
    }
}
