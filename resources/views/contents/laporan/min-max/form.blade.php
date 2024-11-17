<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">Set Min Max Produk</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Form Min Max Produk</li>
			</ol>
		</nav>
	</div>
</div>
<div class="row">
	<div class="col-xl-12 mx-auto">
		<div class="card border-top border-0 border-4 border-info">
			<div class="card-body">
				<div class="border p-4 rounded">
					<div class="card-title d-flex align-items-center">
						<div><i class="bx bxs-basket me-1 font-22 text-info"></i>
						</div>
						<h5 class="mb-0 text-secondary">Min Max Produk</h5>
					</div>
					<hr class="mb-4"/>
					<form id="form-min-max">
						<div class="row g-3 mb-4" id="container-input-produk">
							<div class="col-md-6">
								<label for="input-nama-produk" class="form-label">Nama Produk <span class="text-danger">*)</span></label>
								<select class="single-select validation reset" id="input-nama-produk" name="kode_produk" onchange="setMinMax()">
									<option selected readonly value="">--PILIH OPSI--</option>
									@foreach ($produk ?? [] as $item)
									<option value="{{$item->kode_produk}}">{{$item->kode_produk}} - {{strtoupper($item->nama_produk)}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-6">
								<label for="input-satuan" class="form-label">Satuan (satuan jual) <span class="text-danger">*)</span></label>
								<select class="single-select validation reset" id="input-satuan" name="satuan_id" onchange="setMinMax()">
									<option selected readonly value="">--PILIH OPSI--</option>
									@foreach ($satuan ?? [] as $item)
									<option value="{{$item->id}}">{{strtoupper($item->nama)}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-6">
								<label for="input-minimal-stok" class="form-label">Minimal Stok <span class="text-danger">*)</span></label>
								<input type="number" class="form-control validation" id="input-minimal-stok" name="min_stok" placeholder="Masukkan minimal stok">
							</div>
							<div class="col-md-6">
								<label for="input-maksimal-stok" class="form-label">Maksimal Stok <span class="text-danger">*)</span></label>
								<input type="number" class="form-control validation" id="input-maksimal-stok" name="max_stok" placeholder="Masukkan maksimal stok">
							</div>
							<div class="col-12">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" role="switch" id="reminder" name="reminder" checked>
									<label class="form-check-label" for="reminder">Tampilkan peringatan jika barang habis?</label>
								</div>
							</div>
						</div>
					</form>

					<hr class="mb-4"/>

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
</div>

<script>
	// function ubahFormat(v) {
	// 	// loopPajak();
	// 	// hitungHargaJual();
	// 	$(v).val(formatRupiah(v.value, "Rp. "));
	// }
	$(function() {
		
	})

	$('.single-select').select2({
		theme: 'bootstrap4',
		width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
		placeholder: $(this).data('placeholder'),
		allowClear: Boolean($(this).data('allow-clear')),
	})

	$("#btn-back-form-pembelian").click((e) => {
		$("#other-page").hide('slow', function () {
			$("#main-page").fadeIn()
			$("#other-page").empty()
		})
	})

	$("#btn-save-form-pembelian").click(async function(e) {
		e.preventDefault()
		// $(this).attr('disabled', true)

		if($("#input-maksimal-stok").val() <= $("#input-minimal-stok").val()){
			return module.swal.warning({text: "Maksimal stok tidak boleh lebih kecil atau sama dengan Minimal stok."})
		}

		let validation = module.validator.form($("#form-invoice .validation"))
		if (validation) {
			return module.swal.warning({text: validation})
		}

		const data = new FormData($("#form-min-max")[0])

		const response = await postRequest("{{route('laporan.barangHabis.store')}}", data)
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
			datatableMinMax()
		})
	})

	async function setMinMax() {
		const data = new FormData()
		data.append('kode_produk',$('#input-nama-produk').val())
		data.append('satuan_id',$('#input-satuan').val())

		const response = await postRequest("{{route('laporan.barangHabis.getMinMax')}}", data)
		if (jQuery.inArray(response.status, [200, 201]) === -1) {
			await module.swal.warning({
				text: response.data.message,
				hideClass: module.var_swal.fadeOutUp,
			})

			return resetFormMinMax()
		}

		// await module.swal.success({
		// 	title: response.data.message,
		// 	text: '',
		// 	showClass: module.var_swal.fadeInDown,
		// 	hideClass: module.var_swal.fadeOutUp,
		// })

		if (response.data.response) {
			$('#input-minimal-stok').val(response.data.response.min_stok)
			$('#input-maksimal-stok').val(response.data.response.max_stok)
			if (response.data.response.reminder) {
				$('#reminder').attr('checked')
			} else {
				$('#reminder').removeAttr('checked')
			}
		} else {
			return resetFormMinMax()
		}

	}

	function resetFormMinMax() {
		$('#input-minimal-stok').val(0)
		$('#input-maksimal-stok').val(0)
		$('#reminder').attr('checked')
	}
</script>