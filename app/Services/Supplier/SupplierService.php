<?php

namespace App\Services\User;

# DTO
use App\DataTransferObjects\User\PostUserDTO;

# Models
use App\Models\Auth\User;

class SupplierService
{
	public function create(PostUserDTO $userDTO): User
	{
		$user = new User;
		$user->name = $userDTO->name;
		$user->level = $userDTO->level;
		$user->username = $userDTO->username;
		$user->email = $userDTO->email;
		$user->password = $userDTO->password;
		$user->save();

		return $user;
	}
}