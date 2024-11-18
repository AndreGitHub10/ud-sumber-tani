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
        DB::statement("CREATE OR REPLACE VIEW v_detail_kartu_stok AS
            SELECT
                dp.kode_produk AS kode_produk,
                p.nomor_invoice AS nomor_invoice,
                pd.id AS detail_pembelian_id,
                NULL AS detail_penjualan_id,
                pd.stok_awal AS stok_masuk,
                pd.satuan_id AS satuan_id,
                NULL AS stok_keluar,
                pd.created_at AS ts 
            FROM
                ((
                        data_produk dp
                        JOIN pembelian_detail pd ON ((
                                dp.kode_produk = pd.kode_produk 
                            )))
                    JOIN pembelian p ON ((
                            p.id = pd.invoice_id 
                        ))) UNION
            SELECT
                dp.kode_produk AS kode_produk,
                sub_pd2.nomor_kwitansi AS nomor_invoice,
                NULL AS detail_pembelian_id,
                sub_pd2.detail_penjualan_id AS detail_penjualan_id,
                NULL AS stok_masuk,
                pd.satuan_id AS satuan_id,
                sub_pd2.jumlah AS stok_keluar,
                sub_pd2.created_at AS ts 
            FROM
                ((
                        data_produk dp
                        JOIN pembelian_detail pd ON ((
                                dp.kode_produk = pd.kode_produk 
                            )))
                    JOIN (
                    SELECT
                        pd.id AS id,
                        pd2.id AS detail_penjualan_id,
                        pd2.jumlah AS jumlah,
                        pd2.created_at AS created_at,
                        p.nomor_kwitansi AS nomor_kwitansi 
                    FROM
                        ((
                                pembelian_detail pd
                                JOIN penjualan_detail pd2 ON ((
                                        pd.id = pd2.detail_pembelian_id 
                                    )))
                            JOIN penjualan p ON ((
                                    p.id = pd2.penjualan_id 
                                )))) sub_pd2 ON ((
                        pd.id = sub_pd2.id 
                )))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('v_detail_kartu_stok');
    }
};
