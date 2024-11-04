<?php

namespace App\Models\Auth;

# Package
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;

class User extends Authenticatable
{
	protected $table = 'users';
	use HasFactory;
	
	protected $hidden = [
		'password',
		'remember_token',
	];
}
