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
		Schema::create('pembelian', function (Blueprint $table) {
			$table->id();
			$table->string('supplier_id');
			$table->string('nomor_invoice');
			$table->decimal('total_harga', total: 10, places: 0);
			$table->date('tanggal')->comment("Tanggal pembelian sesuai invoice");
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('pembelian');
	}
};
