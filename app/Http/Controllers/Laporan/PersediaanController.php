<?php

namespace App\Http\Controllers\Laporan;

use App\DataTransferObjects\Response\ResponseAxiosDTO;
use App\Http\Controllers\Controller;
use App\Models\UangMasukKeluar;
use App\Models\VUangMasukKeluar;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PersediaanController extends Controller
{
	public function main() {
		return view('contents.laporan.persediaan.main');
	}

	public function datatables(Request $request) {
		$date_range = $request->date_range != '' ? explode(' to ',$request->date_range) : [];
        if (count($date_range)==1) {
            $date_range[1]=date('Y-m-d',strtotime($date_range[0]));
            $date_range[0]=date('Y-m-d',strtotime($date_range[0].' -7 days'));
        }
		$arrData = [];
        if (count($date_range)>1) {
			$uang_awal = 0;
			$data = VUangMasukKeluar::
				selectRaw('tanggal, sum(masuk) as masuk, sum(keluar) as keluar, sum(total) as total'
				)->
				// 'tanggal',
				// DB::raw('sum("masuk") as masuk')
				// DB::raw('sum("keluar") as keluar'),
				// DB::raw('sum("sum") as sum')
				whereBetween('tanggal',$date_range)->
				groupBy('tanggal')->
				get();
			$uang_awal = VUangMasukKeluar::where('tanggal','<',$date_range[0])->get()->sum('total');
			$loopBegin = new DateTime($date_range[0]);
			$loopEnd = new DateTime($date_range[1]);
			$interval = DateInterval::createFromDateString('1 day');
			$period = new DatePeriod($loopBegin, $interval, $loopEnd);
			foreach ($period as $k => $v) {
				$continue = false;
				$plus=$k+1;
				// return date("d-m-Y", strtotime($date_range[0]." +$plus day"));
				foreach ($data as $k2 => $v2) {
					if (date('d-m-Y',strtotime($v2->tanggal)) == date("d-m-Y", strtotime($date_range[0]." +$plus day"))) {
						$v2->tanggal = date('d-m-Y',strtotime($v2->tanggal));
						// return $v2;
						$arrData[]=$v2;
						$continue = true;
						// break;
					}
				}
				if ($continue) {
					continue;
				}
				$dayData = (object)[];
				$dayData->tanggal = date("d-m-Y", strtotime($date_range[0]." +$plus day"));
				$dayData->masuk = 0;
				$dayData->keluar = 0;
				$dayData->total = 0;
				$arrData[] = $dayData;
			}
			// return $arrData;
			foreach ($arrData as $key => $value) {
				$value->uang_awal = $uang_awal;
				$uang_awal += $value->total;
				$value->uang_akhir = $value->uang_awal + $value->masuk - $value->keluar;
			}
        }
		// return $arrData;
		return DataTables::of($arrData)
			->addIndexColumn()
			->addColumn('action', function($item) {
				return "
					<div class='text-center'>
						<button type='button' class='btn btn-sm btn-primary px-2 btn-detail' data-tanggal='$item->tanggal'>
							<i class='fadeIn animated bx bx-detail'></i>
						</button>
					</div>
				";
			})
			->rawColumns(["action"])
			->toJson();
	}

	public function form(Request $request) {
		$uang = UangMasukKeluar::find($request->id);
		$array = [
			'uang' => $uang,
		];

		$content = view('contents.laporan.persediaan.form', $array)->render();

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => 200,
			'message' => '',
			'response' => $content,
		]), 200);
    }

	public function store(Request $request)
	{
		try {
			if ($request->id) {
				$uang = UangMasukKeluar::find($request->id);
				if (!$uang) {
					$uang = new UangMasukKeluar;
				}
			} else {
				$uang = new UangMasukKeluar;
			}
			$uang->jumlah = $request->jumlah;
			$uang->keterangan = $request->keterangan;
			$uang->tanggal_waktu = $request->tanggal_waktu;
			$uang->type_id = $request->type_id;
			$uang->save();

			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 201,
				'message' => 'Data berhasil dibuat',
			]), 201);
		} catch (\Throwable $e) {

			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 500,
				'message' => $e->getMessage(),
			]), 500);
		}
	}
}
