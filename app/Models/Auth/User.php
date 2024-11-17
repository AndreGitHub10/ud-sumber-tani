<?php

namespace App\Models\Auth;

# Package

use App\Models\Penjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
	protected $table = 'users';
	use HasFactory;
	
	protected $hidden = [
		'password',
		'remember_token',
	];

	public function penjualan(): HasMany 
	{
		return $this->hasMany(Penjualan::class, 'user_id', 'id');
	}
}
