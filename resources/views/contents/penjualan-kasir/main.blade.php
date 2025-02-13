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
		.hide {
			display: none;
		}
	</style>
@endpush

@section('content')
	<div id="main-page">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Penjualan</div>
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
			<div class="col-xl-4">
				<div class="card">
					<div class="card-header bg-info">
						<h5 class="mb-0 text-light">Form Penjualan</h5>
					</div>
					<div class="card-body">
						<form id="form-penjualan">
							<div class="row">
								<div class="col-12">
									<div class="form-check form-switch">
										<input class="form-check-input" type="checkbox" role="switch" id="is-scan" name="is-scan">
										<label class="form-check-label" for="is-scan">Scanner Mode <span id="scanner-mode"></span></label>
									</div>
								</div>
							</div>
							<div class="row mb-4">
								<label for="input-produk" class="form-label">Temukan Produk</label>
								<div class="col-12">
									<select class="single-select validation reset" id="input-produk" name="level">
									</select>
								</div>
							</div>
							<div class="row mb-4">
								<div class="col-12">
									<span class="fw-bolder">Harga Jual : </span> <span class="fw-bolder" id="display-harga-jual"></span>
								</div>
							</div>
							<div class="row mb-4">
								<div class="col-12">
									<label for="input-jumlah" class="form-label">Jumlah Barang</label>
									<input type="number" min="1" class="form-control validation reset" id="input-jumlah" placeholder="Masukkkan Jumlah Barang" name="jumlah">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12 text-center">
									<button class="btn btn-sm btn-info px-5 text-light" id="btn-append-penjualan">Tambahkan ke list penjualan</button>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<img id="preview-gambar" src="" class="img-fluid" alt="...">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-xl-8">
				<div class="card">
					<div class="card-header bg-secondary">
						<h5 class="mb-0 text-light">List Penjualan</h5>
					</div>
					<div class="card-body">
						<form id="form-penjualan-final">

							<div class="row mb-4">
								<div class="col-12">
									<table class="table mb-0 table-striped">
										<thead>
											<tr>
												<th scope="col">No</th>
												<th scope="col">Nama Produk</th>
												<th scope="col">Harga</th>
												<th scope="col" class="text-center">Diskon</th>
												<th scope="col" class="text-center">Jumlah</th>
												<th scope="col" class="nowrap">Total Harga</th>
												<th scope="col" class="text-center">Aksi</th>
											</tr>
										</thead>
										<tbody id="container-list-penjualan"></tbody>
										<tfoot id="">
											<tr>
												<th colspan="5">
													<input type="hidden" name="total_semua_harga_murni" id="total-semua-harga-murni" value="">
													<input type="hidden" name="total_semua_harga_diskon" id="total-semua-harga-diskon" value="">
													Total Semua Harga :
												</th>
												<th colspan="2" id="container-total-semua-harga">Rp. 0</th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
							<div id="bayar-form">
								<div class="row mb-2">
									<div class="col-6">
										<label for="input-tanggal-penjualan" class="form-label">Tanggal Penjualan</label>
										<input type="date" class="form-control validation" id="input-tanggal-penjualan" name="tanggal_penjualan" value="{{date("Y-m-d")}}" readonly>
									</div>
									<div class="col-6">
										<div class="select2-sm">
											<label for="input-jenis-pembayaran" class="form-label">Jenis Pembayaran</label>
											<select class="single-select validation reset" id="input-jenis-pembayaran" name="jenis_pembayaran" disabled>
												<option selected value="">--PILIH OPSI--</option>
												<option value="tunai">TUNAI</option>
												<option value="non-tunai">NON - TUNAI</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row mb-2">
									<div class="col-6">
										<label for="input-jumlah-pembayaran" class="form-label">Jumlah Pembayaran</label>
										<input type="text" class="form-control validation reset" id="input-jumlah-pembayaran" placeholder="Masukkkan Jumlah Pembayaran" name="pembayaran" readonly>
									</div>
									<div class="col-6">
										<label for="input-kembalian" class="form-label">Kembalian</label>
										<input type="text" class="form-control" id="input-kembalian" name="kembalian" value="Rp. 0" readonly>
									</div>
								</div>
								<div class="row mb-5">
									<div class="col-6">
										<div class="select2-sm">
											<label for="is_hutang" class="form-label">Hutang</label>
											<select class="single-select validation reset" id="is_hutang" name="hutang" disabled>
												<option value="lunas">Tidak</option>
												<option value="hutang">Ya</option>
											</select>
										</div>
									</div>
									<div class="col-6 hide" id="container-nama-pembeli">
										<label for="input-nama-pembeli" class="form-label">Nama Pembeli</label>
										<input type="text" class="form-control" id="input-nama-pembeli" name="nama_pembeli">
									</div>
								</div>
							</div>
						</form>
						<div class="row">
							<div class="col-7"></div>
							<div class="col-5 text-end">
								<div id="container-btn-sesi-penjualan-awal">
									<button type="button" class="btn btn-sm btn-success px-3" id="btn-bayar-list-penjualan">Bayar</button>
								</div>
								<div id="container-btn-sesi-penjualan-akhir" style="display: none;">
									<button type="button" class="btn btn-sm btn-warning px-3" id="btn-ubah-list-penjualan">Ubah Transaksi</button>
									<button type="button" class="btn btn-sm btn-success px-3" id="btn-save-list-penjualan">Simpan</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end row-->
	</div>
	<div id="other-page" style="display:none;"></div>
