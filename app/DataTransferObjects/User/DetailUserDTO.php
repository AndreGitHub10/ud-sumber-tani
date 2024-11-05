<?php

namespace App\DataTransferObjects\User;

use OpenSoutheners\LaravelDto\DataTransferObject;

final class DetailUserDTO extends DataTransferObject
{
	public function __construct(
		public int $id
	) {
		// 
	}
}
