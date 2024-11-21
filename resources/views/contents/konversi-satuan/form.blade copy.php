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

		<div class="row">
			<div class="col-12">
				<div class="alert alert-primary p-2" role="alert" style="border-radius:5px;">
					<!-- <div class="fas fa-exclamation-circle"></div> -->
					<div class="row">
						<div class="col-xs-12" style="display: flex; align-items: center;">
							{{-- <i class="fas fa-exclamation-circle ml-2" style="margin:auto; font-size: 23px;"></i> --}}
							<i class="fadeIn animated bx bx-error-alt" style="font-size: 23px;"></i>
							<span style="font-size: 16px;">Pastikan data sudah terisi dengan benar sebelum disimpan.</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-12 mx-auto">
				<div class="card">
					<div class="card-header bg-secondary">
						<h5 class="mb-0 text-light">Form Konversi Satuan</h5>
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

			<div class="col-xl-1" style="display: flex; justify-content: center; align-items: center; font-size: 3rem;">
				<span class="mb-0 text-secondary"><i class="fw-bolder fadeIn animated bx bx-transfer-alt"></i></span>
			</div>

			<div class="col-xl-6 mx-auto">
				{{-- <h1 class="mb-0 text-secondary"><i class="fw-bolder fadeIn animated bx bx-transfer-alt"></i></h1> --}}
				<div class="card" style="height: 100%;">
					<div class="card-header bg-success">
						<h5 class="mb-0 text-light">Konversi</h5>
					</div>
					<div class="card-body konversi-tujuan">
						<div class="row">
							<div class="col-12 mb-2">
								<label for="satuan-tujuan" class="form-label">Satuan Konversi</label>
								<select class="form-control" id="satuan-tujuan" name="satuan_tujuan" disabled></select>
							</div>

							<div class="col-12 mb-2">
								<label for="harga-jual-tujuan" class="form-label">Harga Jual (per-besaran-satuan)</label>
								<input type="text" class="form-control form-control-sm" id="harga-jual-tujuan" name="harga_jual_tujuan" readonly>
							</div>

							<div class="col-5 mb-2">
								<label
									for="stok-tujuan"
									class="form-label"
									data-bs-toggle="tooltip"
									data-bs-placement="top"
									title="Inputkan besaran satuan konversi</b>"
								>
									{{-- Besaran Satuan <span class="input-group-text" id="container-satuan"></span> --}}
									Besaran Satuan
									{{-- <span id="container-satuan"></span> --}}
								</label>
								{{-- <div class="input-group"> --}}
									<input type="text" class="form-control form-control-sm text-center" id="stok-tujuan" readonly>
									{{-- <span class="input-group-text" id="container-satuan">-</span> --}}
								{{-- </div> --}}
							</div>
							<div class="col-2 mb-2" style="display: grid; justify-content: center; align-items: end;">
								<h4 class="m-0">x</h4>
							</div>
							<div class="col-5 mb-2">
								<label
									for="total-stok-asal-konversi"
									class="form-label"
									data-bs-toggle="tooltip"
									data-bs-placement="top"
									data-bs-original-title="Inputkan <b>jumlah stok master</b> yang akan dikonversi.<br>stok master akan otomatis <b>berkurang</b> ketika konversi disimpan!"
								>
									Stok Master
								</label>
								<input type="text" class="form-control form-control-sm text-center" id="total-stok-asal-konversi" name="total_stok_asal_konversi" readonly>
							</div>
							{{-- <div class="col-1 mb-2" style="display: grid; justify-content: center; align-items: end;">
								<h4 class="m-0">=</h4>
							</div> --}}
							<div class="col-12 mb-2">
								<label for="total-stok-tujuan" class="form-label">
									Total Stok Konversi
								</label>
								<input type="text" class="form-control form-control-sm text-center" id="total-stok-tujuan" readonly>
							</div>
							{{-- <div class="col-12 mb-2">
								<label for="harga-jual-per-item" class="form-label">
									Harga Jual per 1 <span id="container-harga-jual-per-item"></span>
								</label>
								<input type="text" class="form-control form-control-sm text-center" id="harga-jual-per-item" readonly>
							</div> --}}
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

			$('[data-bs-toggle="tooltip"]').tooltip({
				html: true
			})
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
								satuan_name: item.satuan.nama,
								harga_jual: item.harga_jual,
								stok_real: item.stok_real,
							}
						})
					}
				},
				cache: true,
			},
			// render html for the selected option
			templateSelection: function (container) {
				$(container.element).attr('data-satuan_id', container.satuan_id)
				$(container.element).attr('data-satuan_name', container.satuan_name)
				$(container.element).attr('data-harga_jual', container.harga_jual)
				$(container.element).attr('data-stok_real', container.stok_real)

				return `<span class="fw-bolder">${container.text}</span>`
			},
			// render html as-is without escaping it
			escapeMarkup: function(markup) { return markup }
		})

		$("#data-produk").change(async function(e) {
			if ($(this).val()) {
				const $this = $(this).find(':selected')
				let satuanId = $this.data('satuan_id')
				let satuanText = $this.data('satuan_name')
				let hargaJual = $this.data('harga_jual')
				let stokReal = $this.data('stok_real')

				$("#satuan-asal").val(satuanText.toUpperCase())
				$("#harga-jual-asal").val(module.formatter.formatRupiah(hargaJual, "Rp. "))
				$("#jumlah-asal").val(stokReal)
				$("#jumlah-asal").data('jumlah', stokReal)

				const response = await postRequest("{{route('dataMaster.produk.satuan.konversi')}}", {
					satuan_id: satuanId
				})

				const data = JSON.parse(response.data.response)

				var newOption = new Option('--PILIH OPSI--', '', false, true)
				$("#satuan-tujuan").empty().append(newOption).trigger('change')
				$.each(data, function(index, item) {
					newOption = new Option(item.nama.toUpperCase(), item.id, false, false)
					$("#satuan-tujuan").append(newOption).trigger('change')
				})

				$("#satuan-tujuan").attr('disabled', false)
				$("#harga-jual-tujuan").attr('readonly', false)
				$("#total-stok-asal-konversi").attr('readonly', false)
				$("#stok-tujuan").attr('readonly', false)

				// const response = await postRequest("{{route('konversiSatuan.getKonversi')}}")
				// console.log(response)
				// if (response.status === 204) {
				// 	// $(this).val('').trigger('change')
				// 	return module.swal.warning({text: 'Master konversi belum ada, silahkan buat terlebih dahulu'})
				// }
			}
		})

		$("#satuan-tujuan").change(function() {
			let satuanText = $("#select2-satuan-tujuan-container").text()
			if (!$(this).val()) satuanText = '-';
			$("#container-satuan").text(`per ${satuanText.toLowerCase()}`)
		})

		$("#harga-jual-tujuan").setRules('0-9').on('keyup', function() {
			$(this).val(module.formatter.formatRupiah($(this).val(), 'Rp. '))
		})

		$("#total-stok-asal-konversi, #stok-tujuan").setRules('0-9').on("keyup change", function() {
			let jumlahMasterData = parseInt($("#jumlah-asal").data('jumlah'))
			let jumlahMaster = jumlahMasterData
			let stokMaster = parseInt($("#total-stok-asal-konversi").val())
			let stokKonversi = parseInt($("#stok-tujuan").val())

			if (!stokMaster) stokMaster = 0;
			if (!stokKonversi) stokKonversi = 0;

			if (stokMaster > jumlahMaster) {
				stokMaster = jumlahMasterData
				$(this).val(jumlahMasterData)
			}

			jumlahMaster = jumlahMaster - stokMaster
			$("#jumlah-asal").val(jumlahMaster)

			let totalStok = stokMaster * stokKonversi
			$("#total-stok-tujuan").val(totalStok=== 0 ? '' : totalStok)
		})
	</script>
@endpush