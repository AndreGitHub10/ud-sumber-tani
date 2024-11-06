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
						<li class="breadcrumb-item active" aria-current="page">Produk</li>
						<li class="breadcrumb-item active" aria-current="page">Satuan</li>
					</ol>
				</nav>
			</div>
		</div>
		<!--end breadcrumb-->

		<div class="card">
			<div class="card-header">
				<div class="col-12">
					<button type="button" class="btn btn-primary px-3" id="add-new-satuan">
						<i class="fadeIn animated bx bx-plus"></i>Tambah Satuan Baru
					</button>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="datatable-satuan" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
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
		$(document).ready(function() {
			datatableSatuan()

		})
		function initButton(){
			$(".btn-edit-satuan").click(async (e) => {
				let $this = $(e.currentTarget)
				$this.attr('disabled', true)

				let response = await postRequest("{{route('dataMaster.produk.satuan.form')}}", {satuan: $this.data('id')})
				if (response.status !== 200) {
					$this.attr('disabled', false)
					Swal.fire({
						icon: 'warning',
						title: 'Whoops..',
						text: response.data.message,
						allowOutsideClick: false,
						allowEscapeKey: false,
						hideClass: fadeOutUp,
					})
					return
				}

				$("#main-page").hide('slow', function () {
					$this.attr('disabled', false)
					$("#other-page").html($(response.data.response)).hide().fadeIn(400)
				})
			})

			$(".btn-delete-satuan").click(async (e) => {
				let $this = $(e.currentTarget)
				$this.attr('disabled', true)
				Swal.fire({
					title: 'Apakah anda yakin?',
					text: 'Data yang sudah dihapus tidak dapat dikembalikan!',
					icon: 'warning',
					showClass: fadeInDown,
					showCancelButton: true,
					confirmButtonColor: '#F64E60',
					// cancelButtonColor: '#F3F6F9',
					confirmButtonText: 'Ya, hapus',
					cancelButtonText: 'Batal',
					allowOutsideClick: false,
					allowEscapeKey: false
				}).then(async (res) => {
					if(res.value === true){
						const response = await postRequest("{{route('dataMaster.produk.satuan.destroy')}}", {id_satuan: $this.data('id')})
						code = response.status

						if (code !== 200) {
							await Swal.fire({
								icon: 'warning',
								title: 'Whoops..',
								text: code !== 204 ? response.data.message : 'Data tidak ditemukan, silahkan reload halaman terlebih dahulu!',
								allowOutsideClick: false,
								allowEscapeKey: false,
								hideClass: fadeOutUp,
							})
							$this.attr('disabled', false)
							return
						}

						await Swal.fire({
							icon: 'success',
							title: response.data.message,
							showConfirmButton: false,
							timer: 900,
							hideClass: fadeOutUp,
						})

						datatableSatuan()
					}
					$this.attr('disabled', false)
				})
			})
		}

		$("#add-new-satuan").click(async (e) => {
			const $this = $(e.currentTarget)
			$this.attr('disabled', true)
			let response = await postRequest("{{route('dataMaster.produk.satuan.form')}}")
			if (response.status !== 200) {
				$this.attr('disabled', false)
				Swal.fire({
					icon: 'warning',
					title: 'Whoops..',
					text: response.data.message,
					allowOutsideClick: false,
					allowEscapeKey: false,
					hideClass: fadeOutUp,
				})
				return
			}

			$("#main-page").hide('slow', function () {
				$this.attr('disabled', false)
				$("#other-page").html($(response.data.response)).hide().fadeIn(400)
			})
		})

		async function datatableSatuan(){
			await $('#datatable-satuan').dataTable({
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
					url:"{{route('dataMaster.produk.satuan.datatables')}}",
					type: 'post',
				},
				columns: [
					{data: 'DT_RowIndex', name: 'DT_RowIndex'},
					{data: 'nama', name: 'nama'},
					{data: 'action', name: 'action'}
				],
				initComplete: function (settings, json) {
					initButton()
				}
			})
		}
	</script>
@endpush