<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\DataProduk;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KartuStokController extends Controller
{
	public function main() {
		return view('contents.laporan.kartu-stok.main');
	}

	public function datatables() {
		return DataTables::of(DataProduk::get())
			->addIndexColumn()
			->addColumn('stok', function($item) {
				return '0';
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
			->toJson();
	}
}
