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
		Schema::create('penjualan', function (Blueprint $table) {
			$table->id();
			$table->integer('user_id');
			$table->string('nomor_kwitansi');
			$table->enum('jenis_pembayaran', ['non-tunai', 'tunai'])->default('non-tunai');
			$table->decimal('pembayaran', total: 10, places: 0);
			$table->decimal('kembalian', total: 10, places: 0);
			$table->decimal('total_penjualan_murni', total: 10, places: 0);
			$table->decimal('total_penjualan_diskon', total: 10, places: 0);
			$table->date("tanggal");
			$table->string('nama_pembeli')->nullable();
			$table->boolean('is_hutang')->default(false);
			$table->boolean('is_lunas')->default(true);
			$table->date("tanggal_pelunasan")->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('penjualan');
	}
};
