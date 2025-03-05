@php
	function formatRupiah($angka)
	{
		$hasil_rupiah = 'Rp. ' . number_format((int) $angka);
		$hasil_rupiah = str_replace(',', '.', $hasil_rupiah);
		return $hasil_rupiah;
	}
@endphp

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">Pembelian</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Form Pembelian Produk</li>
			</ol>
		</nav>
	</div>
</div>
<!--end breadcrumb-->
{{-- <div class="row"> --}}
	{{-- <div class="col">
		<h6 class="mb-0 text-uppercase">Basic Form</h6>
		<hr/>
		<div class="card border-top border-0 border-4 border-primary">
			<div class="card-body p-5">
				<div class="card-title d-flex align-items-center">
					<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
					</div>
					<h5 class="mb-0 text-primary">User Registration</h5>
				</div>
				<hr>
				<form class="row g-3">
					<div class="col-md-6">
						<label for="inputFirstName" class="form-label">First Name</label>
						<input type="email" class="form-control" id="inputFirstName">
					</div>
					<div class="col-md-6">
						<label for="inputLastName" class="form-label">Last Name</label>
						<input type="password" class="form-control" id="inputLastName">
					</div>
					<div class="col-md-6">
						<label for="inputEmail" class="form-label">Email</label>
						<input type="email" class="form-control" id="inputEmail">
					</div>
					<div class="col-md-6">
						<label for="inputPassword" class="form-label">Password</label>
						<input type="password" class="form-control" id="inputPassword">
					</div>
					<div class="col-12">
						<label for="inputAddress" class="form-label">Address</label>
						<textarea class="form-control" id="inputAddress" placeholder="Address..." rows="3"></textarea>
					</div>
					<div class="col-12">
						<label for="inputAddress2" class="form-label">Address 2</label>
						<textarea class="form-control" id="inputAddress2" placeholder="Address 2..." rows="3"></textarea>
					</div>
					<div class="col-md-6">
						<label for="inputCity" class="form-label">City</label>
						<input type="text" class="form-control" id="inputCity">
					</div>
					<div class="col-md-4">
						<label for="inputState" class="form-label">State</label>
						<select id="inputState" class="form-select">
							<option selected>Choose...</option>
							<option>...</option>
						</select>
					</div>
					<div class="col-md-2">
						<label for="inputZip" class="form-label">Zip</label>
						<input type="text" class="form-control" id="inputZip">
					</div>
					<div class="col-12">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="gridCheck">
							<label class="form-check-label" for="gridCheck">Check me out</label>
						</div>
					</div>
					<div class="col-12">
						<button type="submit" class="btn btn-primary px-5">Register</button>
					</div>
				</form>
			</div>
		</div>
	</div> --}}

	{{-- <div class="col">
		<div class="card border-top border-0 border-4 border-success">
			<div class="card-header">
				<div class="col-12">
					<button type="button" class="btn btn-secondary px-3" id="btn-back-form-user" title="kembali">
						<i class="fadeIn animated bx bx-left-arrow"></i>
					</button>
				</div>
			</div>
			<div class="card-body p-5">
				<form class="row g-3">
					<div class="col-md-12">
						<label for="inputName" class="form-label">Name</label>
						<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
							<input type="text" class="form-control border-start-0" id="inputName" placeholder="Name" />
						</div>
					</div>
					<div class="col-md-12">
						<label for="inputUsername" class="form-label">Username</label>
						<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
							<input type="text" class="form-control border-start-0" id="inputUsername" placeholder="Name" />
						</div>
					</div>
					<div class="col-12">
						<label for="inputPhoneNo" class="form-label">Phone No</label>
						<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-microphone' ></i></span>
							<input type="text" class="form-control border-start-0" id="inputPhoneNo" placeholder="Phone No" />
						</div>
					</div>
					<div class="col-12">
						<label for="inputEmailAddress" class="form-label">Email Address</label>
						<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
							<input type="text" class="form-control border-start-0" id="inputEmailAddress" placeholder="Email Address" />
						</div>
					</div>
					<div class="col-12">
						<label for="inputChoosePassword" class="form-label">Choose Password</label>
						<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-lock-open' ></i></span>
							<input type="text" class="form-control border-start-0" id="inputChoosePassword" placeholder="Choose Password" />
						</div>
					</div>
					<div class="col-12">
						<label for="inputConfirmPassword" class="form-label">Confirm Password</label>
						<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-lock' ></i></span>
							<input type="text" class="form-control border-start-0" id="inputConfirmPassword" placeholder="Confirm Password" />
						</div>
					</div>
					<div class="col-12">
						<label for="inputAddress3" class="form-label">Address</label>
						<textarea class="form-control" id="inputAddress3" placeholder="Enter Address" rows="3"></textarea>
					</div>
					<div class="col-12">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="gridCheck2">
							<label class="form-check-label" for="gridCheck2">Check me out</label>
						</div>
					</div>
					<div class="col-12">
						<button type="submit" class="btn btn-danger px-5">Register</button>
					</div>
				</form>
			</div>
		</div>
	</div> --}}

	{{-- <div class="col">
		<h6 class="mb-0 text-uppercase">Login Form</h6>
		<hr/>
		<div class="card border-top border-0 border-4 border-dark">
			<div class="card-body p-5">
				<div class="card-title text-center"><i class="bx bxs-user-circle text-dark font-50"></i>
					<h5 class="mb-5 mt-2 text-dark">User Login</h5>
				</div>
				<hr>
				<form class="row g-3">
					<div class="col-12">
						<label for="inputLastEnterUsername" class="form-label">Enter Username</label>
						<div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
							<input type="text" class="form-control border-start-0" id="inputLastEnterUsername" placeholder="Enter Username" />
						</div>
					</div>
					<div class="col-12">
						<label for="inputLastEnterPassword" class="form-label">Enter Password</label>
						<div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class='bx bxs-lock-open'></i></span>
							<input type="text" class="form-control border-start-0" id="inputLastEnterPassword" placeholder="Enter Password" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="gridCheck3">
							<label class="form-check-label" for="gridCheck3">Check me out</label>
						</div>
					</div>
					<div class="col-md-6 text-end">	<a href="javascript:;">Forgot Password ?</a>
					</div>
					<div class="col-12">
						<div class="d-grid">
							<button type="submit" class="btn btn-dark btn-lg px-5"><i class='bx bxs-lock-open'></i>Login</button>
						</div>
					</div>
					<hr/>
					<div class="col-12 text-center">
						<p class="mb-0">or Sign in with:</p>
					</div>
					<div class="col-12">
						<div class="d-grid gap-2">
							<button type="submit" class="btn btn-facebook btn-lg px-5"><i class='bx bxl-facebook'></i>Login with facebook</button>
							<button type="submit" class="btn btn-light btn-lg px-5"><i class='bx bxl-google'></i>Login with Google</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div> --}}

