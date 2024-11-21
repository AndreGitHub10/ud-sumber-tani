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
		Schema::create('penjualan_detail', function (Blueprint $table) {
			$table->id();
			$table->integer('penjualan_id');
			$table->integer('detail_pembelian_id');
			$table->decimal('diskon', total: 10, places: 0)->nullable()->comment("Diskon dalam bentuk nominal rupiah");
			$table->integer('jumlah')->comment("Jumlah qty");
			$table->decimal('harga_jual', total: 10, places: 0);
			$table->decimal('total_harga_jual_murni', total: 10, places: 0);
			$table->decimal('total_harga_jual_diskon', total: 10, places: 0);
			$table->boolean('is_konversi')->nullable()->default(0)->change();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('penjualan_detail');
	}
};
