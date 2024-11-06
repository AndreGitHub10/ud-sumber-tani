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
		$kategori->kode = $postKategoriDTO->kode;
		$kategori->nama = $postKategoriDTO->nama;
		$kategori->nomor_hp = $postKategoriDTO->nomor_hp;
		$kategori->alamat = $postKategoriDTO->alamat;
		$kategori->keterangan = $postKategoriDTO->keterangan;
		$kategori->tanggal = date('Y-m-d');
		$kategori->save();

		return $kategori;
	}

	public function update(PostKategoriDTO $postKategoriDTO): KategoriProduk
	{
		$kategori = KategoriProduk::find($postKategoriDTO->id_kategori);
		$kategori->nama = $postKategoriDTO->nama;
		$kategori->nomor_hp = $postKategoriDTO->nomor_hp;
		$kategori->alamat = $postKategoriDTO->alamat;
		$kategori->keterangan = $postKategoriDTO->keterangan;
		$kategori->save();

		return $kategori;
	}

	public function destroy(DetailKategoriDTO $postKategoriDTO): bool
	{
		$kategori = KategoriProduk::find($postKategoriDTO->id_kategori);
		if ($kategori && $kategori->delete()) {
			return true;
		}
		return false;
	}
}