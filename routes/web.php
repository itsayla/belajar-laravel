<?php

use App\Http\Controllers\InstructorController;
use App\Http\Controllers\KeyController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('latihan', [LatihanController::class, 'index']);
Route::get('tambah', [LatihanController::class, 'tambah'])->name('tambah');
Route::get('kurang', [LatihanController::class, 'kurang'])->name('kurang');
Route::get('kali', [LatihanController::class, 'kali'])->name('kali');
Route::get('bagi', [LatihanController::class, 'bagi'])->name('bagi');
// cara yg panjang
// Route::get('latihan', [App\Http\Controllers\LatihanController::class, 'index']);

Route::post('action-tambah', [LatihanController::class, 'actionTambah'])->name('action-tambah');
Route::post('action-kurang', [LatihanController::class, 'actionKurang'])->name('action-kurang');
Route::post('action-kali', [LatihanController::class, 'actionKali'])->name('action-kali');
Route::post('action-bagi', [LatihanController::class, 'actionBagi'])->name('action-bagi');

// profiles
Route::get('profile', [ProfileController::class, 'index']);

// login 
Route::get('login', [LoginController::class, 'index'])->name('login');

Route::get('dashboard', function () {
    return view('dashboard.index');
});

Route::post('action-login', [LoginController::class, 'actionLogin'])->name('action-login');
Route::post('action-logout', [LoginController::class, 'actionLogout'])->name('action-logout');

Route::get('dashboard', function(){
    return view('dashboard.index'); 
})->middleware('auth');

Route::resource('user', \App\Http\Controllers\UserController::class); 
Route::resource('role', \App\Http\Controllers\RoleController::class); 

Route::resource('locker', LockerController::class); 
Route::resource('key', KeyController::class); 
Route::resource('major', MajorController::class); 
Route::resource('student', StudentController::class);
Route::resource('instructor', InstructorController::class);