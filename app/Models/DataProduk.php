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
		return $this->hasMany(PembelianDetail::class, 'kode_produk', 'kode_produk');
	}

	public function minmax_produk(): HasMany
	{
		return $this->hasMany(MinMaxProduk::class, 'kode_produk', 'kode_produk');
	}

	public function v_kartu_stok() : HasMany
	{
		return $this->hasMany(VKartuStok::class, 'kode_produk', 'kode_produk');
	}

	public function v_harga_barang() : HasMany
	{
		return $this->hasMany(VHargaBarang::class, 'kode_produk', 'kode_produk');
	}
}
