<?php

namespace App\Imports;

use App\Models\DataProduk;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToModel;

class DataProdukImport implements ToArray
{
	/**
	* @param array $row
	*
	* @return \Illuminate\Database\Eloquent\Model|null
	*/
	public function array(array $array)
    {
        return $array;
    }
}
