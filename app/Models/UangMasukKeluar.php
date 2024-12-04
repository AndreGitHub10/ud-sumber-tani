<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UangMasukKeluar extends Model
{
    protected $table = 'uang_masuk_keluar';

	public function getJumlahAttribute($value)
	{
		return (float)$value;
	}
}
