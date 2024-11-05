<?php

namespace App\DataTransferObjects\Produk;

use OpenSoutheners\LaravelDto\DataTransferObject;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;
# Models
use App\Models\Satuan;

final class DetailSatuanDTO extends DataTransferObject
{
	public function __construct(
		public ?int $id = null,

		#[BindModel(using: 'id')]
		#[WithDefaultValue(Satuan::class)]
		public Satuan|null $satuan = null,
	) {
		// 
	}
}
