<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables, Excel, DB;
# DTO
use App\DataTransferObjects\Produk\DetailDataDTO;
use App\DataTransferObjects\Produk\PostDataDTO;
use App\DataTransferObjects\Response\ResponseAxiosDTO;
# Form request
use App\Http\Requests\Produk\PostDataRequest;
# Helpers
use App\Helpers\Generate;
use App\Imports\DataProdukImport;
# Models
use App\Models\DataProduk;
use App\Models\PembelianDetail;
use App\Models\KategoriProduk;
# Services
use App\Services\Produk\DataService;

class DataController extends Controller
{
	private DataService $dataProdukService;

	public function __construct(
		DataService $dataProdukService
	)
	{
		date_default_timezone_set('Asia/Jakarta');
		$this->dataProdukService = $dataProdukService;
	}

	public function datatables(Request $request)
	{
		$kategori = $request->kategori ? $request->kategori : '';
		$data = DataProduk::with(
				'kategori',
				'pembelian_detail',
				'pembelian_detail.pembelian',
				'pembelian_detail.pembelian.supplier',
				'v_harga_barang',
				'v_harga_barang.satuan')->
			when($kategori!='',function($q) use ($kategori){
				$q->whereHas('kategori',function($qq) use ($kategori){
					$qq->where('id',$kategori);
				});
			})->
			get();
		return DataTables::of($data)
			->addIndexColumn()
			->addColumn('nama_kategori', function($item) {
				return $item->kategori ? $item->kategori->nama : '';
			})
			->addColumn('supplier', function($item) {
				$html = '<ul>';
				$sup = [];
				foreach ($item->pembelian_detail as $k => $v) {
					if ($v->pembelian && $v->pembelian->supplier && !in_array($v->pembelian->supplier->nama,$sup)) {
						$sup[] = $v->pembelian->supplier->nama;
						$html .= "<li>".$v->pembelian->supplier->nama."</li>";
					}
				}
				$html .= '</ul>';
				return $html;
			})
			->addColumn('harga_beli', function($item) {
				$html = '<ul>';
				foreach ($item->v_harga_barang as $k => $v) {
					if ($v->satuan) {
						$html .= "<li>".$v->satuan->nama."(<span class='badge rounded-pill bg-primary'>Rp. ".number_format($v->harga_beli_terbaru,0,',','.')."</span>)</li>";
					}
				}
				$html .= '</ul>';
				return $html;
			})
			->addColumn('harga_jual', function($item) {
				$html = '<ul>';
				foreach ($item->v_harga_barang as $k => $v) {
					if ($v->satuan) {
						$html .= "<li>".$v->satuan->nama."(<span class='badge rounded-pill bg-primary'>Rp. ".number_format($v->harga_jual_terbaru,0,',','.')."</span>)</li>";
					}
				}
				$html .= '</ul>';
				return $html;
			})
			->addColumn('action', function($item) {
				return "
					<div class='text-center'>
						<button type='button' class='btn btn-sm btn-danger px-2 btn-delete-data-produk' data-id='$item->id'>
							<i class='fadeIn animated bx bx-trash'></i>
						</button>
						<button type='button' class='btn btn-sm btn-warning px-2 btn-edit-data-produk' data-id='$item->id'>
							<i class='fadeIn animated bx bx-pencil'></i>
						</button>
						<button type='button' class='btn btn-sm btn-secondary px-2 btn-print-barcode' data-id='$item->barcode'>
							<i class='fadeIn animated bx bx-barcode'></i>
						</button>
					</div>
				";
			})
			->rawColumns(['action','supplier','harga_beli','harga_jual'])
			->toJson();
	}

