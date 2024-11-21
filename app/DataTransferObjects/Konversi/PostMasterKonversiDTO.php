<?php

namespace App\DataTransferObjects\Konversi;

use OpenSoutheners\LaravelDto\DataTransferObject;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;

final class PostMasterKonversiDTO extends DataTransferObject
{
	/**
	 * Please check the DTO guide before you start. https://docs.opensoutheners.com/laravel-dto
	 */
	public function __construct(
		#[WithDefaultValue(201)]
		public int $res_code,

		#[WithDefaultValue('Data berhasil dibuat')]
		public string $res_message,

		#[WithDefaultValue(null)]
		public int|null $id_konversi_satuan = null,

		#[WithDefaultValue(null)]
		public int|null $satuan_asal = null,

		#[WithDefaultValue(null)]
		public int|null $satuan_tujuan = null,

		#[WithDefaultValue(null)]
		public int|null $nilai_konversi = null,
	) {
		if ($id_konversi_satuan) {
			$this->res_code = 200;
			$this->res_message = 'Data berhasil diperbarui';
		}
	}
}
