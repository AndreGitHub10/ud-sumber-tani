<?php

namespace App\DataTransferObjects\Produk;

use OpenSoutheners\LaravelDto\DataTransferObject;

use Illuminate\Http\Request;
use OpenSoutheners\LaravelDto\Contracts\ValidatedDataTransferObject;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;
# Form request
use App\Http\Requests\Produk\PostSatuanRequest;

final class PostSatuanDTO extends DataTransferObject implements ValidatedDataTransferObject
{
	/**
	 * Please check the DTO guide before you start. https://docs.opensoutheners.com/laravel-dto
	 */
	public function __construct(
		#[WithDefaultValue(201)]
		public int $res_code,

		#[WithDefaultValue('Data berhasil dibuat')]
		public string $res_message,

		public string $nama = "",

		public int|null $id_satuan = null,
	) {
		if ($id_satuan) {
			$this->res_code = 200;
			$this->res_message = 'Data berhasil diperbarui';
		}

        $this->nama = strtolower($this->nama);
	}
	// public function __construct(
	// 	#[WithDefaultValue(201)]
	// 	public int $res_code,

	// 	#[WithDefaultValue('Data berhasil dibuat')]
	// 	public string $res_message,

	// 	public string $nama = "",

	// 	public int|null $id_satuan = null,
	// ) {
	// 	// 
	// }

	// public static function fromRequest(Request $request): self
	// {
	// 	# $id_satuan ada, berarti data lama
	// 	$isNew = $request->id_satuan ? false : true;

	// 	return new self(
	// 		$isNew ? 201 : 200,
	// 		$isNew ? 'Data berhasil dibuat' : 'Data berhasil diperbarui',
	// 		strtolower($request->nama),
	// 		// $this->id_satuan
	// 		$request->id_satuan ? $request->id_satuan : null,
	// 	);
	// }

	/**
	 * Get form request that this data transfer object is based from.
	 */
	public static function request(): string
	{
		return PostSatuanRequest::class;
	}
}
