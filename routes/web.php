<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
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

Route::get('/',[IndexController::class,'index'])->name('home');
Route::get('/old',[IndexController::class,'indexold'])->name('indexold');
Route::get('/result',[IndexController::class,'result'])->name('result');
Route::get('check',[IndexController::class,'check']);
Route::get('delete/{token}/{mail}',[IndexController::class,'delete']);
Route::post('addNewRequest',[IndexController::class,'add'])->name('add_new_request');
