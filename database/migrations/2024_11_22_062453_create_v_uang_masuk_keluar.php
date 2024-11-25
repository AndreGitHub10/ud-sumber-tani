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
        DB::statement('CREATE OR REPLACE VIEW v_uang_masuk_keluar AS
            --     SELECT
            --     total_harga as nominal,
            --     0 as masuk,
            --     total_harga as keluar,
            --     0-total_harga as sum,
            --     tanggal,
            --     cast(created_at as time) as waktu,
            --     2 as type_id
            -- FROM
            --     pembelian
            -- UNION
            SELECT
                total_penjualan_diskon as nominal,
                total_penjualan_diskon as total,
                total_penjualan_diskon as masuk,
                0 as keluar,
                tanggal,
                cast(created_at as time) as waktu,
                1 as type_id
            FROM
                penjualan
            UNION
            SELECT
                jumlah,
                (CASE
                    WHEN type_id=2 THEN
                        0-jumlah
                    ELSE
                        jumlah
                END) as total,
                (CASE
                    WHEN type_id=1 THEN
                        jumlah
                    ELSE
                        0
                END) as masuk,
                (CASE
                    WHEN type_id=2 THEN
                        jumlah
                    ELSE
                        0
                END) as masuk,
                cast(tanggal_waktu as date) as tanggal,
                cast(tanggal_waktu as time) as waktu,
                type_id
            FROM
                uang_masuk_keluar
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('v_uang_masuk_keluar');
    }
};
