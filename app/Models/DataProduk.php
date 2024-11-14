<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataProduk extends Model
{
	protected $table = 'data_produk';

	public function satuan(): BelongsTo
	{
		return $this->belongsTo(SatuanProduk::class, 'satuan_id', 'id');
	}

	public function kategori(): BelongsTo
	{
		return $this->belongsTo(KategoriProduk::class, 'kategori_id', 'id');
	}

	public function pembelian_detail(): HasMany
	{
		return $this->hasMany(KategoriProduk::class, 'kode_produk', 'kode_produk');
	}
}
