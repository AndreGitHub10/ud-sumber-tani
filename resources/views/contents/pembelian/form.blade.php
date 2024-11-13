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
					<form id="form-pembelian">
						<div class="row mb-4">
							<label for="input-nomor-invoice" class="col-sm-3 col-form-label">Nomor Invoice <span class="text-danger">*)</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="input-nomor-invoice" placeholder="Masukkan nomor invoice">
							</div>
						</div>
						<div class="row mb-4">
							<label for="input-supplier" class="col-sm-3 col-form-label">Supplier <span class="text-danger">*)</span></label>
							<div class="col-sm-9">
								<select class="single-select" id="input-supplier" name="level">
									<option selected disabled>--PILIH OPSI--</option>
									@foreach ($supplier ?? [] as $item)
									<option value="{{$item->id}}">{{$item->nama}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="row mb-4">
							<label for="inputLevel" class="col-sm-3 col-form-label">Tanggal Pembelian <span class="text-danger">*)</span></label>
							<div class="col-sm-9">
								<input type="date" class="form-control" id="inputFirstName">
							</div>
						</div>

						<hr class="mb-4"/>

						<div class="row g-3 mb-4 container-input-produk">
							<div class="col-md-6">
								<label for="input-nama-produk" class="form-label">Nama Produk</label>
								<select class="single-select validation" id="input-nama-produk" name="level">
									<option selected readonly value="">--PILIH OPSI--</option>
									@foreach ($produk ?? [] as $item)
									<option value="{{$item->id}}">{{$item->kode_produk}} - {{strtoupper($item->nama_produk)}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-6">
								<label for="input-satuan" class="form-label">Satuan</label>
								<select class="single-select validation" id="input-satuan" name="satuan_id">
									<option selected readonly value="">--PILIH OPSI--</option>
									@foreach ($satuan ?? [] as $item)
									<option value="{{$item->id}}">{{strtoupper($item->nama)}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-6">
								<label for="input-jumlah" class="form-label">Jumlah</label>
								<input type="text" class="form-control validation" id="input-jumlah" placeholder="Masukkkan Jumlah Produk" name="jumlah">
							</div>
							<div class="col-md-6">
								<label for="input-tanggal-kedaluwarsa" class="form-label">Tanggal Kedaluwarsa</label>
								<input type="date" class="form-control validation" id="input-tanggal-kedaluwarsa" name="tanggal_kedaluwarsa">
							</div>
							<div class="col-md-6">
								<label for="input-harga-beli" class="form-label">Harga Beli Per-Item</label>
								<input type="text" class="form-control validation" id="input-harga-beli" placeholder="Masukkan Harga Beli" name="harga_beli">
							</div>
							<div class="col-md-6">
								<label for="input-harga-jual" class="form-label">Harga Jual</label>
								<input type="text" class="form-control validation" id="input-harga-jual" placeholder="Masukkan Harga Jual" name="harga_jual">
							</div>

						{{-- <div class="row mb-3">
							<label for="inputName" class="col-sm-3 col-form-label">Nama <span class="text-danger">*)</span></label>
							<div class="col-sm-9">
								<input type="hidden" class="form-control" id="pembelian-id" name="id_pembelian" value="{{ $pembelian->id ?? '' }}">
								<input type="text" class="form-control" id="inputName" name="name" placeholder="Masukkan Nama" value="{{ $pembelian->name ?? '' }}">
							</div>
						</div>
						<div class="row mb-3">
							<label for="inputLevel" class="col-sm-3 col-form-label">Level User <span class="text-danger">*)</span></label>
							<div class="col-sm-9">
								<select class="single-select" id="inputLevel" name="level">
									<option selected disabled>--PILIH OPSI--</option>
									<option value="admin">Admin</option>
									<option value="kasir">Kasir</option>
								</select>
							</div>
						</div>
						<div class="row mb-3">
							<label for="inputUsername" class="col-sm-3 col-form-label">Username <span class="text-danger">*)</span></label>
							<div class="col-sm-9">
								<input class="form-control" id="inputUsername" name="username" placeholder="Masukkan Username" value="{{ $pembelian->username ?? '' }}">
							</div>
						</div>
						<div class="row mb-3">
							<label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" id="inputEmail" name="email" placeholder="Masukkan Email" value="{{ $pembelian->email ?? '' }}">
							</div>
						</div>
						<div class="row mb-5">
							<label for="inputPassword" class="col-sm-3 col-form-label">Password {!!$pembelian ? '' : '<span class="text-danger">*)</span>'!!}</label>
							<div class="col-sm-9">
								<div class="input-group input-group-md" id="show_hide_password">
									<input type="password" class="form-control" id="inputPassword" name="password" placeholder="Masukkan Password" autocomplete="new-password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
								</div>
							</div>
						</div> --}}
						</div>
						
						<div class="row">
							<div
								class="col-12"
								style="display: grid; justify-content: end;"
							>
								{{-- <button type="button" class="btn btn-secondary px-3" id="btn-back-form-pembelian">
									<i class="fadeIn animated bx bx-left-arrow"></i> Kembali
								</button> --}}
								<button class="btn btn-sm btn-info px-2" id="btn-append-pembelian">Tambahkan Data</button>
							</div>
						</div>
					</form>
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
							<tbody id="container-produk"></tbody>
						</table>
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
				{{-- <div class="border p-4 rounded"> --}}
					{{-- <div class="card-title d-flex align-items-center">
						<div><i class="bx bxs-basket me-1 font-22 text-info"></i>
						</div>
						<h5 class="mb-0 text-secondary">Pembelian</h5>
					</div>
					<hr class="mb-4"/>
					<form id="form-pembelian">
						<div class="row mb-4">
							<label for="input-nomor-invoice" class="col-sm-3 col-form-label">Nomor Invoice <span class="text-danger">*)</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="input-nomor-invoice" placeholder="Masukkan nomor invoice">
							</div>
						</div>
						<div class="row mb-4">
							<label for="input-supplier" class="col-sm-3 col-form-label">Supplier <span class="text-danger">*)</span></label>
							<div class="col-sm-9">
								<select class="single-select" id="input-supplier" name="level">
									<option selected disabled>--PILIH OPSI--</option>
									@foreach ($supplier ?? [] as $item)
									<option value="{{$item->id}}">{{$item->nama}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="row mb-4">
							<label for="inputLevel" class="col-sm-3 col-form-label">Tanggal Pembelian <span class="text-danger">*)</span></label>
							<div class="col-sm-9">
								<input type="date" class="form-control" id="inputFirstName">
							</div>
						</div>
						<hr class="mb-4"/>
						<div class="row g-3 mb-4">
							<div class="col-md-6">
								<label for="input-produk" class="form-label">Produk</label>
								<select class="single-select" id="input-produk" name="level">
									<option selected disabled>--PILIH OPSI--</option>
									@foreach ($produk ?? [] as $item)
									<option value="{{$item->id}}">{{$item->kode_produk}} - {{strtoupper($item->nama_produk)}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-6">
								<label for="input-satuan" class="form-label">Satuan</label>
								<select class="single-select" id="input-satuan" name="satuan_id">
									<option selected disabled>--PILIH OPSI--</option>
									@foreach ($satuan ?? [] as $item)
									<option value="{{$item->id}}">{{strtoupper($item->nama)}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-6">
								<label for="input-jumlah" class="form-label">Jumlah</label>
								<input type="text" class="form-control" id="input-jumlah" placeholder="Masukkkan Jumlah Produk" name="jumlah">
							</div>
							<div class="col-md-6">
								<label for="input-tanggal-kedaluwarsa" class="form-label">Tanggal Kedaluwarsa</label>
								<input type="date" class="form-control" id="input-tanggal-kedaluwarsa" name="tanggal_kedaluwarsa">
							</div>
							<div class="col-md-6">
								<label for="input-harga-beli" class="form-label">Harga Beli</label>
								<input type="text" class="form-control" id="input-harga-beli" name="harga_beli">
							</div>
							<div class="col-md-6">
								<label for="input-harga-jual" class="form-label">Harga Jual</label>
								<input type="text" class="form-control" id="input-harga-jual" name="harga_jual">
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
								<button type="button" class="btn btn-secondary px-3" id="btn-back-form-pembelian">
									<i class="fadeIn animated bx bx-left-arrow"></i> Kembali
								</button>
								<button class="btn btn-info px-5" id="btn-save-form-pembelian">Simpan</button>
							</div>
						</div>
					</form> --}}
				{{-- </div> --}}
			</div>
		</div>
	</div>
