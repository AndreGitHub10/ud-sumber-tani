<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">Data Master</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Form Supplier</li>
			</ol>
		</nav>
	</div>
</div>
<!--end breadcrumb-->

<!--end row-->
<div class="row">
	<div class="col-xl-9 mx-auto">
		<div class="card border-top border-0 border-4 border-info">
			<div class="card-body">
				<div class="border p-4 rounded">
					<div class="card-title d-flex align-items-center">
						<div><i class="bx bxs-user me-1 font-22 text-info"></i>
						</div>
						<h5 class="mb-0 text-info">Supplier</h5>
					</div>
					<hr/>
					<form id="form-data-supplier">
						<div class="row mb-3">
							<label for="inputNama" class="col-sm-3 col-form-label">Nama</label>
							<div class="col-sm-9">
								<input type="hidden" class="form-control" id="id-supplier" name="id_supplier" value="{{ $modelSupplier->id ?? '' }}">
								<input type="text" class="form-control" id="inputNama" name="nama" placeholder="Masukkan Nama" value="{{ $modelSupplier->nama ?? '' }}">
							</div>
						</div>
						<div class="row mb-3">
							<label for="inputNomorHp" class="col-sm-3 col-form-label">Nomor Hp</label>
							<div class="col-sm-9">
								<input type="number" class="form-control" id="inputNomorHp" name="nomor_hp" placeholder="Masukkan Nomor Hp" value="{{ $modelSupplier->nomor_hp ?? '' }}">
							</div>
						</div>
						<div class="row mb-3">
							<label for="inputAlamat" class="col-sm-3 col-form-label">Alamat</label>
							<div class="col-sm-9">
								<textarea class="form-control" id="inputAlamat" name="alamat" placeholder="Alamat..." rows="3">{{ $modelSupplier->alamat ?? '' }}</textarea>
							</div>
						</div>
						<div class="row mb-5">
							<label for="inputKeterangan" class="col-sm-3 col-form-label">Keterangan</label>
							<div class="col-sm-9">
								<textarea class="form-control" id="inputKeterangan" name="keterangan" placeholder="Keterangan..." rows="3">{{ $modelSupplier->keterangan ?? '' }}</textarea>
							</div>
						</div>
						<div class="row">
							<div
								class="col-sm-12"
								style="
									display: flex;
									justify-content: space-between;
								"
							>
								<button type="button" class="btn btn-secondary px-3" id="btn-back-form-supplier">
									<i class="fadeIn animated bx bx-left-arrow"></i> Kembali
								</button>
								<button class="btn btn-info px-5" id="btn-save-form-supplier">Simpan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!--end row-->

<script>
	$('.single-select').select2({
		theme: 'bootstrap4',
		width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
		placeholder: $(this).data('placeholder'),
		allowClear: Boolean($(this).data('allow-clear')),
	});
	
	$("#btn-back-form-supplier").click((e) => {
		$("#other-page").hide('slow', function () {
			$("#main-page").fadeIn()
			$("#other-page").empty()
		})
	})

	$("#btn-save-form-supplier").click(async (e) => {
		e.preventDefault()
		const $this = $(e.currentTarget)
		$this.attr('disabled', true)

		const data = new FormData($("#form-data-supplier")[0])

		const response = await postRequest("{{route('dataMaster.supplier.store')}}", data)

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
			datatableSupplier()
		})

	})
</script>