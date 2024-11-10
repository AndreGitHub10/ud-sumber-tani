<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
# DTO
use App\DataTransferObjects\Produk\DetailDataDTO;
use App\DataTransferObjects\Produk\PostDataDTO;
use App\DataTransferObjects\Response\ResponseAxiosDTO;
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

	public function destroy(Request $request)
	{
		return 'destroy';
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

	public function store(PostDataDTO $data)
	// public function store(Request $data)
	{
		return $data;
		if (!Generate::kodeSupplier($request)) {
			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 500,
				'message' => 'Generate kode gagal, silahkan coba lagi!',
			]), 500);
		}
		$request->merge(['kode' => $request->res_kode_supplier]);

		$data = PostSupplierDTO::fromRequest($request);
		if ($request->id_supplier) {
			$supplier = $this->supplierService->update($data);
		} else {
			$supplier = $this->supplierService->create($data);
		}

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
			'response' => $supplier,
		]), $data->res_code);
	}
}
