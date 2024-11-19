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
		Schema::create('konversi_satuan', function (Blueprint $table) {
			$table->integer('produk_id');
			$table->integer('satuan_id_asal');
			$table->integer('satuan_id_tujuan');
			$table->integer('jumlah_tujuan');
			$table->primary(['produk_id', 'satuan_id_asal', 'satuan_id_tujuan']);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('konversi_satuan');
	}
};
