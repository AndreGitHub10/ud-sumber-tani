<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KonversiSatuan extends Model
{
	protected $table = 'konversi_satuan';

	public function satuan_asal(): BelongsTo
	{
		return $this->belongsTo(SatuanProduk::class, 'satuan_id_asal', 'id');
	}

	public function satuan_tujuan(): BelongsTo
	{
		return $this->belongsTo(SatuanProduk::class, 'satuan_id_tujuan', 'id');
	}
}
