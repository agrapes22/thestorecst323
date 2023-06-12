<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/store', [UserController::class, 'store']);

Route::get('/login', [UserController::class, 'loginPage']);

Route::get('/register', [UserController::class, 'registerPage']);

Route::post('login', [UserController::class, 'login']);

Route::post('register', [UserController::class, 'register']);

Route::get('/signout', [UserController::class, 'signout']);

Route::get('/dashboard', [UserController::class, 'dashboard']);

Route::get('/profile', [UserController::class, 'profile']);

Route::post('updateAccount', [UserController::class, 'updateAccount']);

Route::delete('/deleteAccount/{id}', [UserController::class, 'delete'])->name('deleteAccount');