<?php

namespace App\Services\User;

# DTO

use App\DataTransferObjects\User\DetailSupplierDTO;
use App\DataTransferObjects\User\PostSupplierDTO;

# Models
use App\Models\Supplier;

class SupplierService
{
	public function create(PostSupplierDTO $supplierDTO): Supplier
	{
		$supplier = new Supplier;
		$supplier->kode = $supplierDTO->kode;
		$supplier->nama = $supplierDTO->nama;
		$supplier->nomor_hp = $supplierDTO->nomor_hp;
		$supplier->alamat = $supplierDTO->alamat;
		$supplier->keterangan = $supplierDTO->keterangan;
		$supplier->tanggal = date('Y-m-d');
		$supplier->save();

		return $supplier;
	}

	public function update(PostSupplierDTO $supplierDTO): Supplier
	{
		$supplier = Supplier::find($supplierDTO->id_supplier);
		$supplier->nama = $supplierDTO->nama;
		$supplier->nomor_hp = $supplierDTO->nomor_hp;
		$supplier->alamat = $supplierDTO->alamat;
		$supplier->keterangan = $supplierDTO->keterangan;
		$supplier->save();

		return $supplier;
	}

	public function destroy(DetailSupplierDTO $supplierDTO): bool
	{
		$supplier = Supplier::find($supplierDTO->id_supplier);
		if ($supplier && $supplier->delete()) {
			return true;
		}
		return false;
	}
}