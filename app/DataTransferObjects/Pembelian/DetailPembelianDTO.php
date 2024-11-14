<?php

namespace App\DataTransferObjects\Pembelian;

use OpenSoutheners\LaravelDto\DataTransferObject;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;
# Models
use App\Models\Pembelian;

final class DetailPembelianDTO extends DataTransferObject
{
	public function __construct(
		#[WithDefaultValue(200)]
		public int $res_code,

		#[WithDefaultValue('Ok')]
		public string $res_message,

		#[WithDefaultValue(false)]
		public bool $is_destroy,

		public int|null $id_pembelian = null,

		#[BindModel(using: 'id')]
		#[WithDefaultValue(Pembelian::class)]
		public Pembelian|null $model_pembelian = null,
	) {
		// 
	}
}
