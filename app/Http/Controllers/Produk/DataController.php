<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
# DTO
use App\DataTransferObjects\Produk\DetailDataDTO;
use App\DataTransferObjects\Produk\PostDataDTO;
use App\DataTransferObjects\Response\ResponseAxiosDTO;
# Form request
use App\Http\Requests\Produk\PostDataRequest;
# Helpers
use App\Helpers\Generate;
# Models
use App\Models\DataProduk;
use App\Models\KategoriProduk;
# Services
use App\Services\Produk\DataService;

class DataController extends Controller
{
	private DataService $dataProdukService;

	public function __construct(
		DataService $dataProdukService
	)
	{
		date_default_timezone_set('Asia/Jakarta');
		$this->dataProdukService = $dataProdukService;
	}

	public function datatables(Request $request)
	{
		return DataTables::of(DataProduk::with('kategori')->get())
			->addIndexColumn()
			->addColumn('action', function($item) {
				return "
					<div class='text-center'>
						<button type='button' class='btn btn-sm btn-danger px-2 btn-delete-data-produk' data-id='$item->id'>
							<i class='fadeIn animated bx bx-trash'></i>
						</button>
						<button type='button' class='btn btn-sm btn-warning px-2 btn-edit-data-produk' data-id='$item->id'>
							<i class='fadeIn animated bx bx-pencil'></i>
						</button>
						<button type='button' class='btn btn-sm btn-secondary px-2 btn-print-barcode' data-id='$item->kode_produk'>
							<i class='fadeIn animated bx bx-barcode'></i>
						</button>
					</div>
				";
			})
			->toJson();
	}

	public function destroy(DetailDataDTO $data)
	{
		$file = $data->model_data_produk->foto_directory;
		$fileExists = public_path()."/storage/public/$file";
		if ($file && file_exists($fileExists)) {
			unlink($fileExists);
		}
		$this->dataProdukService->destroy($data);

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
		]), $data->res_code);
	}

	public function form(Request $request)
	{
		$data = DetailDataDTO::fromRequest($request);
		$array = [
			'dataProduk' => $data->model_data_produk,
			'kategori' => KategoriProduk::all(),
		];

		$content = view('contents.data-master.produk.data.form', $array)->render();

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
			'response' => $content,
		]), $data->res_code);
	}

	public function main(Request $request)
	{
		return view('contents.data-master.produk.data.main');
	}

	public function store(PostDataRequest $request)
	{
		$data = PostDataDTO::fromRequest($request);
		if ($data->res_code !== 500) {
			if ($data->id_data_produk) {
				$file = $data->model_data_produk->foto_directory;
				$fileExists = public_path()."/storage/public/$file";
				if ($file && file_exists($fileExists)) {
					unlink($fileExists);
				}
				$supplier = $this->dataProdukService->update($data);
			} else {
				$supplier = $this->dataProdukService->create($data);
			}
			if ($request->hasFile('foto_directory')) {
				$request->file('foto_directory')->storeAs("public/".$request->master, $request->file_name);
			}
		}

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
			'response' => $supplier,
		]), $data->res_code);
	}

	public function barcode($barcode='') {
		$array = [
			'barcode' => $barcode
		];
		return view('contents.data-master.produk.data.barcode',$array);
	}

	public function importForm(Request $request)
	{
		$content = view('contents.data-master.produk.data.import-form')->render();

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => 200,
			'message' => 'Berhasil',
			'response' => $content,
		]), 200);
	}

	public function downloadTemplate()
	{
		$fileMateri = public_path("template/template.xlsx");
		return response()->download($fileMateri);
	}

	public function import(Request $request)
	{
		// if (!isset($request->file)) {
		// 	return response()->json(ResponseAxiosDTO::fromArray([
		// 		'code' => 400,
		// 		'message' => 'File excel harus di isi'
		// 	]), 400);
		// }
		// $array = Excel::toArray(new SiswaImport, $request->file('file'));
		// DB::beginTransaction();
		// try {
		// 	$total = 0;
		// 	foreach ($array[0] as $key => $value) {
		// 		$siswa = Siswa::where([
		// 				'nis'=>$value[0],
		// 				'tingkat'=>$request->tingkat
		// 			])
		// 			->first();
		// 		if ($siswa) {
		// 			continue;
		// 		}
		// 		$stop=false;
		// 		foreach ($value as $k => $v) {
		// 			if ($k==4) {
		// 				break;
		// 			}
		// 			if ($v==''&&$k!=1) {
		// 				$stop = true;
		// 			}
		// 			if ($k==3&&!in_array(substr(strtoupper($v),0,1),['L','P'])) {
		// 				$stop = true;
		// 			}
		// 		}
		// 		if ($stop) {
		// 			continue;
		// 		}
		// 		$siswa = new Siswa;
		// 		$siswa->nama = $value[2];
		// 		$siswa->nis = $value[0];
		// 		$siswa->nisn = $value[1];
		// 		$siswa->jenis_kelamin = substr(strtoupper($value[3]),0,1);
		// 		$siswa->tahun_masuk = $request->tahun_masuk;
		// 		$siswa->tingkat = $request->tingkat;
		// 		if (!$siswa->save()) {
		// 			DB::rollBack();
		// 			return ['status'=>'error','message'=>'Gagal menyimpan data, coba lagi atau hubungi admin!'];
		// 		}
		// 		$total+=1;
		// 	}
		// 	DB::commit();
		// 	return ['status'=>'success','message'=>"Berhasil mengupload $total data!"];
		// } catch (\Throwable $th) {
		// 	Log::info($th->getMessage());
		// 	DB::rollBack();
		// 	throw $th;
		// 	return ['status'=>'error','message'=>'Terjadi Kesalahan Sistem!'];
		// }
		// return $array;
	}
}
