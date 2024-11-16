<?php

namespace App\DataTransferObjects\Response;

use OpenSoutheners\LaravelDto\DataTransferObject;

final class ResponseAxiosDTO extends DataTransferObject
{
	/**
	 * Please check the DTO guide before you start. https://docs.opensoutheners.com/laravel-dto
	 */
	public function __construct(
		public ?int $code = 200,
		public string $message = 'Default message',
		public array|Collection|int|string|null $response = null
	) {
		// 
	}
}
