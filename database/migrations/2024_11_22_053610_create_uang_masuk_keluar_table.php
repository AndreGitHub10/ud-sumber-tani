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
        Schema::create('uang_masuk_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->dateTime('tanggal_waktu');
            $table->decimal('jumlah', total: 10, places: 0);
            $table->integer('type_id')->comment('1=masuk,2=keluar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uang_masuk_keluar');
    }
};
