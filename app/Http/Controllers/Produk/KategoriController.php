<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
# Models
use App\Models\Kategori;

class KategoriController extends Controller
{
	public function __construct()
	{
	}

	public function datatables(Request $request)
	{
		return DataTables::of(Kategori::all())
			->addIndexColumn()
			->addColumn('action', function($item) {
				return "
					<div class='text-center'>
						<button type='button' class='btn btn-sm btn-danger px-2 btn-delete-kategori' data-id='$item->id'>
							<i class='fadeIn animated bx bx-trash'></i>
						</button>
						<button type='button' class='btn btn-sm btn-warning px-2 btn-edit-kategori' data-id='$item->id'>
							<i class='fadeIn animated bx bx-pencil'></i>
						</button>
					</div>
				";
			})
			->toJson();
	}

	public function destroy(Request $request)
	{
	}

	public function form(Request $request)
	{
	}
	
	public function main(Request $request)
	{
		return view('contents.data-master.produk.kategori.main');
	}

	public function store(Request $request)
	{
	}
}
