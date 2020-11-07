<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MaintainerController;

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

Route::post('maintainer',[MaintainerController::class], 'createMaintainer');   //for creating maintainer
Route::get('maintainer/{id}',[MaintainerController::class], 'updateMaintainer'); //for updating maintainer
Route::post('maintainer/{id}',[MaintainerController::class], 'deleteMaintainer');  // for deleting maintainer
Route::get('maintainers',[MaintainerController::class], 'index'); // for retrieving maintainers

Route::get('tasks/{id_machine}', [TaskController::class, 'getTaskByMachineId']); // for retrieving all task of machine

Route::post('maintain', [MaintainController::class, 'createMaintain']); // create maintain


