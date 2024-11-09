<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
# DTO
use App\DataTransferObjects\Response\ResponseAxiosDTO;
use App\DataTransferObjects\User\DetailSupplierDTO;
use App\DataTransferObjects\User\PostSupplierDTO;
# Form request
use App\Http\Requests\User\PostSupplierRequest;
# Helpers
use App\Helpers\Generate;
# Models
use App\Models\Supplier;
# Services
use App\Services\User\SupplierService;

class SupplierController extends Controller
{
	private SupplierService $supplierService;

	public function __construct(
		SupplierService  $supplierService
	)
	{
		$this->supplierService = $supplierService;
	}

	public function datatables(Request $request)
	{
		return DataTables::of(Supplier::all())
			->addIndexColumn()
			->addColumn('action', function($item) {
				return "
					<div class='text-center'>
						<button type='button' class='btn btn-sm btn-danger px-2 btn-delete-supplier' data-id='$item->id'>
							<i class='fadeIn animated bx bx-trash'></i>
						</button>
						<button type='button' class='btn btn-sm btn-warning px-2 btn-edit-supplier' data-id='$item->id'>
							<i class='fadeIn animated bx bx-pencil'></i>
						</button>
					</div>
				";
			})
			->toJson();
	}

	public function destroy(DetailSupplierDTO $data)
	{
		$this->supplierService->destroy($data);

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
		]), $data->res_code);
	}

	public function form(Request $request)
	{
		$data = DetailSupplierDTO::fromRequest($request);

		$content = view('contents.data-master.supplier.form', ['modelSupplier' => $data->model_supplier])->render();

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
			'response' => $content,
		]), $data->res_code);
	}

	public function main(Request $request)
	{
		return view('contents.data-master.supplier.main');
	}

	public function store(PostSupplierRequest $request)
	{
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
