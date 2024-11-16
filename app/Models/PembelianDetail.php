<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PembelianDetail extends Model
{
	protected $table = 'pembelian_detail';

	public function data_produk(): BelongsTo
	{
		return $this->belongsTo(DataProduk::class, 'kode_produk', 'kode_produk');
	}

	public function satuan(): BelongsTo
	{
		return $this->belongsTo(SatuanProduk::class, 'satuan_id', 'id');
	}
}
