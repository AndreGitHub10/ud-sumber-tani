<?php

namespace App\Http\Controllers\Konversi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
	public function main(Request $request)
	{
		return view('contents.konversi-satuan.main');
	}
}
