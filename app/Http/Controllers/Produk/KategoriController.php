<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
# DTO
use App\DataTransferObjects\Produk\DetailKategoriDTO;
use App\DataTransferObjects\Produk\PostKategoriDTO;
use App\DataTransferObjects\Response\ResponseAxiosDTO;
# Models
use App\Models\KategoriProduk;
# Services
use App\Services\Produk\KategoriService;

class KategoriController extends Controller
{
	private KategoriService $kategoriService;

	public function __construct(
		KategoriService $kategoriService
	)
	{
		$this->kategoriService = $kategoriService;
	}

	public function datatables(Request $request)
	{
		return DataTables::of(KategoriProduk::all())
			->addIndexColumn()
			->addColumn('action', function($item) {
				return "
					<div class='text-center'>
						<button type='button' class='btn btn-sm btn-danger px-2 btn-delete-kategori' data-id='$item->id'>
							<i class='fadeIn animated bx bx-trash'></i>
						</button>
						<button type='button' class='btn btn-sm btn-warning px-2 btn-edit-kategori' data-id='$item->id'>
							<i class='fadeIn animated bx bx-pencil'></i>
						</button>
					</div>
				";
			})
			->toJson();
	}

	public function destroy(DetailKategoriDTO $data)
	{
		$this->satuanService->destroy($data);

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
		]), $data->res_code);
	}

	public function form(Request $request)
	{
		$data = DetailKategoriDTO::fromRequest($request);

		$content = view('contents.data-master.produk.kategori.form', ['kategori' => $data->kategori])->render();

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
			'response' => $content,
		]), $data->res_code);
	}
	
	public function main(Request $request)
	{
		return view('contents.data-master.produk.kategori.main');
	}

	public function store(PostKategoriDTO $data)
	{
		try {
			if (!$data->id_kategori) {
				$kategori = $this->kategoriService->create($data);
			} else {
				$kategori = $this->kategoriService->update($data);
			}

			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => $data->res_code,
				'message' => $data->res_message,
				'response' => $kategori,
			]), $data->res_code);
		} catch (\Throwable $e) {
			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 500,
				'message' => $e->getMessage(),
			]), 500);
		}
	}
}
