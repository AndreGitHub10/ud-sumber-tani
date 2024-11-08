<?php

namespace App\DataTransferObjects\User;

use OpenSoutheners\LaravelDto\DataTransferObject;

use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;

# Models
use App\Models\Auth\User;

final class DetailUserDTO extends DataTransferObject
{
	public function __construct(
		public ?int $id = null,

		#[BindModel(using: 'id')]
		#[WithDefaultValue(User::class)]
		public User|null $user = null,
	) {
		// 
	}
}
