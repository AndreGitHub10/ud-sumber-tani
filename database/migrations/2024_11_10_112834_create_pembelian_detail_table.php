<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('pembelian_detail', function (Blueprint $table) {
			$table->id();
			$table->integer('invoice_id');
			$table->string('kode_produk');
			$table->integer('satuan_id');
			$table->integer('stok_awal')->nullable();
			$table->integer('stok_real');
			$table->date('tanggal_kedaluwarsa')->nullable();
			$table->decimal('harga_beli', total: 10, places: 0);
			$table->decimal('total_harga_beli', total: 10, places: 0);
			$table->decimal('harga_jual', total: 10, places: 0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('pembelian_detail');
	}
};
