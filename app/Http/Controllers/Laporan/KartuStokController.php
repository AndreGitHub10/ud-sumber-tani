<?php

namespace App\Http\Controllers\Laporan;

use App\DataTransferObjects\Response\ResponseAxiosDTO;
use App\Exports\KartuStokExport;
use App\Http\Controllers\Controller;
use App\Models\DataProduk;
use App\Models\VDetailKartuStok;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class KartuStokController extends Controller
{
	public function main() {
		return view('contents.laporan.kartu-stok.main');
	}

	public function datatables() {
		return DataTables::of(DataProduk::with('v_kartu_stok','v_kartu_stok.satuan_produk')->get())
			->addIndexColumn()
			->addColumn('stok', function($item) {
				$return = "";
				foreach ($item->v_kartu_stok as $k => $v) {
					if ($v->satuan_produk) {
						$return .= "<li>" . $v->satuan_produk->nama . " ($v->stok)</li>";
					}
				}
				return $return;
			})
			->addColumn('action', function($item) {
				return "
					<div class='text-center'>
						<button type='button' class='btn btn-sm btn-primary px-2 btn-detail' data-id='$item->id'>
							<i class='fadeIn animated bx bx-detail'></i>
						</button>
					</div>
				";
			})
			->rawColumns(["stok","action"])
			->toJson();
	}

	public function detail(Request $request)
	{
		$data = DataProduk::with('v_kartu_stok','v_kartu_stok.satuan_produk','kategori')->find($request->id);

		$fileExists = '';

		if ($data) {
			$data->res_code=200;
			$data->res_message="Data Ditemukan";
			$fileExists = public_path()."/storage/public/".$data->foto_directory;
			if (!$data->foto_directory || !file_exists($fileExists)) {
				$data->foto = asset('/assets/images/errors-images/no-image.jpg');
			} else {
				$data->foto = url("storage/public/".$data->foto_directory);
			}
		} else {
			$data->res_code=400;
			$data->res_message="Data Tidak Ditemukan";
		}

		$array = [
			'produk' => $data
		];

		$content = view('contents.laporan.kartu-stok.detail', $array)->render();

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
			'response' => $content,
		]), $data->res_code);
	}

	public function datatablesDetail(Request $request) {
		$data = VDetailKartuStok::where([
				'kode_produk' => $request->kode_produk,
				'satuan_id' => $request->satuan_id
			])->
			orderBy("ts","desc")->
			get();
		$stokMasuk = $data->sum('stok_masuk');
		$stokKeluar = $data->sum('stok_keluar');
		$stokAkhir = $stokMasuk-$stokKeluar;
		foreach ($data as $key => $value) {
			$value->sisa_stok = $stokAkhir;
			$stokAkhir-=$value->stok_masuk;
			$stokAkhir+=$value->stok_keluar;
		}
		return DataTables::of($data)
			->addIndexColumn()
			->addColumn('action', function($item) {
				return "
					<div class='text-center'>
						<button type='button' class='btn btn-sm btn-primary px-2 btn-detail' data-id='$item->id'>
							<i class='fadeIn animated bx bx-detail'></i>
						</button>
					</div>
				";
			})
			->addColumn('tanggal', function($item) {
				return Date('Y-m-d', strtotime($item->ts));
			})
			->rawColumns(["action"])
			->with('stok_akhir',$stokMasuk-$stokKeluar)
			->toJson();
	}

	public function exportExcel(Request $request) {
		$timeStamps = date('d-m-Y H:i:s');
		return Excel::download(new KartuStokExport, 'Kartu Stok '.$timeStamps.'.xlsx');
		
	}
}
