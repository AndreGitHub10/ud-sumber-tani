<?php

namespace Database\Seeders;

use App\Models\KonversiSatuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterKonversiSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		KonversiSatuan::create([
			'satuan_id_asal' => 5,
			'satuan_id_tujuan' => 6,
			'nilai_konversi' => 1000
		]);
		KonversiSatuan::create([
			'satuan_id_asal' => 1,
			'satuan_id_tujuan' => 2,
			'nilai_konversi' => 12
		]);
		KonversiSatuan::create([
			'satuan_id_asal' => 1,
			'satuan_id_tujuan' => 3,
			'nilai_konversi' => 48
		]);
	}
}
