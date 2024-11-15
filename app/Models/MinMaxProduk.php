<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MinMaxProduk extends Model
{
	protected $table = 'minmax_produk';

	public function data_produk(): BelongsTo
	{
		return $this->belongsTo(DataProduk::class, 'produk_id', 'id');
	}
}
