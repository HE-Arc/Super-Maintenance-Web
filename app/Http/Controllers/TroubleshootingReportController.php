<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TroubleshootingReport;
use DB;

class TroubleshootingReportController extends Controller{

	public function getTroubleshootingReportById(Request $request, $id)
    {
        $troubleshootingReport = DB::table('troubleshooting_reports')->join('machines', 'troubleshooting_reports.id_machine', '=', 'machines.id')->select('troubleshooting_reports.*', 'machines.name as machine_name')->where('id', $id)->get();

        $response["troubleshootingReport"] = $troubleshootingReport;
        $response["success"] = 1;

        return response()->json($response);
	}
	
	public function createTroubleshootingReport(Request $request)
    {
        $troubleshootingReport = new TroubleshootingReport($request->all());
        $troubleshootingReport->save();

        $response["troubleshootingReport"] = $troubleshootingReport;
        $response["success"] = 1;

        return response()->json($response);
	}

	public function updateTroubleshootingReport(Request $request, $id)
    {
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
        $troubleshootingReports = DB::table('troubleshooting_reports')->get()->where('id_machine', $id);

        $response["troubleshooting_reports"] = $troubleshootingReports;
        $response["success"] = 1;

        return response()->json($response);
    }
	
	public function index()
    {
        $troubleshootingReports = DB::table('troubleshooting_reports')->get();

        $response["troubleshooting_reports"] = $troubleshootingReports;
        $response["success"] = 1;

        return response()->json($response);
    }

    public function getUnresolvedTRByMaintainerId(Request $request, $id_maintainer)
    {
        $troubleshootingReports = DB::table('troubleshooting_reports')->join('machines', 'troubleshooting_reports.id_machine', '=', 'machines.id')->where('resolved', false)->where('id_maintainer', $id_maintainer)->select('troubleshooting_reports.*', 'machines.name as machine_name')->get();

        $response["troubleshooting_reports"] = $troubleshootingReports;
        $response["success"] = 1;

        return response()->json($response);
    }
}
