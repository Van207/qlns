<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CanboController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TintucController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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



Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('post.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [MenuController::class, 'getTreeTable'])->middleware('checkLogin')->name('homepage');

Route::prefix('canbo')->middleware('checkLogin')->group(function () {
	Route::get('/', [CanboController::class, 'index'])->name('canbo.index');
	Route::get('/create', [CanboController::class, 'create'])->name('canbo.create');
	Route::post('/create', [CanboController::class, 'store'])->name('canbo.store');
	Route::get('/edit/{id}', [CanboController::class, 'edit'])->name('canbo.edit');
	Route::post('/edit/{id}', [CanboController::class, 'update'])->name('canbo.update');
	Route::get('/delete/{id}', [CanboController::class, 'destroy'])->name('canbo.delete');
	Route::get('/filter', [CanboController::class, 'filter'])->name('canbo.filter');
});

Route::prefix('coquan')->middleware('checkLogin')->group(function () {

	Route::get('/', [MenuController::class, 'index'])->name('menu.index');
	Route::get('/create', [MenuController::class, 'create'])->name('menu.create');
	Route::post('/create', [MenuController::class, 'store'])->name('menu.store');
	Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
	Route::post('/edit/{id}', [MenuController::class, 'update'])->name('menu.update');
	Route::get('/delete/{id}', [MenuController::class, 'destroy'])->name('menu.delete');
	Route::get('/filter', [MenuController::class, 'filter'])->name('menu.filter');
});

Route::prefix('user')->middleware('checkLogin')->group(function () {

	Route::get('/', [UserController::class, 'index'])->name('user.index');
	// Route::get('/create', [UserController::class, 'create'])->name('user.create');
	Route::post('/create', [UserController::class, 'store'])->name('user.store');
	Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
	Route::post('/edit/{id}', [UserController::class, 'update'])->name('user.update');
	Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
});

Route::prefix('tintuc')->middleware('checkLogin')->group(function () {

	Route::get('/', [TintucController::class, 'index'])->name('tintuc.index');
	Route::get('/delete/{id}', [TintucController::class, 'destroy'])->name('tintuc.delete');
});


Route::get('/getCanbo/{menu_id}', [CanboController::class, 'getCanBo_byMenuId'])->middleware('checkLogin')->name('ajax.getCanbo');
