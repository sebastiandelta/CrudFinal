<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\GraficaController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('items', ItemController::class);
Route::delete('/history/{id}', [HistoryController::class, 'destroy'])->name('history.destroy');
Route::delete('/images/{id}', [ImageController::class, 'destroy'])->name('images.destroy');
Route::get('/grafica', [GraficaController::class, 'index'])->name('grafica.index');
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');

