<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		DB::statement("CREATE OR REPLACE VIEW v_uang_masuk AS
			SELECT
				`penjualan`.`total_penjualan_diskon` AS `nominal`,
				`penjualan`.`total_penjualan_diskon` AS `sum`,
				`penjualan`.`total_penjualan_diskon` AS `masuk`,
				0 AS `keluar`,
				`penjualan`.`tanggal` AS `tanggal`,
				cast(`penjualan`.`created_at` as time) AS `waktu`,
				1 AS `type_id`
			FROM
				`penjualan` UNION
			SELECT
				`uang_masuk_keluar`.`jumlah` AS `jumlah`,
				(
					case
						when (`uang_masuk_keluar`.`type_id` = 2)
							then (0 - `uang_masuk_keluar`.`jumlah`)
						else `uang_masuk_keluar`.`jumlah`
					end
				) AS `sum`,
				(
					case
						when (`uang_masuk_keluar`.`type_id` = 1)
							then `uang_masuk_keluar`.`jumlah`
						else 0
					end
				) AS `masuk`,
				(
					case
						when (`uang_masuk_keluar`.`type_id` = 2)
							then `uang_masuk_keluar`.`jumlah`
						else 0
					end
				) AS `masuk`,
				cast(`uang_masuk_keluar`.`tanggal_waktu` as date) AS `tanggal`,
				cast(`uang_masuk_keluar`.`tanggal_waktu` as time) AS `waktu`,
				`uang_masuk_keluar`.`type_id` AS `type_id`
			FROM
				`uang_masuk_keluar`
		");
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('v_uang_masuk');
	}
};
