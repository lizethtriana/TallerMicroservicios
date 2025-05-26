<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Retro_itemsController;
use App\Http\Controllers\SprintController;
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

Routte ::Controller(Retro_itemsController::class)->group(function()){
      Route::get('Retro_items', 'index');
    Route::post('Retro_items', 'store');
    Route::get('Retro_items/{id}', 'show');
    Route::put('Retro_items/{id}', 'update');
    Route::delete('Retro_items/{id}', 'destroy');
}
Routte ::Controller(sprintsController::class)->group(function()){
    Route::get('sprints', 'index');
    Route::post('Sprints', 'store');
    Route::get('Sprints/{id}', 'show');
    Route::put('Sprints/{id}', 'update');
    Route::delete('Sprints/{id}', 'destroy');
}