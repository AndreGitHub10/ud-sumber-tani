<?php
namespace App\Helpers;

use DB;
# Models
use App\Models\Supplier;

class Generate{
	public function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
	}

	public static function kodeSupplier($request)
	{
		$timestamps = strtotime('now');
		$prefix = date('ym').'SPL';
		$length = strlen($prefix);
		$digitQuery = $length + 1;
		$digit = 3;
		$num = 1;

		try {
			$getKode = Supplier::whereYear('tanggal', date('Y', $timestamps))
				->whereMonth('tanggal', date('m', $timestamps))
				->lockForUpdate()
				->orderBy(DB::raw("CONVERT(SUBSTRING(kode, $digitQuery), SIGNED INTEGER)"), 'DESC')
				->first();
			if ($getKode) {
				$nextKode = $getKode->kode;
				$digit = strlen($nextKode) - $length;
				$num = ((int) substr($nextKode, -$digit)) + 1;
			}
	
			$angkaKode = sprintf("%0$digit"."d", $num);
			$nextKode = "$prefix$angkaKode";
		
			return $request->merge([
				'res_kode_supplier' => $nextKode
			]);
		} catch (\Throwable $e) {
			return false;
		}
	}
}