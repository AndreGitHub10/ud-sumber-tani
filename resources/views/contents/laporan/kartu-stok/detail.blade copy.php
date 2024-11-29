<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">Kartu Stok</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Detail Stok</li>
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
						<h5 class="mb-0 text-secondary">Kartu Stok</h5>
					</div>
					<hr class="mb-4"/>
                    <div class="row">
                        <div class="col-md-8">
                            <form id="form-invoice">
                                <div class="row mb-4">
                                    <label for="input-nomor-invoice" class="col-sm-3 col-form-label fw-bold">Kode Produk</label>
                                    <label class="col-sm-3 col-form-label">: {{$produk->kode_produk}}</label>
                                    <input type="hidden" name="kode_produk" id="kode_produk" value="{{$produk->kode_produk}}">
                                </div>
                                <div class="row mb-4">
                                    <label for="input-nomor-invoice" class="col-sm-3 col-form-label fw-bold">Nama Produk</label>
                                    <label class="col-sm-3 col-form-label">: {{$produk->nama_produk}}</label>
                                </div>
                                <div class="row mb-4">
                                    <label for="input-nomor-invoice" class="col-sm-3 col-form-label fw-bold">Kategori</label>
                                    <label class="col-sm-3 col-form-label">: {{$produk->kategori ? $produk->kategori->nama : ''}}</label>
                                </div>
                                <div class="row mb-4">
                                    <label for="satuan_id" class="col-sm-3 col-form-label fw-bold">Satuan <span class="text-danger">*)</span></label>
                                    <div class="col-sm-9">
                                        <select class="single-select validation" id="satuan_id" onchange="filter()">
                                            <option selected disabled>--PILIH OPSI--</option>
                                            @foreach ($produk->v_kartu_stok ?? [] as $item)
                                            <option value="{{$item->satuan_id}}">{{$item->satuan_produk ? $item->satuan_produk->nama : ''}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="input-nomor-invoice" class="col-sm-3 col-form-label fw-bold">Sisa</label>
                                    <label class="col-sm-3 col-form-label">: <span class="sisa"></span></label>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <img src="{{$produk->foto}}" class="img-fluid" alt="...">
                        </div>
                    </div>

					<hr class="mb-4"/>

                    <div class="table-responsive">
                        <table id="datatable-kartu-stok-detail" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Invoice</th>
                                    <th>Tanggal</th>
                                    <th>Stok Masuk</th>
                                    <th>Stok Keluar</th>
                                    <th>Sisa Stok</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

					<div class="row">
						<div class="col-4">
							<button type="button" class="btn btn-secondary px-3" id="btn-back-form-pembelian">
								<i class="fadeIn animated bx bx-left-arrow"></i> Kembali
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
    $(async () => {
        datatableKartuStokDetail()
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

    async function filter() {
        await datatableKartuStokDetail($('#kode_produk').val(),$('#satuan_id').val())
    }

    async function datatableKartuStokDetail(kode_produk=$('#kode_produk').val(),satuan_id=$('#satuan_id').val()){
			await $('#datatable-kartu-stok-detail').dataTable({
				scrollX: true,
				bPaginate: true,
				bFilter: true,
				bDestroy: true,
				processing: true,
				serverSide: false,
				columnDefs: [{
					orderable: false,
					targets: [1,2,3,4,5]
				}],
				ajax: {
					url:"{{route('laporan.kartuStok.datatablesDetail')}}",
					type: 'post',
                    data: {
                        kode_produk:kode_produk,
                        satuan_id:satuan_id
                    }
				},
				columns: [
					{data: 'DT_RowIndex', name: 'DT_RowIndex'},
					{data: 'nomor_invoice', name: 'nomor_invoice'},
					{data: 'tanggal', name: 'tanggal'},
					{data: 'stok_masuk', name: 'stok_masuk'},
					{data: 'stok_keluar', name: 'stok_keluar'},
					{data: 'sisa_stok', name: 'sisa_stok'}
				],
                drawCallback: function (settings, json) {
                    $('.sisa').html(json.stok_akhir)
                }
			})
		}
</script>