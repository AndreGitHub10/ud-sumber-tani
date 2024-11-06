<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
# DTO
use App\DataTransferObjects\Produk\DetailSatuanDTO;
use App\DataTransferObjects\Produk\PostSatuanDTO;
use App\DataTransferObjects\Response\ResponseAxiosDTO;
# Form request
use App\Http\Requests\Produk\PostSatuanRequest;
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
		// return $data;
		// return self::$satuanService->destroy($data);
		// return $this->satuanService->destroy($data);
		// if (!$this->satuanService->destroy($data)) {
		// 	return response()->json(ResponseAxiosDTO::fromArray([
		// 		'code' => 500,
		// 		'message' => 'Data gagal dihapus',
		// 	]), 500);
		// }
		if ($data->res_code === 200 && !$this->satuanService->destroy($data)) {
			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 500,
				'message' => 'Data gagal dihapus',
			]), 500);
		}

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
		]), $data->res_code);
	}

	public function form(Request $request)
	{
		$data = DetailSatuanDTO::fromRequest($request)->toArray();
		$data['satuan'] = $data['satuan'] !== null ? (object)$data['satuan'] : "";

		$content = view('contents.data-master.produk.satuan.form')->with($data)->render();

		$dto = ResponseAxiosDTO::fromArray([
			'code' => 200,
			'message' => 'Ok',
			'response' => $content,
		]);

		return response()->json($dto, $dto->code);
	}
	
	public function main(Request $request)
	{
		return view('contents.data-master.produk.satuan.main');
	}

	public function store(PostSatuanDTO $data)
	{
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
	}
}