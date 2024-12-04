<?php

namespace App\Http\Controllers\Laporan;

use App\DataTransferObjects\Response\ResponseAxiosDTO;
use App\Http\Controllers\Controller;
use App\Models\DataProduk;
use App\Models\MinMaxProduk;
use App\Models\SatuanProduk;
use App\Models\VKartuStok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MinMaxController extends Controller
{
	public function main() {
		return view('contents.laporan.min-max.main');
	}

    public function datatables(Request $request) {
        $stok_filter = isset($request->stok_filter) ? $request->stok_filter : '';
        $data = VKartuStok::select([
                'v_kartu_stok.*',
                DB::raw('coalesce(stok,0) as stok'),
                'minmax_produk.min_stok',
                'minmax_produk.max_stok',
            ])->
            with('data_produk','satuan_produk')->
            has('data_produk')->
            has('satuan_produk')->
            leftJoin('minmax_produk', function ($join) {
                $join->
                    on('v_kartu_stok.kode_produk','=','minmax_produk.kode_produk')->
                    on('v_kartu_stok.satuan_id','=','minmax_produk.satuan_id');
            })->
            get();
        // $data = MinMaxProduk::select(
        //         'minmax_produk.*',
        //         DB::raw('coalesce(stok,0) as stok')
        //     )->
        //     with('data_produk','satuan_produk')->
        //     has('satuan_produk')->
        //     has('data_produk')->
        //     leftJoin('v_kartu_stok', function ($join) use ($stok_filter) {
        //         $join->
        //             on('minmax_produk.kode_produk','=','v_kartu_stok.kode_produk')->
        //             on('minmax_produk.satuan_id','=','v_kartu_stok.satuan_id');
        //     })->
        //     get();
        $data = $data->filter(function ($v,$k) use ($stok_filter) {
            if ($stok_filter=='stok_habis') {
                return $v->stok==0;
            }
            if ($stok_filter=='stok_dibawah_minimal') {
                return $v->stok<$v->min_stok;
            }
            if ($stok_filter=='stok_diatas_maksimal') {
                return $v->stok>$v->max_stok;
            }
        });
        return DataTables::of($data)
			->addIndexColumn()
			->addColumn('nama_produk', function($item) {
				return $item->data_produk ? $item->data_produk->nama_produk : '';
			})
			->addColumn('satuan', function($item) {
				return $item->satuan_produk ? $item->satuan_produk->nama : '';
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
			->rawColumns(["action"])
			->toJson();
    }

    public function form() {
		$array = [
			'produk' => DataProduk::all(),
			'satuan' => SatuanProduk::all(),
		];

		$content = view('contents.laporan.min-max.form', $array)->render();

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => 200,
			'message' => '',
			'response' => $content,
		]), 200);
    }

    public function getMinMax(Request $request) {
        $data = MinMaxProduk::where([
            'kode_produk' => $request->kode_produk,
            'satuan_id' => $request->satuan_id
        ])->first();
        return response()->json(ResponseAxiosDTO::fromArray([
			'code' => 200,
			'message' => '',
			'response' => $data,
		]), 200);
    }
    
    public function store(Request $request) {
        $data = MinMaxProduk::where([
            'kode_produk' => $request->kode_produk,
            'satuan_id' => $request->satuan_id
        ])->first();

        if (!$data) {
            $data = new MinMaxProduk;
            $data->kode_produk = $request->kode_produk;
            $data->satuan_id = $request->satuan_id;
        }

        $data->min_stok = $request->min_stok;
        $data->max_stok = $request->max_stok;
        $data->reminder = isset($request->reminder) ? true : false;

        if (!$data->save()) {
            $data->res_code = 205;
            $data->res_message = 'Data gagal disimpan!';
        } else {
            $data->res_code = 200;
            $data->res_message = 'Data berhasil disimpan!';
        }
        return response()->json(ResponseAxiosDTO::fromArray([
            'code' => $data->res_code,
            'message' => $data->res_message,
            'response' => $data,
        ]), $data->res_code);
        
    }
}
