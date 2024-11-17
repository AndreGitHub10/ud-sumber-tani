<?php

namespace Database\Seeders;

use App\Models\PembelianDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembelianDetailSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$timestamps = strtotime('now');

		PembelianDetail::create([
			'invoice_id' => 1,
			'kode_produk' => date('ym', $timestamps).'PDK001',
			'satuan_id' => 1,
			'stok_awal' => 10,
			'stok_real' => 10,
			'harga_beli' => 12000,
			'total_harga_beli' => 120000,
			'harga_jual' => 1000,
		]);
		PembelianDetail::create([
			'invoice_id' => 1,
			'kode_produk' => date('ym', $timestamps).'PDK002',
			'satuan_id' => 5,
			'stok_awal' => 3,
			'stok_real' => 3,
			'tanggal_kedaluwarsa' => date("Y-m-d", strtotime("now +1months")),
			'harga_beli' => 13000,
			'total_harga_beli' => 39000,
			'harga_jual' => 15000,
		]);
	}
}
