<?php

namespace App\DataTransferObjects\Produk;

use OpenSoutheners\LaravelDto\DataTransferObject;
use OpenSoutheners\LaravelDto\Contracts\ValidatedDataTransferObject;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;
# Form request
use App\Http\Requests\Produk\PostKategoriRequest;

final class PostKategoriDTO extends DataTransferObject implements ValidatedDataTransferObject
{
	/**
	 * Please check the DTO guide before you start. https://docs.opensoutheners.com/laravel-dto
	 */
	public function __construct(
		#[WithDefaultValue(201)]
		public int $res_code,

		#[WithDefaultValue('Data berhasil dibuat')]
		public string $res_message,

		public string $nama = "",

		public int|null $id_kategori = null,
	) {
		if ($id_kategori) {
			$this->res_code = 200;
			$this->res_message = 'Data berhasil diperbarui';
		}

		$this->nama = strtolower($this->nama);
	}

	/**
	 * Get form request that this data transfer object is based from.
	 */
	public static function request(): string
	{
		return PostKategoriRequest::class;
	}
}
