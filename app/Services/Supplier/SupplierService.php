<?php

namespace App\Services\Supplier;

# DTO
use App\DataTransferObjects\UserDTO;

# Models
use App\Models\Auth\User;

class SupplierService
{
	public function store(UserDTO $userDTO)
	{
		$user = new User;
		$user->name = $userDTO->name;
		$user->level = $userDTO->level;
		$user->username = $userDTO->username;
		$user->email = $userDTO->email;
		$user->password = $userDTO->password;
		$user->save();
	}
}