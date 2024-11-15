<?php

namespace App\DataTransferObjects\Penjualan;

use OpenSoutheners\LaravelDto\DataTransferObject;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;
# Helpers
use App\Helpers\Generate;

final class PostPenjualanDTO extends DataTransferObject
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
		public array $array_diskon,
		#[WithDefaultValue([])]
		public array $array_harga_jual,
		#[WithDefaultValue([])]
		public array $array_jumlah,
		#[WithDefaultValue([])]
		public array $array_pembelian,
		#[WithDefaultValue([])]
		public array $array_total_harga_per_produk_diskon,
		#[WithDefaultValue([])]
		public array $array_total_harga_per_produk_murni,
		#[WithDefaultValue(null)]
		public int|null $total_semua_harga_diskon = null,
		#[WithDefaultValue(null)]
		public int|null $total_semua_harga_murni = null,
		#[WithDefaultValue(null)]
		public int|null $id_penjualan = null,
		#[WithDefaultValue("")]
		public string $nomor_kwitansi = "",
	) {
		if (!$this->id_penjualan) {
			$this->nomor_kwitansi = Generate::nomorKwitansi();
		}
	}
}
