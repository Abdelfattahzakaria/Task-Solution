<?php

use App\Http\Controllers\UserRegisteration\UserRegisterationController;
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
    return view('index');
});
Route::controller(UserRegisterationController::class)->group(function(){
    Route::post("UserRegisterationStore","UserRegisterationStore")->name("UserRegisterationStore");
});
  

 