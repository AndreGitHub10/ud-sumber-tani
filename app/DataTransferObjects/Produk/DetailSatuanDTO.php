<?php

namespace App\DataTransferObjects\Produk;

use Illuminate\Http\Request;
use OpenSoutheners\LaravelDto\DataTransferObject;
use OpenSoutheners\LaravelDto\Attributes\WithDefaultValue;
# Models
use App\Models\SatuanProduk;

final class DetailSatuanDTO extends DataTransferObject
{
	public function __construct(
        // public int $res_code,
        // public string $res_message,
		public int|null $id_satuan = null,
        
		#[BindModel(using: 'id')]
		#[WithDefaultValue(SatuanProduk::class)]
		public SatuanProduk|null $satuan = null,
	) {
		// 
	}

	// public static function fromRequest(Request $request): self
	// {
	// 	$satuan = $request->id_satuan ? SatuanProduk::find($request->id_satuan) : null;

	// 	return new self(
	// 		$satuan ? 200 : 204,
	// 		$satuan ? 'Data berhasil dihapus' : 'Data tidak ditemukan',
	// 		$satuan,
	// 		$request->id_satuan ?? null,
	// 	);
	// }
}
