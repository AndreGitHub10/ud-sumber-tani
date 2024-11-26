<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
# DTO
use App\DataTransferObjects\Pembelian\DetailPembelianDetailDTO;
use App\DataTransferObjects\Penjualan\DetailPenjualanDetailDTO;
use App\DataTransferObjects\Penjualan\DetailPenjualanDTO;
use App\DataTransferObjects\Penjualan\PostPenjualanDetailDTO;
use App\DataTransferObjects\Penjualan\PostPenjualanDTO;
use App\DataTransferObjects\Response\ResponseAxiosDTO;
use App\Models\DataProduk;
# Models
use App\Models\PembelianDetail;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
# Services
use App\Services\Pembelian\PembelianDetailService;
use App\Services\Penjualan\PenjualanService;
use App\Services\Penjualan\PenjualanDetailService;

class KasirController extends Controller
{
	private PembelianDetailService $pembelianDetailService;
	private PenjualanService $penjualanService;
	private PenjualanDetailService $penjualanDetailService;

	public function __construct(
		PembelianDetailService $pembelianDetailService,
		PenjualanService $penjualanService,
		PenjualanDetailService $penjualanDetailService
	)
	{
		$this->pembelianDetailService = $pembelianDetailService;
		$this->penjualanService = $penjualanService;
		$this->penjualanDetailService = $penjualanDetailService;
	}

	public function main(Request $request)
	{
		$produk = PembelianDetail::select('id', 'kode_produk', 'satuan_id', 'stok_real', 'harga_jual')
			->with([
				'data_produk:id,kode_produk,nama_produk,foto_directory,barcode',
				'satuan:id,nama'
			])->
			where('stok_real','>',0)->get();
		return view('contents.penjualan-kasir.main', ['produk' => $produk]);
	}

	public function store(Request $request)
	{
		DB::beginTransaction();
		try {
			$postPenjualan = PostPenjualanDTO::fromRequest($request);
			$diskon = $postPenjualan->array_diskon;
			$hargaJual = $postPenjualan->array_harga_jual;
			$jumlah = $postPenjualan->array_jumlah;
			$produk = $postPenjualan->array_pembelian;
			$totalHargaPerProdukDiskon = $postPenjualan->array_total_harga_per_produk_diskon;
			$totalHargaPerProdukMurni = $postPenjualan->array_total_harga_per_produk_murni;

			# Validasi stok sebelum insert
			foreach($produk as $key => $val){
				$dataStok = DetailPembelianDetailDTO::fromArray([
					'model_pembelian_detail' => $produk[$key],
					'jumlah_qty_penjualan' => $jumlah[$key]
				]);
				if ($dataStok->model_pembelian_detail->stok_real < $jumlah[$key]) {
					$namaProduk = strtoupper($dataStok->data_produk->nama_produk);
					return response()->json(ResponseAxiosDTO::fromArray([
						'code' => 422,
						'message' => "$namaProduk hanya tersisa $dataStok->stok_real",
					]), 422);
				}
			}
			# End validasi stok

			if (!$request->id_penjualan) {
				$penjualan = $this->penjualanService->create($postPenjualan);
				foreach($produk as $key => $val){
					$this->pembelianDetailService->updateStokReal(
						DetailPembelianDetailDTO::fromArray([
							'id_pembelian_detail' => $produk[$key],
							'jumlah_qty_penjualan' => $jumlah[$key],
							'model_pembelian_detail' => $produk[$key],
						])
					);

					$this->penjualanDetailService->create(
						PostPenjualanDetailDTO::fromArray([
							'id_penjualan' => $penjualan->id,
							'id_pembelian_detail' => $produk[$key],
							'diskon' => $diskon[$key] ?? null,
							'jumlah' => $jumlah[$key],
							'harga_jual' => $hargaJual[$key],
							'total_harga_jual_diskon' => $totalHargaPerProdukDiskon[$key],
							'total_harga_jual_murni' => $totalHargaPerProdukMurni[$key],
						])
					);
				}
			}

			DB::commit();

			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 201,
				'message' => 'Data berhasil dibuat',
				'response' => $penjualan->id
			]), 201);
		} catch (\Throwable $e) {
			DB::rollback();
			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 500,
				'message' => $e->getMessage(),
			]), 500);
		}
	}

	public function invoice($id = 0)
	{
		$data['penjualan'] = Penjualan::with('penjualan_detail','user','penjualan_detail.pembelian_detail','penjualan_detail.pembelian_detail.data_produk')
			->find($id);
		return view('contents.penjualan-kasir.invoice', $data);
	}

	public function getProduk(Request $request) {
		$data = DataProduk::find($request->id);
		if ($data) {
			$data->res_code=200;
			$data->res_message="Data Ditemukan";
			$fileExists = public_path()."/storage/public/".$data->foto_directory;
			if (!$data->foto_directory || !file_exists($fileExists)) {
				$data->foto = asset('/assets/images/errors-images/no-image.jpg');
			} else {
				$data->foto = url("storage/public/".$data->foto_directory);
			}
		} else {
			$data->res_code=400;
			$data->res_message="Data Tidak Ditemukan";
		}

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => 200,
			'message' => $data->getMessage(),
		]), 500);
	}

	public function scanBarcode(Request $request) {
		$data = PembelianDetail::select('id', 'kode_produk', 'satuan_id', 'stok_real', 'harga_jual')->
			with([
				'data_produk:id,kode_produk,nama_produk,foto_directory',
				'satuan:id,nama'
			])->
			where('stok_real','>',0)->
			whereHas('data_produk',function ($q) use ($request) {
				$q->where('barcode',$request->barcode);
			})->
			get();
		$return = (object)[];
		if (count($data)) {
			$return->res_code=200;
			$return->res_message="Data Ditemukan";
			// $fileExists = public_path()."/storage/public/".$data->foto_directory;
			// if (!$data->foto_directory || !file_exists($fileExists)) {
			// 	$data->foto = asset('/assets/images/errors-images/no-image.jpg');
			// } else {
			// 	$data->foto = url("storage/public/".$data->foto_directory);
			// }
		} else {
			$return->res_code=400;
			$return->res_message="Data Tidak Ditemukan";
		}

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $return->res_code,
			'message' => $return->res_message,
			'response' => $data,
		]), $return->res_code);
	}
}
