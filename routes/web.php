<?php

use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');

});
Route::get('/students-list',function () {
    return view('base');
});
Route::get('/students-list', [StudentsController::class, 'index']);
