<?php

namespace App\DataTransferObjects\Pembelian;

use OpenSoutheners\LaravelDto\Attributes\BindModel;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;
use OpenSoutheners\LaravelDto\DataTransferObject;
# Models
use App\Models\PembelianDetail;

final class DetailPembelianDetailDTO extends DataTransferObject
{
	/**
	 * Please check the DTO guide before you start. https://docs.opensoutheners.com/laravel-dto
	 */
	public function __construct(
		#[WithDefaultValue(200)]
		public int $res_code,

		#[WithDefaultValue('Ok')]
		public string $res_message,

		#[WithDefaultValue([])]
		public array $array_id_pembelian_detail,

		#[WithDefaultValue(false)]
		public bool $is_destroy,

		#[WithDefaultValue(null)]
		public int|null $id_pembelian = null,

		#[WithDefaultValue(null)]
		public int|null $id_pembelian_detail = null,

		#[WithDefaultValue(null)]
		public int|null $jumlah_qty_penjualan = null,

		#[WithDefaultValue(null)]
		public int|null $stok_real_terbaru = null,

		#[WithDefaultValue("")]
		public string|null $query_string = "",

		#[BindModel(using: 'id', with: ['data_produk'])]
		#[WithDefaultValue(PembelianDetail::class)]
		public PembelianDetail|null $model_pembelian_detail = null,
	) {
		if ($model_pembelian_detail && $jumlah_qty_penjualan) {
			// $stokReal = $this->model_pembelian_detail->stok_real;
			// $stokReal = $this->model_pembelian_detail;
			// \Log::debug($stokReal);
			// \Log::debug(json_encode($this->model_pembelian_detail->stok_real, JSON_PRETTY_PRINT));
			$this->stok_real_terbaru = $this->model_pembelian_detail->stok_real - $this->jumlah_qty_penjualan;
			// $this->stok_real_terbaru = $this->model_pembelian_detail['stok_real'];
		}
	}
}
