<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables, DB;
# DTO
use App\DataTransferObjects\Pembelian\DetailPembelianDetailDTO;
use App\DataTransferObjects\Pembelian\DetailPembelianDTO;
use App\DataTransferObjects\Pembelian\PostPembelianDetailDTO;
use App\DataTransferObjects\Pembelian\PostPembelianDTO;
use App\DataTransferObjects\Response\ResponseAxiosDTO;
use App\Models\DataProduk;
# Models
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\PenjualanDetail;
use App\Models\SatuanProduk;
use App\Models\Supplier;
# Services
use App\Services\Pembelian\PembelianService;
use App\Services\Pembelian\PembelianDetailService;

class PembelianController extends Controller
{
	private PembelianService $pembelianService;
	private PembelianDetailService $pembelianDetailService;

	public function __construct(
		PembelianService $pembelianService,
		PembelianDetailService $pembelianDetailService
	)
	{
		$this->pembelianService = $pembelianService;
		$this->pembelianDetailService = $pembelianDetailService;
	}

	public function datatables(Request $request)
	{
		return DataTables::of(Pembelian::with('supplier')->get())
			->addIndexColumn()
			->addColumn('nama_supplier', function($item) {
				return $item->supplier ? $item->supplier->nama : '(tidak ditemukan)';
			})
			->addColumn('action', function($item) {
				// return "
				// 	<div class='text-center'>
				// 		<button type='button' class='btn btn-sm btn-danger px-2 btn-delete-pembelian' data-id='$item->id'>
				// 			<i class='fadeIn animated bx bx-trash'></i>
				// 		</button>
				// 		<button type='button' class='btn btn-sm btn-warning px-2 btn-edit-pembelian' data-id='$item->id'>
				// 			<i class='fadeIn animated bx bx-pencil'></i>
				// 		</button>
				// 	</div>
				// ";
				return "
					<div class='text-center'>
						<button type='button' class='btn btn-sm btn-warning px-2 btn-edit-pembelian' data-id='$item->id' title='Edit Pembelian'>
							<i class='fadeIn animated bx bx-pencil'></i>
						</button>
						<button type='button' class='btn btn-sm btn-danger px-2 btn-delete-pembelian' data-id='$item->id'>
							<i class='fadeIn animated bx bx-trash'></i>
						</button>
					</div>
				";
			})
			->toJson();
	}

