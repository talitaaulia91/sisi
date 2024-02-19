<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuLevelController;
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
    Route::get('/menu-level', [MenuLevelController::class, 'index'])->name('menu.level.index');
    Route::get('/menu-level/create', [MenuLevelController::class, 'create'])->name('menu.level.create');
    Route::post('/menu-level/store', [MenuLevelController::class, 'store'])->name('menu.level.store');
    Route::get('/menu-level/edit/{id}', [MenuLevelController::class, 'edit'])->name('menu.level.edit');
    Route::post('/menu-level/update', [MenuLevelController::class, 'update'])->name('menu.level.update');
    Route::post('/menu-level/delete', [MenuLevelController::class, 'delete'])->name('menu.level.delete');
});