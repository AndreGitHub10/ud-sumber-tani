<?php

use Illuminate\Support\Facades\Route;

# Middleware
use App\Http\Middleware\Authenticate;

# Controllers
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\Penjualan\KasirController;
use App\Http\Controllers\Produk\DataController;
use App\Http\Controllers\Produk\KategoriController;
use App\Http\Controllers\Produk\SatuanController;
use App\Http\Controllers\User\SupplierController;
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
			Route::controller(DataController::class)->prefix('data')->as('data.')
			->group(function () {
				Route::get('/', 'main')->name('main');
				Route::post('form', 'form')->name('form');
				Route::post('datatables', 'datatables')->name('datatables');
				Route::post('destroy', 'destroy')->name('destroy');
				Route::post('store', 'store')->name('store');
			});

			Route::controller(KategoriController::class)->prefix('kategori')->as('kategori.')
			->group(function () {
				Route::get('/', 'main')->name('main');
				Route::post('form', 'form')->name('form');
				Route::post('datatables', 'datatables')->name('datatables');
				Route::post('destroy', 'destroy')->name('destroy');
				Route::post('store', 'store')->name('store');
			});

			Route::controller(SatuanController::class)->prefix('satuan')->as('satuan.')
			->group(function () {
				Route::get('/', 'main')->name('main');
				Route::post('form', 'form')->name('form');
				Route::post('datatables', 'datatables')->name('datatables');
				Route::post('destroy', 'destroy')->name('destroy');
				Route::post('store', 'store')->name('store');
			});
		});

		Route::controller(SupplierController::class)->prefix('supplier')->as('supplier.')
		->group(function () {
			Route::get('/', 'main')->name('main');
			Route::post('form', 'form')->name('form');
			Route::post('datatables', 'datatables')->name('datatables');
			Route::post('destroy', 'destroy')->name('destroy');
			Route::post('store', 'store')->name('store');
		});

		Route::controller(UserController::class)->prefix('pengguna')->as('pengguna.')
		->group(function () {
			Route::get('/', 'main')->name('main');
			Route::post('form', 'form')->name('form');
			Route::post('datatables', 'datatables')->name('datatables');
			Route::post('destroy', 'destroy')->name('destroy');
			Route::post('store', 'store')->name('store');
		});
	});

	Route::prefix('konversi-satuan')->as('konversiSatuan.')
	->group(function () {
		Route::get('/', [DashboardController::class, 'main'])->name('main');
	});

	Route::controller(PembelianController::class)->prefix('pembelian')->as('pembelian.')
	->group(function () {
		Route::get('/', 'main')->name('main');
		Route::post('form', 'form')->name('form');
		Route::post('datatables', 'datatables')->name('datatables');
		Route::post('destroy', 'destroy')->name('destroy');
		Route::post('store', 'store')->name('store');
	});

	Route::controller(KasirController::class)->prefix('penjualan-kasir')->as('penjualanKasir.')
	->group(function () {
		Route::get('/', 'main')->name('main');
		Route::post('store', 'store')->name('store');
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