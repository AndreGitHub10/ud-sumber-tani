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

		<div id="main-form-konversi-satuan">
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
										<select class="form-control reset" id="data-produk" name="kode_produk"></select>
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
									<div class="select2-middle">
										<select class="form-control select2 reset" id="satuan-asal" name="satuan_asal" disabled>
											<option value="" selected>PILIH PRODUK DULU</option>
										</select>
									</div>
								</div>
								<div class="col-12 mb-2">
									<label for="harga-jual-asal" class="form-label">Harga Jual Master</label>
									<input type="text" class="form-control form-control-sm reset" id="harga-jual-asal" readonly>
								</div>
								<div class="col-12 mb-2">
									<label for="jumlah-asal" class="form-label">Jumlah Stok Master</label>
									<div class="input-group">
										<input type="text" class="form-control form-control-sm reset" id="jumlah-asal" readonly>
										{{-- <input type="text" class="form-control form-control-sm text-center" id="stok-tujuan" readonly> --}}
										<span class="input-group-text" id="container-satuan"></span>
									</div>
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
							<form id="form-konversi-satuan" class="form-konversi-satuan">
								<div class="row">
									<div class="col-12 mb-2">
										<label for="input-harga-jual" class="form-label">Harga Jual</label>
										<div class="input-group">
											<input type="text" class="form-control form-control-sm validation remove-alert reset" id="input-harga-jual" name="harga_jual_tujuan" readonly>
											<span class="input-group-text" id="container-satuan-harga-jual-tujuan"></span>
										</div>
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
										<input type="text" class="form-control form-control-sm text-center validation remove-alert reset" id="total-stok-asal-konversi" name="total_stok_asal_konversi" readonly>
									</div>
									<div class="col-2 mb-2" style="display: grid; justify-content: center; align-items: end;">
										<h4 class="m-0">x</h4>
									</div>
									<div class="col-5 mb-2">
										<label
											for="stok-tujuan"
											id="label-stok-tujuan"
											class="form-label"
											data-bs-toggle="tooltip"
											data-bs-placement="top"
											title="Ttt"
										>
											Nilai Konversi
										</label>
										<input type="text" class="form-control form-control-sm text-center validation remove-alert reset" id="stok-tujuan" name="stok_tujuan" readonly>
									</div>
									<div class="col-12 mb-4">
										<label for="total-stok-tujuan" class="form-label">
											Total Stok Konversi
										</label>
										<input type="text" class="form-control form-control-sm text-center reset" id="total-stok-tujuan" name="total_stok_tujuan">
									</div>
									<div class="col-12">
										<button class="btn btn-success" id="btn-simpan-konversi-satuan" style="width: 100%;">Simpan Konversi</button>
									</div>
									{{-- <div class="col-12 mb-2 mt-2">
										<input class="form-check-input mb-2" type="checkbox" value="" id="harga-jual-terkecil-check">
										<label class="form-check-label" for="harga-jual-terkecil-check">Gunakan Harga Jual Terkecil?</label>
										<input type="text" class="form-control form-control-sm" id="harga-jual-terkecil" name="harga_jual_terkecil" readonly>
									</div> --}}
								</div>
							</form>
						</div>
					</div>
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

			// toolTip()
		})

		function toolTip() {
			$('[data-bs-toggle="tooltip"]').tooltip({
				html: true
			})
		}

		$(".select2").select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
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
								invoice_id: item.invoice_id,
								kode_produk: item.kode_produk,
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
				$(container.element).attr('data-invoice_id', container.invoice_id)
				$(container.element).attr('data-kode_produk', container.kode_produk)
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

				const resSatuanAwal = await postRequest("{{route('dataMaster.konversi.getMaster')}}", {
					satuan_id: satuanId
				})

				if (resSatuanAwal.status !== 200) {
					$("#satuan-asal").val('').trigger('change').attr('disabled', true)
					return module.swal.warning({text: 'Master Konversi Satuan belum dibuat!'})
				}

				const dataSatuanAwal = JSON.parse(resSatuanAwal.data.response)

				var newOption = new Option('--PILIH OPSI--', '', false, true)
				$("#satuan-asal").attr('disabled', false).empty().append(newOption).trigger('change')
				$.each(dataSatuanAwal, function(index, item) {
					let satuanAsalText = item.satuan_asal.nama.toUpperCase()
					let satuanTujuanText = item.satuan_tujuan.nama.toUpperCase()
					let konversiMaster = item.nilai_konversi

					$("#satuan-asal").append(`
						<option
							data-id="${item.id}"
							data-satuan-asal-id="${item.satuan_asal.id}"
							data-satuan-asal-text="${satuanAsalText}"
							data-satuan-tujuan-id="${item.satuan_tujuan.id}"
							data-satuan-tujuan-text="${satuanTujuanText}"
							data-nilai-konversi="${konversiMaster}"
							value="${item.satuan_asal.id}"
						>${satuanAsalText} => ${satuanTujuanText} => ${konversiMaster}</option>
					`)
				})

				// $("#satuan-asal").val(satuanText.toUpperCase())
				$("#harga-jual-asal").val(module.formatter.formatRupiah(hargaJual, "Rp. "))
				$("#jumlah-asal").val(stokReal)
				$("#jumlah-asal").data('jumlah', stokReal)
				$("#container-satuan").text(satuanText.toUpperCase())

				// const response = await postRequest("{{route('dataMaster.produk.satuan.konversi')}}", {
				// 	satuan_id: satuanId
				// })

				// const data = JSON.parse(response.data.response)

				// var newOption = new Option('--PILIH OPSI--', '', false, true)
				// $("#satuan-tujuan").empty().append(newOption).trigger('change')
				// $.each(data, function(index, item) {
				// 	newOption = new Option(item.nama.toUpperCase(), item.id, false, false)
				// 	$("#satuan-tujuan").append(newOption).trigger('change')
				// })


				// const response = await postRequest("{{route('konversiSatuan.getKonversi')}}")
				// console.log(response)
				// if (response.status === 204) {
				// 	// $(this).val('').trigger('change')
				// 	return module.swal.warning({text: 'Master konversi belum ada, silahkan buat terlebih dahulu'})
				// }
			}
		})

		$(".remove-alert").on('keyup', function() {
			if ($(this).hasClass('show-alert')) $(this).removeClass('show-alert');
		})

		$("#satuan-asal").change(async function() {
			await module.reset.form($(".konversi-tujuan .reset"))

			let isDisabled = true
			let satuanTujuanText = ''
			let satuanAsalText = ''
			if ($(this).val()) {
				isDisabled = false
				satuanTujuanText = "Per-"+$(this).find(':selected').data('satuan-tujuan-text')
				satuanAsalText = $(this).find(':selected').data('satuan-asal-text')
			}

			await $("#label-stok-tujuan").attr('data-bs-original-title', `Jumlah per 1 ${satuanAsalText}`)
			$("#label-stok-tujuan").tooltip()

			$("#container-satuan-harga-jual-tujuan").text(satuanTujuanText)
			// $("#container-satuan-nilai-konversi").text(satuanTujuanText)
			$("#satuan-tujuan").attr('disabled', isDisabled)
			$("#input-harga-jual").attr('readonly', isDisabled)
			$("#total-stok-asal-konversi").attr('readonly', isDisabled)
			$("#stok-tujuan").attr('readonly', isDisabled)
			// toolTip()

		})

		$("#input-harga-jual").setRules('0-9').on('keyup', function() {
			$(this).val(module.formatter.formatRupiah($(this).val(), 'Rp. '))
		})

		// $("#harga-jual-terkecil-check").change(function() {
		// 	const nilaiKonversi = parseInt($("#stok-tujuan").val())

		// 	if (!$(this).is(':checked') || !nilaiKonversi) return $("#harga-jual-terkecil").val('');

		// 	const hargaJualTujuan = parseInt(module.parse.onlyNumber($("#harga-jual").val()))
		// 	$("#harga-jual-terkecil").val(module.formatter.formatRupiah(parseInt(hargaJualTujuan / nilaiKonversi)))
		// })

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

		$("#btn-simpan-konversi-satuan").click(async function(e) {
			e.preventDefault()

			const validation = module.validator.form($("#form-konversi-satuan .validation"))
			if (validation) {
				return module.swal.warning({text: validation})
			}

			const data = new FormData($("#form-konversi-satuan")[0])
			data.append('detail_pembelian_id', $("#data-produk").find(':selected').val())
			data.append('konversi_id', $("#satuan-asal").find(':selected').data('id'))
			data.append('kode_produk', $("#data-produk").find(':selected').data('kode_produk'))
			data.append('invoice_id', $("#data-produk").find(':selected').data('invoice_id'))
			data.append('satuan_tujuan_id', $("#satuan-asal").find(':selected').data('satuan-tujuan-id'))
			data.set('harga_jual_tujuan', parseInt(module.parse.onlyNumber($("#input-harga-jual").val())))

			const response = await postRequest("{{route('konversiSatuan.store')}}", data)

			if (response.status !== 201) {
				return module.swal.warning({text: response.data.message})
			}

			module.swal.success({text: response.data.message})

			module.reset.form($("#main-form-konversi-satuan .reset"))
			$("#data-produk").empty().append(`Masukkan (<span style="color: #000;">Kode</span>/<span style="color: #00b8dd;">Nama</span>) Produk`).val('').trigger('change')
			$("#container-satuan").text('')
			$("#satuan-asal").val('').trigger('change').attr('disabled', true)
		})
	</script>
@endpush