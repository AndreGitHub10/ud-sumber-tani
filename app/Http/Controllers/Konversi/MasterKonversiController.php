<?php

namespace App\Http\Controllers\Konversi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
# DTO
use App\DataTransferObjects\Konversi\DetailMasterKonversiDTO;
use App\DataTransferObjects\Konversi\PostMasterKonversiDTO;
use App\DataTransferObjects\Response\ResponseAxiosDTO;
# Models
use App\Models\KonversiSatuan;
use App\Models\SatuanProduk;
# Service
use App\Services\Konversi\MasterKonversiService;

class MasterKonversiController extends Controller
{
	private MasterKonversiService $masterKonversiService;
	public function __construct(
		MasterKonversiService $masterKonversiService
	)
	{
		$this->masterKonversiService = $masterKonversiService;
	}

	public function datatables(Request $request)
	{
		// return KonversiSatuan::with(['satuan_asal', 'satuan_tujuan'])->get();
		return DataTables::of(KonversiSatuan::with(['satuan_asal:id,nama', 'satuan_tujuan:id,nama']))
			->addIndexColumn()
			->addColumn('satuan_asal_nama', function($item) {
				return $item->satuan_asal ? strtoupper($item->satuan_asal->nama) : '(satuan tidak ditemukan)';
			})
			->addColumn('satuan_tujuan_nama', function($item) {
				return strtoupper($item->satuan_tujuan->nama);
				return $item->satuan_tujuan ? strtoupper($item->satuan_tujuan->nama) : '(satuan tidak ditemukan)';
			})
			->addColumn('action', function($item) {
				return "
					<div class='text-center'>
						<button type='button' class='btn btn-sm btn-danger px-2 btn-delete-master-konversi' data-id='$item->id' data-satuan-asal='$item->satuan_id_asal' data-satuan-tujuan='$item->satuan_id_tujuan' data-nilai-konversi='$item->nilai_konversi'>
							<i class='fadeIn animated bx bx-trash'></i>
						</button>
						<button type='button' class='btn btn-sm btn-warning px-2 btn-edit-master-konversi' data-id='$item->id' data-satuan-asal='$item->satuan_id_asal' data-satuan-tujuan='$item->satuan_id_tujuan' data-nilai-konversi='$item->nilai_konversi'>
							<i class='fadeIn animated bx bx-pencil'></i>
						</button>
					</div>
				";
			})
			->toJson();
	}

	public function destroy(DetailMasterKonversiDTO $data)
	{
		$this->masterKonversiService->destroy($data);

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
		]), $data->res_code);
	}

	public function getMaster(Request $request)
	{
		$data = KonversiSatuan::where('satuan_id_asal', $request->satuan_id)->with(['satuan_asal:id,nama', 'satuan_tujuan:id,nama'])->get();
		$code = count($data) ? 200 : 204;

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $code,
			'message' => 'Oke',
			'response' => $data
		]), $code);
	}

	public function main(Request $request)
	{
		$data = SatuanProduk::all();
		return view('contents.konversi-satuan.main', ['satuan' => $data]);
	}

	public function store(Request $request)
	{
		$dto = PostMasterKonversiDTO::fromRequest($request);

		if (!$dto->id_konversi_satuan) {
			$this->masterKonversiService->create($dto);
		} else {
			$this->masterKonversiService->update($dto);
		}

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $dto->res_code,
			'message' => $dto->res_message,
		]), $dto->res_code);
	}
}
