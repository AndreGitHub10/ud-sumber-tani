<?php

namespace App\DataTransferObjects\Produk;

use Illuminate\Http\Request;
use OpenSoutheners\LaravelDto\DataTransferObject;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;
# Form request
use App\Http\Requests\Produk\PostDataRequest;
# Helpers
use App\Helpers\Generate;
# Models
use App\Models\DataProduk;

final class PostDataDTO extends DataTransferObject
{
	/**
	 * Please check the DTO guide before you start. https://docs.opensoutheners.com/laravel-dto
	 */
	public function __construct(
		public int $res_code,
		public string $res_message,
		public string $kode_produk,
		public string $file_path,
		public string $nama_produk,
		public int|null $kategori,
		public int|null $id_data_produk,
		public DataProduk $model_data_produk,
	) {
		date_default_timezone_set('Asia/Jakarta');
		if ($id_data_produk) {
			$this->res_code = 200;
			$this->res_message = 'Data berhasil diperbarui';
			return;
		}

		if (!$kodeProduk = Generate::kodeProduk()) {
			$this->res_code = 500;
			$this->res_message = "Generate kode gagal, silahkan coba lagi!";
			return;
		}
		$this->kode_produk = $kodeProduk;
	}

	public static function fromRequest(Request $request): PostDataDTO
	{
		$timestamps = strtotime('now');

		# $id_data_produk ada, berarti data lama
		$isNew = $request->id_data_produk ? false : true;
		$code = $isNew ? 201 : 200;
		$message = $isNew ? 'Data berhasil dibuat' : 'Data berhasil diperbarui';
		$filePath = $kodeProduk = "";
		
		if ($request->hasFile('foto_directory')) {
			$file = $request->file('foto_directory');
			$time = date('His', $timestamps).'-';
			$date = date('Y-m-d', $timestamps).'/';
			$fileName = $time.$file->getClientOriginalName();
			$root = 'data-master/produk/data/';
			$master = $root.$date;
			$filePath = $master.$fileName;
			$request->merge([
				'master' => $master,
				'file_name' => $fileName
			]);
		}

		if ($isNew) {
			if (!$kodeProduk = Generate::kodeProduk()) {
				$code = 500;
				$message = 'Generate kode gagal, silahkan coba lagi!';
			}
		}

		return new self(
			$isNew ? 201 : 200,
			$message,
			$kodeProduk,
			$filePath,
			$request->nama_produk ?? null,
			$request->kategori ?? null,
			$request->id_data_produk ?? null,
            $isNew ? DataProduk::class : DataProduk::find($request->id_data_produk)
		);
	}
}
