<?php

use App\Http\Controllers\DashboardController;
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

Route::group(['middleware' => ['auth', 'peran:direktur-manager-staff']], function () {

    Route::get('logbook/list', [LogBookController::class, 'logbookList'])->name('logbook.list');
    Route::get('logbook/dashlist', [LogBookController::class, 'logbookDashList'])->name('logbook.dashlist');
    Route::resource('logbook', LogBookController::class);

    Route::get('dash', [DashboardController::class, 'index']);
    Route::post('dash/store/{id}', [DashboardController::class, 'store']);

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
