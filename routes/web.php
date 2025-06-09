<?php

use App\Http\Controllers\ApiRevenueDataController;
use App\Http\Controllers\cach2;
use App\Http\Controllers\RevenueDataController;
use App\Http\Controllers\hieu;
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
Route::get('index',[RevenueDataController::class,'index'])->name('index');
Route::get('cach2',[cach2::class,'cach2'])->name('cach2');
Route::get('hieu',[hieu::class,'hieu'])->name('hieu');


Route::get('showRevenueData',[ApiRevenueDataController::class,'show'])->name('showIndex');
