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
		if (!$this->supplierService->destroy($data)) {
			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 500,
				'message' => 'Data gagal dihapus',
			]), 500);
		}

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => 200,
			'message' => 'Data berhasil dihapus',
		]), 200);
	}

	public function form(Request $request)
	{
		$data = DetailSupplierDTO::fromRequest($request)->toArray();
		$data['supplier'] = $data['supplier'] !== null ? (object)$data['supplier'] : "";

		$content = view('contents.data-master.supplier.form')->with($data)->render();

		$dto = ResponseAxiosDTO::fromArray([
			'code' => 200,
			'message' => 'Ok',
			'response' => $content,
		]);

		return response()->json($dto, $dto->code);
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
			$code = 200;
		} else {
			$supplier = $this->supplierService->create($data);
			$code = 201;
		}

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $code,
			'message' => 'Data berhasil disimpan',
			'response' => $supplier,
		]), $code);
	}
}
