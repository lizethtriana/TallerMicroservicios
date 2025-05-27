<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Retro_itemController;
use App\Http\Controllers\SprintController;
use Illuminate\Support\Facades\Route;


Route::controller(Retro_itemController::class)->group(function () {
    Route::get('Retro_items', 'index');
    Route::post('Retro_items', 'store');
    Route::get('Retro_items/{id}', 'show');
    Route::put('Retro_items/{id}', 'update');
    Route::delete('Retro_items/{id}', 'destroy');
});

Route::controller(SprintController::class)->group(function () {
    Route::get('sprints', 'index');
    Route::post('Sprints', 'store');
    Route::get('Sprints/{id}', 'show');
    Route::put('Sprints/{id}', 'update');
    Route::delete('Sprints/{id}', 'destroy');
});