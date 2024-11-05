<?php

namespace App\DataTransferObjects\Produk;

use OpenSoutheners\LaravelDto\DataTransferObject;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;
# Models
use App\Models\Kategori;

final class DetailKategoriDTO extends DataTransferObject
{
	public function __construct(
		public ?int $id = null,

		#[BindModel(using: 'id')]
		#[WithDefaultValue(Kategori::class)]
		public Kategori|null $kategori = null,
	) {
		// 
	}
}
