<?php

namespace App\DataTransferObjects\Produk;

use OpenSoutheners\LaravelDto\DataTransferObject;
use OpenSoutheners\LaravelDto\Contracts\ValidatedDataTransferObject;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;
# Form request
use App\Http\Requests\Produk\PostDataRequest;
# Models
use App\Models\DataProduk;

final class PostDataDTO extends DataTransferObject implements ValidatedDataTransferObject
{
	/**
	 * Please check the DTO guide before you start. https://docs.opensoutheners.com/laravel-dto
	 */
	public function __construct(
		#[WithDefaultValue(201)]
		public int $res_code,
		#[WithDefaultValue('Data berhasil dibuat')]
		public string $res_message,
		public string $nama_produk = "",
		public int|null $id_data_produk = null,
		// public int|null $kategori_produk_id = null,
		public int|null $kategori_id = null,
		public string|null $kode_produk = null,
		public object|null $foto_directory = null,
	) {
		if ($id_data_produk) {
			$this->res_code = 200;
			$this->res_message = 'Data berhasil diperbarui';
		}
	}

	/**
	 * Get form request that this data transfer object is based from.
	 */
	public static function request(): string
	{
		return PostDataRequest::class;
	}
}
