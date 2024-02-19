<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RegisterController;
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

Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register/store', [RegisterController::class, 'register'])->name('register.store');


Route::prefix('management')->group(function () {
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
});