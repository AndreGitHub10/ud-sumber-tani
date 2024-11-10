<?php

namespace App\Services\Produk;

# DTO

use App\DataTransferObjects\Produk\DetailSatuanDTO;
use App\DataTransferObjects\Produk\PostSatuanDTO;

# Models
use App\Models\SatuanProduk;

class SatuanService
{
	public function create(PostSatuanDTO $satuanDTO): SatuanProduk
	{
		$satuan = new SatuanProduk;
		$satuan->nama = $satuanDTO->nama;
		$satuan->save();

		return $satuan;
	}

	public function update(PostSatuanDTO $satuanDTO): SatuanProduk
	{
		$satuan = SatuanProduk::find($satuanDTO->id_satuan);
		$satuan->nama = $satuanDTO->nama;
		$satuan->save();

		return $satuan;
	}

	public function destroy(DetailSatuanDTO $satuanDTO): bool
	{
		if ($satuanDTO->res_code === 204) {
			return false;
		}

		if ($satuanDTO->satuan->delete()) {
			return true;
		}

		$satuanDTO->res_code = 500;
		$satuanDTO->res_message = 'Data gagal dihapus';
		return false;
	}
}