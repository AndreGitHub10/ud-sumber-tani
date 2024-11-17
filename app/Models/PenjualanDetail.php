<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenjualanDetail extends Model
{
	protected $table = "penjualan_detail";

	public function penjualan_detail(): BelongsTo
	{
		return $this->belongsTo(Penjualan::class, 'penjualan_id', 'id');
	}

	public function pembelian_detail(): BelongsTo
	{
		return $this->belongsTo(PembelianDetail::class, 'detail_pembelian_id', 'id');
	}
}
