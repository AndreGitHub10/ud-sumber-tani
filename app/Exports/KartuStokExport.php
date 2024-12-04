<?php

namespace App\Exports;

use App\Models\DataProduk;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class KartuStokExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $data = DataProduk::with('v_kartu_stok','v_kartu_stok.satuan_produk')->has('v_kartu_stok')->has('v_kartu_stok.satuan_produk')->get();
		$arrData = [];
		foreach ($data as $k => $v) {
			foreach ($v->v_kartu_stok as $k2 => $v2) {
				$arrData[] = (object)[
					'no' => $k+1,
					'kode_produk' => $v->kode_produk,
					'nama_produk' => $v->nama_produk,
					'satuan' => $v2->satuan_produk->nama,
					'stok' => $v2->stok
				];
			}
		}
        return view('contents.laporan.kartu-stok.export', [
            'data' => $arrData
        ]);
    }
}
