<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\IndoRegionController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StudentController;
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
    Route::get('indoregion', [IndoRegionController::class, 'index'])->name('indoregion');
    Route::post('/getkabupaten', [IndoRegionController::class, 'getkabupaten'])->name('getkabupaten');
    Route::post('/getkecamatan', [IndoRegionController::class, 'getkecamatan'])->name('getkecamatan');
    Route::post('/getdesa', [IndoRegionController::class, 'getdesa'])->name('getdesa');

    //
    Route::get('class-index', [ClassController::class, 'index'])->name('class.index');
    Route::post('class-store', [ClassController::class, 'store'])->name('class.store');
    Route::post('class-edit', [ClassController::class, 'edit'])->name('class.edit');
    Route::post('class-update', [ClassController::class, 'update'])->name('class.update');
    Route::post('class-hapus', [ClassController::class, 'destroy'])->name('class.hapus');

    Route::resource('students', StudentController::class);
});
