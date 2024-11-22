@extends('main')

@push('styles')
	{{-- <link href="{{asset('assets/plugins/highcharts/css/highcharts.css')}}" rel="stylesheet" /> --}}
	<link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
	
	<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
	<style>
		.show-alert{
			border: 1px solid red !important;
			border-radius: 5px;
		}
		.tool-tip {
			display: inline-block;
		}
		.tool-tip [disabled] {
			pointer-events: none;
		}
	</style>
@endpush

@section('content')
	<div id="main-page">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Pembelian</div>
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
					<button type="button" class="btn btn-primary px-3" id="add-new-pembelian">
						<i class="fadeIn animated bx bx-plus"></i>Tambah Pembelian
					</button>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="datatable-pembelian" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Nomor Invoice</th>
								<th>Total Harga</th>
								<th>Tanggal</th>
								<th>Nama Supplier</th>
								<th>Action</th>
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

	<script>
		$(async () => {
			// initModul() in "scripts.main.blade.php"
			module = await initModul()
			console.log(module)

			datatablePembelian()
		})

		$("#datatable-pembelian").on('click', '.btn-edit-pembelian', async function(e) {
			e.preventDefault()
			let $this = $(e.currentTarget)
			$this.attr('disabled', true)

			let response = await postRequest("{{route('pembelian.form')}}", {id_pembelian: $this.data('id'), model_pembelian: $this.data('id')})
			
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
		
		$("#datatable-pembelian").on('click', '.btn-delete-pembelian', async function(e) {
			e.preventDefault()
			return module.swal.warning({text: 'Masih tahap pengembangan!'})
			$(this).attr('disabled', true)

			module.swal.confirm().then(async (e) => {
				if (e.value) {
					const response = await postRequest("{{route('pembelian.destroy')}}", {id_user: $(this).data('id')})
					code = response.status

					if (code !== 200) {
						await module.swal.warning({
							text: code !== 204 ? response.data.message : 'Data tidak ditemukan, silahkan reload halaman terlebih dahulu!'
						})

						return $(this).attr('disabled', false)
					}

					await module.swal.success({
						text: response.data.message,
						hideClass: module.var_swal.fadeOutUp,
					})

					datatablePembelian()
				}
				$(this).attr('disabled', false)
			})
		})

		$("#add-new-pembelian").click(async (e) => {
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

		async function datatablePembelian(){
			await $('#datatable-pembelian').dataTable({
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
					url:"{{route('pembelian.datatables')}}",
					type: 'post',
				},
				columns: [
					{data: 'DT_RowIndex', name: 'DT_RowIndex'},
					{data: 'nomor_invoice', name: 'nomor_invoice'},
					{data: 'total_harga', name: 'total_harga', render: function(data, type, row) {
						return module.formatter.formatRupiah(data, 'Rp. ')
					}},
					{data: 'tanggal', name: 'tanggal'},
					{data: 'supplier.nama', name: 'supplier.nama'},
					{data: 'action', name: 'action'}
				],
				// initComplete: function (settings, json) {
				// 	initButton()
				// }
			})
		}
	</script>
@endpush