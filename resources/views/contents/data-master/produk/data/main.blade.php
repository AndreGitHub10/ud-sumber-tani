@extends('main')

@push('styles')
	<link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
	
	<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
@endpush

@section('content')
	<div id="main-page">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Data Master</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Produk</li>
						<li class="breadcrumb-item active" aria-current="page">Data</li>
					</ol>
				</nav>
			</div>
		</div>
		<!--end breadcrumb-->

		<div class="card">
			<div class="card-header">
				<div class="col-12">
					<button type="button" class="btn btn-primary px-3" id="add-new-data">
						<i class="fadeIn animated bx bx-plus"></i>Tambah Data Baru
					</button>
					<button type="button" class="btn btn-success px-3" id="import-new-data">
						<i class="fadeIn animated bx bx-plus"></i>Import Data Baru
					</button>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-3 mb-3">
						<label for="kategori" class="form-label fw-bold">Ketegori</label>
						<select class="single-select validation" id="kategori" onchange="filter()">
							<option value="" selected>Semua</option>
							@foreach ($kategori ?? [] as $item)
								<option value="{{$item->id}}">{{$item->nama}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="table-responsive">
					<table id="datatable-data" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode</th>
								<th>Nama</th>
								<th>Kategori</th>
								<th>Supplier</th>
								<th>Harga Beli Terbaru</th>
								<th>Harga Jual Terbaru</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="hargaModel" tabindex="-1" aria-labelledby="hargaModelLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="hargaModelLabel">Pilih Produk</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<table class="table table-striped" id="tbl-list-produk-scanner">
					<thead>
						<th>
							<td>Tanggal</td>
							<td>Satuan</td>
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
	<div id="other-page" style="display:none;"></div>
@endsection

@push('scripts')
	<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>

	<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>

	<script>
		var hargaModel = new bootstrap.Modal(document.getElementById('hargaModel'), {keyboard : false})
		$(async () => {
			// initModul() in "scripts.main.blade.php"
			module = await initModul()
			console.log(module)

			filter()

		})

		function initPilihBtn() {
			$(".btn-pilih-barcode").click(async (e) => {
				let $this = $(e.currentTarget)
				// return module.swal.warning({text: 'Masih tahap pengembangan!'})
				let barcode = $this.data('barcode')
				let harga = $this.data('harga')
				window.open("{{route('dataMaster.produk.data.barcode')}}/"+barcode+'/'+harga)
				
			})
		}

		$('.single-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		})

		function initButton(){
			$(".btn-edit-data-produk").click(async (e) => {
				let $this = $(e.currentTarget)
                const id = $this.data('id')
				$this.attr('disabled', true)

				let response = await postRequest("{{route('dataMaster.produk.data.form')}}", {id_data_produk: id, model_data_produk: id})

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

			$(".btn-delete-data-produk").click(async (e) => {
				let $this = $(e.currentTarget)
				const id = $this.data('id')
				$this.attr('disabled', true)

				module.swal.confirm().then(async (e) => {
					if(e.value === true){
						const response = await postRequest("{{route('dataMaster.produk.data.destroy')}}", {id_data_produk: id, model_data_produk: id, is_destroy: true})
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

						filter()
					}
					$this.attr('disabled', false)
				})
			})
			$(".btn-print-barcode").click(async (e) => {
				let $this = $(e.currentTarget)
				const id = $this.data('id')
				$this.attr('disabled', true)
				// window.open("{{route('dataMaster.produk.data.barcode')}}/"+id)
				const responses = await postRequest("{{route('dataMaster.produk.data.getHargaList')}}", {barcode:id})
				if (jQuery.inArray(responses.status, [200, 201]) === -1) {
					await module.swal.warning({
						text: responses.data.message,
						hideClass: module.var_swal.fadeOutUp,
					})

					return $(this).attr('disabled', false)
				}
				await module.swal.success({
					title: responses.data.message,
					text: '',
					showClass: module.var_swal.fadeInDown,
					hideClass: module.var_swal.fadeOutUp,
				})
				console.log(responses);
				
				if (JSON.parse(responses.data.response).length > 0) {

					let htmlList = '';
					console.log(JSON.parse(responses.data.response));
					$.each(JSON.parse(responses.data.response), function (i, v) {
						
						htmlList += `<tr>
								<td>
									${v.data_produk.nama_produk}
									<input type="hidden" value="${v.harga_jual}" id="harga_jual_${i}" />
								</td>
								<td>
									`+v.tanggal.split('-')[2]+`/`+v.tanggal.split('-')[1]+`/`+v.tanggal.split('-')[0]+`
								</td>
								<td>
									${v.satuan.nama}
								</td>
								<td>
									${v.harga_jual}
								</td>
								<td>
									<button class="btn btn-sm btn-info text-light btn-pilih-barcode" data-harga="${v.harga_jual}" data-barcode="${id}">Pilih</button>
								</td>
							</tr>`
					});
					$('#tbl-list-produk-scanner tbody').html(htmlList)
					hargaModel.show()
					initPilihBtn()
				}

				$this.attr('disabled', false)
			})
		}

		$("#add-new-data").click(async (e) => {
			const $this = $(e.currentTarget)
			$this.attr('disabled', true)
			let response = await postRequest("{{route('dataMaster.produk.data.form')}}")

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

		$("#import-new-data").click(async (e) => {
			const $this = $(e.currentTarget)
			$this.attr('disabled', true)
			let response = await postRequest("{{route('dataMaster.produk.data.importForm')}}")

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

		function filter() {
			datatableDataProduk($('#kategori').val())
		}

		async function datatableDataProduk(kategori=$('#kategori').val()){
			await $('#datatable-data').dataTable({
				scrollX: true,
				bPaginate: true,
				bFilter: true,
				bDestroy: true,
				processing: true,
				serverSide: true,
				columnDefs: [{
					orderable: false,
					targets: 0
				}],
				ajax: {
					url:"{{route('dataMaster.produk.data.datatables')}}",
					type: 'post',
					data: {
						kategori: kategori
					}
				},
				columns: [
					{data: 'DT_RowIndex', name: 'DT_RowIndex'},
					{data: 'kode_produk', name: 'kode_produk'},
					{data: 'nama_produk', name: 'nama_produk'},
					{data: 'nama_kategori', name: 'nama_kategori'},
					{data: 'supplier', name: 'supplier'},
					{data: 'harga_beli', name: 'harga_beli'},
					{data: 'harga_jual', name: 'harga_jual'},
					{data: 'action', name: 'action'}
				],
				drawCallback: function (settings, json) {
					initButton()
					console.log('tes');
					
				}
			})
		}
	</script>
@endpush