<?php

namespace App\Services\Penjualan;

use Auth;
# DTO
use App\DataTransferObjects\Penjualan\DetailPenjualanDTO;
use App\DataTransferObjects\Penjualan\PostPenjualanDTO;
# Models
use App\Models\Penjualan;

class PenjualanService
{
    public function __construct() {
        date_default_timezone_set('Asia/Jakarta');
    }

	public function create(PostPenjualanDTO $penjualanDTO): Penjualan
	{
		$penjualan = new Penjualan;
		$penjualan->user_id = Auth::user()->id;
		$penjualan->nomor_kwitansi = $penjualanDTO->nomor_kwitansi;
		$penjualan->total_penjualan_murni = $penjualanDTO->total_semua_harga_murni;
		$penjualan->total_penjualan_diskon = $penjualanDTO->total_semua_harga_diskon;
		$penjualan->tanggal = date("Y-m-d");
		$penjualan->save();

		return $penjualan;
	}

	// public function update(PostPenjualanDTO $penjualanDTO): Penjualan
	// {
	// 	$penjualan = Penjualan::find($penjualanDTO->id_pembelian);
	// 	$penjualan->supplier_id = $penjualanDTO->id_supplier;
	// 	$penjualan->nomor_invoice = $penjualanDTO->nomor_invoice;
	// 	$penjualan->total_harga = $penjualanDTO->total_semua_harga;
	// 	$penjualan->tanggal = $penjualanDTO->tanggal_pembelian;
	// 	$penjualan->save();

	// 	return $penjualan;
	// }

	// public function destroy(DetailPenjualanDTO $penjualanDTO): bool
	// {
	// 	$penjualan = Penjualan::find($penjualanDTO->id_pembelian);
	// 	if ($penjualan && $penjualan->delete()) {
	// 		return true;
	// 	}
	// 	return false;
	// }
}