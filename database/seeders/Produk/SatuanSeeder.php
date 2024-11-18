<?php

namespace Database\Seeders\Produk;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
# Models
use App\Models\SatuanProduk;

class SatuanSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		SatuanProduk::create(['nama' => 'gram']);
		SatuanProduk::create(['nama' => 'kg']);
		SatuanProduk::create(['nama' => 'pcs']);
		SatuanProduk::create(['nama' => 'lusin']);
		SatuanProduk::create(['nama' => 'dus']);
	}
}
