<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Auth;

class MenuComposer
{
	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 * @return void
	 */
	public function compose(View $view)
	{
		/**
		 * ------------------------
		 *  LIST MENU
		 * ------------------------
		 * 1. Dashboard
		 * 2. Data Master
		 *    - Produk
		 *       -- Data
		 *       -- Kategori
		 *       -- Satuan
		 *    - Supplier
		 *    - Pengguna
		 * 3. Konversi Satuan (repack)
		 * 4. Pembelian
		 * 5. Penjualan Kasir
		 * 6. Laporan
		 *    - Barang Habis
		 *    - Kartu Stok
		 *    - Laba
		 *    - Penjualan
		 *    - Persediaan
		 */
		$menu = [
			# Dashboard
			[
				'id' => 1,
				'link' => route('dashboard.main'),
				'text' => 'Dashboard',
				'icon' => 'bx bx-home',
				'sub_menu_icon' => 'bx bx-right-arrow-alt',
				'sub_menu' => [],
			],

			# Data master
			[
				'id' => '2',
				'link' => 'javascript:;',
				'text' => 'Data Master',
				'icon' => 'bx bx-data',
				'sub_menu_icon' => 'bx bx-right-arrow-alt',
				'sub_menu' => [
					[
						'link' => 'javascript:;',
						'text' => 'Produk',
						'sub_menu' => [
							[
								'link' => route('dataMaster.produk.data.main'),
								'text' => 'Data',
							],
							[
								'link' => route('dataMaster.produk.kategori.main'),
								'text' => 'Kategori',
							],
							[
								'link' => route('dataMaster.produk.satuan.main'),
								'text' => 'Satuan',
							],
						]
					],
					[
						'link' => route('dataMaster.supplier.main'),
						'text' => 'Supplier / Vendor',
					],
					[
						'link' => route('dataMaster.pengguna.main'),
						'text' => 'Pengguna',
					],
				],
			],

			# Konversi satuan
			[
				'id' => 3,
				'link' => route('konversiSatuan.main'),
				'text' => 'Konversi Satuan (repack)',
				'icon' => 'bx bx-transfer-alt',
				'sub_menu_icon' => 'bx bx-right-arrow-alt',
				'sub_menu' => [],
			],

			# Pembelian
			[
				'id' => 4,
				'link' => route('pembelian.main'),
				'text' => 'Pembelian',
				'icon' => 'bx bx-basket',
				'sub_menu_icon' => 'bx bx-right-arrow-alt',
				'sub_menu' => [],
			],

			# Penjualan kasir
			[
				'id' => 5,
				'link' => route('penjualanKasir.main'),
				'text' => 'Penjualan Kasir',
				'icon' => 'bx bx-dollar-circle',
				'sub_menu_icon' => 'bx bx-right-arrow-alt',
				'sub_menu' => [],
			],

			# Laporan
			[
				'id' => 6,
				'link' => 'javascript:;',
				'text' => 'Laporan',
				'icon' => 'bx bx-file',
				'sub_menu_icon' => 'bx bx-right-arrow-alt',
				'sub_menu' => [
					[
						'link' => route('laporan.barangHabis.main'),
						'text' => 'Barang Habis',
					],
					[
						'link' => route('laporan.kartuStok.main'),
						'text' => 'Kartu Stok',
					],
					[
						'link' => route('laporan.laba.main'),
						'text' => 'Laba',
					],
					[
						'link' => route('laporan.penjualan.main'),
						'text' => 'Penjualan',
					],
					[
						'link' => route('laporan.persediaan.main'),
						'text' => 'Persediaan',
					],
				],
			],
		];


		$auth = Auth::user();
		if ($auth && $auth->level === 'kasir') {
			# Kasir hanya bisa akses menu 1 (dashboard) & 5 (penjualan kasir)
			$menu = collect($menu)->filter(fn ($item) => in_array($item['id'], [1, 5]))->values()->toArray();
		}

		$view->with('menu', $menu);
	}
}