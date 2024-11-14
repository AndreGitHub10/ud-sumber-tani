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
			{{-- <div class="col-xl-9 mx-auto"> --}}
			<div class="col-xl-4">
				<div class="card">
					<div class="card-header bg-info">
						<h5 class="mb-0 text-light">Form Penjualan</h5>
					</div>
					<div class="card-body">
						{{-- <div class="border p-4 rounded"> --}}
							{{-- <div class="card-title d-flex align-items-center">
								<div><i class="bx bxs-user me-1 font-22 text-info"></i>
								</div>
								<h5 class="mb-0 text-info">User</h5>
							</div> --}}
							<form id="form-data-user">
								<div class="row mb-4">
									<label for="input-produk" class="form-label">Temukan barang</label>
									<div class="col-12">
										<select class="single-select" id="input-produk" name="level">
											<option selected disabled>--PILIH OPSI--</option>
											@foreach ($produk ?? [] as $item)
												<option value="admin" class="fw-bolder">{{ $item->kode_produk }}|{{ strtoupper($item->data_produk->nama_produk) }}|{{ $item->stok_real }} ({{ strtoupper($item->satuan->nama) }})</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="row mb-4">
									<div class="col-12">
										<label for="input-jumlah" class="form-label">Jumlah Barang</label>
										<input type="number" min="1" class="form-control validation reset" id="input-jumlah" placeholder="Masukkkan Jumlah Barang" name="jumlah">
									</div>
								</div>
								<div class="row">
									<div
										class="col-sm-12 text-center"
										{{-- style="
											display: flex;
											justify-content: space-between;
										" --}}
									>
										<button class="btn btn-sm btn-info px-5 text-light" id="btn-append-penjualan">Tambahkan ke list penjualan</button>
									</div>
								</div>
							</form>
						{{-- </div> --}}
					</div>
				</div>
			</div>
			<div class="col-xl-8">
				<div class="card">
					<div class="card-header bg-secondary">
						<h5 class="mb-0 text-light">List Penjualan</h5>
					</div>
					<div class="card-body">
						<form id="form-data-user">
							<div class="row mb-4">
								<div class="col-12">
									<table class="table mb-0 table-striped">
										<thead>
											<tr>
												<th scope="col">Nama Produk</th>
												<th scope="col">Harga Per-Item</th>
												<th scope="col">Jumlah</th>
												<th scope="col">Total Harga</th>
												<th scope="col" class="text-center">Aksi</th>
											</tr>
										</thead>
										<tbody id="container-produk">
											{{-- <tr id="rows-1">
												<input type="hidden" name="array_produk[]" class="array-produk" value="2411PDK001">
												<input type="hidden" name="array_satuan[]" class="array-satuan" value="1">
												<input type="hidden" name="array_jumlah[]" class="array-jumlah" value="5">
												<input type="hidden" name="array_tanggal_kedaluwarsa[]" class="array-tanggal-kedaluwarsa" value="">
												<input type="hidden" name="array_harga_beli[]" class="array-harga-beli" value="12000">
												<input type="hidden" name="array_total_harga[]" class="array-total-harga" value="60000">
												<input type="hidden" name="array_harga_jual[]" class="array-harga-jual" value="15000">
								
												<td id="container-produk">2411PDK001 - PUPUK KOMPOS (GRAM)</td>
												<td id="container-harga-beli">Rp. 12.000</td>
												<td id="container-jumlah" class='text-center'>5</td>
												<td id="container-total-harga">Rp. 60.000</td>
												<td>
													<div class='text-center'>
														<button type='button' class='btn btn-sm btn-danger px-2 btn-remove-pembelian' data-unique-id="1" title="Hapus">
															<i class='fadeIn animated bx bx-trash'></i>
														</button>
														<button type='button' class='btn btn-sm btn-warning px-2 btn-modify-pembelian' data-unique-id="1" title="Edit">
															<i class='fadeIn animated bx bx-pencil'></i>
														</button>
													</div>
												</td>
											</tr>
											<tr id="rows-2">
												<input type="hidden" name="array_produk[]" class="array-produk" value="2411PDK002">
												<input type="hidden" name="array_satuan[]" class="array-satuan" value="2">
												<input type="hidden" name="array_jumlah[]" class="array-jumlah" value="14">
												<input type="hidden" name="array_tanggal_kedaluwarsa[]" class="array-tanggal-kedaluwarsa" value="2024-11-15">
												<input type="hidden" name="array_harga_beli[]" class="array-harga-beli" value="8000">
												<input type="hidden" name="array_total_harga[]" class="array-total-harga" value="112000">
												<input type="hidden" name="array_harga_jual[]" class="array-harga-jual" value="10000">
								
												<td id="container-produk">2411PDK002 - SPRAYER ELEKTRIK (KG)</td>
												<td id="container-harga-beli">Rp. 8.000</td>
												<td id="container-jumlah" class='text-center'>14</td>
												<td id="container-total-harga">Rp. 112.000</td>
												<td>
													<div class='text-center'>
														<button type='button' class='btn btn-sm btn-danger px-2 btn-remove-pembelian' data-unique-id="2" title="Hapus">
															<i class='fadeIn animated bx bx-trash'></i>
														</button>
														<button type='button' class='btn btn-sm btn-warning px-2 btn-modify-pembelian' data-unique-id="2" title="Edit">
															<i class='fadeIn animated bx bx-pencil'></i>
														</button>
													</div>
												</td>
											</tr> --}}
										</tbody>
										<tfoot id="">
											<tr>
												<th colspan="3">
													<input type="hidden" name="total_semua_harga" id="total-semua-harga" value="">
													Total Semua Harga : 
												</th>
												<th colspan="2" id="container-total-semua-harga">Rp.</th>
												{{-- <th colspan="2" id="container-total-semua-harga">Rp. 172.000</th> --}}
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
							<div class="row">
								<div
									class="col-sm-12"
									style="
										display: flex;
										justify-content: end;
									"
								>
									<button class="btn btn-sm btn-success px-5" id="btn-save-penjualan">Simpan</button>
								</div>
							</div>
						</form>
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
			escapeMarkup: function(markup) { return markup; }
		})

		function initButton(){
			$(".btn-edit-pembelian").click(async (e) => {
				let $this = $(e.currentTarget)
				return module.swal.warning({text: 'Masih tahap pengembangan!'})
				$this.attr('disabled', true)

				let response = await postRequest("{{route('pembelian.form')}}", {id_user: $this.data('id')})
				
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

			$(".btn-delete-pembelian").click(async (e) => {
				let $this = $(e.currentTarget)
				return module.swal.warning({text: 'Masih tahap pengembangan!'})
				$this.attr('disabled', true)

				module.swal.confirm().then(async (e) => {
					if (e.value) {
						const response = await postRequest("{{route('pembelian.destroy')}}", {id_user: $this.data('id')})
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

						datatablePembelian()
					}
					$this.attr('disabled', false)
				})
			})
		}

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
	</script>
@endpush