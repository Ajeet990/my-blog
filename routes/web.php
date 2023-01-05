<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
// Route::view("test")
Route::get("logout", [UserController::class, 'logout']);
Route::view("signup", "registration");
Route::post('register', [UserController::class, 'register']);
Route::view('login', "login");
Route::post('userLogin', [UserController::class, 'login']);
Route::get('dashboard', [UserController::class, 'dashboard'])->middleware('checkLogin');
