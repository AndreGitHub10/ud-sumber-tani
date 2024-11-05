<?php

use Illuminate\Support\Facades\Route;

# Middleware
use App\Http\Middleware\Authenticate;

# Controllers
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\UserController;

Route::get('/', function () {
	return redirect()->route('auth.login');
});

Route::prefix('auth')
->as('auth.')
->group(function () {
	Route::get('login', [AuthController::class, 'login'])->name('login');
	Route::post('generate-token', [AuthController::class, 'generateToken'])->name('generateToken');
	Route::get('remove-token', [AuthController::class, 'removeToken'])->name('removeToken');
});

Route::get('testing', [AuthController::class, 'testing'])->name('testing');

Route::middleware(Authenticate::class)->group(function () {
	Route::prefix('dashboard')->as('dashboard.')
	->group(function () {
		Route::get('/', [DashboardController::class, 'main'])->name('main');
	});

	Route::prefix('data-master')->as('dataMaster.')
	->group(function () {
		Route::prefix('produk')->as('produk.')
		->group(function () {
			Route::prefix('data')->as('data.')
			->group(function () {
				Route::get('/', [DashboardController::class, 'main'])->name('main');
			});

			Route::prefix('kategori')->as('kategori.')
			->group(function () {
				Route::get('/', [DashboardController::class, 'main'])->name('main');
			});

			Route::prefix('satuan')->as('satuan.')
			->group(function () {
				Route::get('/', [DashboardController::class, 'main'])->name('main');
			});
		});

		Route::prefix('supplier')->as('supplier.')
		->group(function () {
			Route::get('/', [DashboardController::class, 'main'])->name('main');
		});

		Route::prefix('pengguna')->as('pengguna.')
		->group(function () {
			Route::get('/', [UserController::class, 'main'])->name('main');
			Route::post('form', [UserController::class, 'form'])->name('form');
			Route::post('datatables', [UserController::class, 'datatables'])->name('datatables');
			Route::post('destroy', [UserController::class, 'destroy'])->name('destroy');
			Route::post('store', [UserController::class, 'store'])->name('store');
		});
	});

	Route::prefix('konversi-satuan')->as('konversiSatuan.')
	->group(function () {
		Route::get('/', [DashboardController::class, 'main'])->name('main');
	});

	Route::prefix('pembelian')->as('pembelian.')
	->group(function () {
		Route::get('/', [DashboardController::class, 'main'])->name('main');
	});

	Route::prefix('penjualan-kasir')->as('penjualanKasir.')
	->group(function () {
		Route::get('/', [DashboardController::class, 'main'])->name('main');
	});

	Route::prefix('laporan')->as('laporan.')
	->group(function () {
		Route::prefix('barang-habis')->as('barangHabis.')
		->group(function () {
			Route::get('/', [DashboardController::class, 'main'])->name('main');
		});

		Route::prefix('kartu-stok')->as('kartuStok.')
		->group(function () {
			Route::get('/', [DashboardController::class, 'main'])->name('main');
		});

		Route::prefix('laba')->as('laba.')
		->group(function () {
			Route::get('/', [DashboardController::class, 'main'])->name('main');
		});

		Route::prefix('penjualan')->as('penjualan.')
		->group(function () {
			Route::get('/', [DashboardController::class, 'main'])->name('main');
		});

		Route::prefix('persediaan')->as('persediaan.')
		->group(function () {
			Route::get('/', [DashboardController::class, 'main'])->name('main');
		});
	});
});