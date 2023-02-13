<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
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

// Route::get('/', function () {
//     return view('dashboard');
// });


Route::get('/', [LoginController::class, 'index'])->name('admin.login');
Route::post('login', [LoginController::class, 'authenticate'])->name('admin.authenticate');
Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register.auth');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('posts', PostController::class);
    Route::resource('karyawan', KaryawanController::class);
});
