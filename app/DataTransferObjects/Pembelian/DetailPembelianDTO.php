<?php

namespace App\DataTransferObjects\Pembelian;

use OpenSoutheners\LaravelDto\Attributes\BindModel;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;
use OpenSoutheners\LaravelDto\DataTransferObject;
# Models
use App\Models\Pembelian;

final class DetailPembelianDTO extends DataTransferObject
{
	/**
	 * Please check the DTO guide before you start. https://docs.opensoutheners.com/laravel-dto
	 */
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
