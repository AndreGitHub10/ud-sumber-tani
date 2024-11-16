<?php

namespace App\Services\User;

use Illuminate\Http\Request;

# DTO
use App\DataTransferObjects\User\PostUserDTO;
use App\DataTransferObjects\User\DetailUserDTO;

# Models
use App\Models\Auth\User;

use function Symfony\Component\Console\find;

class UserService
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

	public function update(PostUserDTO $userDTO): User
	{
		$user = User::find($userDTO->id_user);
		$user->name = $userDTO->name;
		$user->level = $userDTO->level;
		$user->username = $userDTO->username;
		$user->email = $userDTO->email;
		if ($userDTO->password) {
			$user->password = $userDTO->password;
		}
		$user->save();

		return $user;
	}

	public function destroy(DetailUserDTO $userDTO): bool
	{
		$user = User::find($userDTO->id_user);
		if ($user && $user->delete()) {
			return true;
		}
		return false;
	}
}