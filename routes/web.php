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

Route::get('/test', [\App\Http\Controllers\testController::class,'index']);
Route::get('/portfolio', [\App\Http\Controllers\testController::class,'portfolio']);

Route::get('/create', [App\Http\Controllers\TradeController::class, 'create']);
Route::post('/create', [App\Http\Controllers\TradeController::class, 'store']);

Route::get('/investor', [App\Http\Controllers\InvestorController::class, 'index']);
Route::get('/investor/create', [App\Http\Controllers\InvestorController::class, 'create']);
Route::post('/investor/create', [App\Http\Controllers\InvestorController::class, 'store']);
Route::get('/investor/{id}/contracts', [App\Http\Controllers\InvestorController::class, 'showContracts']);
Route::get('/investor/{id}/create-contract', [App\Http\Controllers\InvestorController::class, 'createContract']);

Route::get('/deposit/create', [App\Http\Controllers\DepositsController::class, 'create']);
Route::post('/deposit/create', [App\Http\Controllers\DepositsController::class, 'store']);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
