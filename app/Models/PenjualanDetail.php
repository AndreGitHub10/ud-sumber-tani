<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenjualanDetail extends Model
{
	protected $table = "penjualan_detail";

	// protected function casts() 
	// {
	// 	return [
	// 		'diskon' => 'decimal',
	// 		'harga_jual' => 'decimal',
	// 		'total_harga_jual_murni' => 'decimal',
	// 		'total_harga_jual_diskon' => 'decimal'
	// 	];
	// }

	public function getDiskonAttribute($value)
	{
		return (float)$value;
	}

	public function getHargaJualAttribute($value)
	{
		return (float)$value;
	}

	public function getTotalHargaJualMurniAttribute($value)
	{
		return (float)$value;
	}

	public function getTotalHargaJualDiskonAttribute($value)
	{
		return (float)$value;
	}

	public function penjualan(): BelongsTo
	{
		return $this->belongsTo(Penjualan::class, 'penjualan_id', 'id');
	}

	public function pembelian_detail(): BelongsTo
	{
		return $this->belongsTo(PembelianDetail::class, 'detail_pembelian_id', 'id');
	}
}
