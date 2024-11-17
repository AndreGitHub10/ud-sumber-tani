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
        DB::statement("CREATE VIEW v_kartu_stok AS
            SELECT 
                dp.kode_produk,
                SUM(COALESCE(pd.stok_real,0)) - SUM(COALESCE(sub_pd2.jumlah,0)) stok,
                pd.satuan_id
            FROM data_produk dp
            LEFT JOIN pembelian_detail pd ON dp.kode_produk=pd.kode_produk
            LEFT JOIN (
                SELECT 
                    pd.id,
                    SUM(pd2.jumlah) jumlah
                FROM pembelian_detail pd 
                LEFT JOIN penjualan_detail pd2 ON pd.id=pd2.detail_pembelian_id
                GROUP BY pd.id 
            ) AS sub_pd2 ON pd.id=sub_pd2.id
            GROUP BY 
                dp.kode_produk,
                pd.satuan_id");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('v_kartu_stok');
    }
};
