<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
	protected $table = 'supplier';
    
	public function data_produk(): HasMany
	{
		return $this->hasMany(Pembelian::class, 'supplier_id', 'id');
	}
}
