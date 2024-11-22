<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SatuanProduk extends Model
{
	protected $table = 'satuan_produk';

	public function data_produk(): HasMany
	{
		return $this->hasMany(DataProduk::class, 'satuan_id', 'id');
	}

	public function minmax_produk(): HasMany
	{
		return $this->hasMany(MinMaxProduk::class, 'satuan_id', 'id');
	}

	public function pembelian_detail(): HasMany
	{
		return $this->hasMany(PembelianDetail::class, 'satuan_id', 'id');
	}

	public function konversi_satuan_asal(): HasMany
	{
		return $this->hasMany(KonversiSatuan::class, 'satuan_id_asal', 'id');
	}

	public function konversi_satuan_tujuan(): HasMany
	{
		return $this->hasMany(KonversiSatuan::class, 'satuan_id_tujuan', 'id');
	}
}
