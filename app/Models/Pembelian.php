<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pembelian extends Model
{
	protected $table = 'pembelian';
    
	public function supplier(): BelongsTo
	{
		return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
	}

    public function pembelian_detail(): HasMany
    {
        return $this->hasMany(PembelianDetail::class, 'invoice_id', 'id');
    }
}
