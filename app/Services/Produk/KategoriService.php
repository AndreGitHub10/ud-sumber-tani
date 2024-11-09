<?php

namespace App\Services\Produk;

# DTO

use App\DataTransferObjects\Produk\DetailKategoriDTO;
use App\DataTransferObjects\Produk\PostKategoriDTO;

# Models
use App\Models\KategoriProduk;

class KategoriService
{
	public function create(PostKategoriDTO $postKategoriDTO): KategoriProduk
	{
		$kategori = new KategoriProduk;
		$kategori->nama = $postKategoriDTO->nama;
		$kategori->save();

		return $kategori;
	}

	public function update(PostKategoriDTO $postKategoriDTO): KategoriProduk
	{
		$kategori = KategoriProduk::find($postKategoriDTO->id_kategori);
		$kategori->nama = $postKategoriDTO->nama;
		$kategori->save();

		return $kategori;
	}

	public function destroy(DetailKategoriDTO $detailKategoriDTO): bool
	{
		$kategori = KategoriProduk::find($detailKategoriDTO->id_kategori);
		if ($kategori && $kategori->delete()) {
			return true;
		}
		return false;
		if ($detailKategoriDTO->res_code === 204) {
			return false;
		}

		if ($detailKategoriDTO->satuan->delete()) {
			return true;
		}

		$detailKategoriDTO->res_code = 500;
		$detailKategoriDTO->res_message = 'Data gagal dihapus';
		return false;
	}
}