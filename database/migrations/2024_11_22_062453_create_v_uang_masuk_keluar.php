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
        DB::statement("CREATE OR REPLACE VIEW v_uang_masuk_keluar AS
            SELECT
                cast(
                `penjualan`.`total_penjualan_diskon` AS DECIMAL ( 10, 0 )) AS `nominal`,
                cast(
                `penjualan`.`total_penjualan_diskon` AS DECIMAL ( 10, 0 )) AS `total`,
                cast(
                `penjualan`.`total_penjualan_diskon` AS DECIMAL ( 10, 0 )) AS `masuk`,
                cast(
                0 AS DECIMAL ( 10, 0 )) AS `keluar`,
                `penjualan`.`tanggal` AS `tanggal`,
                cast( `penjualan`.`created_at` AS time ) AS `waktu`,
                1 AS `type_id`,
                concat( 'penjualan (', `penjualan`.`nomor_kwitansi`, ')' ) AS `keterangan`,
                NULL AS `uang_masuk_id` 
            FROM
                `penjualan` UNION
            SELECT
                cast(
                    `uang_masuk_keluar`.`jumlah` AS DECIMAL ( 10, 0 )) AS `jumlah`,(
                CASE
                        
                        WHEN ( `uang_masuk_keluar`.`type_id` = 2 ) THEN
                        cast((
                                0 - `uang_masuk_keluar`.`jumlah` 
                                ) AS DECIMAL ( 10, 0 )) ELSE cast(
                        `uang_masuk_keluar`.`jumlah` AS DECIMAL ( 10, 0 )) 
                    END 
                        ) AS `total`,(
                    CASE
                            
                            WHEN ( `uang_masuk_keluar`.`type_id` = 1 ) THEN
                            cast(
                                `uang_masuk_keluar`.`jumlah` AS DECIMAL ( 10, 0 )) ELSE cast(
                            0 AS DECIMAL ( 10, 0 )) 
                        END 
                            ) AS `masuk`,(
                        CASE
                                
                                WHEN ( `uang_masuk_keluar`.`type_id` = 2 ) THEN
                                cast(
                                    `uang_masuk_keluar`.`jumlah` AS DECIMAL ( 10, 0 )) ELSE cast(
                                0 AS DECIMAL ( 10, 0 )) 
                            END 
                            ) AS `masuk`,
                            cast( `uang_masuk_keluar`.`tanggal_waktu` AS date ) AS `tanggal`,
                            cast( `uang_masuk_keluar`.`tanggal_waktu` AS time ) AS `waktu`,
                            `uang_masuk_keluar`.`type_id` AS `type_id`,
                            `uang_masuk_keluar`.`keterangan` AS `keterangan`,
                            `uang_masuk_keluar`.`id` AS `uang_masuk_id` 
                    FROM
                `uang_masuk_keluar`
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('v_uang_masuk_keluar');
    }
};
