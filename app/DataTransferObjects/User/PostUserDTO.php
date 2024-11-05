<?php

namespace App\DataTransferObjects\User;

use Illuminate\Http\Request;
use OpenSoutheners\LaravelDto\DataTransferObject;
use OpenSoutheners\LaravelDto\Contracts\ValidatedDataTransferObject;

# Form request validation
use App\Http\Requests\User\PostUserRequest;

final class PostUserDTO extends DataTransferObject implements ValidatedDataTransferObject
{
	public function __construct(
		public string $name,
		public string $level,
		public string $username,
		public string|null $email,
		public string|null $password,
		public int|null $id = null,
	) {
		// 
	}

	public static function fromRequest(Request $request): PostUserDTO
	{
		return new self(
			$request->input('name'),
			strtolower($request->input('level')),
			strtolower($request->input('username')),
			$request->input('email') ? strtolower($request->input('email')) : null,
			$request->input('password') ? bcrypt($request->input('password')) : null,
            $request->input('id') ?? null,
		);
	}

	/**
	 * Get form request that this data transfer object is based from.
	 */
	public static function request(): string
	{
		return PostUserRequest::class;
	}
}
