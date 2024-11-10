<?php

namespace App\DataTransferObjects\Produk;

use OpenSoutheners\LaravelDto\DataTransferObject;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;
# Models
use App\Models\DataProduk;

final class DetailDataDTO extends DataTransferObject
{
	public function __construct(
		#[WithDefaultValue(200)]
		public int $res_code,

		#[WithDefaultValue('Ok')]
		public string $res_message,

		#[WithDefaultValue(false)]
		public bool $is_destroy,

		public int|null $id_data_produk = null,

		#[BindModel(using: 'id')]
		#[WithDefaultValue(DataProduk::class)]
		public DataProduk|null $model_data_produk = null,
	) {
		if ($is_destroy) {
			$this->res_message = 'Data berhasil dihapus';
		}

		if ($id_data_produk && !$model_data_produk) {
			$this->res_code = 204;
			$this->res_message = 'Data tidak ditemukan';
		}
	}
}
