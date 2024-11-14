<?php

namespace App\DataTransferObjects\Pembelian;

use OpenSoutheners\LaravelDto\DataTransferObject;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;

final class PostPembelianDetailDTO extends DataTransferObject
{
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
	) {
		if ($id_pembelian) {
			$this->res_code = 200;
			$this->res_message = 'Data berhasil diperbarui';
		}

		// $this->nama = strtolower($this->nama);
	}
}
