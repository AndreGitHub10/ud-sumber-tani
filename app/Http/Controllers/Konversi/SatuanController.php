<?php

namespace App\Http\Controllers\Konversi;

use App\DataTransferObjects\Response\ResponseAxiosDTO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
# Models
use App\Models\KonversiSatuan;
use App\Models\PembelianDetail;
use App\Models\PenjualanDetail;
use App\Models\SatuanProduk;

class SatuanController extends Controller
{
	public function form(Request $request)
	{
		$data = SatuanProduk::all();
		return view('contents.konversi-satuan.form', ['satuan' => $data]);
	}

	public function getKonversi(Request $request)
	{
		$data = KonversiSatuan::get();
		$code = count($data) ? 200 : 204;
		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $code,
			'message' => 'Ok',
			'response' => $data
		]), $code);
	}

	public function store(Request $request)
	{
		// return $request->all();
		DB::beginTransaction();
		try {
			$pembelianDetail = new PembelianDetail;
			$pembelianDetail->invoice_id = $request->invoice_id;
			$pembelianDetail->kode_produk = $request->kode_produk;
			$pembelianDetail->satuan_id = $request->satuan_tujuan_id;
			$pembelianDetail->stok_awal = $request->total_stok_tujuan;
			$pembelianDetail->stok_real = $request->total_stok_tujuan;
			$pembelianDetail->harga_jual = $request->harga_jual_tujuan;
			$pembelianDetail->konversi_id = $request->konversi_id;
			$pembelianDetail->is_konversi = '1';
			$pembelianDetail->save();

			$updatePembelianDetail = PembelianDetail::find($request->detail_pembelian_id);
			$updatePembelianDetail->stok_real = $updatePembelianDetail->stok_real - $request->total_stok_asal_konversi;
			$updatePembelianDetail->save();

			$penjualanDetail = new PenjualanDetail;
			$penjualanDetail->penjualan_id = 0;
			$penjualanDetail->detail_pembelian_id = $pembelianDetail->id;
			$penjualanDetail->jumlah = $request->total_stok_asal_konversi;
			$penjualanDetail->harga_jual = $request->harga_jual_tujuan;
			$penjualanDetail->total_harga_jual_murni = $request->harga_jual_tujuan;
			$penjualanDetail->total_harga_jual_diskon = $request->harga_jual_tujuan;
			$penjualanDetail->is_konversi = '1';
			$penjualanDetail->save();

			DB::commit();

			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 201,
				'message' => 'Data berhasil dibuat',
			]), 201);
		} catch (\Throwable $e) {
			DB::rollback();

			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 500,
				'message' => $e->getMessage(),
			]), 500);
		}
	}
}
