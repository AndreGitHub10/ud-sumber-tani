<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">Data Master</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
                <li class="breadcrumb-item active" aria-current="page">Produk</li>
				<li class="breadcrumb-item active" aria-current="page">Form Kategori</li>
			</ol>
		</nav>
	</div>
</div>
<!--end breadcrumb-->

<!--end row-->
<div class="row">
	<div class="col-xl-10 mx-auto">
		<div class="card border-top border-0 border-4 border-info">
			<div class="card-body">
				<div class="border p-4 rounded">
					<div class="card-title d-flex align-items-center">
						<div><i class="bx bx-unite me-1 font-22 text-info"></i>
						</div>
						<h5 class="mb-0 text-info">Kategori</h5>
					</div>
					<hr/>
					<form id="form-data-kategori">
						<div class="row mb-5">
							<label for="inputName" class="col-sm-3 col-form-label">Nama Kategori</label>
							<div class="col-sm-9">
								<input type="hidden" class="form-control" id="kategori-id" name="id_kategori" value="{{ $kategori->id ?? '' }}">
								<input type="hidden" class="form-control" id="model-kategori" name="model_kategori" value="{{ $kategori->id ?? '' }}">
								<input type="text" class="form-control" id="inputName" name="nama" placeholder="Masukkan Nama Kategori" value="{{ $kategori->nama ?? '' }}">
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
								<button type="button" class="btn btn-sm btn-secondary px-3" id="btn-back-form-kategori">
									<i class="fadeIn animated bx bx-left-arrow"></i> Kembali
								</button>
								<button class="btn btn-sm btn-info px-4" id="btn-save-form-kategori">Simpan</button>
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
	
	$("#btn-back-form-kategori").click((e) => {
		$("#other-page").hide('slow', function () {
			$("#main-page").fadeIn()
			$("#other-page").empty()
		})
	})

	$("#btn-save-form-kategori").click(async (e) => {
		e.preventDefault()
		const $this = $(e.currentTarget)
		$this.attr('disabled', true)

		const data = new FormData($("#form-data-kategori")[0])

		const response = await postRequest("{{route('dataMaster.produk.kategori.store')}}", data)

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
			datatableKategori()
		})

	})
</script>