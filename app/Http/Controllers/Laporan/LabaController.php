<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\DataProduk;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LabaController extends Controller
{
	public function main() {
        $array = [
			'kategori' => KategoriProduk::all()
		];
		return view('contents.laporan.laba.main',$array);
	}

    public function datatables(Request $request) {
        $kategori = isset($request->kategori) ? $request->kategori : '';
        $data = DataProduk::with('pembelian_detail','pembelian_detail.satuan','pembelian_detail.penjualan_detail')->
            when($kategori!='',function ($q) use($kategori) {
                $q->where('kategori_id',$kategori);
            })->
            get();
        return DataTables::of($data)
			->addIndexColumn()
			->addColumn('jumlah', function($item) {
                $satuan = (object)[];
                foreach ($item->pembelian_detail ?? [] as $k => $v) {
                    if ($v->satuan) {
                        foreach ($v->penjualan_detail ?? [] as $k2 => $v2) {
                            if (!isset($satuan->{$v->satuan->nama})) {
                                $satuan->{$v->satuan->nama} = 0;
                            }
                            $satuan->{$v->satuan->nama} += $v2->jumlah;
                        }
                    }
                }
                $html = '';
                foreach ($satuan as $k => $v) {
                    $html .= "<li>$k ($v)</li>";
                }
				return $html;
			})
			->addColumn('laba_kotor', function($item) {
                $laba = 0;
                foreach ($item->pembelian_detail ?? [] as $k => $v) {
                    if ($v->satuan) {
                        foreach ($v->penjualan_detail ?? [] as $k2 => $v2) {
                            $laba += $v2->total_harga_jual_diskon;
                        }
                    }
                }
				return $laba;
			})
			->addColumn('laba_bersih', function($item) {
                $laba = 0;
                foreach ($item->pembelian_detail ?? [] as $k => $v) {
                    if ($v->satuan) {
                        foreach ($v->penjualan_detail ?? [] as $k2 => $v2) {
                            $laba += $v2->total_harga_jual_diskon - ($v->harga_beli*$v2->jumlah);
                        }
                    }
                }
				return $laba;
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
			->rawColumns(["jumlah","action"])
			->toJson();
    }
}
