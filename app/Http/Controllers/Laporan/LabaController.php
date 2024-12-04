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
        $date_range = $request->date_range != '' ? explode(' to ',$request->date_range) : [];
        if (count($date_range)==1) {
            $date_range[]=$date_range[0];
        }
        $start = $end = '';
        if (count($date_range)>1) {
            $start = date('Y-m-d',strtotime($date_range[0]));
            $end = date('Y-m-d',strtotime($date_range[1]));
        }
        $kategori = isset($request->kategori) ? $request->kategori : '';
        $data = DataProduk::with('pembelian_detail','pembelian_detail.satuan','pembelian_detail.penjualan_detail','pembelian_detail.penjualan_detail.penjualan')->
            when($kategori!='',function ($q) use($kategori) {
                $q->where('kategori_id',$kategori);
            })->
            when(count($date_range)==0, function($q) {
                $q->limit(0);
            })->
            when(count($date_range)>1, function($q) use ($start,$end) {
                $q->whereHas('pembelian_detail.penjualan_detail.penjualan',function($qq) use ($start,$end) {
                    $qq->whereBetween('tanggal', [$start,$end]);
                });
            })->
            // has('pembelian_detail.penjualan_detail.penjualan')->
            // where('pembelian_detail.penjualan_detail.is_konversi','=','0')->
            // whereHas('pembelian_detail',function ($q) {
            //     $q->whereHas('penjualan_detail',function ($qq) {
            //         $qq->where('penjualan_detail.is_konversi','=','0');
            //     });
            // })->
            get();
        $laba = 0;
        foreach ($data as $key => $value) {
            foreach ($value->pembelian_detail ?? [] as $k => $v) {
                if ($v->satuan) {
                    foreach ($v->penjualan_detail ?? [] as $k2 => $v2) {
                        if ($v2->is_konversi=='1') {
                            continue;
                        }
                        if ($v2->penjualan) {
                            $tgl = date('Y-m-d',strtotime($v2->penjualan->tanggal));
                            if (($tgl >= $start) && ($tgl <= $end)) {
                                $laba += $v2->total_harga_jual_diskon - ($v->harga_beli*$v2->jumlah);
                            }
                        }
                    }
                }
            }
        }
        return DataTables::of($data)
			->addIndexColumn()
			->addColumn('jumlah', function($item) use ($start,$end) {
                $satuan = (object)[];
                foreach ($item->pembelian_detail ?? [] as $k => $v) {
                    if ($v->satuan) {
                        foreach ($v->penjualan_detail ?? [] as $k2 => $v2) {
                            if ($v2->is_konversi=='1') {
                                continue;
                            }
                            if ($v2->penjualan) {
                                $tgl = date('Y-m-d',strtotime($v2->penjualan->tanggal));
                                if (($tgl >= $start) && ($tgl <= $end)) {
                                    if (!isset($satuan->{$v->satuan->nama})) {
                                        $satuan->{$v->satuan->nama} = 0;
                                    }
                                    $satuan->{$v->satuan->nama} += $v2->jumlah;
                                }
                            }
                        }
                    }
                }
                $html = '';
                foreach ($satuan as $k => $v) {
                    $html .= "<li>$k ($v)</li>";
                }
				return $html;
			})
			->addColumn('laba_kotor', function($item) use ($start,$end) {
                $laba = 0;
                foreach ($item->pembelian_detail ?? [] as $k => $v) {
                    if ($v->satuan) {
                        foreach ($v->penjualan_detail ?? [] as $k2 => $v2) {
                            if ($v2->is_konversi=='1') {
                                continue;
                            }
                            if ($v2->penjualan) {
                                $tgl = date('Y-m-d',strtotime($v2->penjualan->tanggal));
                                if (($tgl >= $start) && ($tgl <= $end)) {
                                    $laba += $v2->total_harga_jual_diskon;
                                }
                            }
                        }
                    }
                }
				return $laba;
			})
			->addColumn('laba_bersih', function($item) use ($start,$end) {
                $laba = 0;
                foreach ($item->pembelian_detail ?? [] as $k => $v) {
                    if ($v->satuan) {
                        foreach ($v->penjualan_detail ?? [] as $k2 => $v2) {
                            if ($v2->is_konversi=='1') {
                                continue;
                            }
                            if ($v2->penjualan) {
                                $tgl = date('Y-m-d',strtotime($v2->penjualan->tanggal));
                                if (($tgl >= $start) && ($tgl <= $end)) {
                                    $laba += $v2->total_harga_jual_diskon - ($v->harga_beli*$v2->jumlah);
                                }
                            }
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
            ->with('laba',$laba)
			->toJson();
    }
}
