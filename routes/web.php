<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MaintainerController;
use App\Http\Controllers\MaintainController;
use App\Http\Controllers\TroubleshootingReportController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\StatisticController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
})->name("home");

Route::get('/task', function () {
    return view('task');
});

Route::get('/maintenance', function () {
    return view('mf');
});

Route::get('/calendar', function () {
    return view('calendar');
});

Route::get('/failurereport', function () {
    return view('failurereport');
});

Route::post('maintainer',[MaintainerController::class, 'createMaintainer']);   //for creating maintainer
Route::post('maintainer_delete/{id}',[MaintainerController::class, 'deleteMaintainer']);  // for deleting maintainer
Route::post('maintainer/{id}',[MaintainerController::class, 'updateMaintainer']); //update maintainer
Route::get('maintainer/{id}',[MaintainerController::class, 'getMaintainerById']); //get maintainer by id
Route::get('maintainers',[MaintainerController::class, 'index']); // for retrieving maintainers

Route::get('tasks/{id_machine}', [TaskController::class, 'getTaskByMachineId']); // for retrieving all task of machine

Route::get('statistics/{id_machine}', [StatisticController::class, 'getStatisticByMachineId']); // get all statistics for machine id
Route::get('statistic/{id}', [StatisticController::class, 'getStatisticById']); // get statistic by id

Route::post('maintain', [MaintainController::class, 'createMaintain']); // create maintain
Route::post('maintain/{id}', [MaintainController::class, 'updateMaintain']); // update maintain
Route::post('maintain_delete/{id}', [MaintainController::class, 'deleteMaintain']); // delete maintain
Route::get('maintains', [MaintainController::class, 'index']); // create maintain
Route::get('maintain/{id}', [MaintainController::class, 'getMaintainById']); // get maintain by id
Route::get('unresolvedmaintain/{id_maintainer}', [MaintainController::class, 'getUnresolvedMaintainByMaintainerId']);

Route::get('troubleshootingReport/{id}', [TroubleshootingReportController::class, 'getTroubleshootingReportById']); // get troubleshootingReport by id
Route::get('troubleshootingReports', [TroubleshootingReportController::class, 'index']); // get all troubleshootingReports
Route::post('troubleshootingReport', [TroubleshootingReportController::class, 'createTroubleshootingReport']); // create troubleshootingReport
Route::post('troubleshootingReport_delete/{id}', [TroubleshootingReportController::class, 'deleteTroubleshootingReport']); // delete troubleshootingReport
Route::post('troubleshootingReport/{id}', [TroubleshootingReportController::class, 'updateTroubleshootingReport']); // update troubleshootingReport
Route::get('unresolvedtroubleshooting/{id_maintainer}', [TroubleshootingReportController::class, 'getUnresolvedTRByMaintainerId']);

Route::get('machine/{id}', [MachineController::class, 'getMachineById']); // get machine by id
Route::get('machines', [MachineController::class, 'index']); // get all machines