	public function destroy(DetailDataDTO $data)
	{
		$file = $data->model_data_produk->foto_directory;
		$fileExists = public_path()."/storage/public/$file";
		if ($file && file_exists($fileExists)) {
			unlink($fileExists);
		}
		$this->dataProdukService->destroy($data);

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
		]), $data->res_code);
	}

	public function form(Request $request)
	{
		$data = DetailDataDTO::fromRequest($request);
		$array = [
			'dataProduk' => $data->model_data_produk,
			'kategori' => KategoriProduk::all(),
		];

		$content = view('contents.data-master.produk.data.form', $array)->render();

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
			'response' => $content,
		]), $data->res_code);
	}

	public function main(Request $request)
	{
		$kategori = KategoriProduk::get();
		$array = [
			'kategori' => $kategori
		];
		return view('contents.data-master.produk.data.main',$array);
	}

	public function store(PostDataRequest $request)
	{
		$data = PostDataDTO::fromRequest($request);
		if ($data->res_code !== 500) {
			if ($data->id_data_produk) {
				if (DataProduk::where('id', '!=', $data->id_data_produk)->
					where('nama_produk', $data->nama_produk)->
					first()
				) {
					return response()->json(ResponseAxiosDTO::fromArray([
						'code' => 400,
						'message' => 'Nama produk sudah digunakan'
					]), 400);
				}
				$file = $data->model_data_produk->foto_directory;
				$fileExists = public_path()."/storage/public/$file";
				if ($file && file_exists($fileExists)) {
					unlink($fileExists);
				}
				$supplier = $this->dataProdukService->update($data);
			} else {
				if (DataProduk::where('nama_produk', $data->nama_produk)->first()) {
					return response()->json(ResponseAxiosDTO::fromArray([
						'code' => 400,
						'message' => 'Nama produk sudah digunakan'
					]), 400);
				}
				$supplier = $this->dataProdukService->create($data);
			}
			if ($request->hasFile('foto_directory')) {
				$request->file('foto_directory')->storeAs("public/".$request->master, $request->file_name);
			}
		}

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
			'response' => $supplier,
		]), $data->res_code);
	}

	public function barcode($barcode='',$harga='') {
		$produk = DataProduk::where('barcode',$barcode)->first();
		$array = [
			'barcode' => $barcode,
			'produk' => $produk,
			'harga' => $harga
		];
		return view('contents.data-master.produk.data.barcode',$array);
	}

	public function getHargaList(Request $request) {
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

	public function importForm(Request $request)
	{
		$array = [
			'kategori' => KategoriProduk::get()
		];
		$content = view('contents.data-master.produk.data.import-form',$array)->render();

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => 200,
			'message' => 'Berhasil',
			'response' => $content,
		]), 200);
	}

	public function downloadTemplate()
	{
		$fileMateri = public_path("template/template.xlsx");
		return response()->download($fileMateri);
	}

	public function import(Request $request)
	{
		if (!isset($request->file)) {
			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 400,
				'message' => 'File excel harus di isi'
			]), 400);
		}
		$array = Excel::toArray(new DataProdukImport, $request->file('file'));
		DB::beginTransaction();
		try {
			$total = 0;
			$sama = 0;
			foreach ($array[0] as $key => $value) {
				if ($value[0]=='' || $key==0) {
					continue;
				}
				$newRequest = new Request;
				// $newRequest->id_data_produk = '';
				$newRequest->nama_produk = $value[0];
				$newRequest->kategori = $request->kategori;
				$data = PostDataDTO::fromRequest($newRequest);
				if ($data->res_code !== 500) {
					if ($data->id_data_produk) {
						if (DataProduk::where('id', '!=', $data->id_data_produk)->
							where('nama_produk', $data->nama_produk)->
							first()
						) {
							$sama += 1;
							continue;
						}
						$file = $data->model_data_produk->foto_directory;
						$fileExists = public_path()."/storage/public/$file";
						if ($file && file_exists($fileExists)) {
							unlink($fileExists);
						}
						$supplier = $this->dataProdukService->update($data);
					} else {
						if (DataProduk::where('nama_produk', $data->nama_produk)->first()) {
							$sama += 1;
							continue;
						}
						$supplier = $this->dataProdukService->create($data);
					}
					if ($newRequest->hasFile('foto_directory')) {
						$newRequest->file('foto_directory')->storeAs("public/".$newRequest->master, $newRequest->file_name);
					}
					$total+=1;
				}
			}
			DB::commit();
			$msg = $sama > 0 ? 'Data produk berhasil di import dengan total data '.$total.' dan data yang sama '.$sama : 'Data produk berhasil di import dengan total data '.$total;
			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 200,
				'message' => $msg,
				'response' => $array,
			]), 200);
		} catch (\Throwable $th) {
			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 500,
				'message' => "Gagal mengupload data! periksa file.",
				'response' => $th->getMessage()
			]), 500);
		}
	}
}
