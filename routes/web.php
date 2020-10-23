<?php

use Illuminate\Support\Facades\Route;

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

Route::post('maintainer','MaintainerController@createMaintainer');   //for creating maintainer
Route::get('maintainer/{id}','MaintainerController@updateMaintainer'); //for updating maintainer
Route::post('maintainer/{id}','MaintainerController@deleteMaintainer');  // for deleting maintainer
Route::get('maintainers','MaintainerController@index'); // for retrieving maintainers
