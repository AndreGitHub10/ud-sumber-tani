<?php

namespace App\DataTransferObjects\Produk;

use OpenSoutheners\LaravelDto\DataTransferObject;

use Illuminate\Http\Request;
use OpenSoutheners\LaravelDto\Contracts\ValidatedDataTransferObject;

# Form request
use App\Http\Requests\Produk\PostSatuanRequest;

final class PostSatuanDTO extends DataTransferObject implements ValidatedDataTransferObject
{
	/**
	 * Please check the DTO guide before you start. https://docs.opensoutheners.com/laravel-dto
	 */
	public function __construct(
		public int $res_code,
		public string $res_message,
		public string $nama,
		public int|null $id_satuan,
	) {
		// 
	}

	public static function fromRequest(Request $request): self
	{
		# $id_satuan ada, berarti data lama
		$isNew = $request->id_satuan ? false : true;

		return new self(
			$isNew ? 201 : 200,
			$isNew ? 'Data berhasil disimpan' : 'Data berhasil diperbarui',
			strtolower($request->nama),
			$request->id_satuan ?? null,
		);
	}

	/**
	 * Get form request that this data transfer object is based from.
	 */
	public static function request(): string
	{
		return PostSatuanRequest::class;
	}
}
