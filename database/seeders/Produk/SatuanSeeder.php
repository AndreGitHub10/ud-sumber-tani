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
		$array = ['dus', 'lusin', 'pcs', 'bal', 'kg', 'gram'];
		foreach($array as $key => $val){
			SatuanProduk::create(['nama' => $val]);
		}
	}
}
