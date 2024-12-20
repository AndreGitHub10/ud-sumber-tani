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
		#[WithDefaultValue('tunai')]
		public string|null $jenis_pembayaran = 'tunai',
		#[WithDefaultValue('lunas')]
		public string|null $hutang = 'lunas',
		#[WithDefaultValue(true)]
		public bool $is_lunas = true,
		#[WithDefaultValue(false)]
		public bool $is_hutang = false,
		#[WithDefaultValue(null)]
		public string|null $tanggal_pelunasan = null,
		#[WithDefaultValue(null)]
		public int|string|null $kembalian = null,
		#[WithDefaultValue(null)]
		public int|string|null $pembayaran = null,
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

		if ($this->hutang=='hutang') {
			$this->is_lunas = false;
			$this->is_hutang = true;
		} else {
			$this->is_lunas = true;
			$this->is_hutang = false;
		}

		if (count($this->array_diskon)) {
			foreach($this->array_diskon as $key => $val){
				$this->array_diskon[$key] = (int)preg_replace("/\D+/", "", $val);
			}
		}

		$array = ['kembalian', 'pembayaran'];
		foreach($array as $key => $val){
			if ($this->$val) {
				$this->$val = (int)preg_replace("/\D+/", "", $this->$val);
			}
		}
	}
}
