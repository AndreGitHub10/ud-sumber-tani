<?php

namespace App\Services\Pembelian;

# DTO

use App\DataTransferObjects\Pembelian\DetailPembelianDTO;
use App\DataTransferObjects\Pembelian\PostPembelianDTO;

# Models
use App\Models\Pembelian;

class PembelianService
{
	public function create(PostPembelianDTO $pembelianDTO): Pembelian
	{
		$pembelian = new Pembelian;
		$pembelian->supplier_id = $pembelianDTO->id_supplier;
		$pembelian->nomor_invoice = $pembelianDTO->nomor_invoice;
		$pembelian->total_harga = $pembelianDTO->total_semua_harga;
		$pembelian->tanggal = $pembelianDTO->tanggal_pembelian;
		$pembelian->save();

		return $pembelian;
	}

	public function update(PostPembelianDTO $pembelianDTO): Pembelian
	{
		$pembelian = Pembelian::find($pembelianDTO->id_pembelian);
		$pembelian->supplier_id = $pembelianDTO->id_supplier;
		$pembelian->nomor_invoice = $pembelianDTO->nomor_invoice;
		$pembelian->total_harga = $pembelianDTO->total_semua_harga;
		$pembelian->tanggal = $pembelianDTO->tanggal_pembelian;
		$pembelian->save();

		return $pembelian;
	}

	public function destroy(DetailPembelianDTO $pembelianDTO): bool
	{
		$pembelian = Pembelian::find($pembelianDTO->id_pembelian);
		if ($pembelian && $pembelian->delete()) {
			return true;
		}
		return false;
	}
}