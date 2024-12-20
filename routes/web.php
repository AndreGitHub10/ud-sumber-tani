<?php

use Illuminate\Support\Facades\Route;

# Middleware
use App\Http\Middleware\Authenticate;

# Controllers
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DBController;
use App\Http\Controllers\Konversi\MasterKonversiController;
use App\Http\Controllers\Konversi\SatuanController as KonversiSatuanController;
use App\Http\Controllers\Laporan\HutangController;
use App\Http\Controllers\Laporan\KartuStokController;
use App\Http\Controllers\Laporan\LabaController;
use App\Http\Controllers\Laporan\MinMaxController;
use App\Http\Controllers\Laporan\PenjualanController;
use App\Http\Controllers\Laporan\PersediaanController;
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
Route::get('test', function() {
    return view('utama');
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
				Route::get('barcode/{barcode?}', 'barcode')->name('barcode');
				Route::post('importForm', 'importForm')->name('importForm');
				Route::get('download-template', 'downloadTemplate')->name('downloadTemplate');
				Route::post('import', 'import')->name('import');
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
				Route::post('konversi', 'konversi')->name('konversi');
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

		Route::controller(MasterKonversiController::class)->prefix('konversi')->as('konversi.')
		->group(function () {
			Route::get('/', 'main')->name('main');
			Route::post('form', 'form')->name('form');
			Route::post('store', 'store')->name('store');
			Route::post('datatables', 'datatables')->name('datatables');
			Route::post('get-master', 'getMaster')->name('getMaster');
			Route::post('destroy', 'destroy')->name('destroy');
		});
	});

	Route::controller(KonversiSatuanController::class)->prefix('konversi-satuan')->as('konversiSatuan.')
	->group(function () {
		Route::get('/', 'form')->name('form');
		Route::post('store', 'store')->name('store');
		Route::post('get-konversi', 'getKonversi')->name('getKonversi');
	});

	Route::controller(PembelianController::class)->prefix('pembelian')->as('pembelian.')
	->group(function () {
		Route::get('/', 'main')->name('main');
		Route::post('form', 'form')->name('form');
		Route::post('datatables', 'datatables')->name('datatables');
		Route::post('destroy', 'destroy')->name('destroy');
		Route::post('store', 'store')->name('store');
		Route::post('find-produk', 'findProduk')->name('findProduk');
	});

	Route::controller(KasirController::class)->prefix('penjualan-kasir')->as('penjualanKasir.')
	->group(function () {
		Route::get('/', 'main')->name('main');
		Route::post('store', 'store')->name('store');
		Route::get('invoice/{id?}', 'invoice')->name('invoice');
		Route::post('get-produk', 'getProduk')->name('getProduk');
		Route::post('scan-barcode', 'scanBarcode')->name('scanBarcode');
		Route::post('find-produk', 'findProduk')->name('findProduk');
	});

	Route::prefix('laporan')->as('laporan.')
	->group(function () {
		Route::prefix('barang-habis')->as('barangHabis.')
		->group(function () {
			Route::get('/', [MinMaxController::class, 'main'])->name('main');
			Route::post('datatables', [MinMaxController::class, 'datatables'])->name('datatables');
			Route::post('form', [MinMaxController::class, 'form'])->name('form');
			Route::post('getMinMax', [MinMaxController::class, 'getMinMax'])->name('getMinMax');
			Route::post('store', [MinMaxController::class, 'store'])->name('store');
		});

		Route::prefix('kartu-stok')->as('kartuStok.')
		->group(function () {
			Route::get('/', [KartuStokController::class, 'main'])->name('main');
			Route::post('datatables', [KartuStokController::class, 'datatables'])->name('datatables');
			Route::post('detail', [KartuStokController::class, 'detail'])->name('detail');
			Route::post('datatablesDetail', [KartuStokController::class, 'datatablesDetail'])->name('datatablesDetail');
			Route::get('export-excel', [KartuStokController::class, 'exportExcel'])->name('exportExcel');
		});

		Route::prefix('laba')->as('laba.')
		->group(function () {
			Route::get('/', [LabaController::class, 'main'])->name('main');
			Route::post('datatables', [LabaController::class, 'datatables'])->name('datatables');
		});

		Route::prefix('penjualan')->as('penjualan.')
		->group(function () {
			Route::get('/', [PenjualanController::class, 'main'])->name('main');
			Route::post('datatables', [PenjualanController::class, 'datatables'])->name('datatables');
			Route::post('detail', [PenjualanController::class, 'detail'])->name('detail');
			Route::post('destroy', [PenjualanController::class, 'destroy'])->name('destroy');
		});

		Route::prefix('hutang')->as('hutang.')
		->group(function () {
			Route::get('/', [HutangController::class, 'main'])->name('main');
			Route::post('datatables', [HutangController::class, 'datatables'])->name('datatables');
			Route::post('detail', [HutangController::class, 'detail'])->name('detail');
			Route::post('destroy', [HutangController::class, 'destroy'])->name('destroy');
			Route::post('cancel', [HutangController::class, 'cancel'])->name('cancel');
			Route::post('accept', [HutangController::class, 'accept'])->name('accept');
		});

		Route::prefix('persediaan')->as('persediaan.')
		->group(function () {
			Route::get('/', [PersediaanController::class, 'main'])->name('main');
			Route::post('datatables', [PersediaanController::class, 'datatables'])->name('datatables');
			Route::post('form', [PersediaanController::class, 'form'])->name('form');
			Route::post('store', [PersediaanController::class, 'store'])->name('store');
			Route::post('detail', [PersediaanController::class, 'detail'])->name('detail');
			Route::post('destroy', [PersediaanController::class, 'destroy'])->name('destroy');
		});
	});

	Route::get('backup', [DBController::class, 'backup'])->name('backup');
});