<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">Penjualan</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Detail Penjualan</li>
			</ol>
		</nav>
	</div>
</div>
<div class="row">
	<div class="col-xl-12 mx-auto">
		<div class="card border-top border-0 border-4 border-info">
			<div class="card-body">
				<div class="border p-4 rounded">
					<div class="card-title d-flex align-items-center">
						<div><i class="bx bxs-basket me-1 font-22 text-info"></i>
						</div>
						<h5 class="mb-0 text-secondary">Detail Penjualan</h5>
					</div>
					<hr class="mb-4"/>
					<form id="form-invoice">
						<div class="row">
							<div class="col-md-6">
								<div class="row mb-4">
									<label for="input-nomor-invoice" class="col-sm-4 col-form-label fw-bold">Nomor Kwitansi</label>
									<label class="col-sm-8 col-form-label">: {{$penjualan->nomor_kwitansi}}</label>
									<input type="hidden" name="id" value="{{$penjualan->id}}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="row mb-4">
									<label for="input-nomor-invoice" class="col-sm-4 col-form-label fw-bold">Tanggal</label>
									<label class="col-sm-8 col-form-label">: {{Date('d-m-Y',strtotime($penjualan->tanggal))}}</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row mb-4">
									<label for="input-nomor-invoice" class="col-sm-4 col-form-label fw-bold">Nama Kasir</label>
									<label class="col-sm-8 col-form-label">: {{$penjualan->user ? $penjualan->user->username : '(tidak ditemukan)'}}</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row mb-4">
									<label for="input-nomor-invoice" class="col-sm-4 col-form-label fw-bold">Total Penjualan</label>
									<label class="col-sm-8 col-form-label">: Rp. {{number_format($penjualan->total_penjualan_murni,2,',','.')}}</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row mb-4">
									<label for="input-nomor-invoice" class="col-sm-4 col-form-label fw-bold">Nama Pembeli</label>
									<label class="col-sm-8 col-form-label">: {{$penjualan->nama_pembeli}}</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row mb-4">
									<label for="input-nomor-invoice" class="col-sm-4 col-form-label fw-bold">Total Diskon</label>
									<label class="col-sm-8 col-form-label">: Rp. {{number_format($penjualan->total_penjualan_murni-$penjualan->total_penjualan_diskon,2,',','.')}}</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row mb-4">
									<label for="input-nomor-invoice" class="col-sm-4 col-form-label fw-bold">Total Penjualan Akhir</label>
									<label class="col-sm-8 col-form-label">: Rp. {{number_format($penjualan->total_penjualan_diskon,2,',','.')}}</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<label for="input-tanggal-pelunasan" class="form-label">Tanggal Pelunasan</label>
								<input type="date" class="form-control form-control-sm validation" id="input-tanggal-pelunasan" name="tanggal_pelunasan" value="{{$penjualan->tanggal_pelunasan}}" >
							</div>
							@if (!$penjualan->is_lunas)
							<div class="col-6 pt-4">
								<button type="button" class="btn btn-success px-3" id="btn-lunas">
									<i class="fadeIn animated bx bx-check"></i> Lunaskan
								</button>
							</div>
							@endif
						</div>
					</form>

					<hr class="mb-4"/>

					<div class="table-responsive">
						<table id="datatable-penjualan-detail" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Produk</th>
									<th>Nama Produk</th>
									<th>Jumlah</th>
									<th>Harga</th>
									<th>Diskon</th>
									<th>Harga Akhir</th>
									<th>Laba</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($penjualan->penjualan_detail ?? [] as $item)
									<tr>
										<th>{{$loop->index+1}}</th>
										<th>{{$item->pembelian_detail->data_produk->kode_produk}}</th>
										<th>{{$item->pembelian_detail->data_produk->nama_produk}}</th>
										<th>{{$item->jumlah}}</th>
										<th>{{number_format($item->total_harga_jual_murni,2,',','.')}}</th>
										<th>{{number_format($item->total_harga_jual_murni-$item->total_harga_jual_diskon,2,',','.')}}</th>
										<th>{{number_format($item->total_harga_jual_diskon,2,',','.')}}</th>
										<th>{{number_format($item->total_harga_jual_diskon-($item->pembelian_detail->harga_beli*$item->jumlah),2,',','.')}}</th>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>

					<div class="row">
						<div class="col-4">
							<button type="button" class="btn btn-secondary px-3" id="btn-back-detail-penjualan">
								<i class="fadeIn animated bx bx-left-arrow"></i> Kembali
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(async () => {
		datatableKartuStokDetail()
	})

	$("#btn-back-detail-penjualan").click((e) => {
		$("#other-page").hide('slow', function () {
			$("#main-page").fadeIn()
			$("#other-page").empty()
		})
	})

	$("#btn-lunas").click(async function(e) {
		e.preventDefault()

		const validation = module.validator.form($("#form-invoice .validation"))
		if (validation) {
			return module.swal.warning({text: validation})
		}

		const data = new FormData($("#form-invoice")[0])

		const response = await postRequest("{{route('laporan.hutang.accept')}}", data)

		if (response.status !== 200) {
			return module.swal.warning({text: response.data.message})
		}

		module.swal.success({text: response.data.message})

		$("#other-page").hide('slow', function () {
			$("#main-page").fadeIn()
			$("#other-page").empty()
		})
	})

	async function datatableKartuStokDetail(){
		await $('#datatable-penjualan-detail').dataTable({
			scrollX: true,
			bPaginate: true,
			bFilter: true,
			bDestroy: true,
			processing: true,
			serverSide: false,
			columnDefs: [{
				orderable: false,
				targets: [1,2,3,4,5]
			}]
		})
	}
</script>
