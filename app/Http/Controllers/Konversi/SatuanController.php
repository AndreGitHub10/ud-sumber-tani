<?php

namespace App\Http\Controllers\Konversi;

use App\DataTransferObjects\Response\ResponseAxiosDTO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
# Models
use App\Models\KonversiSatuan;
use App\Models\PembelianDetail;
use App\Models\SatuanProduk;

class SatuanController extends Controller
{
	public function form(Request $request)
	{
		$data = SatuanProduk::all();
		return view('contents.konversi-satuan.form', ['satuan' => $data]);
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

    public function store(Request $request)
    {
        return $request->all();
        try {
            $pembelianDetail = new PembelianDetail;
            $pembelianDetail->
        } catch (\Throwable $e) {
            $e->getFile(); # Get location file error
            $e->getMessage(); # Get error message
            $e->getLine(); # Get line error
        }
    }
}
