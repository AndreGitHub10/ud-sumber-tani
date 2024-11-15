<?php

namespace Database\Seeders;

use App\Models\Pembelian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembelianSeeder extends Seeder
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

		Pembelian::create([
			'supplier_id' => 1,
			'nomor_invoice' => 12345,
			'total_harga' => 3535000,
			'tanggal' => date("Y-m-d", $timestamps)
		]);
	}
}
