<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuLevelController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TestController;
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
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register/store', [RegisterController::class, 'register'])->name('register.store');

Route::get('/test-1', [TestController::class, 'first'])->name('test.first.index')->middleware(['auth']);
Route::get('/test-2', [TestController::class, 'second'])->name('test.second.index')->middleware(['auth']);


Route::prefix('management')->group(function () {
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index')->middleware(['auth']);
    Route::get('/menu-level', [MenuLevelController::class, 'index'])->name('menu.level.index')->middleware(['auth']);
    Route::get('/menu-level/create', [MenuLevelController::class, 'create'])->name('menu.level.create')->middleware(['auth']);
    Route::post('/menu-level/store', [MenuLevelController::class, 'store'])->name('menu.level.store')->middleware(['auth']);
    Route::get('/menu-level/edit/{id}', [MenuLevelController::class, 'edit'])->name('menu.level.edit')->middleware(['auth']);
    Route::post('/menu-level/update', [MenuLevelController::class, 'update'])->name('menu.level.update')->middleware(['auth']);
    Route::post('/menu-level/delete', [MenuLevelController::class, 'delete'])->name('menu.level.delete')->middleware(['auth']);

    Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create')->middleware(['auth']);
    Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store')->middleware(['auth']);
    Route::get('/menu/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit')->middleware(['auth']);
    Route::post('/menu/update', [MenuController::class, 'update'])->name('menu.update')->middleware(['auth']);
    Route::post('/menu/delete', [MenuController::class, 'delete'])->name('menu.delete')->middleware(['auth']);
});