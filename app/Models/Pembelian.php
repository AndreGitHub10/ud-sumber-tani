<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembelian extends Model
{
	protected $table = 'pembelian';
    
	public function supplier(): BelongsTo
	{
		return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
	}
}
