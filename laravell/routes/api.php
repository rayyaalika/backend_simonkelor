<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', App\Http\Controllers\Api\ControllerLogin::class)->name('login');
Route::post('/logout', App\Http\Controllers\Api\ControllerLogout::class)->name('logout');
Route::middleware('auth:api')->get('/datauser', function (Request $request) {
    return $request->user();
});

Route::get('/test', [App\Http\Controllers\Api\ControllerDashboard::class, 'test']);

Route::post('/user', 'App\Http\Controllers\Api\ControllerUser@store');
Route::put('/update_user/{user}', 'App\Http\Controllers\Api\ControllerUser@update');
Route::delete('/delete_user/{user}', 'App\Http\Controllers\Api\ControllerUser@destroy');
Route::get('/pegawai', 'App\Http\Controllers\Api\ControllerUser@getPegawai');
Route::get('/admin', 'App\Http\Controllers\Api\ControllerUser@getAdmin');
Route::get('/detail_user/{user}', 'App\Http\Controllers\Api\ControllerUser@show');

Route::get('/pembangkit', 'App\Http\Controllers\Api\ControllerPembangkit@index');
Route::get('/detail_pembangkit/{pembangkit}', 'App\Http\Controllers\Api\ControllerPembangkit@show');
Route::post('/pembangkit', 'App\Http\Controllers\Api\ControllerPembangkit@store');
Route::put('/update_pembangkit/{pembangkit}', 'App\Http\Controllers\Api\ControllerPembangkit@update');
Route::delete('/delete_pembangkit/{pembangkit}', 'App\Http\Controllers\Api\ControllerPembangkit@destroy');
