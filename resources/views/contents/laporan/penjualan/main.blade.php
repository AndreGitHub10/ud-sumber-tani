@extends('main')

@push('styles')
	{{-- <link href="{{asset('assets/plugins/highcharts/css/highcharts.css')}}" rel="stylesheet" /> --}}
	<link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
	
	<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/flatpickr/dist/flatpickr.min.css')}}" rel="stylesheet" />
	<style>
		.show-alert{
			border: 1px solid red !important;
			border-radius: 5px;
		}
	</style>
@endpush

@section('content')
	<div id="main-page">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Laporan Penjualan</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
					</ol>
				</nav>
			</div>
		</div>
		<!--end breadcrumb-->

		<div class="card">
			{{-- <div class="card-header">
				<div class="col-12">
					<button type="button" class="btn btn-primary px-3" id="set-min-max">
						<i class="fadeIn animated bx bx-plus"></i>Set Min-Max Produk
					</button>
				</div>
			</div> --}}
			<div class="card-body">
				<div class="row mb-4">
					<div class="col-md-6">
						<div class="mb-3">
							<label class="form-label fw-bold">Rentang Tanggal</label>
							<input type="text" class="form-control date-range" id="date_range" onchange="filter()"/>
						</div>
					</div>
					<div class="col-md-3">
						<label for="pembayaran" class="form-label fw-bold">Pembayaran</label>
						<select class="single-select validation" id="pembayaran" onchange="filter()">
							<option value="" selected>Semua</option>
							<option value="tunai" >Tunai</option>
							<option value="non-tunai" >Non-tunai</option>
						</select>
					</div>
				</div>
				<div class="table-responsive">
					<table id="datatable-penjualan" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Nomer Kwitansi</th>
								<th>Nama Kasir</th>
								<th>Total Harga</th>
								<th>Jenis Pembayaran</th>
								<th>TS</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div id="other-page" style="display:none;"></div>
@endsection

@push('scripts')
	<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>

	<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

	<script>
		$(async () => {
			// initModul() in "scripts.main.blade.php"
			module = await initModul()
			console.log(module)

			datatablePenjualan($('#date_range').val(),$('#pembayaran').val())
		})

		$(".date-range").flatpickr({
			mode: "range",
			altInput: true,
			altFormat: "d-m-Y",
			dateFormat: "Y-m-d",
			defaultDate: "{{date('Y-m-d')}} to {{date('Y-m-d')}}"
		});

		$('.single-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		})

		function filter() {
			datatablePenjualan($('#date_range').val(),$('#pembayaran').val())
		}

		function initButton(){
			$(".btn-detail").click(async (e) => {
				let $this = $(e.currentTarget)
				// return module.swal.warning({text: 'Masih tahap pengembangan!'})
				$this.attr('disabled', true)

				let response = await postRequest("{{route('laporan.penjualan.detail')}}", {id: $this.data('id')})
				
				if (response.status !== 200) {
					await module.swal.warning({
						text: response.data.message,
						hideClass: module.var_animasi.fadeOutUp,
					})

					return $this.attr('disabled', false)
				}

				$("#main-page").hide('slow', function () {
					$this.attr('disabled', false)
					$("#other-page").html($(response.data.response)).hide().fadeIn(400)
				})
			})
			$(".btn-invoice").click(async (e) => {
				let $this = $(e.currentTarget)
				// return module.swal.warning({text: 'Masih tahap pengembangan!'})
				$this.attr('disabled', true)

				window.open("{{route('penjualanKasir.invoice')}}/"+$this.data('id'))

				$this.attr('disabled', false)
			})

			$(".btn-delete").click(async (e) => {
				let $this = $(e.currentTarget)
				// return module.swal.warning({text: 'Masih tahap pengembangan!'})
				$this.attr('disabled', true)

				module.swal.confirm().then(async (e) => {
					if (e.value) {
						const response = await postRequest("{{route('laporan.penjualan.destroy')}}", {id: $this.data('id')})
						code = response.data.code

						if (code != 200) {
							await module.swal.warning({
								text: code !== 204 ? response.data.message : 'Data tidak ditemukan, silahkan reload halaman terlebih dahulu!'
							})

							return $this.attr('disabled', false)
						}

						await module.swal.success({
							text: response.data.message,
							hideClass: module.var_swal.fadeOutUp,
						})

						filter()
					}
					$this.attr('disabled', false)
				})
			})
		}

		$("#set-min-max").click(async (e) => {
			const $this = $(e.currentTarget)
			$this.attr('disabled', true)
			let response = await postRequest("{{route('pembelian.form')}}")

			if (response.status !== 200) {
				await module.swal.warning({
					text: response.data.message,
					hideClass: module.var_swal.fadeOutUp,
				})

				return $this.attr('disabled', false)
			}

			$("#main-page").hide('slow', function () {
				$this.attr('disabled', false)
				$("#other-page").html($(response.data.response)).hide().fadeIn(400)
			})
		})

		async function datatablePenjualan(date_range=$('#date_range').val(),pembayaran=$('#pembayaran').val()){
			await $('#datatable-penjualan').dataTable({
				scrollX: true,
				bPaginate: true,
				bFilter: true,
				bDestroy: true,
				processing: true,
				serverSide: true,
				columnDefs: [{
					orderable: false,
					targets: 0
				}],
				ajax: {
					url:"{{route('laporan.penjualan.datatables')}}",
					type: 'post',
					data: {
						date_range:date_range,
						pembayaran:pembayaran
					}
				},
				columns: [
					{data: 'DT_RowIndex', name: 'DT_RowIndex'},
					{data: 'tanggal', name: 'tanggal'},
					{data: 'nomor_kwitansi', name: 'nomor_kwitansi'},
					{data: 'nama_kasir', name: 'nama_kasir'},
					{data: 'total_penjualan_diskon', name: 'total_penjualan_diskon', render: function(data, type, row) {
						return module.formatter.formatRupiah(data, 'Rp. ')
					}},
					{data: 'jenis_pembayaran', name: 'jenis_pembayaran'},
					{data: 'ts', name: 'ts'},
					{data: 'action', name: 'action'}
				],
				drawCallback: function (settings, json) {
					initButton()
				}
			})
		}
	</script>
@endpush