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

		<div class="row mb-3">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-header bg-secondary">
						<h5 class="mb-0 text-light">Form Master Konversi</h5>
					</div>
					<div class="card-body">
						<form id="form-master-konversi">
							<div class="row mb-2">
								<div class="col-4">
									<input type="hidden" id="id-konversi-satuan" name="id_konversi_satuan">
									<label for="satuan-asal" class="form-label">Dari Satuan</label>
									<div class="select2-middle">
										<select class="form-control select2 validation" id="satuan-asal" name="satuan_asal">
											<option value="" selected>--PILIH OPSI--</option>
											@foreach ($satuan ?? [] as $item)
											<option value="{{$item->id}}">{{strtoupper($item->nama)}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-1" style="display: grid; justify-content: center; align-items: end;  font-size: 3rem;">
									<h1 class="mx-0 my-0"><i class="fadeIn animated bx bx-chevrons-right"></i></h1>
								</div>
								<div class="col-4">
									<label for="input-ke-satuan" class="form-label">Ke Satuan</label>
									<div class="select2-middle">
										<select class="form-control select2 validation" id="input-ke-satuan" name="satuan_tujuan" disabled>
											<option value="" selected>Pilih Dari Satuan</option>
										</select>
									</div>
								</div>
								<div class="col-3">
									<label for="input-nilai-konversi" class="form-label">Nilai Konversi</label>
									<input type="text" class="form-control text-center validation" name="nilai_konversi" id="input-nilai-konversi">
								</div>
							</div>
							<div class="row">
								<div class="col-12 text-end" id="container-btn-form-master-satuan" style="display: none;">
									<button type="button" class="btn btn-sm btn-secondary btn-batal-master-konversi">Batal</button>
									&nbsp;
									<button type="button" class="btn btn-sm btn-success btn-simpan-master-konversi">Simpan</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xl-12 mx-auto">
				<div class="card" style="height: 100%;">
					<div class="card-header bg-success">
						<h5 class="mb-0 text-light">Data Master Konversi</h5>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="datatable-master-konversi" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Dari Satuan</th>
										<th>Ke Satuan</th>
										<th>Nilai</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
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

			await datatableMasaterKonversi()

			$('[data-bs-toggle="tooltip"]').tooltip({
				html: true
			})

			$("#input-nilai-konversi").setRules('0-9').on('keyup change', function() {
				$(this).removeClass('show-alert')
			})
		})
		
		async function datatableMasaterKonversi(){
			await $('#datatable-master-konversi').dataTable({
				scrollX: true,
				bPaginate: true,
				bFilter: true,
				bDestroy: true,
				processing: true,
				serverSide: true,
				searchDelay: 500,
				columnDefs: [{
					orderable: false,
					searchable: false,
					targets: 0
				}],
				ajax: {
					url:"{{route('dataMaster.konversi.datatables')}}",
					type: 'post',
				},
				columns: [
					{data: 'DT_RowIndex', name: 'DT_RowIndex'},
					{data: 'satuan_asal_nama', name: 'satuan_asal.nama'},
					{data: 'satuan_tujuan_nama', name: 'satuan_tujuan.nama'},
					{data: 'nilai_konversi', name: 'nilai_konversi'},
					{data: 'action', name: 'action'}
				],
				// initComplete: function (settings, json) {
				// 	initButton()
				// }
			})
		}

		$(".select2").select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		})

		$("#satuan-asal").change(async function() {
			if (!$(this).val()) {
				$("#input-nilai-konversi").val('')
				$("#container-btn-form-master-satuan").hide('slow')
				return $("#input-ke-satuan").attr('disabled', true).empty().append(`<option value="" selected>Pilih Dari Satuan</option>`)
			}

			$("#container-btn-form-master-satuan").show('slow')
			const response = await postRequest("{{route('dataMaster.produk.satuan.konversi')}}", {satuan_id: $(this).val()})
			const data = JSON.parse(response.data.response)

			var newOption = new Option('--PILIH OPSI--', '', false, true)
			$("#input-ke-satuan").attr('disabled', false).empty().append(newOption).trigger('change')
			$.each(data, function(index, item) {
				newOption = new Option(item.nama.toUpperCase(), item.id, false, false)
				$("#input-ke-satuan").append(newOption).trigger('change')
			})
		})
		$("#input-ke-satuan").change(async function() {
			if ($(this).val()) {
				$(this).siblings(".select2-container").removeClass('show-alert')
			}
		})

		$(".btn-batal-master-konversi").click(function(e) {
			e.preventDefault()

			$("#satuan-asal").val('').trigger('change')
			$("#id-konversi-satuan").val('')
		})

		$("#datatable-master-konversi").on('click', '.btn-delete-master-konversi', async function(e) {
			e.preventDefault()
			const $this = $(this)
			let id = $(this).data('id')
			$this.attr('disabled', true)

			module.swal.confirm().then(async function(e) {
				if (e.value === true) {
					const response = await postRequest("{{route('dataMaster.konversi.destroy')}}", {id_konversi_satuan: id, model_konversi_satuan: id, is_destroy: true})
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

					datatableMasaterKonversi()
				}

				$this.attr('disabled', false)
			})
		})

		$("#datatable-master-konversi").on('click', '.btn-edit-master-konversi', async function(e) {
			e.preventDefault()

			let id = $(this).data('id')
			let satuanAsal = $(this).data('satuan-asal')
			let satuanTujuan = $(this).data('input-ke-satuan')
			let nilaiKonversi = $(this).data('nilai-konversi')

			await $("#satuan-asal").val(satuanAsal).trigger('change')
			setTimeout(() => {
				$("#input-ke-satuan").val(satuanTujuan).trigger('change')
				$("#input-nilai-konversi").val(nilaiKonversi)
			}, 500)

			$("#id-konversi-satuan").val(id)
		})

		$(".btn-simpan-master-konversi").click(async function(e) {
			e.preventDefault()

			const validation = module.validator.form($("#form-master-konversi .validation"))
			if (validation) {
				return module.swal.warning({text: validation})
			}

			const data = new FormData($("#form-master-konversi")[0])
			const response = await postRequest("{{route('dataMaster.konversi.store')}}", data)

			if (jQuery.inArray(response.status, [200, 201]) === -1) {
				return module.swal.warning({
					text: response.data.message,
					hideClass: module.var_swal.fadeOutUp,
				})
			}

			await module.swal.success({text: response.data.message})

			datatableMasaterKonversi()

			await $("#satuan-asal").val('').trigger('change')
			$("#id-konversi-satuan").val('')
		})
	</script>
@endpush