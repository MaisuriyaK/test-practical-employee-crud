<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
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
    return view('auth.login');

});

Route::resource('employee', EmployeeController::class);

Route::get('login',[AuthController::class,'login'])->name('login'); 
Route::post('post-login',[AuthController::class,'postLogin'])->name('login.post');  
Route::get('logout',[AuthController::class,'logout'])->name('logout');