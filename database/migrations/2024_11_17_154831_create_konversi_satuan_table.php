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
			$table->id();
			$table->integer('satuan_id_asal');
			$table->integer('satuan_id_tujuan');
			$table->integer('nilai_konversi');
			// $table->primary(['satuan_id_asal', 'satuan_id_tujuan', 'nilai_konversi']);
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
