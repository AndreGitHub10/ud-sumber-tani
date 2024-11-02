<?php

use Illuminate\Support\Facades\Route;

# Controllers
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
	return view('contents.dashboard.main');
});

Route::get('login', [AuthController::class, 'main']);
Route::get('testing', [AuthController::class, 'testing'])->name('testing');