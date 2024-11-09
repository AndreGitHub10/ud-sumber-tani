<?php

namespace App\DataTransferObjects\Produk;

use OpenSoutheners\LaravelDto\DataTransferObject;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;
# Models
use App\Models\KategoriProduk;

final class DetailKategoriDTO extends DataTransferObject
{
	public function __construct(
		#[WithDefaultValue(200)]
		public int $res_code,

		#[WithDefaultValue('Ok')]
		public string $res_message,

		#[WithDefaultValue(false)]
		public bool $is_destroy,

		public int|null $id_kategori = null,

		#[BindModel(using: 'id')]
		#[WithDefaultValue(KategoriProduk::class)]
		public KategoriProduk|null $kategori = null,
	) {
		if ($is_destroy) {
			$this->res_message = 'Data berhasil dihapus';
		}

		if ($id_kategori && !$kategori) {
			$this->res_code = 204;
			$this->res_message = 'Data tidak ditemukan';
		}
	}
}
