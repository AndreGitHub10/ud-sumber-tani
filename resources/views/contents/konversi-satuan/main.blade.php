@extends('main')

@push('styles')
	<link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
	
	<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
	<style>
		.show-alert{
			border: 1px solid red !important;
			border-radius: 5px;
		}
		.nowrap {
			white-space: nowrap;
		}
	</style>
@endpush

@section('content')
	<div id="main-page">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Konversi Satuan</div>
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

		<!--end row-->
		<div class="row">
			<div class="col-xl-12 mx-auto">
				<div class="card">
					<div class="card-header bg-secondary">
						<h5 class="mb-0 text-light">Cari Produk</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								{{-- <label for="data-produk" class="form-label">Cari <span class="fw-bolder">(Kode / Nama)</span> Produk</label> --}}
								<div class="select2-middle">
									<select class="form-control" id="data-produk" name="kode_produk"></select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xl-5 mx-auto">
				<div class="card" style="height: 100%;">
					<div class="card-header bg-info" style="display: flex; justify-content: space-between">
						<h5 class="mb-0 text-light">Master</h5>
						{{-- <button class="btn btn-sm btn-primary" type="button" title="Buat master baru" data-bs-toggle="modal" data-bs-target="#master-konversi-modal">Buat Master</button> --}}
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-12 mb-2">
								<label for="satuan-asal" class="form-label">Satuan Master</label>
								<input type="text" class="form-control form-control-sm" id="satuan-asal" readonly>
							</div>
							<div class="col-12 mb-2">
								<label for="harga-jual-asal" class="form-label">Harga Jual Master</label>
								<input type="text" class="form-control form-control-sm" id="harga-jual-asal" readonly>
							</div>
							<div class="col-12 mb-2">
								<label for="jumlah-asal" class="form-label">Jumlah Stok Master</label>
								<input type="text" class="form-control form-control-sm" id="jumlah-asal" readonly>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal -->
			{{-- <div class="modal fade" id="master-konversi-modal" tabindex="-1" aria-labelledby="master-konversi-modal-label" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur.</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Save changes</button>
						</div>
					</div>
				</div>
			</div> --}}

			<div class="col-xl-2" style="display: flex; justify-content: center; align-items: center; font-size: 5rem;">
				<span class="mb-0 text-secondary"><i class="fw-bolder fadeIn animated bx bx-transfer-alt"></i></span>
			</div>

			<div class="col-xl-5 mx-auto">
				{{-- <h1 class="mb-0 text-secondary"><i class="fw-bolder fadeIn animated bx bx-transfer-alt"></i></h1> --}}
				<div class="card" style="height: 100%;">
					<div class="card-header bg-success">
						<h5 class="mb-0 text-light">Konversi</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-12 mb-2">
								<label for="satuan-tujuan" class="form-label">Satuan Konversi</label>
								<select class="form-control" id="satuan-tujuan" name="satuan_tujuan"></select>
							</div>
							<div class="col-12 mb-2">
								<label for="satuan-asal" class="form-label">Harga Jual Konversi</label>
								<input type="text" class="form-control form-control-sm" id="satuan_asal">
							</div>
							<div class="col-6 mb-2">
								<label for="satuan-asal" class="form-label">Stok Master</label>
								<input type="text" class="form-control form-control-sm" id="satuan_asal">
							</div>
							<div class="col-6 mb-2">
								<label for="satuan-asal" class="form-label">Stok Konversi</label>
								<input type="text" class="form-control form-control-sm" id="satuan_asal">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end row-->
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
		})

		$("#satuan-tujuan").select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		})
		$('#data-produk').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: `Masukkan (<span style="color: #000;">Kode</span>/<span style="color: #00b8dd;">Nama</span>) Produk`,
			allowClear: Boolean($(this).data('allow-clear')),
			ajax: {
				url: "{{ route('pembelian.findProduk') }}",
				dataType: 'json',
				type: 'POST',
				delay: 500,
				data: function(params) {
					return {query_string: params.term}
				},
				// render html in the dropdown
				processResults: function(data) {
					return {
						results: $.map(data, function(item) {
							return {
								text: `
									<span class="fw-bolder" style="color: #000;">${item.kode_produk}</span>
									|
									<span class="fw-bolder" style="color: #00b8dd;">${item.data_produk.nama_produk.toUpperCase()}</span> (${item.satuan.nama.toUpperCase()})
									|
									<span class="fw-bolder" style="color: #00b30f;">${item.stok_real}</span>
								`,
								id: item.id,
								satuan_id: item.satuan_id,
							}
						})
					}
				},
				cache: true,
			},
			// render html for the selected option
			templateSelection: function (container) { 
				$(container.element).attr('data-satuan_id',container.satuan_id)
				return `<span class="fw-bolder">${container.text}</span>`
			},
			// render html as-is without escaping it
			escapeMarkup: function(markup) { return markup }
		})
		.change(async function(e) {
			if ($(this).val()) {
				const response = await postRequest("{{route('konversiSatuan.getKonversi')}}")
				console.log(response)
				if (response.status === 204) {
					// $(this).val('').trigger('change')
					return module.swal.warning({text: 'Master konversi belum ada, silahkan buat terlebih dahulu'})
				}
			}
		})
		
	</script>
@endpush