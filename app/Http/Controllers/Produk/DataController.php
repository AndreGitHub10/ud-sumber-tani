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
		return DataTables::of(DataProduk::with('kategori')->get())
			->addIndexColumn()
			->addColumn('nama_kategori', function($item) {
				return $item->kategori ? $item->kategori->nama : '';
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
		return view('contents.data-master.produk.data.main');
	}

	public function store(PostDataRequest $request)
	{
		$data = PostDataDTO::fromRequest($request);
		if ($data->res_code !== 500) {
			if ($data->id_data_produk) {
				$file = $data->model_data_produk->foto_directory;
				$fileExists = public_path()."/storage/public/$file";
				if ($file && file_exists($fileExists)) {
					unlink($fileExists);
				}
				$supplier = $this->dataProdukService->update($data);
			} else {
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

	public function barcode($barcode='') {
		$produk = DataProduk::where('barcode',$barcode)->first();
		$array = [
			'barcode' => $barcode,
			'produk' => $produk
		];
		return view('contents.data-master.produk.data.barcode',$array);
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
						$file = $data->model_data_produk->foto_directory;
						$fileExists = public_path()."/storage/public/$file";
						if ($file && file_exists($fileExists)) {
							unlink($fileExists);
						}
						$supplier = $this->dataProdukService->update($data);
					} else {
						$supplier = $this->dataProdukService->create($data);
					}
					if ($newRequest->hasFile('foto_directory')) {
						$newRequest->file('foto_directory')->storeAs("public/".$newRequest->master, $newRequest->file_name);
					}
					$total+=1;
				}
			}
			DB::commit();
			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 200,
				'message' => "Berhasil mengupload $total data!",
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
