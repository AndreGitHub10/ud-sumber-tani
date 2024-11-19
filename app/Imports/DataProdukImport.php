<?php

namespace App\Imports;

use App\Models\DataProduk;
use Maatwebsite\Excel\Concerns\ToModel;

class DataProdukImport implements ToModel
{
	/**
	* @param array $row
	*
	* @return \Illuminate\Database\Eloquent\Model|null
	*/
	public function model(array $row)
	{
		return new DataProduk([
			//
		]);
	}
}
