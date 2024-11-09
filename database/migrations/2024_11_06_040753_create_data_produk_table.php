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
		Schema::create('data_produk', function (Blueprint $table) {
			$table->id();
			$table->string('kode_produk');
			$table->integer('satuan_id');
			$table->integer('kategori_id');
			$table->string('nama_produk');
			$table->text('foto_directory');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('data_produk');
	}
};
