<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriProduk extends Model
{
	protected $table = 'kategori_produk';

    public function data_produk(): HasMany
    {
        return $this->hasMany(DataProduk::class, 'kategori_id', 'id');
    }
}
