<?php

namespace App\Http\Controllers\Laporan;

use App\DataTransferObjects\Response\ResponseAxiosDTO;
use App\Http\Controllers\Controller;
use App\Models\PembelianDetail;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class PenjualanController extends Controller
{
	public function main() {
		return view('contents.laporan.penjualan.main');
	}

    public function datatables(Request $request) {
		$date_range = $request->date_range != '' ? explode(' to ',$request->date_range) : [];
        if (count($date_range)==1) {
            $date_range[]=$date_range[0];
        }
		$data = Penjualan::with('user','penjualan_detail','penjualan_detail.pembelian_detail')->
			when(count($date_range)==0, function($q) {
				$q->limit(0);
			})->
			when($request->pembayaran!='', function($q) use ($request) {
				$q->where('jenis_pembayaran',$request->pembayaran);
			})->
			when(count($date_range)>1, function($q) use ($date_range) {
				$start = date($date_range[0]);
				$end = date($date_range[1]);
				$q->whereBetween('tanggal', [$start,$end]);
			})->
			get();
        return DataTables::of($data)
			->addIndexColumn()
			->addColumn('nama_kasir', function($item) {
				return $item->user ? "<b>" . $item->user->username . "</b>" : '<span>(tidak ditemukan)<span>';
			})
			->editColumn('tanggal', function($item) {
				return Date('Y-m-d',strtotime($item->tanggal));
			})
			->addColumn('ts', function($item) {
				return Date('Y-m-d H:i:s',strtotime($item->created_at));
			})
			// ->addColumn('total_laba', function($item) {
            //     $laba = 0;
            //     foreach ($item->penjualan_detail as $k => $v) {
            //         if ($v->pembelian_detail) {
            //             $laba -= $v->pembelian_detail->harga_beli;
            //         }
            //         $laba += $v->total_harga_jual_diskon;
            //     }
            //     return $laba;
			// })
			->addColumn('action', function($item) {
				return "
					<div class='text-center'>
						<button type='button' class='btn btn-sm btn-primary px-2 btn-detail' data-id='$item->id'>
							<i class='fadeIn animated bx bx-detail'></i>
						</button>
						<button type='button' class='btn btn-sm btn-secondary px-2 btn-invoice' data-id='$item->id'>
							<i class='fadeIn animated bx bx-receipt'></i>
						</button>
						<button type='button' class='btn btn-sm btn-danger px-2 btn-delete' data-id='$item->id'>
							<i class='fadeIn animated bx bx-trash'></i>
						</button>
					</div>
				";
			})
			->rawColumns(["nama_kasir","action"])
			->toJson();
    }

    public function detail(Request $request) {
        $data = Penjualan::with('user','penjualan_detail','penjualan_detail.pembelian_detail','penjualan_detail.pembelian_detail.data_produk')->find($request->id);

        $laba = 0;

        if ($data) {
            $data->res_code = 200;
            $data->res_message = 'Data Ditemukan';
            foreach ($data->penjualan_detail as $k => $v) {
                if ($v->pembelian_detail) {
                    $laba -= $v->pembelian_detail->harga_beli;
                }
                $laba += $v->total_harga_jual_diskon;
            }
        } else {
            $data->res_code = 400;
            $data->res_message = 'Data Tidak Ditemukan';
        }

		$array = [
			'penjualan' => $data,
			'laba' => $laba
		];

		$content = view('contents.laporan.penjualan.detail', $array)->render();

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
			'response' => $content,
		]), $data->res_code);
    }

	public function destroy(Request $request)
	{
		DB::beginTransaction();
		try {
			$penjualan = Penjualan::find($request->id);
			if ($penjualan) {
				$detailPenjualan = PenjualanDetail::where('penjualan_id',$penjualan->id)->get();
				foreach ($detailPenjualan as $k => $v) {
					$detailPembelian = PembelianDetail::find($v->detail_pembelian_id);
					if ($detailPembelian) {
						$detailPembelian->stok_real += $v->jumlah;
						$detailPembelian->save();
					}
					PenjualanDetail::destroy($v->id);
				}
			}
			$penjualan->delete();

			DB::commit();

			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 200,
				'message' => 'Data berhasil Dihapus',
				'response' => $penjualan->id
			]), 200);
		} catch (\Throwable $e) {
			DB::rollback();
			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 500,
				'message' => $e->getMessage(),
			]), 500);
		}
	}
}
