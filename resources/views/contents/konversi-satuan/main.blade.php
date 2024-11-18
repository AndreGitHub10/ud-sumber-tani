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
			<div class="col-xl-12 mx-auto">
				<div class="card">
					<div class="card-header bg-success">
						<h5 class="mb-0 text-light">Form Konversi</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<label for="data-produk" class="form-label">Cari <span class="fw-bolder">(Kode / Nama)</span> Produk</label>
								{{-- <select class="form-control" id="data-produk" name="kode_produk" data-placeholder="Masukkan Kode/Nama Produk">
									<option selected disabled value=""></option>
								</select> --}}
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
		.change(function(e) {
		})
		
	</script>
@endpush