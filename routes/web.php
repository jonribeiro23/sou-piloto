<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [LoginController::class, 'index'])->name('login.page');
Route::post('/auth', [LoginController::class, 'auth'])->name('auth.user');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/buscar', [DashboardController::class, 'buscar'])->name('buscar');
Route::post('/capturar', [DashboardController::class, 'capturar'])->name('capturar');
Route::get('/deletar/{id}', [DashboardController::class, 'deletar'])->name('deletar');
