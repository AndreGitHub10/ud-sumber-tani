<?php

namespace App\Http\Controllers\Konversi;

use App\DataTransferObjects\Response\ResponseAxiosDTO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
# Models
use App\Models\KonversiSatuan;

class SatuanController extends Controller
{
	public function main(Request $request)
	{
		return view('contents.konversi-satuan.main');
	}

	public function getKonversi(Request $request)
	{
		$data = KonversiSatuan::get();
		$code = count($data) ? 200 : 204;
		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $code,
			'message' => 'Ok',
			'response' => $data
		]), $code);
	}
}
