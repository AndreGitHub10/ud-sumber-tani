<?php

namespace App\Services\Penjualan;

# DTO
use App\DataTransferObjects\Penjualan\DetailPenjualanDetailDTO;
use App\DataTransferObjects\Penjualan\PostPenjualanDetailDTO;
# Models
use App\Models\PenjualanDetail;

class PenjualanDetailService
{
	public function create(PostPenjualanDetailDTO $penjualanDetailDTO): PenjualanDetail
	{
		$penjualanDetail = new PenjualanDetail;
		$penjualanDetail->penjualan_id = $penjualanDetailDTO->id_penjualan;
		$penjualanDetail->detail_pembelian_id = $penjualanDetailDTO->id_pembelian_detail;
		$penjualanDetail->diskon = $penjualanDetailDTO->diskon;
		$penjualanDetail->jumlah = $penjualanDetailDTO->jumlah;
		$penjualanDetail->harga_jual = $penjualanDetailDTO->harga_jual;
		$penjualanDetail->total_harga_jual_murni = $penjualanDetailDTO->total_harga_jual_murni;
		$penjualanDetail->total_harga_jual_diskon = $penjualanDetailDTO->total_harga_jual_diskon;
		$penjualanDetail->save();

		return $penjualanDetail;
	}

	// public function update(PostPenjualanDetailDTO $penjualanDetailDTO): PenjualanDetail
	// {
	// 	$penjualanDetail = PenjualanDetail::find($penjualanDetailDTO->id_pembelian_detail);
	// 	$penjualanDetail->supplier_id = $penjualanDetailDTO->id_supplier;
	// 	$penjualanDetail->nomor_invoice = $penjualanDetailDTO->nomor_invoice;
	// 	$penjualanDetail->alamat = $penjualanDetailDTO->alamat;
	// 	$penjualanDetail->keterangan = $penjualanDetailDTO->keterangan;
	// 	$penjualanDetail->save();

	// 	return $penjualanDetail;
	// }

	// public function destroy(DetailPenjualanDetailDTO $penjualanDetailDTO): bool
	// {
	// 	$penjualanDetail = Penjualan::find($penjualanDetailDTO->id_pembelian_detail);
	// 	if ($penjualanDetail && $penjualanDetail->delete()) {
	// 		return true;
	// 	}
	// 	return false;
	// }
}