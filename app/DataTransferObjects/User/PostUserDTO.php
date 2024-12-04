<?php

namespace App\DataTransferObjects\User;

use Illuminate\Http\Request;
use OpenSoutheners\LaravelDto\DataTransferObject;
use OpenSoutheners\LaravelDto\Contracts\ValidatedDataTransferObject;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;

# Form request validation
use App\Http\Requests\User\PostUserRequest;

final class PostUserDTO extends DataTransferObject implements ValidatedDataTransferObject
{
	/**
	 * Please check the DTO guide before you start. https://docs.opensoutheners.com/laravel-dto
	 */
	public function __construct(
		public int $res_code,
		public string $res_message,
		public string $name,
		public string $level,
		public string $username,
		public string|null $email,
		public string|null $password,

		#[WithDefaultValue(null)]
		public string|null $id_user,
	) {
		// 
	}

	public static function fromRequest(Request $request): self
	{
		# $id_user ada, berarti data lama
		$isNew = $request->id_user ? false : true;

		return new self(
			$isNew ? 201 : 200,
			$isNew ? 'Data berhasil disimpan' : 'Data berhasil diperbarui',
			$request->name,
			strtolower($request->level),
			strtolower($request->username),
			$request->email ? strtolower($request->email) : null,
			$request->password ? bcrypt($request->password) : null,
			$request->id_user ?? null,
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
