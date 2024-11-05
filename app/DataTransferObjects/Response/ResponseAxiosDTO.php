<?php

namespace App\DataTransferObjects\Response;

use OpenSoutheners\LaravelDto\DataTransferObject;

final class ResponseAxiosDTO extends DataTransferObject
{
	public function __construct(
		public ?int $code = 200,
		public string $message = 'Default message',
		public array|Collection|int|string|null $response = null
	) {
		// 
	}
}
