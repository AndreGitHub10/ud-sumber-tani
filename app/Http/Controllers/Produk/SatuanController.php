<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
# DTO
use App\DataTransferObjects\Produk\DetailSatuanDTO;
use App\DataTransferObjects\Response\ResponseAxiosDTO;
# Form request
use App\Http\Requests\Produk\PostSatuanRequest;
# Models
use App\Models\Satuan;

class SatuanController extends Controller
{
	public function __construct()
	{
	}

	public function datatables(Request $request)
	{
		return DataTables::of(Satuan::all())
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

	public function destroy(Request $request)
	{
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

	public function store(PostSatuanRequest $request)
	{
	}
}