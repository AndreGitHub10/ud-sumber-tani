<?php

namespace App\Http\Controllers;

use App\Models\PenjualanDetail;
use App\Models\VUangMasukKeluar;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
	public function main(Request $request)
	{
		if (Auth::user()->level!='admin') {
			return redirect()->route('penjualanKasir.main');
		}
		$penjualanHarian = PenjualanDetail::whereHas('penjualan',function ($q) {
			$q->where('penjualan.tanggal',date('Y-m-d'));
		})->get();
		$penjualanBulanan = PenjualanDetail::whereHas('penjualan',function ($q) {
			$q->whereBetween('penjualan.tanggal',[date('Y-m-1'),date('Y-m-t')]);
		})->get();
		$uang_masuk = VUangMasukKeluar::whereBetween('tanggal',[date('Y-m-1'),date('Y-m-t')])->get()->sum('masuk');
		$uang_keluar = VUangMasukKeluar::whereBetween('tanggal',[date('Y-m-1'),date('Y-m-t')])->get()->sum('keluar');
		$data = [
			'terjual_harian' => $penjualanHarian->sum('jumlah'),
			'terjual_bulanan' => $penjualanBulanan->sum('jumlah'),
			'pendapatan_harian' => $penjualanHarian->sum('total_harga_jual_diskon'),
			'pendapatan_bulanan' => $penjualanBulanan->sum('total_harga_jual_diskon'),
			'uang_masuk' => $uang_masuk,
			'uang_keluar' => $uang_keluar,
		];
		return view('contents.dashboard.main',$data);
	}
}
