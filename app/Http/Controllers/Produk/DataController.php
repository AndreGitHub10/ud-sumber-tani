<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
# DTO
use App\DataTransferObjects\Produk\DetailDataDTO;
use App\DataTransferObjects\Produk\PostDataDTO;
use App\DataTransferObjects\Response\ResponseAxiosDTO;
# Models
use App\Models\DataProduk;
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
		return DataTables::of(DataProduk::all())
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

		$content = view('contents.data-master.produk.data.form', ['dataProduk' => $data->model_data_produk])->render();

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

	public function store(Request $request)
	{
		return 'store';
	}
}
