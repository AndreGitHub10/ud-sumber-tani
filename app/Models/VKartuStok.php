<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class VKartuStok extends Model
{
    protected $table = 'v_kartu_stok';

	public function data_produk(): BelongsTo
	{
		return $this->belongsTo(DataProduk::class, 'kode_produk', 'kode_produk');
	}

	public function satuan_produk() : HasOne
	{
		return $this->hasOne(SatuanProduk::class, 'id', 'satuan_id');
	}
}
