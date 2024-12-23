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
			<div class="breadcrumb-title pe-3">Laporan Persediaan</div>
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
			<div class="card-header">
				<div class="col-12">
					<button type="button" class="btn btn-primary px-3" id="btn-tambah">
						<i class="fadeIn animated bx bx-plus"></i>Tambah Uang Masuk/Keluar
					</button>
				</div>
			</div>
			<div class="card-body">
				<div class="row mb-4">
					<div class="col-md-6">
						<div class="mb-3">
							<label class="form-label fw-bold">Rentang Tanggal</label>
							<input type="text" class="form-control date-range" id="date_range" onchange="filter()"/>
						</div>
					</div>
					<div class="col-md-3">
						<div class="mb-3">
							<label class="form-label fw-bold">Persediaan (hrg beli)</label>
							<input type="text" class="form-control" id="harga_beli" readonly/>
						</div>
					</div>
					<div class="col-md-3">
						<div class="mb-3">
							<label class="form-label fw-bold">Persediaan (hrg jual)</label>
							<input type="text" class="form-control" id="harga_jual" readonly/>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table id="datatable-min-max" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Nilai Awal</th>
								<th>Masuk</th>
								<th>Keluar</th>
								<th>Nilai Akhir</th>
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

			datatableMinMax()
		})
		
		$(".date-range").flatpickr({
			mode: "range",
			altInput: true,
			altFormat: "d-m-Y",
			dateFormat: "Y-m-d",
			defaultDate: "{{date('Y-m-d')}} to {{date('Y-m-d')}}"
		});

		function filter() {
			datatableMinMax($('#date_range').val())
		}

		$('.single-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		})

		function initButton(){
			$(".btn-edit-pembelian").click(async (e) => {
				let $this = $(e.currentTarget)
				return module.swal.warning({text: 'Masih tahap pengembangan!'})
				$this.attr('disabled', true)

				let response = await postRequest("{{route('pembelian.form')}}", {id_user: $this.data('id')})
				
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

			$(".btn-delete-pembelian").click(async (e) => {
				let $this = $(e.currentTarget)
				return module.swal.warning({text: 'Masih tahap pengembangan!'})
				$this.attr('disabled', true)

				module.swal.confirm().then(async (e) => {
					if (e.value) {
						const response = await postRequest("{{route('pembelian.destroy')}}", {id_user: $this.data('id')})
						code = response.status

						if (code !== 200) {
							await module.swal.warning({
								text: code !== 204 ? response.data.message : 'Data tidak ditemukan, silahkan reload halaman terlebih dahulu!'
							})

							return $this.attr('disabled', false)
						}

						await module.swal.success({
							text: response.data.message,
							hideClass: module.var_swal.fadeOutUp,
						})

						datatablePembelian()
					}
					$this.attr('disabled', false)
				})
			})
		}

		$("#btn-tambah").click(async (e) => {
			const $this = $(e.currentTarget)
			$this.attr('disabled', true)
			let response = await postRequest("{{route('laporan.persediaan.form')}}")

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

		$("#datatable-min-max").on('click', '.btn-detail', async function(e) {
			e.preventDefault()
			let $this = $(e.currentTarget)
			$this.attr('disabled', true)
			let response = await postRequest("{{route('laporan.persediaan.detail')}}", {tanggal: $this.data('tanggal')})
				
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

		async function datatableMinMax(date_range=$('#date_range').val()){
			await $('#datatable-min-max').dataTable({
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
					url:"{{route('laporan.persediaan.datatables')}}",
					type: 'post',
					data: {
						date_range: date_range
					}
				},
				columns: [
					{data: 'DT_RowIndex', name: 'DT_RowIndex'},
					{data: 'tanggal', name: 'tanggal'},
					{data: 'uang_awal', name: 'uang_awal', render: function(data, type, row) {
						return module.formatter.formatRupiah(data, 'Rp. ')
					}},
					{data: 'masuk', name: 'masuk', render: function(data, type, row) {
						return module.formatter.formatRupiah(data, 'Rp. ')
					}},
					{data: 'keluar', name: 'keluar', render: function(data, type, row) {
						return module.formatter.formatRupiah(data, 'Rp. ')
					}},
					{data: 'uang_akhir', name: 'uang_akhir', render: function(data, type, row) {
						return module.formatter.formatRupiah(data, 'Rp. ')
					}},
					{data: 'action', name: 'action'}
				],
				initComplete: function (settings, json) {
					$('#harga_beli').val(module.formatter.formatRupiah(json.persediaan[0].persediaan_beli, 'Rp. '))
					$('#harga_jual').val(module.formatter.formatRupiah(json.persediaan[0].persediaan_jual, 'Rp. '))
				}
			})
		}
	</script>
@endpush