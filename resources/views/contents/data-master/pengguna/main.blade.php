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
						<li class="breadcrumb-item active" aria-current="page">Pengguna</li>
					</ol>
				</nav>
			</div>
		</div>
		<!--end breadcrumb-->

		<div class="card">
			<div class="card-header">
				<div class="col-12">
					<button type="button" class="btn btn-primary px-3" id="add-new-user">
						<i class="fadeIn animated bx bx-plus"></i>Tambah User Baru
					</button>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="datatable-pengguna" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Level</th>
								<th>Username</th>
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
			datatablePengguna()

		})
		function initButton(){
			$(".btn-edit-user").click(async (e) => {
				let $this = $(e.currentTarget)
				$this.attr('disabled', true)

				let response = await postRequest("{{route('dataMaster.pengguna.form')}}", {user: $this.data('id')})
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

			$(".btn-delete-user").click(async (e) => {
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
						const response = await postRequest("{{route('dataMaster.pengguna.destroy')}}", {id: $this.data('id')})
						
						if (response.status !== 200) {
							await Swal.fire({
								icon: 'warning',
								title: 'Whoops..',
								text: response.data.message,
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

						datatablePengguna()
					}
					$this.attr('disabled', false)
				})
			})
		}

		$("#add-new-user").click(async (e) => {
			const $this = $(e.currentTarget)
			$this.attr('disabled', true)
			let response = await postRequest("{{route('dataMaster.pengguna.form')}}")
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

		async function datatablePengguna(){
			await $('#datatable-pengguna').dataTable({
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
					url:"{{route('dataMaster.pengguna.datatables')}}",
					type: 'post',
				},
				columns: [
					{data: 'DT_RowIndex', name: 'DT_RowIndex'},
					{data: 'name', name: 'name'},
					{data: 'level', name: 'level'},
					{data: 'username', name: 'username'},
					{data: 'action', name: 'action'}
				],
				initComplete: function (settings, json) {
					initButton()
				}
			})
		}
	</script>
@endpush