	public function destroy(Request $request)
	{
		DB::beginTransaction();
		try {
			$pembelian = Pembelian::find($request->id);
			if ($pembelian) {
				$detailPembelian = PembelianDetail::where('invoice_id',$pembelian->id)->get();
				foreach ($detailPembelian as $k => $v) {
					$detailPenjualan = PenjualanDetail::where('detail_pembelian_id',$v->id)->get();
					if (count($detailPenjualan)>0) {
						return response()->json(ResponseAxiosDTO::fromArray([
							'code' => 201,
							'message' => 'Tidak dapat menghapus pembelian karena ada stok barang yang sudah terjual'
						]), 201);
					}
					PembelianDetail::destroy($v->id);
				}
				$pembelian->delete();
			}

			DB::commit();

			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 200,
				'message' => 'Data berhasil Dihapus',
				'response' => $pembelian
			]), 200);
		} catch (\Throwable $e) {
			DB::rollback();
			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 500,
				'message' => $e->getMessage(),
			]), 500);
		}
	}

	public function findProduk(Request $request)
	{
		$string = $request->query_string ?? "###";

		$data = PembelianDetail::whereHas('data_produk', function($q) use($string) {
			return $q->where('kode_produk', 'like', "%$string%")->orWhere('nama_produk', 'like', "%$string%");
		})->with(['data_produk', 'satuan'])->get();
		return response()->json($data);

		// return response()->json(ResponseAxiosDTO::fromArray([
		// 	'code' => 200,
		// 	'message' => 'Ok',
		// 	'response' => collect($data),
		// ]), 200);
	}

	public function form(Request $request)
	{
		$data = DetailPembelianDTO::fromRequest($request);

		$array = [
			'pembelian' => $data->model_pembelian,
			'supplier' => Supplier::all(),
			'produk' => DataProduk::all(),
			'satuan' => SatuanProduk::all(),
		];

		$content = view('contents.pembelian.form', $array)->render();

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
			'response' => $content,
		]), $data->res_code);
	}

	public function main(Request $request)
	{
		return view('contents.pembelian.main');
	}

	// public function store(PostKategoriDTO $data)
	public function store(Request $request)
	{
		DB::beginTransaction();
		try {
			$postPembelian = PostPembelianDTO::fromRequest($request);
			$produk = $postPembelian->array_produk;
			$satuan = $postPembelian->array_satuan;
			$jumlah = $postPembelian->array_jumlah;
			$tanggalKedaluwarsa = $postPembelian->array_tanggal_kedaluwarsa;
			$hargaBeli = $postPembelian->array_harga_beli;
			$totalHarga = $postPembelian->array_total_harga;
			$hargaJual = $postPembelian->array_harga_jual;
			$idPembelianDetail = $postPembelian->array_id_pembelian_detail;
			$iskonversi = $postPembelian->array_is_konversi;

			if (!$postPembelian->id_pembelian) {
				$pembelian = $this->pembelianService->create($postPembelian);
				foreach($postPembelian->array_produk as $key => $val){
					$postPembelianDetail = PostPembelianDetailDTO::fromArray([
						'id_pembelian' => $pembelian->id,
						'kode_produk' => $produk[$key],
						'id_satuan' => $satuan[$key],
						'jumlah' => $jumlah[$key],
						'tanggal_kedaluwarsa' => $tanggalKedaluwarsa[$key] ?? null,
						'harga_beli' => $hargaBeli[$key],
						'total_harga_beli' => $totalHarga[$key],
						'harga_jual' => $hargaJual[$key],
						'is_konversi' => $iskonversi[$key],
					]);
					$this->pembelianDetailService->create($postPembelianDetail);
				}
			} else {
				$pembelian = $this->pembelianService->update($postPembelian);

				$this->pembelianDetailService->destroyMultiple(
					DetailPembelianDetailDTO::fromArray([
						'id_pembelian' => $pembelian->id,
						'array_id_pembelian_detail' => $idPembelianDetail,
					])
				);

				foreach($postPembelian->array_produk as $key => $val){
					$postPembelianDetail = PostPembelianDetailDTO::fromArray([
						'id_pembelian' => $pembelian->id,
						'kode_produk' => $produk[$key],
						'id_satuan' => $satuan[$key],
						'jumlah' => $jumlah[$key],
						'tanggal_kedaluwarsa' => $tanggalKedaluwarsa[$key] ?? null,
						'harga_beli' => $hargaBeli[$key],
						'total_harga_beli' => $totalHarga[$key],
						'harga_jual' => $hargaJual[$key],
						'id_pembelian_detail' => $idPembelianDetail[$key] ?? null,
						'model_pembelian_detail' => $idPembelianDetail[$key] ?? null,
						'is_konversi' => $iskonversi[$key],
					]);

					// \Log::debug(json_encode($postPembelianDetail, JSON_PRETTY_PRINT));
					if (!$postPembelianDetail->id_pembelian_detail) {
						$this->pembelianDetailService->create($postPembelianDetail);
					} else {
						$this->pembelianDetailService->update($postPembelianDetail);
					}
				}
			}

			DB::commit();

			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => $postPembelian->res_code,
				'message' => $postPembelian->res_message,
			]), $postPembelian->res_code);
			// return response()->json(ResponseAxiosDTO::fromArray([
			// 	'code' => 201,
			// 	'message' => 'Data berhasil dibuat',
			// 	// 'response' => $kategori,
			// ]), 201);
		} catch (\Throwable $e) {
			DB::rollback();
			\Log::error($e->getMessage());
			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 500,
				'message' => $e->getMessage(),
			]), 500);
		}
	}
}
