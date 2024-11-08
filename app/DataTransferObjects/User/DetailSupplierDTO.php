<?php

namespace App\DataTransferObjects\User;

use OpenSoutheners\LaravelDto\DataTransferObject;

use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;

# Models
use App\Models\Supplier;

final class DetailSupplierDTO extends DataTransferObject
{
	public function __construct(
		public ?int $id_supplier = null,

		#[BindModel(using: 'id')]
		#[WithDefaultValue(Supplier::class)]
		public Supplier|null $supplier = null,
	) {
		// 
	}
}
