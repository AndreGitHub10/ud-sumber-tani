<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
# DTO
use App\DataTransferObjects\Produk\DetailDataDTO;
use App\DataTransferObjects\Produk\PostDataDTO;
use App\DataTransferObjects\Response\ResponseAxiosDTO;
# Form request
use App\Http\Requests\Produk\PostDataRequest;
# Helpers
use App\Helpers\Generate;
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
			->addColumn('action', function($item) {
				return "
					<div class='text-center'>
						<button type='button' class='btn btn-sm btn-danger px-2 btn-delete-data-produk' data-id='$item->id'>
							<i class='fadeIn animated bx bx-trash'></i>
						</button>
						<button type='button' class='btn btn-sm btn-warning px-2 btn-edit-data-produk' data-id='$item->id'>
							<i class='fadeIn animated bx bx-pencil'></i>
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
}
