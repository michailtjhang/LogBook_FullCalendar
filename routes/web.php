<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogBookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('logbook/list', [LogBookController::class, 'logbookList'])->name('logbook.list');
Route::resource('logbook', LogBookController::class);
Route::get('home', [HomeController::class, 'index']);
Route::post('home/store/{id}', [HomeController::class, 'store']);
