<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

	public function penjualan_detail(): HasMany
	{
		return $this->hasMany(PenjualanDetail::class, 'detail_pembelian_id', 'id');
	}
}
