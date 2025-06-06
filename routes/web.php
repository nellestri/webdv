<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\Auth\AuthController;

// Public route for welcome or landing page
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Auth routes (login, register, logout)
Route::middleware(['web'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Protected routes - require login
Route::middleware(['auth'])->group(function () {
    Route::get('/', [StudentsController::class, 'myView'])->name('home');
    Route::post('/add-new', [StudentsController::class, 'addNewStudent'])->name('std.addNewStudent');
    Route::post('/students/update/{id}', [StudentsController::class, 'updateStudent'])->name('std.updateStudent');
    Route::delete('/students/delete/{id}', [StudentsController::class, 'deleteStudent'])->name('std.deleteStudent');
});
