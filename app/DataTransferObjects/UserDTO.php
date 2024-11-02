<?php

namespace App\DataTransferObjects;

use OpenSoutheners\LaravelDto\DataTransferObject;
use OpenSoutheners\LaravelDto\Attributes\BindModel;
use Illuminate\Support\Collection;

# Models
// use App\Models\Auth\User;
use App\Models\User;

final class UserDTO extends DataTransferObject
{
	// public string $name;
	// public string $level;
	// public bool $is_api;
	// public string $username;
	// public ?string $email;

	public function __construct(
		#[BindModel(using: 'id')]
		// #[BindModel(using: [User::class => 'id'])]
		// #[BindModel(with: [
		// 	User::class => 'level',
		// ])]
		// #[BindModel(using: [User::class => 'level'])]
		// public ?User $user = null,
		public ?Collection $user = null,
		public ?string $name = null,
		public ?string $level = null,
		// public ?bool $is_api = null,
		// public ?string $username = null,
		// public ?string $email = null,
		// public string $email = null,
	) {
		// 
	}

	public function transform()
	{
		return [
			'name' => ucfirst($this->name),
			// 'level' => strtolower($this->level),
			'username' => strtolower($this->username),
			'email' => strtoupper($this->email),
		];
	}
}
