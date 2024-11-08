<?php

namespace App\DataTransferObjects\User;

use Illuminate\Http\Request;
use OpenSoutheners\LaravelDto\DataTransferObject;
// use OpenSoutheners\LaravelDto\Contracts\ValidatedDataTransferObject;

# Form request validation
use App\Http\Requests\User\PostSupplierRequest;

final class PostSupplierDTO extends DataTransferObject
// final class PostSupplierDTO extends DataTransferObject implements ValidatedDataTransferObject
{
	public function __construct(
		public string $kode,
		public string $nama,
		public string|null $nomor_hp,
		public string|null $alamat,
		public string|null $keterangan,
		public int|null $id_supplier = null,
	) {
		// 
	}

	public static function fromRequest(Request $request): PostSupplierDTO
	{
		return new self(
			$request->input('kode'),
			$request->input('nama'),
			$request->input('nomor_hp') ?? null,
			$request->input('alamat') ?? null,
			$request->input('keterangan') ?? null,
            $request->input('id_supplier') ?? null,
		);
	}

	/**
	 * Get form request that this data transfer object is based from.
	 */
	// public static function request(): string
	// {
	// 	return PostUserRequest::class;
	// }
}
