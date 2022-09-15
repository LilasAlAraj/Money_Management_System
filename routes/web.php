<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

//views
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard/yearly',[App\Http\Controllers\DashboardController::class,'yearly'])->name('yearly-dashboard');
Route::get('/dashboard/monthly',[App\Http\Controllers\DashboardController::class,'monthly'])->name('monthly-dashboard');
Route::get('/incoming/add', [App\Http\Controllers\IncomingController::class, 'create'])->name('incoming-add');
Route::get('/outcoming/add', [App\Http\Controllers\OutgoingController::class, 'create'])->name('outgoing-add');
Route::post('/incoming/edit', [App\Http\Controllers\IncomingController::class, 'edit'])->name('incoming-edit');
Route::post('/outgoing/edit', [App\Http\Controllers\OutgoingController::class, 'edit'])->name('outgoing-edit');
Route::get('/incoming/by_date', [App\Http\Controllers\IncomingController::class, 'display_date'])->name('incoming-dis-date');
Route::get('/outgoing/by_date', [App\Http\Controllers\OutgoingController::class, 'display_date'])->name('outgoing-dis-date');

//////////
Route::post('/incoming/store', [App\Http\Controllers\IncomingController::class, 'store'])->name('incoming-store');
Route::post('/incoming/update', [App\Http\Controllers\IncomingController::class, 'update'])->name('incoming-update');
Route::delete('/incoming/delete/', [App\Http\Controllers\IncomingController::class, 'destroy'])->name('incoming-delete');
Route::get('/incoming/show/{id}', [App\Http\Controllers\IncomingController::class, 'show'])->name('incoming-show');
Route::get('/incoming/user/{id}', [App\Http\Controllers\IncomingController::class, 'getUser'])->name('incoming-user');


Route::post('/outgoing/store', [App\Http\Controllers\OutgoingController::class, 'store'])->name('outgoing-store');
Route::post('/outgoing/update', [App\Http\Controllers\OutgoingController::class, 'update'])->name('outgoing-update');
Route::delete('/outgoing/delete', [App\Http\Controllers\OutgoingController::class, 'destroy'])->name('outgoing-delete');
Route::get('/outgoing/show/{id}', [App\Http\Controllers\OutgoingController::class, 'show'])->name('outgoing-show');
Route::get('/outgoing/user/{id}', [App\Http\Controllers\OutgoingController::class, 'getUser'])->name('outgoing-user');

Route::get('/user/outs', [App\Http\Controllers\OutgoingController::class, 'Outgoings'])->name('outgoings');;
Route::get('/user/outs-value', [App\Http\Controllers\OutgoingController::class, 'OutgoingsValue'])->name('outgoing-val');;
Route::get('/user/outs-value/{date}', [App\Http\Controllers\OutgoingController::class, 'OutgoingsValueOfDate'])->name('outgoing-val-date');;
Route::get('/user/outs-by-year/{year}', [App\Http\Controllers\OutgoingController::class, 'OutgoingsByYear'])->name('outgoings-by-year');;
Route::get('/user/outs-by-date/{date}', [App\Http\Controllers\OutgoingController::class, 'OutgoingsByDate'])->name('outgoings-by-date');;


Route::get('/user/ins', [App\Http\Controllers\IncomingController::class, 'Incomings'])->name('incomings');;
Route::get('/user/ins-value', [App\Http\Controllers\IncomingController::class, 'IncomingsValue'])->name('incoming-val');;
Route::get('/user/ins-value/{date}', [App\Http\Controllers\IncomingController::class, 'IncomingsValueOfDate'])->name('incoming-val-date');;
Route::get('/user/ins-by-year/{year}', [App\Http\Controllers\IncomingController::class, 'IncomingsByYear'])->name('incomings-by-year');;
//Route::get('/user/ins-by-date/', [App\Http\Controllers\IncomingController::class, 'display_date2'])->name('incomings-by-date');;





