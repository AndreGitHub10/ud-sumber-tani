<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PersediaanController extends Controller
{
	public function main() {
		return view('contents.laporan.persediaan.main');
	}

	public function datatables(Request $request) {
		$stok_filter = isset($request->stok_filter) ? $request->stok_filter : '';
		$data = MinMaxProduk::select(
				'minmax_produk.*',
				DB::raw('coalesce(v_kartu_stok.stok,0) as stok')
			)->
			with('data_produk','satuan_produk')->
			has('satuan_produk')->
			has('data_produk')->
			leftJoin('v_kartu_stok', function ($join) use ($stok_filter) {
				$join->
					on('minmax_produk.kode_produk','=','v_kartu_stok.kode_produk')->
					on('minmax_produk.satuan_id','=','v_kartu_stok.satuan_id');
			})->
			get();
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
}
