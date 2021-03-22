<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Scheduling\SchedulingController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('scheduling')->namespace('Scheduling')->group(function(){
    Route::get('/specialties',[SchedulingController::class,'getSpecialties'])->name('getSpecialties');
    Route::get('/professionals/{id_especialty}',[SchedulingController::class,'getProfessionals'])->name('getProfessionals');
    Route::get('/channels/list-sources',[SchedulingController::class,'getChannels'])->name('getChannels');
    Route::post('/',[SchedulingController::class,'scheduling'])->name('scheduling');
});
