<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
# DTO
use App\DataTransferObjects\Pembelian\DetailPembelianDTO;
use App\DataTransferObjects\Pembelian\PostPembelianDTO;
use App\DataTransferObjects\Response\ResponseAxiosDTO;
use App\Models\DataProduk;
# Models
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\SatuanProduk;
use App\Models\Supplier;

class PembelianController extends Controller
{
	public function __construct()
	{
	}

	public function datatables(Request $request)
	{
		return DataTables::of(KategoriProduk::all())
			->addIndexColumn()
			->addColumn('action', function($item) {
				return "
					<div class='text-center'>
						<button type='button' class='btn btn-sm btn-danger px-2 btn-delete-pembelian' data-id='$item->id'>
							<i class='fadeIn animated bx bx-trash'></i>
						</button>
						<button type='button' class='btn btn-sm btn-warning px-2 btn-edit-pembelian' data-id='$item->id'>
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
		$data = DetailPembelianDTO::fromRequest($request);

		$array = [
			'pembelian' => $data->model_pembelian,
			'supplier' => Supplier::all(),
			'produk' => DataProduk::all(),
			'satuan' => SatuanProduk::all(),
		];

		$content = view('contents.pembelian.form', $array)->render();

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
			'response' => $content,
		]), $data->res_code);
	}

	public function main(Request $request)
	{
		return view('contents.pembelian.main');
	}

	// public function store(PostKategoriDTO $data)
	public function store(Request $data)
	{
        return $data->all();
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
