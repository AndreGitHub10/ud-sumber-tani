<?php

namespace App\DataTransferObjects\Pembelian;

use OpenSoutheners\LaravelDto\Attributes\BindModel;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;
use OpenSoutheners\LaravelDto\DataTransferObject;
# Models
use App\Models\PembelianDetail;

final class PostPembelianDetailDTO extends DataTransferObject
{
	/**
	 * Please check the DTO guide before you start. https://docs.opensoutheners.com/laravel-dto
	 */
	public function __construct(
		#[WithDefaultValue(201)]
		public int $res_code,

		#[WithDefaultValue('Data berhasil dibuat')]
		public string $res_message,

		#[WithDefaultValue(null)]
		public int|null $id_pembelian = null,

		#[WithDefaultValue(null)]
		public string|null $kode_produk = null,

		#[WithDefaultValue(null)]
		public int|null $id_satuan = null,

		#[WithDefaultValue(null)]
		public int|null $jumlah = null,

		#[WithDefaultValue(null)]
		public string|null $tanggal_kedaluwarsa = null,

		#[WithDefaultValue(null)]
		public int|null $harga_beli = null,

		#[WithDefaultValue(null)]
		public int|null $total_harga_beli = null,

		#[WithDefaultValue(null)]
		public int|null $harga_jual = null,

		#[WithDefaultValue(null)]
		public int|null $id_pembelian_detail = null,

		#[BindModel(using: 'id')]
		#[WithDefaultValue(PembelianDetail::class)]
		public PembelianDetail|null $model_pembelian_detail = null,

		#[WithDefaultValue(null)]
		public int|null $stok_awal = null,

		#[WithDefaultValue(null)]
		public int|null $stok_real = null,
	) {
		if ($id_pembelian) {
			$this->res_code = 200;
			$this->res_message = 'Data berhasil diperbarui';
		}
		if ($model_pembelian_detail) {
			$this->stok_awal = $model_pembelian_detail->stok_awal;
			$this->stok_real = $model_pembelian_detail->stok_real;
		}
	}
}
