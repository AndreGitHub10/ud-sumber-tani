<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
# Models
use App\Models\PembelianDetail;

class KasirController extends Controller
{
	public function main(Request $request)
	{
		$produk = PembelianDetail::select('id', 'kode_produk', 'satuan_id', 'stok_real', 'harga_jual')
			->with([
				'data_produk:id,kode_produk,nama_produk',
				'satuan:id,nama'
			])->get();
		return view('contents.penjualan-kasir.main', ['produk' => $produk]);
	}
}
