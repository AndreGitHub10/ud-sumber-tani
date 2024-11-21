<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
# DTO
use App\DataTransferObjects\Produk\DetailSatuanDTO;
use App\DataTransferObjects\Produk\PostSatuanDTO;
use App\DataTransferObjects\Response\ResponseAxiosDTO;
# Models
use App\Models\SatuanProduk;
# Services
use App\Services\Produk\SatuanService;

class SatuanController extends Controller
{
	private SatuanService $satuanService;

	public function __construct(
		SatuanService $satuanService
	)
	{
		$this->satuanService = $satuanService;
	}

	public function datatables(Request $request)
	{
		return DataTables::of(SatuanProduk::all())
			->addIndexColumn()
			->addColumn('action', function($item) {
				return "
					<div class='text-center'>
						<button type='button' class='btn btn-sm btn-danger px-2 btn-delete-satuan' data-id='$item->id'>
							<i class='fadeIn animated bx bx-trash'></i>
						</button>
						<button type='button' class='btn btn-sm btn-warning px-2 btn-edit-satuan' data-id='$item->id'>
							<i class='fadeIn animated bx bx-pencil'></i>
						</button>
					</div>
				";
			})
			->toJson();
	}

	public function destroy(DetailSatuanDTO $data)
	{
		$this->satuanService->destroy($data);

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
		]), $data->res_code);
	}

	public function form(Request $request)
	{
		$data = DetailSatuanDTO::fromRequest($request);

		$content = view('contents.data-master.produk.satuan.form', ['satuan' => $data->satuan])->render();

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
			'response' => $content,
		]), $data->res_code);
	}

	public function konversi(Request $request)
	{
		$data = SatuanProduk::whereNotIn('id', [$request->satuan_id])->get();
		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => 200,
			'message' => 'Ok',
			'response' => $data,
		]), 200);
	}
	
	public function main(Request $request)
	{
		return view('contents.data-master.produk.satuan.main');
	}

	public function store(PostSatuanDTO $data)
	{
		try {
			if (!$data->id_satuan) {
				$satuan = $this->satuanService->create($data);
			} else {
				$satuan = $this->satuanService->update($data);
			}

			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => $data->res_code,
				'message' => $data->res_message,
				'response' => $satuan,
			]), $data->res_code);
		} catch (\Throwable $e) {
			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 500,
				'message' => $e->getMessage(),
			]), 500);
		}
	}
}