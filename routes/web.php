<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;

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
    return view('registration');
    // Route::view("signup", "registration");

});
// Route::view("test")
Route::get("logout", [UserController::class, 'logout']);
Route::view("signup", "registration");
Route::post('register', [UserController::class, 'register']);
Route::view('login', "login");
Route::post('userLogin', [UserController::class, 'login']);
Route::get('dashboard', [UserController::class, 'dashboard'])->middleware('checkLogin');
Route::get('edit/{id}', [UserController::class, 'edit']);
Route::put('edit/{id}', [UserController::class, 'update']);
Route::get('delete/{id}', [UserController::class, 'delete']);
// Route::post('update', [UserController::class, 'update']);
Route::get('blogs', [BlogController::class, 'showAllBlogs']);
