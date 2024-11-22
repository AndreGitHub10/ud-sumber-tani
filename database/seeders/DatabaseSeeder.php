<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Produk\DataSeeder;
use Database\Seeders\Produk\KategoriSeeder;
use Database\Seeders\Produk\SatuanSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$this->call(UserSeeder::class);
		$this->call(SupplierSeeder::class);
		$this->call(SatuanSeeder::class);
		$this->call(KategoriSeeder::class);
		$this->call(DataSeeder::class);
		$this->call(PembelianSeeder::class);
		$this->call(PembelianDetailSeeder::class);
		$this->call(MasterKonversiSeeder::class);

		// User::factory(10)->create();
		// User::factory()->create([
		// 	'name' => 'Test User',
		// 	'email' => 'test@example.com',
		// ]);
	}
}