<!-- Modal -->
<div class="modal fade" id="scannerModal" tabindex="-1" aria-labelledby="scannerModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title" id="scannerModalLabel">Pilih Produk</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<table class="table table-striped" id="tbl-list-produk-scanner">
			<thead>
				<th>
					<td>Nama Produk</td>
					<td>Satuan</td>
					<td>Stok</td>
					<td>Harga Jual</td>
					<td>Pilih</td>
				</th>
			</thead>
			<tbody></tbody>
		</table>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	</div>
	</div>
</div>
</div>
@endsection

@push('scripts')
	<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>

	<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>

	<script>
		var scannerModal = new bootstrap.Modal(document.getElementById('scannerModal'), {keyboard : false})
		$(async () => {
			// initModul() in "scripts.main.blade.php"
			module = await initModul()
			console.log(module)
			$('#preview-gambar').hide()
			$('#is-scan').prop('checked',false)
			$('#scanner-mode').html('off')
			$('#bayar-form').hide()
		})

		$('#is-scan').click(async function(){
			await scanToggleHandler()
		})

		async function scanToggleHandler() {
			await module.reset.form($("#form-penjualan .reset"))
			$('#preview-gambar').hide("slow")
			$('#preview-gambar').attr('src',"")
			$("#display-harga-jual").text("")
			var isChecked = $('#is-scan').prop('checked');
			if (isChecked) {
				$('#form-penjualan .reset').prop("disabled", true);
				$('#btn-append-penjualan').prop("disabled", true);
				$('#scanner-mode').html("On");
			} else {
				$('#form-penjualan .reset').prop("disabled", false);
				$('#btn-append-penjualan').prop("disabled", false);
				$('#scanner-mode').html("Off");
			}
		}

		var interval;
		var scan_barcode = '';
		document.addEventListener('keydown', function(evt) {
			var isChecked = $('#is-scan').prop('checked');
			if (isChecked) {
				if (interval) clearInterval(interval);

				if (evt.code == 'Enter') {
					if (scan_barcode) handleBarcode(scan_barcode);
					scan_barcode = '';
					return;
				}

				if (evt.key != 'Shift') scan_barcode += evt.key;

				interval = setInterval(() => {
					handleBarcode(scan_barcode);
					scan_barcode = ''
				}, 200);
			} else {
				clearInterval(interval); // Clear the interval if isChecked is false
			}
		});

		async function handleBarcode(sc_code) {
			if (sc_code.length > 0) {
				var data = {
					barcode: sc_code
				};
				$('#loader-full').removeClass('d-none')
				$('#loader-full').addClass('d-block')

				const response = await postRequest("{{route('penjualanKasir.scanBarcode')}}", data)

				$('#loader-full').addClass('d-none')
				$('#loader-full').removeClass('d-block')

				if (jQuery.inArray(response.status, [200, 201]) === -1) {
					await module.swal.warning({
						text: response.data.message,
						hideClass: module.var_swal.fadeOutUp,
					})

					return $(this).attr('disabled', false)
				}

				await module.swal.success({
					title: response.data.message,
					text: '',
					showClass: module.var_swal.fadeInDown,
					hideClass: module.var_swal.fadeOutUp,
				})

				if (JSON.parse(response.data.response).length == 1) {
					const produk = JSON.parse(response.data.response)[0]
					let produkText = produk.data_produk.nama_produk
					let idPembelian = produk.id
					let jumlahReal = produk.stok_real
					let jumlahRequest = 1

					let duplikat = false
					let jumlahAda = 0
					await $(".array-pembelian").each(function(idx) {
						if (idPembelian == this.value) {
							console.log('aa');
							duplikat = true
							jumlahAda = parseInt($("#array_jumlah_"+idPembelian).val())
							return false
						}
					})

					if (duplikat) {
						if ((jumlahRequest + jumlahAda) > jumlahReal) return module.swal.warning({text: "Jumlah penjualan tidak bisa melebihi stok!"});

						$("#btn_inc_"+idPembelian).click()
						// $("#array_jumlah_"+idPembelian).val(jumlahRequest + jumlahAda)
						return module.swal.success({text: "Berhasil menambahkan sejumlah 1 pada "+produkText})
						// return module.swal.warning({text: "Produk sudah ada di list penjualan"})
					}

					if (jumlahRequest > jumlahReal) {
						return module.swal.warning({text: "Jumlah penjualan tidak bisa melebihi stok!"})
					}

					let hargaJual = produk.harga_jual
					let totalHargaPerProduk = hargaJual * jumlahRequest

					let nomor = $("#container-list-penjualan tr").length + 1

					const randomId = module.generate.randomId(10)

					let html = `
						<tr class="rows-list-penjualan" id="rows-${randomId}">
							<input type="hidden" name="array_pembelian[]" class="array-pembelian" value="${idPembelian}">
							<input type="hidden" name="array_jumlah_real[]" class="array-jumlah-real" value="${jumlahReal}">
							<input type="hidden" name="array_harga_jual[]" class="array-harga-jual" value="${hargaJual}">
							<input type="hidden" name="array_total_harga_per_produk_murni[]" class="array-total-harga-per-produk-murni" value="${totalHargaPerProduk}">
							<input type="hidden" name="array_total_harga_per_produk_diskon[]" class="array-total-harga-per-produk-diskon" value="${totalHargaPerProduk}">

							<td id="container-nomor">${nomor}</td>
							<td id="container-produk">${produkText}</td>
							<td id="container-harga-jual" class="nowrap">${module.formatter.formatRupiah(hargaJual, 'Rp. ')}</td>
							<td>
								<input type="text" class="form-control text-center array-diskon readonly" name="array_diskon[]" data-unique-id="${randomId}">
							</td>
							<td id="container-jumlah" class='text-center'>
								<div class="input-group" style="margin-bottom: 4px; width: 87%; margin-left: auto; margin-right: auto;">
									<div class="input-group-prepend">
										<button
											class="btn btn-outline-secondary btn-decrease-jumlah btn-update-jumlah"
											data-unique-id="${randomId}"
											data-is-increase="false"
										>-</button>
									</div>
									<input
										type="number"
										class="form-control w-25 text-center array-jumlah"
										name="array_jumlah[]"
										id="array_jumlah_${idPembelian}"
										value="${jumlahRequest}"
										aria-describedby="basic-addon1"
										data-unique-id="${randomId}"
										autocomplete="off"
										readonly
										style="cursor: pointer; box-shadow: none; border: 1px solid #ced4da; z-index: 0;"
									>
									<div class="input-group-append">
										<button
											class="btn btn-outline-secondary btn-increase-jumlah btn-update-jumlah"
											data-unique-id="${randomId}"
											id="btn_inc_${idPembelian}"
											data-is-increase="true"
										>+</button>
									</div>
								</div>
							</td>
							<td id="container-total-harga-per-produk" class="nowrap">${module.formatter.formatRupiah(totalHargaPerProduk, 'Rp. ')}</td>
							<td class="text-center">
								<button type="button" class="btn btn-sm btn-danger px-2 btn-remove-list-penjualan" data-unique-id="${randomId}" title="Hapus">
									<i class="fadeIn animated bx bx-trash"></i>
								</button>
							</td>
						</tr>
					`

					await $("#container-list-penjualan").append(html)
					totalSemuaHarga()
				}
				if (JSON.parse(response.data.response).length > 1) {

					let htmlList = '';
					$.each(JSON.parse(response.data.response), function (i, v) {
						htmlList += `<tr>
								<td>
									${v.data_produk.nama_produk}
									<input type="hidden" value="${v.id}" id="list_${i}" />
									<input type="hidden" value="${v.data_produk.nama_produk}" id="nama_produk_${i}" />
									<input type="hidden" value="${v.stok_real}" id="stok_real_${i}" />
									<input type="hidden" value="${v.harga_jual}" id="harga_jual_${i}" />
								</td>
								<td>
									${v.satuan.nama}
								</td>
								<td>
									${v.stok_real}
								</td>
								<td>
									${v.harga_jual}
								</td>
								<td>
									<button class="btn btn-sm btn-info px-5 text-light btn-pilih-barcode" data-ind="${i}">Pilih</button>
								</td>
							</tr>`
					});
					$('#tbl-list-produk-scanner tbody').html(htmlList)
					scannerModal.show()
					initPilihBtn()
				}
			}
		}

		function initPilihBtn() {
			$(".btn-pilih-barcode").click(async (e) => {
				let $this = $(e.currentTarget)
				// return module.swal.warning({text: 'Masih tahap pengembangan!'})
				$this.attr('disabled', true)
				let produkText = $('#nama_produk_'+$this.data('ind')).val()
				let idPembelian = $('#list_'+$this.data('ind')).val()
				let jumlahReal = $('#stok_real_'+$this.data('ind')).val()
				let jumlahRequest = 1

				let duplikat = false
				let jumlahAda = 0
				await $(".array-pembelian").each(function(idx) {
					if (idPembelian == this.value) {
						duplikat = true
						jumlahAda = parseInt($("#array_jumlah_"+idPembelian).val())
						return false
					}
				})

				if (duplikat) {
						if ((jumlahRequest + jumlahAda) > jumlahReal) {
							return module.swal.warning({text: "Jumlah penjualan tidak bisa melebihi stok!"})
						}
						$("#btn_inc_"+idPembelian).click()
						$this.attr('disabled', false)
						// $("#array_jumlah_"+idPembelian).val(jumlahRequest + jumlahAda)
						return module.swal.success({text: "Berhasil menambahkan sejumlah 1 pada "+produkText})
						// return module.swal.warning({text: "Produk sudah ada di list penjualan"})
					}

				if (jumlahRequest > jumlahReal) {
					return module.swal.warning({text: "Jumlah penjualan tidak bisa melebihi stok!"})
				}

				let hargaJual = $('#harga_jual_'+$this.data('ind')).val()
				let totalHargaPerProduk = hargaJual * jumlahRequest

				let nomor = $("#container-list-penjualan tr").length + 1

				const randomId = module.generate.randomId(10)

				let html = `
					<tr class="rows-list-penjualan" id="rows-${randomId}">
						<input type="hidden" name="array_pembelian[]" class="array-pembelian" value="${idPembelian}">
						<input type="hidden" name="array_jumlah_real[]" class="array-jumlah-real" value="${jumlahReal}">
						<input type="hidden" name="array_harga_jual[]" class="array-harga-jual" value="${hargaJual}">
						<input type="hidden" name="array_total_harga_per_produk_murni[]" class="array-total-harga-per-produk-murni" value="${totalHargaPerProduk}">
						<input type="hidden" name="array_total_harga_per_produk_diskon[]" class="array-total-harga-per-produk-diskon" value="${totalHargaPerProduk}">

						<td id="container-nomor">${nomor}</td>
						<td id="container-produk">${produkText}</td>
						<td id="container-harga-jual" class="nowrap">${module.formatter.formatRupiah(hargaJual, 'Rp. ')}</td>
						<td>
							<input type="text" class="form-control text-center array-diskon readonly" name="array_diskon[]" data-unique-id="${randomId}">
						</td>
						<td id="container-jumlah" class='text-center'>
							<div class="input-group" style="margin-bottom: 4px; width: 87%; margin-left: auto; margin-right: auto;">
								<div class="input-group-prepend">
									<button
										class="btn btn-outline-secondary btn-decrease-jumlah btn-update-jumlah"
										data-unique-id="${randomId}"
										data-is-increase="false"
									>-</button>
								</div>
								<input
									type="number"
									class="form-control w-25 text-center array-jumlah"
									name="array_jumlah[]"
									id="array_jumlah_${idPembelian}"
									value="${jumlahRequest}"
									aria-describedby="basic-addon1"
									data-unique-id="${randomId}"
									autocomplete="off"
									readonly
									style="cursor: pointer; box-shadow: none; border: 1px solid #ced4da; z-index: 0;"
								>
								<div class="input-group-append">
									<button
										class="btn btn-outline-secondary btn-increase-jumlah btn-update-jumlah"
										data-unique-id="${randomId}"
										id="btn_inc_${idPembelian}"
										data-is-increase="true"
									>+</button>
								</div>
							</div>
						</td>
						<td id="container-total-harga-per-produk" class="nowrap">${module.formatter.formatRupiah(totalHargaPerProduk, 'Rp. ')}</td>
						<td class="text-center">
							<button type="button" class="btn btn-sm btn-danger px-2 btn-remove-list-penjualan" data-unique-id="${randomId}" title="Hapus">
								<i class="fadeIn animated bx bx-trash"></i>
							</button>
						</td>
					</tr>
				`

				await $("#container-list-penjualan").append(html)
				$this.attr('disabled', false)
				totalSemuaHarga()
				$('#tbl-list-produk-scanner tbody').html('')
				scannerModal.hide()
			})
		}

		function totalSemuaHarga() {
			$("#input-jumlah-pembayaran").val("").change()

			let sumTotalHargaMurni = 0
			let sumTotalHargaDiskon = 0
			$(".array-total-harga-per-produk-murni").each(function(idx) {
				sumTotalHargaMurni += parseFloat(this.value)
			})
			$(".array-total-harga-per-produk-diskon").each(function(idx) {
				sumTotalHargaDiskon += parseFloat(this.value)
			})

			$("#total-semua-harga-murni").val(sumTotalHargaMurni)
			$("#total-semua-harga-diskon").val(sumTotalHargaDiskon)

			$("#container-total-semua-harga").text(module.formatter.formatRupiah(sumTotalHargaDiskon, "Rp. "))
		}

		$("#form-penjualan").on('keyup change', '.validation', function() {
			if ($(this).val()) {
				$(this).removeClass('show-alert');
				$(this).siblings(".select2-container").removeClass('show-alert');
			}
		})
		$("#form-penjualan-final").on('keyup change', '.validation', function() {
			if ($(this).val()) {
				$(this).removeClass('show-alert');
				$(this).siblings(".select2-container").removeClass('show-alert');
			}
		})

		$('.single-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),

			// render html in the dropdown
			templateResult: function(el) {
				const string = el.text.split('|')
				if (string.length === 3) {
					let html = ""
					const arrayColor = ['#000000', '#00b8dd', '#00b30f']
					jQuery.each(string, (index, item) => {
						html += `<span class="${$(el.element).prop('class')}" style="color: ${arrayColor[index]};">${string[index]}</span>${string.length === index+1 ? "" :  " | "}`
					})
					return html
				}
				return `<span>${el.text}</span>`
			},
			// render html for the selected option
			templateSelection: function(el) {
				const string = el.text.split('|')
				if (string.length === 3) {
					let html = ""
					const arrayColor = ['#000000', '#00b8dd', '#00b30f']
					jQuery.each(string, (index, item) => {
						html += `<span class="${$(el.element).prop('class')}" style="color: ${arrayColor[index]};">${string[index]}</span>${string.length === index+1 ? "" :  " | "}`
					})
					return html
				}
				return `<span>${el.text}</span>`
			},
			// render html as-is without escaping it
			escapeMarkup: function(markup) { return markup }
		})

		// $("#input-produk").change(async function(e) {
		$("#input-produk").on('select2:select',async function(e) {
			// return console.log(e.params.data);
			var dataProduk = e.params.data;

			if ($(this).val()) {
				// let hargaJual = $(this).find(':selected').data('harga-jual')
				let hargaJual = dataProduk.harga_jual
				await $("#display-harga-jual").text(module.formatter.formatRupiah(hargaJual, "Rp. "))
				$("#input-jumlah").focus()

				// let gambar = $(this).find(':selected').data('foto-directory')
				let gambar = dataProduk.foto_directory
				if (gambar) {
					$('#preview-gambar').attr('src','{{url("storage/public/")}}'+gambar)
				} else {
					$('#preview-gambar').attr('src',"{{asset('/assets/images/errors-images/no-image.jpg')}}")
				}
				$('#preview-gambar').show("slow")
			} else {
				$("#display-harga-jual").text("")
			}
		})

		$("#btn-append-penjualan").click(async function(e) {
			e.preventDefault()

			const validation = module.validator.form($("#form-penjualan .validation"))
			if (validation) {
				return module.swal.warning({text: validation})
			}

			const $produk = $("#input-produk")
			const $dataProduk = $produk.find(':selected')
			let produkText = $dataProduk.data('nama-produk')
			let idPembelian = $produk.val()
			let jumlahReal = $dataProduk.data('jumlah')
			let jumlahRequest = $("#input-jumlah").val()


			let duplikat = false
			await $(".array-pembelian").each(function(idx) {
				if (idPembelian === this.value) {
					duplikat = true
					return false
				}
			})

			if (duplikat) {
				return module.swal.warning({text: "Produk sudah ada di list penjualan"})
			}

			if (jumlahRequest > jumlahReal) {
				return module.swal.warning({text: "Jumlah penjualan tidak bisa melebihi stok!"})
			}

			let hargaJual = $dataProduk.data('harga-jual')
			let totalHargaPerProduk = hargaJual * jumlahRequest

			let nomor = $("#container-list-penjualan tr").length + 1

			const randomId = module.generate.randomId(10)

			let html = `
				<tr class="rows-list-penjualan" id="rows-${randomId}">
					<input type="hidden" name="array_pembelian[]" class="array-pembelian" value="${idPembelian}">
					<input type="hidden" name="array_jumlah_real[]" class="array-jumlah-real" value="${jumlahReal}">
					<input type="hidden" name="array_harga_jual[]" class="array-harga-jual" value="${hargaJual}">
					<input type="hidden" name="array_total_harga_per_produk_murni[]" class="array-total-harga-per-produk-murni" value="${totalHargaPerProduk}">
					<input type="hidden" name="array_total_harga_per_produk_diskon[]" class="array-total-harga-per-produk-diskon" value="${totalHargaPerProduk}">

					<td id="container-nomor">${nomor}</td>
					<td id="container-produk">${produkText}</td>
					<td id="container-harga-jual" class="nowrap">${module.formatter.formatRupiah(hargaJual, 'Rp. ')}</td>
					<td>
						<input type="text" class="form-control text-center array-diskon readonly" name="array_diskon[]" data-unique-id="${randomId}">
					</td>
					<td id="container-jumlah" class='text-center'>
						<div class="input-group" style="margin-bottom: 4px; width: 87%; margin-left: auto; margin-right: auto;">
							<div class="input-group-prepend">
								<button
									class="btn btn-outline-secondary btn-decrease-jumlah btn-update-jumlah"
									data-unique-id="${randomId}"
									data-is-increase="false"
								>-</button>
							</div>
							<input
								type="number"
								class="form-control w-25 text-center array-jumlah"
								name="array_jumlah[]"
								value="${jumlahRequest}"
								aria-describedby="basic-addon1"
								data-unique-id="${randomId}"
								autocomplete="off"
								readonly
								style="cursor: pointer; box-shadow: none; border: 1px solid #ced4da; z-index: 0;"
							>
							<div class="input-group-append">
								<button
									class="btn btn-outline-secondary btn-increase-jumlah btn-update-jumlah"
									data-unique-id="${randomId}"
									id="btn_inc_${idPembelian}"
									data-is-increase="true"
								>+</button>
							</div>
						</div>
					</td>
					<td id="container-total-harga-per-produk" class="nowrap">${module.formatter.formatRupiah(totalHargaPerProduk, 'Rp. ')}</td>
					<td class="text-center">
						<button type="button" class="btn btn-sm btn-danger px-2 btn-remove-list-penjualan" data-unique-id="${randomId}" title="Hapus">
							<i class="fadeIn animated bx bx-trash"></i>
						</button>
					</td>
				</tr>
			`

			await $("#container-list-penjualan").append(html)
			totalSemuaHarga()

			await module.reset.form($("#form-penjualan .reset"))
			$('#preview-gambar').hide("slow")
			$('#preview-gambar').attr('src',"")
			$("#display-harga-jual").text("")

			// $("#input-jumlah").blur()
			$("#input-produk").select2('open')
		})

		$("#input-jumlah-pembayaran").setRules('0-9').on('keyup change', function(e) {
			$(this).val(module.formatter.formatRupiah($(this).val(), "Rp. "))

			const pembayaran = module.parse.onlyNumber($(this).val())
			const totalSemuaHarga = $("#total-semua-harga-diskon").val()
			let hasil = pembayaran - totalSemuaHarga

			if (hasil >= 0) {
				$("#input-kembalian").val(module.formatter.formatRupiah(pembayaran - totalSemuaHarga, "Rp. "))
			} else {
				$("#input-kembalian").val("Rp. 0")
			}
		})

		$(document).on('change keyup', '.array-diskon', async function(e) {
			$(this).setRules('0-9')
			const uniqueId = $(this).data('unique-id')
			await $(this).val(module.formatter.formatRupiah($(this).val(), "Rp. "))
			let diskon = parseInt(module.parse.onlyNumber($(this).val()))

			if (isNaN(diskon)) diskon = 0;

			let jumlah = parseInt($(`#rows-${uniqueId} .array-jumlah`).val())
			let hargaJual = parseInt($(`#rows-${uniqueId} .array-harga-jual`).val())
			let totalHargaJual = hargaJual * jumlah

			$(`#rows-${uniqueId} .array-total-harga-per-produk-murni`).val(totalHargaJual)

			// if (diskon > totalHargaJual) {
			if (diskon > hargaJual) {
				// $(this).val(module.formatter.formatRupiah(totalHargaJual, "Rp. "))
				$(this).val(module.formatter.formatRupiah(hargaJual, "Rp. "))
				diskon = parseInt(module.parse.onlyNumber($(this).val()))
			}

			diskon = diskon * jumlah

			totalHargaJual = totalHargaJual - diskon

			// let totalHargaJualPerProduk = hargaJual * jumlah
			let totalHargaJualPerProdukDiskon = totalHargaJual

			$(`#rows-${uniqueId} .array-total-harga-per-produk-diskon`).val(totalHargaJualPerProdukDiskon)
			$(`#rows-${uniqueId} #container-total-harga-per-produk`).text(module.formatter.formatRupiah(totalHargaJualPerProdukDiskon, 'Rp. '))

			totalSemuaHarga()
		})

		$(document).on('click', '.btn-update-jumlah', function(e) {
			e.preventDefault()
			const isIncrease = $(this).data('is-increase')
			const uniqueId = $(this).data('unique-id')
			let jumlah = parseInt($(`#rows-${uniqueId} .array-jumlah`).val())
			let jumlahReal = parseInt($(`#rows-${uniqueId} .array-jumlah-real`).val())
			let hargaJual = parseInt($(`#rows-${uniqueId} .array-harga-jual`).val())

			if (isIncrease) {
				jumlah += 1
			} else {
				jumlah -= 1
			}

			if (jumlah <= 0) {
				return module.swal.warning({text: "Jumlah min: 1"})
			}

			if (jumlah > jumlahReal) {
				return module.swal.warning({text: `Jumlah tidak bisa melebihi stok(${jumlahReal})`})
			}

			$(`#rows-${uniqueId} .array-total-harga-per-produk-murni`).val(hargaJual * jumlah)

			let totalHargaJualPerProduk = hargaJual * jumlah
			let diskon = module.parse.onlyNumber($(`#rows-${uniqueId} .array-diskon`).val())

			if (diskon) {
				// if (totalHargaJualPerProduk < diskon) {
				if (hargaJual < diskon) {
					// diskon = totalHargaJualPerProduk
					diskon = hargaJual
					$(`#rows-${uniqueId} .array-diskon`).val(module.formatter.formatRupiah(diskon, "Rp. "))
				}

				totalHargaJualPerProduk -= diskon * jumlah
			}

			$(`#rows-${uniqueId} .array-total-harga-per-produk-diskon`).val(totalHargaJualPerProduk)
			$(`#rows-${uniqueId} #container-total-harga-per-produk`).text(module.formatter.formatRupiah(totalHargaJualPerProduk, 'Rp. '))

			$(`#rows-${uniqueId} .array-jumlah`).val(jumlah)

			totalSemuaHarga()
		})

		$(document).on('click', '.btn-remove-list-penjualan', function(e) {
			e.preventDefault()
			const uniqueId = $(this).data('unique-id')

			module.swal.confirm().then((then) => {
				if (then.value) {
					$("#rows-" + uniqueId).hide('slow', async function(){
						await $(this).remove()

						$('.rows-list-penjualan').each(function(index) {
							$(this).find('#container-nomor').text(index + 1)
						})

						totalSemuaHarga()
					})
				}
			})
		})

		$("#is_hutang").change((e) => {
			let isHutang = $(e.currentTarget).val(),
				$input = $("#input-nama-pembeli");
			if (isHutang == 'hutang') {
				$("#container-nama-pembeli").removeClass('hide')
				$input.addClass('validation')
			} else {
				$("#container-nama-pembeli").addClass('hide')
				$input.removeClass('validation').val('')
			}
		})

		$("#btn-bayar-list-penjualan").click(function(e) {
			e.preventDefault()
			$('#is-scan').prop('checked',false)
			if ($("#container-list-penjualan tr").length <= 0) {
				return module.swal.warning({text: "Tidak ada data untuk dibayar"})
			}

			jQuery.each([
				'#input-produk',
				'#input-jumlah',
				'#btn-append-penjualan',
				'.rows-list-penjualan .btn',
				'#is-scan'
			], function(index, item) {
				$(item).attr('disabled', true)
			})

			$("#input-tanggal-penjualan").attr('readonly', false)
			$("#input-jumlah-pembayaran").attr('readonly', false)
			$(".rows-list-penjualan .readonly").attr('readonly', true)
			$("#input-jenis-pembayaran").attr('disabled', false)
			$("#is_hutang").attr('disabled', false)

			$("#container-btn-sesi-penjualan-awal").hide('slow', function() {
				$("#container-btn-sesi-penjualan-akhir").show('slow')
			})
			$('#bayar-form').show('slow')
		})
		$("#btn-ubah-list-penjualan").click(function(e) {
			e.preventDefault()

			jQuery.each([
				'#input-produk',
				'#input-jumlah',
				'#btn-append-penjualan',
				'.rows-list-penjualan .btn',
				'#is-scan'
			], function(index, item) {
				$(item).attr('disabled', false)
			})

			$("#input-tanggal-penjualan").attr('readonly', true)
			$("#input-jumlah-pembayaran").attr('readonly', true)
			$(".rows-list-penjualan .readonly").attr('readonly', false)
			$("#input-jenis-pembayaran").attr('disabled', true)
			$("#is_hutang").attr('disabled', true)

			$("#container-btn-sesi-penjualan-akhir").hide('slow', function() {
				$("#container-btn-sesi-penjualan-awal").show('slow')
			})
			$('#bayar-form').hide('slow')
		})

		$("#btn-save-list-penjualan").click(async function(e) {
			e.preventDefault()

			const validation = module.validator.form($("#form-penjualan-final .validation"))
			if (validation) {
				return module.swal.warning({text: validation})
			}

			// $(this).attr('disabled', true)
			if ($("#container-list-penjualan tr").length <= 0) {
				await module.swal.warning({text: "Tidak ada data untuk disimpan"})
				return $(this).attr('disabled', false)
			}

			const data = new FormData($("#form-penjualan-final")[0])

			const response = await postRequest("{{route('penjualanKasir.store')}}", data)
			// return console.log(response)

			if (jQuery.inArray(response.status, [200, 201]) === -1) {
				await module.swal.warning({
					text: response.data.message,
					hideClass: module.var_swal.fadeOutUp,
				})

				return $(this).attr('disabled', false)
			}

			await module.swal.success({
				title: response.data.message,
				text: '',
				showClass: module.var_swal.fadeInDown,
				hideClass: module.var_swal.fadeOutUp,
			})

			$(this).attr('disabled', false)



			$("#container-btn-sesi-penjualan-akhir").hide('slow', function() {
				$("#container-btn-sesi-penjualan-awal").show('slow')
			})

			await module.reset.form($("#form-penjualan-final .reset"))

			jQuery.each([
				'#input-produk',
				'#input-jumlah',
				'#btn-append-penjualan',
				'#is-scan'
			], function(index, item) {
				$(item).attr('disabled', false)
			})

			$("#input-tanggal-penjualan").attr('readonly', true)
			$("#input-jumlah-pembayaran").attr('readonly', true)
			$("#input-jenis-pembayaran").attr('disabled', true)
			$("#is_hutang").attr('disabled', true)

			$("#input-tanggal-penjualan").val("{{date('Y-m-d')}}")
			$("#container-list-penjualan").empty()
			$("#container-total-semua-harga").text("Rp. 0")
			$("#input-kembalian").val("Rp. 0")
			$('#bayar-form').hide('slow')
			window.open("{{route('penjualanKasir.invoice')}}/"+response.data.response)
		})
		$('#input-produk').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: `Masukkan (<span style="color: #000;">Kode</span>/<span style="color: #00b8dd;">Nama</span>) Produk`,
			allowClear: Boolean($(this).data('allow-clear')),
			ajax: {
				url: "{{ route('penjualanKasir.findProduk') }}",
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
									<span class="fw-bolder" style="color: #000;">${item.data_produk.barcode}</span>
									|
									<span class="fw-bolder" style="color: #00b8dd;">${item.data_produk.nama_produk.toUpperCase()}</span> (${item.satuan.nama.toUpperCase()})
									|
									<span class="fw-bolder" style="color: #00b30f;">${item.stok_real}</span>
								`,
								id: item.id,
								nama_produk: item.data_produk.nama_produk,
								foto_directory: item.data_produk.foto_directory,
								invoice_id: item.invoice_id,
								kode_produk: item.kode_produk,
								barcode: item.data_produk.barcode,
								satuan_name: item.satuan.nama,
								harga_jual: item.harga_jual,
								jumlah: item.stok_real,
							}
						})
					}
				},
				cache: true,
			},
			// render html for the selected option
			templateSelection: function (container) {
				$(container.element).attr('data-kode-produk', container.kode_produk)
				$(container.element).attr('data-nama-produk', container.nama_produk)
				$(container.element).attr('data-foto-directory', container.foto_directory)
				$(container.element).attr('data-harga-jual', container.harga_jual)
				$(container.element).attr('data-jumlah', container.jumlah)

				return `<span class="fw-bolder">${container.text}</span>`
			},
			// render html as-is without escaping it
			escapeMarkup: function(markup) { return markup }
		})
	</script>
@endpush
