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
        DB::statement("CREATE OR REPLACE VIEW v_harga_barang AS (
            SELECT
                sub3.kode_produk,
                sub3.satuan_id,
                sub4.harga_beli_terbaru,
                sub4.harga_jual_terbaru,
                sub3.harga_beli_terendah,
                sub3.harga_jual_terendah,
                sub3.harga_beli_tertinggi,
                sub3.harga_jual_tertinggi
            FROM
                (
                    SELECT
                        pd.kode_produk,
                        pd.satuan_id,
                        MIN(pd.harga_beli) as harga_beli_terendah,
                        MAX(pd.harga_beli) as harga_beli_tertinggi,
                        MIN(pd.harga_jual) as harga_jual_terendah,
                        MAX(pd.harga_jual) as harga_jual_tertinggi
                    FROM
                        pembelian_detail as pd 
                    GROUP BY
                        kode_produk,
                        satuan_id
                ) sub3
            JOIN
                (
                SELECT
                    pd.kode_produk,
                    pd.satuan_id,
                    pd.harga_beli as harga_beli_terbaru,
                    pd.harga_jual as harga_jual_terbaru
                FROM
                    pembelian_detail as pd 
                JOIN
                    (
                        SELECT
                            pd.kode_produk,
                            MAX(pd.id) id,
                            pd.satuan_id
                        FROM
                            pembelian_detail as pd
                        JOIN
                            pembelian as p on p.id=pd.invoice_id
                        JOIN
                            (
                                SELECT
                                    MAX(p.tanggal) lastest,
                                    kode_produk,
                                    satuan_id
                                FROM
                                    pembelian_detail as pd
                                JOIN pembelian as p on p.id=pd.invoice_id
                                GROUP BY
                                    kode_produk,
                                    satuan_id
                            ) sub1 on sub1.kode_produk=pd.kode_produk and sub1.lastest=p.tanggal and sub1.satuan_id=pd.satuan_id
                        GROUP BY
                        pd.kode_produk,
                        pd.satuan_id
                    ) sub2 on pd.id=sub2.id and pd.kode_produk=sub2.kode_produk
                ) sub4 on sub3.kode_produk=sub4.kode_produk and sub3.satuan_id=sub4.satuan_id
        )");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
