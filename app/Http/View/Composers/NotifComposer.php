<?php

namespace App\Http\View\Composers;

use App\Models\MinMaxProduk;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class NotifComposer
{
	/**
	 * Create a new profile composer.
	 */
	// public function __construct(
	// 	protected UserRepository $users,
	// ) {}

	/**
	 * Bind data to the view.
	 */
	public function compose(View $view): void
	{
		$barang_habis = MinMaxProduk::select(
				'minmax_produk.*',
				DB::raw('coalesce(v_kartu_stok.stok,0) as stok')
			)->
			with('data_produk','satuan_produk')->
			has('satuan_produk')->
			has('data_produk')->
			leftJoin('v_kartu_stok', function ($join) {
				$join->
					on('minmax_produk.kode_produk','=','v_kartu_stok.kode_produk')->
					on('minmax_produk.satuan_id','=','v_kartu_stok.satuan_id');
			})->
			get();
		$barang_habis = $barang_habis->filter(function ($v,$k) {
			return $v->stok==0;
		});
		// $data = [
		// 	'notif' => $barang_habis->count(),
		// 	'list' => $barang_habis,
		// ];
		$view->with('notif', $barang_habis->count());
		$view->with('barang_habis', $barang_habis);
	}
}