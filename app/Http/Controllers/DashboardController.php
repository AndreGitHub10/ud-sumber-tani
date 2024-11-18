<?php

namespace App\Http\Controllers;

use App\Models\PenjualanDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function main(Request $request)
	{
		$penjualanHarian = PenjualanDetail::whereHas('penjualan',function ($q) {
			$q->where('penjualan.tanggal',date('Y-m-d'));
		})->get();
		$penjualanBulanan = PenjualanDetail::whereHas('penjualan',function ($q) {
			$q->whereBetween('penjualan.tanggal',[date('Y-m-1'),date('Y-m-t')]);
		})->get();
		$data = [
			'terjual_harian' => $penjualanHarian->sum('jumlah'),
			'terjual_bulanan' => $penjualanBulanan->sum('jumlah'),
			'pendapatan_harian' => $penjualanHarian->sum('total_harga_jual_diskon'),
			'pendapatan_bulanan' => $penjualanBulanan->sum('total_harga_jual_diskon'),
			'uang_masuk' => 0,
			'uang_keluar' => 0,
		];
		return view('contents.dashboard.main',$data);
	}
}
