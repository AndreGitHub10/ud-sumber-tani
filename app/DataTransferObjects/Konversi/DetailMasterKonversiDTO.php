<?php

namespace App\DataTransferObjects\Konversi;

# Models
use App\Models\KonversiSatuan;
# DTO
use OpenSoutheners\LaravelDto\Attributes\BindModel;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;
use OpenSoutheners\LaravelDto\DataTransferObject;

final class DetailMasterKonversiDTO extends DataTransferObject
{
	public function __construct(
		#[WithDefaultValue(200)]
		public int $res_code,

		#[WithDefaultValue('Ok')]
		public string $res_message,

		#[WithDefaultValue(false)]
		public bool $is_destroy,

		public int|null $id_konversi_satuan = null,

		#[BindModel(using: 'id')]
		#[WithDefaultValue(KonversiSatuan::class)]
		public KonversiSatuan|null $model_konversi_satuan = null,
	) {
		if ($is_destroy) {
			$this->res_message = 'Data berhasil dihapus';
		}
		
		if ($id_konversi_satuan && !$model_konversi_satuan) {
			$this->res_code = 204;
			$this->res_message = 'Data tidak ditemukan';
		}
	}
}