{{-- </div> --}}
<!--end row-->
<div class="row">
	<div class="col-xl-12 mx-auto">
		<div class="card border-top border-0 border-4 border-info">
			<div class="card-body">
				<div class="border p-4 rounded">
					<div class="card-title d-flex align-items-center">
						<div><i class="bx bxs-basket me-1 font-22 text-info"></i>
						</div>
						<h5 class="mb-0 text-secondary">Pembelian</h5>
					</div>
					<hr class="mb-4"/>
					<form id="form-invoice">
						<input type="hidden" class="form-control" id="id-pembelian" placeholder="Masukkan nomor invoice" value="{{$pembelian->id ?? ''}}">
						<div class="row mb-4">
							<label for="input-nomor-invoice" class="col-sm-3 col-form-label">Nomor Invoice <span class="text-danger">*)</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control validation" id="input-nomor-invoice" placeholder="Masukkan nomor invoice" value="{{$pembelian->nomor_invoice ?? ''}}">
							</div>
						</div>
						<div class="row mb-4">
							<label for="input-supplier" class="col-sm-3 col-form-label">Supplier <span class="text-danger">*)</span></label>
							<div class="col-sm-9">
								<select class="single-select validation" id="input-supplier">
									<option selected disabled>--PILIH OPSI--</option>
									@foreach ($supplier ?? [] as $item)
									<option value="{{$item->id}}" {{$pembelian && $pembelian->supplier_id == $item->id ? 'selected' : '' }}>{{$item->nama}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="row mb-4">
							<label for="input-tanggal-pembelian" class="col-sm-3 col-form-label">Tanggal Pembelian <span class="text-danger">*)</span></label>
							<div class="col-sm-9">
								<input type="date" class="form-control validation" id="input-tanggal-pembelian" value="{{$pembelian ? $pembelian->tanggal : date("Y-m-d")}}">
							</div>
						</div>
					</form>

					<hr class="mb-4"/>

					<div class="row g-3 mb-4" id="container-input-produk">
						<input type="hidden" class="reset" id="input-unique-id">
						<div class="col-md-6">
							<label for="input-nama-produk" class="form-label">Nama Produk</label>
							<select class="single-select validation reset" id="input-nama-produk" name="level">
								<option selected readonly value="">--PILIH OPSI--</option>
								@foreach ($produk ?? [] as $item)
								<option value="{{$item->kode_produk}}">{{$item->kode_produk}} - {{strtoupper($item->nama_produk)}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-6">
							<label for="input-satuan" class="form-label">Satuan</label>
							<select class="single-select validation reset" id="input-satuan" name="satuan_id">
								<option selected readonly value="">--PILIH OPSI--</option>
								@foreach ($satuan ?? [] as $item)
								<option value="{{$item->id}}">{{strtoupper($item->nama)}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-6">
							<label for="input-jumlah" class="form-label">Jumlah</label>
							<input type="text" class="form-control validation reset" id="input-jumlah" placeholder="Masukkkan Jumlah Produk" name="jumlah">
						</div>
						<div class="col-md-6">
							<label for="input-tanggal-kedaluwarsa" class="form-label">Tanggal Kedaluwarsa</label>
							<input type="date" class="form-control reset" id="input-tanggal-kedaluwarsa" name="tanggal_kedaluwarsa">
						</div>
						<div class="col-md-6">
							<label for="input-harga-beli" class="form-label">Harga Beli Per-Item</label>
							<input type="text" class="form-control validation reset" id="input-harga-beli" placeholder="Masukkan Harga Beli" name="harga_beli">
						</div>
						<div class="col-md-6">
							<label for="input-harga-jual" class="form-label">Harga Jual</label>
							<input type="text" class="form-control validation reset" id="input-harga-jual" placeholder="Masukkan Harga Jual" name="harga_jual">
						</div>
					</div>

					<div class="row">
						<div class="col-8"></div>
						<div class="col-4">
							{{-- <button type="button" class="btn btn-secondary px-3" id="btn-back-form-pembelian">
								<i class="fadeIn animated bx bx-left-arrow"></i> Kembali
							</button> --}}
							<div id="container-btn-append-pembelian" style="display: flex; justify-content: flex-end;">
								<button class="btn btn-sm btn-info px-2" id="btn-append-pembelian" data-isnew="true">Tambahkan Data</button>
							</div>
							<div id="container-btn-update-batal-pembelian" style="display: none; justify-content: space-around;">
								<button class="btn btn-sm btn-secondary px-2" id="btn-batal-pembelian">Batal</button>
								<button class="btn btn-sm btn-warning px-2" id="btn-update-pembelian" data-isnew="false">Update Data</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xl-12 mx-auto">
		<div class="card border-top border-0 border-4 border-success">
			<div class="card-body px-5">
				<div class="row mb-4">
					<div class="col-md-12">
						<form id="form-pembelian">
							<table class="table mb-0 table-striped">
								<thead>
									<tr>
										<th scope="col">Nama Produk</th>
										<th scope="col">Harga Per-Item</th>
										<th scope="col" class="text-center">Jumlah</th>
										<th scope="col">Total Harga</th>
										<th scope="col" class="text-center">Aksi</th>
									</tr>
								</thead>
								<tbody id="container-produk">
									@php
										$totalSemuaHarga = 0;
									@endphp
									@if (isset($pembelian->pembelian_detail))
									@foreach ($pembelian->pembelian_detail ?? [] as $key => $item)
									<tr id="rows-{{$item->id}}" data-is-count="{{$item->stok_awal===$item->stok_real ? 'true' : 'false'}}" class="{{$item->is_konversi ? 'is-konversi' : ''}}">
										<input type="hidden" name="array_produk[]" class="array-produk" value="{{$item->kode_produk}}">
										<input type="hidden" name="array_is_konversi[]" class="array-is-konversi" value="{{$item->is_konversi}}">
										<input type="hidden" name="array_satuan[]" class="array-satuan" value="{{$item->satuan_id}}">
										<input type="hidden" name="array_jumlah[]" class="array-jumlah" value="{{$item->stok_real}}">
										<input type="hidden" name="array_tanggal_kedaluwarsa[]" class="array-tanggal-kedaluwarsa" value="{{$item->tanggal_kedaluwarsa ?? ''}}">
										<input type="hidden" name="array_harga_beli[]" class="array-harga-beli" value="{{$item->harga_beli}}">
										<input
											type="hidden"
											name="array_total_harga[]"
											class="array-total-harga"
											value="{{$item->total_harga_beli}}"
											data-is-count="{{$item->stok_awal===$item->stok_real ? 'true' : 'false'}}"
											data-is-konversi="{{$item->is_konversi}}"
										>
										<input type="hidden" name="array_harga_jual[]" class="array-harga-jual" value="{{$item->harga_jual}}">
										<input type="hidden" name="array_id_pembelian_detail[]" class="array-id-pembelian-detail" value="{{$item->id}}">

										<td id="container-produk">{{$item->data_produk->kode_produk}} - {{strtoupper($item->data_produk->nama_produk)}} ({{strtoupper($item->satuan->nama)}})</td>
										<td id="container-harga-beli">{{formatRupiah($item->harga_beli)}}</td>
										<td id="container-jumlah" class='text-center'>{{$item->stok_awal === $item->stok_real ? $item->stok_real : "$item->stok_real/$item->stok_awal"}}</td>
										{{-- <td id="container-total-harga">{{formatRupiah($item->total_harga_beli)}}</td> --}}
										<td id="container-total-harga">{{formatRupiah($item->stok_real * $item->harga_beli)}}</td>
										<td>
											<div class="text-center">
												<span class="tool-tip" data-toggle="tooltip" data-placement="top" title="{{$item->stok_awal===$item->stok_real ? 'Hapus' : 'Produk sudah ada penjualan, tidak bisa dihapus'}}">
													<button
														type="button"
														class="btn btn-sm btn-danger px-2 btn-remove-pembelian {{$item->stok_awal===$item->stok_real ? '' : 'title-nonaktif'}}"
														data-unique-id="{{$item->id}}"
														data-is-count="{{$item->stok_awal===$item->stok_real ? 'true' : 'false'}}"
														{{$item->stok_awal===$item->stok_real ? '' : 'disabled'}}
													>
														<i class="fadeIn animated bx bx-trash"></i>
													</button>
												</span>
												<span class="tool-tip" data-toggle="tooltip" data-placement="top" title="Edit">
													<button
														type="button"
														class="btn btn-sm btn-warning px-2 btn-modify-pembelian"
														data-unique-id="{{$item->id}}"
														data-is-count="{{$item->stok_awal===$item->stok_real ? 'true' : 'false'}}"
													>
														<i class="fadeIn animated bx bx-pencil"></i>
													</button>
												</span>
											</div>
										</td>
									</tr>
									@php
										// $totalSemuaHarga +=  $item->total_harga_beli;
										// $totalSemuaHarga +=  !$item->is_konversi ? $item->stok_real * $item->harga_beli : 0;
										$totalSemuaHarga +=  !$item->is_konversi ? $item->total_harga_beli : 0;
									@endphp
									@endforeach
									@endif
								</tbody>
								<tfoot id="">
									<tr>
										<th colspan="3">
											<input type="hidden" name="total_semua_harga" id="total-semua-harga" value="{{$totalSemuaHarga}}">
											Total Semua Harga :
										</th>
										<th colspan="2" id="container-total-semua-harga">{{$pembelian ? formatRupiah($totalSemuaHarga) : 'Rp.'}}</th>
										{{-- <th colspan="2" id="container-total-semua-harga">Rp. 172.000</th> --}}
									</tr>
								</tfoot>
							</table>
						</form>
					</div>
				</div>

				<div class="row">
					<div
						class="col-12"
						style="
							display: flex;
							justify-content: space-between;
						"
					>
						<button type="button" class="btn btn-sm btn-secondary px-3" id="btn-back-form-pembelian">
							<i class="fadeIn animated bx bx-left-arrow"></i> Kembali
						</button>
						<button class="btn btn-sm btn-success px-5" id="btn-save-form-pembelian">Simpan</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--end row-->

<script>
	$('[data-toggle="tooltip"]').tooltip()
	$("#other-page").on('click', '.btn-remove-pembelian', function(e) {
		e.preventDefault()
		const target = $(this).data('unique-id')

		module.swal.confirm().then((then) => {
			if (then.value) {
				$("#rows-" + target).hide('slow', async function(){
					await $(this).remove()
					totalSemuaHarga()

					if ($("#input-unique-id").val() == target) {
						module.reset.form($("#container-input-produk .reset"))
						$("#container-btn-update-batal-pembelian").hide('slow', function() {
							$("#container-btn-append-pembelian").show('slow').css('display', 'flex')
						})
					}
				})
			}
		})
	})
	$("#other-page").on('click', '.btn-modify-pembelian', function(e) {
		e.preventDefault()
		const uniqueId = $(this).data('unique-id')
		const isCount = $(this).data('is-count')
		$("#btn-update-pembelian").data('unique-id', uniqueId)
		$("#input-unique-id").val(uniqueId)

		let produkValue = $(`#rows-${uniqueId} .array-produk`).val()
		let satuanValue = $(`#rows-${uniqueId} .array-satuan`).val()
		let jumlah = $(`#rows-${uniqueId} .array-jumlah`).val()
		let tanggalKedaluwarsa = $(`#rows-${uniqueId} .array-tanggal-kedaluwarsa`).val()
		let hargaBeli = $(`#rows-${uniqueId} .array-harga-beli`).val()
		let hargaJual = $(`#rows-${uniqueId} .array-harga-jual`).val()

		$("#input-nama-produk").val(produkValue).trigger('change')
		$("#input-satuan").val(satuanValue).trigger('change')
		$("#input-jumlah").val(jumlah)
		$("#input-tanggal-kedaluwarsa").val(tanggalKedaluwarsa)
		$("#input-harga-beli").val(module.formatter.formatRupiah(hargaBeli, "Rp. "))
		$("#input-harga-jual").val(module.formatter.formatRupiah(hargaJual, "Rp. "))
		if (!isCount) {
			$("#input-nama-produk").attr('disabled', true)
			$("#input-satuan").attr('disabled', true)
			$("#input-jumlah").attr('readonly', true)
			$("#input-harga-beli").attr('readonly', true)
		} else {
			$("#input-nama-produk").attr('disabled', false)
			$("#input-satuan").attr('disabled', false)
			$("#input-jumlah").attr('readonly', false)
			$("#input-harga-beli").attr('readonly', false)
		}

		$("#container-btn-append-pembelian").hide("slow", function() {
			$("#container-btn-update-batal-pembelian").show('slow').css('display', 'flex')
		})
	})

	function totalSemuaHarga() {
		let sumTotalHarga = sumTotalHargaTemp = 0

		$(".array-total-harga").each(function(idx) {
			if ($(this).data('is-konversi') == 0) {
				sumTotalHarga += parseFloat(this.value)
			}
		})
		// $(".array-total-harga-temp").each(function(idx) {
		// 	if ($(this).data('is-konversi') == 0) {
		// 		sumTotalHargaTemp += parseFloat(this.value)
		// 	}
		// })

		$("#total-semua-harga").val(sumTotalHarga)
		$("#container-total-semua-harga").text(module.formatter.formatRupiah(sumTotalHarga, "Rp. "))
	}

	$("#container-input-produk, #form-invoice").on('keyup change', '.validation', function() {
		if ($(this).val()) {
			$(this).removeClass('show-alert');
			$(this).siblings(".select2-container").removeClass('show-alert');
		}
	})

	$("#input-jumlah").setRules('0-9')
	$("#input-harga-beli").setRules('0-9').on('keyup', (e)=>{
		$this = $(e.currentTarget)
		$this.val(module.formatter.formatRupiah($this.val(), 'Rp. '))
	})
	$("#input-harga-jual").setRules('0-9').on('keyup', (e)=>{
		$this = $(e.currentTarget)
		$this.val(module.formatter.formatRupiah($this.val(), 'Rp. '))
	})

	$('.single-select').select2({
		theme: 'bootstrap4',
		width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
		placeholder: $(this).data('placeholder'),
		allowClear: Boolean($(this).data('allow-clear')),
	})

	$("#btn-append-pembelian, #btn-update-pembelian").click(async function(e) {
		e.preventDefault()
		const isNew = $(this).data('isnew')
		let {message, text} = ""

		// Validasi sebelum append produk
		let validation = module.validator.form($("#container-input-produk .validation"))
		if (validation) {
			return module.swal.warning({text: validation})
		}

		let produkText = $("#select2-input-nama-produk-container").attr('title')
		let produkValue = $("#input-nama-produk").val()
		let satuanText = $("#select2-input-satuan-container").attr('title')
		let satuanValue = $("#input-satuan").val()

		let jumlah = $("#input-jumlah").val()
		let tanggalKedaluwarsa = $("#input-tanggal-kedaluwarsa").val()

		let hargaBeli = $("#input-harga-beli").val()
		let fixHargaBeli = module.parse.onlyNumber(hargaBeli)

		const totalHarga = fixHargaBeli * jumlah

		let hargaJual = $("#input-harga-jual").val()
		let fixHargaJual = module.parse.onlyNumber(hargaJual)

		if(isNew===true){
			const randomId = module.generate.randomId()

			let html = `
				<tr id="rows-${randomId}" data-is-count="true">

					<input type="hidden" name="array_produk[]" class="array-produk" value="${produkValue}">
					<input type="hidden" name="array_is_konversi[]" class="array-is-konversi" value="0">
					<input type="hidden" name="array_satuan[]" class="array-satuan" value="${satuanValue}">
					<input type="hidden" name="array_jumlah[]" class="array-jumlah" value="${jumlah}">
					<input type="hidden" name="array_tanggal_kedaluwarsa[]" class="array-tanggal-kedaluwarsa" value="${tanggalKedaluwarsa}">
					<input type="hidden" name="array_harga_beli[]" class="array-harga-beli" value="${fixHargaBeli}">
					<input type="hidden" name="array_total_harga[]" class="array-total-harga" value="${totalHarga}" data-is-count="true" data-is-konversi="false">
					<input type="hidden" name="array_harga_jual[]" class="array-harga-jual" value="${fixHargaJual}">
					<input type="hidden" name="array_id_pembelian_detail[]" class="array-id-pembelian-detail" value="">

					<td id="container-produk">${produkText} (${satuanText})</td>
					<td id="container-harga-beli">${hargaBeli}</td>
					<td id="container-jumlah" class="text-center">${jumlah}</td>
					<td id="container-total-harga">${module.formatter.formatRupiah(totalHarga, "Rp. ")}</td>
					<td>
						<div class="text-center">
							<span class="tool-tip" data-toggle="tooltip" data-placement="top" title="Hapus">
								<button
									type="button"
									class="btn btn-sm btn-danger px-2 btn-remove-pembelian"
									data-unique-id="${randomId}"
									title="Hapus"
									data-is-count="true"
								>
									<i class="fadeIn animated bx bx-trash"></i>
								</button>
							</span>
							<span class="tool-tip" data-toggle="tooltip" data-placement="top" title="Edit">
								<button
									type="button"
									class="btn btn-sm btn-warning px-2 btn-modify-pembelian"
									data-unique-id="${randomId}"
									title="Edit"
									data-is-count="true"
								>
									<i class="fadeIn animated bx bx-pencil"></i>
								</button>
							</span>
						</div>
					</td>
				</tr>
			`
			$("#container-produk").append(html)
		} else {
			const targetId = $(this).data('unique-id')
			const isCount = $('#rows-'+targetId).data('is-count')

			if (isCount) {
				$(`#rows-${targetId} .array-produk`).val(produkValue)
				$(`#rows-${targetId} .array-jumlah`).val(jumlah)
				$(`#rows-${targetId} .array-satuan`).val(satuanValue)
				$(`#rows-${targetId} .array-harga-beli`).val(fixHargaBeli)
				$(`#rows-${targetId} .array-total-harga`).val(totalHarga)
				$(`#rows-${targetId} #container-produk`).html(`${produkText} (${satuanText})`)
				$(`#rows-${targetId} #container-harga-beli`).html(hargaBeli)
				$(`#rows-${targetId} #container-jumlah`).html(jumlah)
				$(`#rows-${targetId} #container-total-harga`).html(module.formatter.formatRupiah(totalHarga, "Rp. "))
			} else {
				$("#input-nama-produk").attr('disabled', false)
				$("#input-satuan").attr('disabled', false)
				$("#input-jumlah").attr('readonly', false)
				$("#input-harga-beli").attr('readonly', false)
			}

			$(`#rows-${targetId} .array-tanggal-kedaluwarsa`).val(tanggalKedaluwarsa)
			$(`#rows-${targetId} .array-harga-jual`).val(fixHargaJual)

			$("#container-btn-update-batal-pembelian").hide('slow', function() {
				$("#container-btn-append-pembelian").show('slow').css('display', 'flex')
			})
		}

		totalSemuaHarga()

		module.reset.form($("#container-input-produk .reset"))
	})

	$("#btn-batal-pembelian").click(function(e) {
		e.preventDefault()
		module.reset.form($("#container-input-produk .reset"))

		$("#input-nama-produk").attr('disabled', false)
		$("#input-satuan").attr('disabled', false)
		$("#input-jumlah").attr('readonly', false)
		$("#input-harga-beli").attr('readonly', false)

		$("#container-btn-update-batal-pembelian").hide('slow', function() {
			$("#container-btn-append-pembelian").show('slow').css('display', 'flex')
		})
	})

	$("#btn-back-form-pembelian").click((e) => {
		$("#other-page").hide('slow', function () {
			$("#main-page").fadeIn()
			$("#other-page").empty()
		})
	})

	$("#btn-save-form-pembelian").click(async function(e) {
		e.preventDefault()
		if($("#container-produk tr").length <= 0){
			return module.swal.warning({text: "Tidak ada data untuk disimpan."})
		}

		let validation = module.validator.form($("#form-invoice .validation"))
		if (validation) {
			return module.swal.warning({text: validation})
		}

		$(this).attr('disabled', true)

		const data = new FormData($("#form-pembelian")[0])
		data.append("nomor_invoice", $("#input-nomor-invoice").val())
		data.append("id_supplier", $("#input-supplier").val())
		data.append("tanggal_pembelian", $("#input-tanggal-pembelian").val())
		data.append("id_pembelian", $("#id-pembelian").val())
		// data.append("total_semua_harga", $("#input-tanggal-pembelian").val())

		const response = await postRequest("{{route('pembelian.store')}}", data)
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

		$("#other-page").hide('slow', async function () {
			await $("#main-page").fadeIn()
			await $("#other-page").empty()
			datatablePembelian()
		})
	})
</script>
