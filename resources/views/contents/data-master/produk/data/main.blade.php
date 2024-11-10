@extends('main')

@push('styles')
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
						<li class="breadcrumb-item active" aria-current="page">Produk</li>
						<li class="breadcrumb-item active" aria-current="page">Data</li>
					</ol>
				</nav>
			</div>
		</div>
		<!--end breadcrumb-->

		<div class="card">
			<div class="card-header">
				<div class="col-12">
					<button type="button" class="btn btn-primary px-3" id="add-new-data">
						<i class="fadeIn animated bx bx-plus"></i>Tambah Data Baru
					</button>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="datatable-data" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode</th>
								<th>Nama</th>
								<th>Kategori</th>
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

			datatableDataProduk()

		})

		function initButton(){
			$(".btn-edit-data-produk").click(async (e) => {
				let $this = $(e.currentTarget)
                const id = $this.data('id')
				$this.attr('disabled', true)

				let response = await postRequest("{{route('dataMaster.produk.data.form')}}", {id_data_produk: id, data_produk: id})

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

			$(".btn-delete-data-produk").click(async (e) => {
				let $this = $(e.currentTarget)
				const id = $this.data('id')
				$this.attr('disabled', true)

				module.swal.confirm().then(async (e) => {
					if(e.value === true){
						const response = await postRequest("{{route('dataMaster.produk.data.destroy')}}", {id_data_produk: id, data_produk: id, is_destroy: true})
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

						datatableDataProduk()
					}
					$this.attr('disabled', false)
				})
			})
		}

		$("#add-new-data").click(async (e) => {
			const $this = $(e.currentTarget)
			$this.attr('disabled', true)
			let response = await postRequest("{{route('dataMaster.produk.data.form')}}")

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

		async function datatableDataProduk(){
			await $('#datatable-data').dataTable({
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
					url:"{{route('dataMaster.produk.data.datatables')}}",
					type: 'post',
				},
				columns: [
					{data: 'DT_RowIndex', name: 'DT_RowIndex'},
					{data: 'kode_produk', name: 'kode_produk'},
					{data: 'nama_produk', name: 'nama_produk'},
					{data: 'kategori.nama', name: 'kategori.nama'},
					{data: 'action', name: 'action'}
				],
				initComplete: function (settings, json) {
					initButton()
				}
			})
		}
	</script>
@endpush