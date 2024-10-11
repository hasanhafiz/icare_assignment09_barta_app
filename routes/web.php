<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\ProfileController;


Route::get('fileupload',[ FileController::class, 'fileupload'])->name('files.fileupload');
Route::post('fileupload',[ FileController::class, 'store'])->name('files.store');


Route::group(['middleware' => 'guest'], function(){
   Route::get('/register', [AuthController::class, 'register'])->name('register');
   Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
   Route::get('/login', [AuthController::class, 'login'])->name('login');
   Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

// Protecting Routes
// Only authenticated users may access this route...
Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [PostController::class, 'index'])->name('home');   
   Route::get('/home', [PostController::class, 'index']);
   Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
   Route::resource('/profiles', ProfileController::class);   
   Route::resource('posts', PostController::class);

});
