<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Retro_itemController;
use App\Http\Controllers\SprintController;
use Illuminate\Support\Facades\Route;


Route::controller(Retro_itemController::class)->group(function () {
    Route::get('retro_items', 'index');
    Route::post('retro_items', 'store');
    Route::get('retro_items/{id}', 'show');
    Route::put('retro_items/{id}', 'update');
    Route::delete('retro_items/{id}', 'destroy');
});

Route::controller(SprintController::class)->group(function () {
    Route::get('sprints', 'index');
    Route::post('sprints', 'store');
    Route::get('sprints/{id}', 'show');
    Route::put('sprints/{id}', 'update');
    Route::delete('sprints/{id}', 'destroy');
});