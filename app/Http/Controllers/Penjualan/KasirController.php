<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
# DTO
use App\DataTransferObjects\Penjualan\DetailPenjualanDetailDTO;
use App\DataTransferObjects\Penjualan\DetailPenjualanDTO;
use App\DataTransferObjects\Penjualan\PostPenjualanDetailDTO;
use App\DataTransferObjects\Penjualan\PostPenjualanDTO;
use App\DataTransferObjects\Response\ResponseAxiosDTO;
# Models
use App\Models\PembelianDetail;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
# Services
use App\Services\Penjualan\PenjualanService;
use App\Services\Penjualan\PenjualanDetailService;

class KasirController extends Controller
{
	private PenjualanService $penjualanService;
	private PenjualanDetailService $penjualanDetailService;

	public function __construct(
		PenjualanService $penjualanService,
		PenjualanDetailService $penjualanDetailService
	)
	{
		$this->penjualanService = $penjualanService;
		$this->penjualanDetailService = $penjualanDetailService;
	}

	public function main(Request $request)
	{
		$produk = PembelianDetail::select('id', 'kode_produk', 'satuan_id', 'stok_real', 'harga_jual')
			->with([
				'data_produk:id,kode_produk,nama_produk',
				'satuan:id,nama'
			])->get();
		return view('contents.penjualan-kasir.main', ['produk' => $produk]);
	}

	public function store(Request $request)
	{
		// return $request->all();
		DB::beginTransaction();
		try {
			$postPenjualan = PostPenjualanDTO::fromRequest($request);
			$diskon = $postPenjualan->array_diskon;
			$hargaJual = $postPenjualan->array_harga_jual;
			$jumlah = $postPenjualan->array_jumlah;
			$produk = $postPenjualan->array_pembelian;
			$totalHargaPerProdukDiskon = $postPenjualan->array_total_harga_per_produk_diskon;
			$totalHargaPerProdukMurni = $postPenjualan->array_total_harga_per_produk_murni;

			if (!$request->id_penjualan) {
				$pembelian = $this->penjualanService->create($postPenjualan);
				foreach($produk as $key => $val){
					$postPenjualanDetail = PostPenjualanDetailDTO::fromArray([
						'id_penjualan' => $pembelian->id,
						'id_pembelian_detail' => $produk[$key],
						'diskon' => $diskon[$key] ?? null,
						'jumlah' => $jumlah[$key],
						'harga_jual' => $hargaJual[$key],
						'total_harga_jual_diskon' => $totalHargaPerProdukDiskon[$key],
						'total_harga_jual_murni' => $totalHargaPerProdukMurni[$key],
					]);
					$this->penjualanDetailService->create($postPenjualanDetail);
				}
			}

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
