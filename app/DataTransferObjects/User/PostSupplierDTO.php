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
		public int $res_code,
		public string $res_message,
        public string $nama,
		public string|null $kode,
		public string|null $nomor_hp,
		public string|null $alamat,
		public string|null $keterangan,
		public int|null $id_supplier,
	) {
		// 
	}

	public static function fromRequest(Request $request): PostSupplierDTO
	{
		# $id_supplier ada, berarti data lama
		$isNew = $request->id_supplier ? false : true;

		return new self(
			$isNew ? 201 : 200,
			$isNew ? 'Data berhasil disimpan' : 'Data berhasil diperbarui',
            $request->nama,
			$request->kode ?? null,
			$request->nomor_hp ?? null,
			$request->alamat ?? null,
			$request->keterangan ?? null,
			$request->id_supplier ?? null,
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
