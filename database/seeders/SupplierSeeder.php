<?php

namespace Database\Seeders;

# Models
use App\Models\Supplier;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
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

		Supplier::create([
			'kode' => date('ym', $timestamps)."SPL001",
			'nama' => 'Supplier 1',
			'nomor_hp' => '0456',
			'alamat' => 'Alamat 1',
			'keterangan' => null,
			'tanggal' => date('Y-m-d', $timestamps),
		]);
		Supplier::create([
			'kode' => date('ym', $timestamps)."SPL002",
			'nama' => 'Supplier 2',
			'nomor_hp' => '0123',
			'alamat' => 'Alamat 2',
			'keterangan' => null,
			'tanggal' => date('Y-m-d', $timestamps),
		]);
	}
}
