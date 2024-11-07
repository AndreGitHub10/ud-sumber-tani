@extends('main')

@push('styles')
	{{-- <link href="{{asset('assets/plugins/highcharts/css/highcharts.css')}}" rel="stylesheet" /> --}}
	<link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
	
	<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
@endpush

@section('content')
	<div id="main-page">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Data Master</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Supplier</li>
					</ol>
				</nav>
			</div>
		</div>
		<!--end breadcrumb-->

		<div class="card">
			<div class="card-header">
				<div class="col-12">
					<button type="button" class="btn btn-primary px-3" id="add-new-supplier">
						<i class="fadeIn animated bx bx-plus"></i>Tambah Supplier Baru
					</button>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="datatable-supplier" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode</th>
								<th>Nama</th>
								<th>Alamat</th>
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

			datatableSupplier()

		})

		function initButton(){
			$(".btn-edit-supplier").click(async (e) => {
				let $this = $(e.currentTarget)
				$this.attr('disabled', true)

				let response = await postRequest("{{route('dataMaster.supplier.form')}}", {supplier: $this.data('id')})

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

			$(".btn-delete-supplier").click(async (e) => {
				let $this = $(e.currentTarget)
				$this.attr('disabled', true)

				module.swal.confirm().then(async (e) => {
					if(e.value === true){
						const response = await postRequest("{{route('dataMaster.supplier.destroy')}}", {id_supplier: $this.data('id')})
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

						datatableSupplier()
					}
					$this.attr('disabled', false)
				})
			})
		}

		$("#add-new-supplier").click(async (e) => {
			const $this = $(e.currentTarget)
			$this.attr('disabled', true)
			let response = await postRequest("{{route('dataMaster.supplier.form')}}")

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

		async function datatableSupplier(){
			await $('#datatable-supplier').dataTable({
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
					url:"{{route('dataMaster.supplier.datatables')}}",
					type: 'post',
				},
				columns: [
					{data: 'DT_RowIndex', name: 'DT_RowIndex'},
					{data: 'kode', name: 'kode'},
					{data: 'nama', name: 'nama'},
					{data: 'alamat', name: 'alamat'},
					{data: 'action', name: 'action'}
				],
				initComplete: function (settings, json) {
					initButton()
				}
			})
		}
	</script>
@endpush