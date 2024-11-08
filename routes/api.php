<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;

Route::get('/user', function (Request $request) {
	return $request->user();
})->middleware('auth:sanctum');

Route::as('api.')->group(function () {
	Route::controller(AuthController::class)
	->prefix('auth')
	->as('auth.')
	->group(function (){
		Route::post('login', 'login')->name('login');
	});
});