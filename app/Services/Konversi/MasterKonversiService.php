<?php

namespace App\Services\Konversi;

use App\DataTransferObjects\Konversi\DetailMasterKonversiDTO;
use Auth;
# DTO
use App\DataTransferObjects\Konversi\PostMasterKonversiDTO;
# Models
use App\Models\KonversiSatuan;

class MasterKonversiService
{
	public function __construct() {
		date_default_timezone_set('Asia/Jakarta');
	}

	public function create(PostMasterKonversiDTO $masterKonversiDTO): KonversiSatuan
	{
		$konversiSatuan = new KonversiSatuan;
		$konversiSatuan->satuan_id_asal = $masterKonversiDTO->satuan_asal;
		$konversiSatuan->satuan_id_tujuan = $masterKonversiDTO->satuan_tujuan;
		$konversiSatuan->nilai_konversi = $masterKonversiDTO->nilai_konversi;
		$konversiSatuan->save();

		return $konversiSatuan;
	}

	public function update(PostMasterKonversiDTO $masterKonversiDTO): KonversiSatuan
	{
		$konversiSatuan = KonversiSatuan::find($masterKonversiDTO->id_konversi_satuan);
		$konversiSatuan->satuan_id_asal = $masterKonversiDTO->satuan_asal;
		$konversiSatuan->satuan_id_tujuan = $masterKonversiDTO->satuan_tujuan;
		$konversiSatuan->nilai_konversi = $masterKonversiDTO->nilai_konversi;
		$konversiSatuan->save();

		return $konversiSatuan;
	}
    
	public function destroy(DetailMasterKonversiDTO $detailMasterKonversiDTO): bool
	{
		$konversiSatuan = KonversiSatuan::find($detailMasterKonversiDTO->id_konversi_satuan);

		if ($detailMasterKonversiDTO->res_code === 204) return false;

		if ($konversiSatuan->delete()) return true;

		$detailMasterKonversiDTO->res_code = 500;
		$detailMasterKonversiDTO->res_message = 'Data gagal dihapus';
		return false;
	}
}