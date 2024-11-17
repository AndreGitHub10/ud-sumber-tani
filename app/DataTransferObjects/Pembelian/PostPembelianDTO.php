<?php

namespace App\DataTransferObjects\Pembelian;

use OpenSoutheners\LaravelDto\DataTransferObject;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;

final class PostPembelianDTO extends DataTransferObject
{
	/**
	 * Please check the DTO guide before you start. https://docs.opensoutheners.com/laravel-dto
	 */
	public function __construct(
		#[WithDefaultValue(201)]
		public int $res_code,

		#[WithDefaultValue('Data berhasil dibuat')]
		public string $res_message,

		#[WithDefaultValue([])]
		public array $array_produk,

		#[WithDefaultValue([])]
		public array $array_satuan,

		#[WithDefaultValue([])]
		public array $array_jumlah,

		#[WithDefaultValue([])]
		public array $array_tanggal_kedaluwarsa,

		#[WithDefaultValue([])]
		public array $array_harga_beli,

		#[WithDefaultValue([])]
		public array $array_total_harga,

		#[WithDefaultValue([])]
		public array $array_harga_jual,

		#[WithDefaultValue([])]
		public array $array_id_pembelian_detail,

		#[WithDefaultValue(null)]
		public int|null $id_supplier = null,

		#[WithDefaultValue(null)]
		public string|null $nomor_invoice = null,

		#[WithDefaultValue(null)]
		public int|null $total_semua_harga = null,

		#[WithDefaultValue(null)]
		public string|null $tanggal_pembelian = null,

		public int|null $id_pembelian = null,
	) {
		if ($id_pembelian) {
			$this->res_code = 200;
			$this->res_message = 'Data berhasil diperbarui';
		}

		// $this->nama = strtolower($this->nama);
	}
}
