<?php

namespace App\Services\Produk;

# DTO
use App\DataTransferObjects\Produk\DetailDataDTO;
use App\DataTransferObjects\Produk\PostDataDTO;
# Models
use App\Models\DataProduk;

class DataService
{
	public function __construct() {
		date_default_timezone_set('Asia/Jakarta');
	}

	public function create(PostDataDTO $postDataDTO): DataProduk
	{
		$dataProduk = new DataProduk;
		$dataProduk->kode_produk = $postDataDTO->kode_produk;
		$dataProduk->kategori_id = $postDataDTO->kategori;
		$dataProduk->nama_produk = $postDataDTO->nama_produk;
		$dataProduk->barcode = $postDataDTO->barcode;

		if ($postDataDTO->file_path) {
			$dataProduk->foto_directory = $postDataDTO->file_path;
		}
		$dataProduk->save();

		return $dataProduk;
	}

	public function update(PostDataDTO $postDataDTO): DataProduk
	{
		$dataProduk = DataProduk::find($postDataDTO->id_data_produk);
		$dataProduk->kategori_id = $postDataDTO->kategori;
		$dataProduk->nama_produk = $postDataDTO->nama_produk;
		$dataProduk->barcode = $postDataDTO->barcode;

		if ($postDataDTO->file_path) {
			$dataProduk->foto_directory = $postDataDTO->file_path;
		}
		$dataProduk->save();

		return $dataProduk;
	}

	public function destroy(DetailDataDTO $detailDataDTO): bool
	{
		$dataproduk = DataProduk::find($detailDataDTO->id_data_produk);
		if ($dataproduk && $dataproduk->delete()) {
			return true;
		}
		return false;
	}
}