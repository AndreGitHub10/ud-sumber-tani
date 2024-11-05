<?php

namespace App\Services\User;

use Illuminate\Http\Request;

# DTO
use App\DataTransferObjects\User\PostUserDTO;
use App\DataTransferObjects\User\DetailUserDTO;

# Models
use App\Models\Auth\User;

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

	public function destroy(DetailUserDTO $userDTO): User
	// public function destroy(DetailUserDTO $userDTO): bool
	// public function destroy(Request $request): User
	// public function destroy(Request $request): bool
	{
		$user = User::find($request->id);
		// $user = User::find($userDTO->user_id);
		return $user;
		if ($user && $user->delete()) {
			return true;
		}
		return false;
	}
}