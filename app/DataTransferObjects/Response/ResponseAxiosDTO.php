<?php

namespace App\DataTransferObjects\Response;

use OpenSoutheners\LaravelDto\DataTransferObject;

final class ResponseAxiosDTO extends DataTransferObject
{
	public function __construct(
		public ?int $code = 200,
		public string $message = 'Default message',
		public string|null $response = null
	) {
		// 
	}
}
