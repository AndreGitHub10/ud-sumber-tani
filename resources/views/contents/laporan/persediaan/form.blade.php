<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">Tambah Uang Masuk/Keluar</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Form</li>
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
						<h5 class="mb-0 text-secondary">Uang Masuk/Keluar</h5>
					</div>
					<hr class="mb-4"/>
					<form id="form-persediaan">
						<div class="row g-3 mb-4" id="container-input-produk">
							<div class="col-md-12">
								<label for="input-nominal" class="form-label">Nominal <span class="text-danger">*)</span></label>
								<input type="text" class="form-control validation" id="input-nominal" name="nominal" placeholder="">
								<input type="hidden" class="form-control" id="id" name="id" placeholder="">
							</div>
							<div class="col-md-12">
								<label for="input-satuan" class="form-label">Masuk / Keluar <span class="text-danger">*)</span></label>
								<select class="single-select validation reset" id="type_id" name="type_id">
									<option value="1" {{$uang?$uang->type_id=='1'? 'selected' : '' :''}}>Masuk</option>
									<option value="2" {{$uang?$uang->type_id=='2'? 'selected' : '' :''}}>Keluar</option>
								</select>
							</div>
							<div class="mb-3">
								<label class="form-label">Tanggal dan Waktu</label>
								<input type="text" class="form-control date-time" name="tanggal_waktu"/>
							</div>
							<div class="mb-3">
								<label class="form-label">Keterangan</label>
								<textarea name="keterangan" id="keterangan" class="form-control validation reset" cols="30" rows="10">{{$uang?$uang->keterangan:''}}</textarea>
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
							<button class="btn btn-sm btn-success px-5" id="btn-save-form-persediaan">Simpan</button>
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
	$(".date-time").flatpickr({
		enableTime: true,
		dateFormat: "Y-m-d H:i",
		defaultDate: `{{$uang? date('Y-m-d H:i',strtotime($uang->tanggal_waktu)) : date('Y-m-d H:i')}}`
	});
	$("#input-nominal").setRules('0-9').on('keyup', (e)=>{
		$this = $(e.currentTarget)
		$this.val(module.formatter.formatRupiah($this.val(), 'Rp. '))
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

	$("#btn-save-form-persediaan").click(async function(e) {
		e.preventDefault()
		// $(this).attr('disabled', true)

		let validation = module.validator.form($("#form-persediaan .validation"))
		if (validation) {
			return module.swal.warning({text: validation})
		}

		const data = new FormData($("#form-persediaan")[0])
		data.append('jumlah',module.parse.onlyNumber($('#input-nominal').val()))

		const response = await postRequest("{{route('laporan.persediaan.store')}}", data)
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