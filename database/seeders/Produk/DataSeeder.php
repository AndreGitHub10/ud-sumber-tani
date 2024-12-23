<?php

namespace Database\Seeders\Produk;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
# Models
use App\Models\DataProduk;

class DataSeeder extends Seeder
{
	public function __construct()
	{
		date_default_timezone_set("Asia/Jakarta");
	}

	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$timestamps = strtotime('now');

		DataProduk::create([
			'kode_produk' => date('ym', $timestamps)."PDK001",
			'kategori_id' => 1,
			'nama_produk' => 'Pupuk Kompos',
			'barcode' => date('ym', $timestamps)."PDK001",
		]);
		DataProduk::create([
			'kode_produk' => date('ym', $timestamps)."PDK002",
			'kategori_id' => 2,
			'nama_produk' => 'Sprayer Elektrik',
			'barcode' => date('ym', $timestamps)."PDK002",
		]);
		DataProduk::create([
			'kode_produk' => date('ym', $timestamps)."PDK003",
			'kategori_id' => 2,
			'nama_produk' => 'Sekop',
			'barcode' => date('ym', $timestamps)."PDK003",
		]);
	}
}