</div>
<!--end row-->

<script>
	// function ubahFormat(v) {
	// 	// loopPajak();
	// 	// hitungHargaJual();
	// 	$(v).val(formatRupiah(v.value, "Rp. "));
	// }

	$(".container-input-produk input, .container-input-produk .validation").on('keyup', (e) => {
		const $this = $(e.currentTarget)
		if ($this.val()) {
			$this.removeClass('show-alert')
		}
	}).on('change', (e) => {
		const $this = $(e.currentTarget)
		if ($this.val()) {
			$this.removeClass('show-alert')
			$this.siblings(".select2-container").removeClass('show-alert')
		}
	})

	$("#btn-append-pembelian").click(async (e) => {
		e.preventDefault()
		let {message, text} = ""

		// Validasi sebelum append produk
		await $(".container-input-produk .validation").each(function (idx) {
			if (!$(this).val()) {
				$(this).addClass('show-alert')
				$(this).siblings(".select2-container").addClass('show-alert')
				if (!text) {
					text = $(this)[0].id.replace(/-/g, ' ').replace(/input /g, '')
					text = `${text[0].toUpperCase()}${text.slice(1)} wajib diisi!`
				};
			}
		})

		if (text) {
			return module.swal.warning({text: text})
		} else {
			console.log('tidak ada pesan')
		}
		
		// let namaProduk = $("#input-nama-produk").val()
		// let namaProduk = $("#nama-produk")
		// let html = `
		// 	<tr>
		// 		<td>2411PDK001 - PUPUK KOMPOS (PCS)</td>
		// 		<td>Rp. 10.000</td>
		// 		<td class='text-center'>10</td>
		// 		<td>Rp. 100.000</td>
		// 		<td>
		// 			<div class='text-center'>
		// 				<button type='button' class='btn btn-sm btn-danger px-2 btn-remove-pembelian' data-id='$item->id' title="Hapus">
		// 					<i class='fadeIn animated bx bx-trash'></i>
		// 				</button>
		// 				<button type='button' class='btn btn-sm btn-warning px-2 btn-modify-pembelian' data-id='$item->id' title="Edit">
		// 					<i class='fadeIn animated bx bx-pencil'></i>
		// 				</button>
		// 			</div>
		// 		</td>
		// 	</tr>
		// `
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
	});

	$("#btn-back-form-pembelian").click((e) => {
		$("#other-page").hide('slow', function () {
			$("#main-page").fadeIn()
			$("#other-page").empty()
		})
	})

	$("#btn-save-form-pembelian").click(async (e) => {
		e.preventDefault()
		const $this = $(e.currentTarget)
		$this.attr('disabled', true)

		const data = new FormData($("#form-pembelian")[0])

		const response = await postRequest("{{route('pembelian.store')}}", data)

		if (jQuery.inArray(response.status, [200, 201]) === -1) {
			await module.swal.warning({
				text: response.data.message,
				hideClass: module.var_swal.fadeOutUp,
			})

			return $this.attr('disabled', false)
		}

		await module.swal.success({
			title: response.data.message,
			text: '',
			showClass: module.var_swal.fadeInDown,
			hideClass: module.var_swal.fadeOutUp,
		})

		$this.attr('disabled', false)

		$("#other-page").hide('slow', async function () {
			await $("#main-page").fadeIn()
			await $("#other-page").empty()
			datatablePengguna()
		})

	})
</script>