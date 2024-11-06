<?php

namespace App\Services\Produk;

# DTO

use App\DataTransferObjects\Produk\DetailDataDTO;
use App\DataTransferObjects\Produk\PostDataDTO;

# Models
use App\Models\DataProduk;

class DataService
{
	public function create(PostDataDTO $supplierDTO): DataProduk
	{
		$supplier = new DataProduk;
		$supplier->kode = $supplierDTO->kode;
		$supplier->nama = $supplierDTO->nama;
		$supplier->nomor_hp = $supplierDTO->nomor_hp;
		$supplier->alamat = $supplierDTO->alamat;
		$supplier->keterangan = $supplierDTO->keterangan;
		$supplier->tanggal = date('Y-m-d');
		$supplier->save();

		return $supplier;
	}

	public function update(PostDataDTO $supplierDTO): DataProduk
	{
		$supplier = DataProduk::find($supplierDTO->id_supplier);
		$supplier->nama = $supplierDTO->nama;
		$supplier->nomor_hp = $supplierDTO->nomor_hp;
		$supplier->alamat = $supplierDTO->alamat;
		$supplier->keterangan = $supplierDTO->keterangan;
		$supplier->save();

		return $supplier;
	}

	public function destroy(DetailDataDTO $supplierDTO): bool
	{
		$supplier = DataProduk::find($supplierDTO->id_supplier);
		if ($supplier && $supplier->delete()) {
			return true;
		}
		return false;
	}
}