<?php

namespace App\DataTransferObjects\User;

use Illuminate\Http\Request;
use OpenSoutheners\LaravelDto\Attributes\BindModel;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;
use OpenSoutheners\LaravelDto\DataTransferObject;

# Models
use App\Models\Auth\User;

final class DetailUserDTO extends DataTransferObject
{
	/**
	 * Please check the DTO guide before you start. https://docs.opensoutheners.com/laravel-dto
	 */
	public function __construct(
		public int $res_code,
		public string $res_message,
		public int|null $id_user,
		#[BindModel(using: 'id')]
		#[WithDefaultValue(User::class)]
		public User|null $user,
	) {
		// 
	}

	public static function fromRequest(Request $request): self
	{
		$user = $request->id_user ? User::find($request->id_user) : null;

		return new self(
			$user ? 200 : 204,
			$user ? 'Data berhasil dihapus' : 'Data tidak ditemukan',
			$request->id_user ?? null,
			$user,
		);
	}
}
