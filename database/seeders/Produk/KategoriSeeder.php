<?php

namespace Database\Seeders\Produk;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
# Models
use App\Models\KategoriProduk;

class KategoriSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		KategoriProduk::create(['nama' => 'pupuk']);
		KategoriProduk::create(['nama' => 'alat tani']);
		KategoriProduk::create(['nama' => 'makanan']);
	}
}
