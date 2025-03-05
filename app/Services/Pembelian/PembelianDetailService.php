<?php

namespace App\Services\Pembelian;

# DTO

use App\DataTransferObjects\Pembelian\DetailPembelianDetailDTO;
use App\DataTransferObjects\Pembelian\PostPembelianDetailDTO;

# Models
use App\Models\PembelianDetail;

class PembelianDetailService
{
	public function create(PostPembelianDetailDTO $pembelianDetailDTO): PembelianDetail
	{
		$pembelianDetail = new PembelianDetail;
		$pembelianDetail->invoice_id = $pembelianDetailDTO->id_pembelian;
		$pembelianDetail->kode_produk = $pembelianDetailDTO->kode_produk;
		$pembelianDetail->satuan_id = $pembelianDetailDTO->id_satuan;
		$pembelianDetail->stok_awal = $pembelianDetailDTO->jumlah;
		$pembelianDetail->stok_real = $pembelianDetailDTO->jumlah;
		$pembelianDetail->tanggal_kedaluwarsa = $pembelianDetailDTO->tanggal_kedaluwarsa;
		$pembelianDetail->harga_beli = $pembelianDetailDTO->harga_beli;
		$pembelianDetail->total_harga_beli = $pembelianDetailDTO->total_harga_beli;
		$pembelianDetail->harga_jual = $pembelianDetailDTO->harga_jual;
		$pembelianDetail->save();

		return $pembelianDetail;
	}

	public function updateStokReal(DetailPembelianDetailDTO $pembelianDetailDTO): PembelianDetail
	{
		$pembelianDetail = PembelianDetail::find($pembelianDetailDTO->id_pembelian_detail);
		$pembelianDetail->stok_real = $pembelianDetailDTO->stok_real_terbaru;
		$pembelianDetail->save();

		return $pembelianDetail;
	}

	public function update(PostPembelianDetailDTO $pembelianDetailDTO): PembelianDetail
	{
		$pembelianDetail = PembelianDetail::find($pembelianDetailDTO->id_pembelian_detail);
		if ($pembelianDetailDTO->stok_awal === $pembelianDetailDTO->stok_real) {
			$pembelianDetail->kode_produk = $pembelianDetailDTO->kode_produk;
			$pembelianDetail->satuan_id = $pembelianDetailDTO->id_satuan;
			$pembelianDetail->stok_awal = $pembelianDetailDTO->jumlah;
			$pembelianDetail->stok_real = $pembelianDetailDTO->jumlah;
			$pembelianDetail->harga_beli = $pembelianDetailDTO->harga_beli;
			$pembelianDetail->total_harga_beli = $pembelianDetailDTO->total_harga_beli;
		}
		$pembelianDetail->tanggal_kedaluwarsa = $pembelianDetailDTO->tanggal_kedaluwarsa;
		$pembelianDetail->harga_jual = $pembelianDetailDTO->harga_jual;
		$pembelianDetail->save();

		return $pembelianDetail;
	}

	public function destroy(DetailPembelianDetailDTO $pembelianDetailDTO): bool
	{
		$pembelianDetail = PembelianDetail::find($pembelianDetailDTO->id_pembelian_detail);
		if ($pembelianDetail && $pembelianDetail->delete()) {
			return true;
		}
		return false;
	}

	public function destroyMultiple(DetailPembelianDetailDTO $pembelianDetailDTO): bool
	{
		$pembelianDetail = PembelianDetail::where('invoice_id', $pembelianDetailDTO->id_pembelian)->whereNotIn('id', $pembelianDetailDTO->array_id_pembelian_detail);
		if ($pembelianDetail && $pembelianDetail->delete()) {
			return true;
		}
		return false;
	}
}
