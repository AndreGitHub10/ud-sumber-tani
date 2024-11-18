<?php

namespace App\DataTransferObjects\Penjualan;

use OpenSoutheners\LaravelDto\DataTransferObject;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;

final class PostPenjualanDetailDTO extends DataTransferObject
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
		public int|null $id_penjualan = null,
		#[WithDefaultValue(null)]
		public int|null $id_pembelian_detail = null,
		#[WithDefaultValue(null)]
		public int|string|null $diskon = null,
		#[WithDefaultValue(null)]
		public int|null $jumlah = null,
		#[WithDefaultValue(null)]
		public int|null $harga_jual = null,
		#[WithDefaultValue(null)]
		public int|null $total_harga_jual_murni = null,
		#[WithDefaultValue(null)]
		public int|null $total_harga_jual_diskon = null,
	) {
		if ($this->diskon) {
			$this->diskon = (int)preg_replace("/\D+/", "", $this->diskon);
		}
	}
}
