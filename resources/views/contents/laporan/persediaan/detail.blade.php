<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">Persediaan</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Detail Persediaan</li>
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
						<h5 class="mb-0 text-secondary">Detail Persediaan</h5>
					</div>
					<hr class="mb-4"/>
                    <form id="form-invoice">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-4">
                                    <label for="input-nomor-invoice" class="col-sm-4 col-form-label fw-bold">Tanggal</label>
                                    <label class="col-sm-8 col-form-label">: {{$tanggal}}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row mb-4">
                                    <label for="input-nomor-invoice" class="col-sm-4 col-form-label fw-bold">Uang Awal</label>
                                    <label class="col-sm-8 col-form-label">: Rp. {{number_format($uang_awal,2,',','.')}}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row mb-4">
                                    <label for="input-nomor-invoice" class="col-sm-4 col-form-label fw-bold">Uang Akhir</label>
                                    <label class="col-sm-8 col-form-label">: Rp. {{number_format($uang_akhir,2,',','.')}}</label>
                                </div>
                            </div>
                        </div>
                    </form>

					<hr class="mb-4"/>

                    <div class="table-responsive">
                        <table id="datatable-penjualan-detail" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Keterangan</th>
                                    <th>Nilai Awal</th>
                                    <th>Masuk</th>
                                    <th>Keluar</th>
                                    <th>Nilai Akhir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($uang ?? [] as $item)
                                    <tr>
                                        <th>{{$loop->index+1}}</th>
                                        <th>{{$item->keterangan}}</th>
                                        <th>{{number_format($item->uang_awal,2,',','.')}}</th>
                                        <th>{{number_format($item->masuk,2,',','.')}}</th>
                                        <th>{{number_format($item->keluar,2,',','.')}}</th>
                                        <th>{{number_format($item->uang_akhir,2,',','.')}}</th>
                                        @if ($item->uang_masuk_id != null)
                                        <th>
                                            <div class='text-center'>
                                                <button type='button' class='btn btn-sm btn-warning px-2 btn-edit' data-id='{{$item->uang_masuk_id}}'>
                                                    <i class='fadeIn animated bx bx-pencil'></i>
                                                </button>
                                                <button type='button' class='btn btn-sm btn-danger px-2 btn-delete' data-id='{{$item->uang_masuk_id}}'>
                                                    <i class='fadeIn animated bx bx-trash'></i>
                                                </button>
                                            </div>
                                        </th>
                                        @else 
                                        <th>-</th>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

					<div class="row">
						<div class="col-4">
							<button type="button" class="btn btn-secondary px-3" id="btn-back-detail-penjualan">
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

    $("#datatable-penjualan-detail").on('click', '.btn-edit', async function(e) {
        e.preventDefault()
        let $this = $(e.currentTarget)
        $this.attr('disabled', true)

        let response = await postRequest("{{route('laporan.persediaan.form')}}", {id: $this.data('id')})
        
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

    $("#datatable-penjualan-detail").on('click', '.btn-delete', async function(e) {
        e.preventDefault()
        let $this = $(e.currentTarget)
        $this.attr('disabled', true)

        module.swal.confirm().then(async (e) => {
            if (e.value) {
                const response = await postRequest("{{route('laporan.persediaan.destroy')}}", {id: $this.data('id')})
                code = response.data.code

                if (code != 200) {
                    await module.swal.warning({
                        text: code !== 204 ? response.data.message : 'Data tidak ditemukan, silahkan reload halaman terlebih dahulu!'
                    })

                    return $this.attr('disabled', false)
                }

                await module.swal.success({
                    text: response.data.message,
                    hideClass: module.var_swal.fadeOutUp,
                })

                $("#other-page").hide('slow', function () {
                    $("#main-page").fadeIn()
                    $("#other-page").empty()
                })
            }
            $this.attr('disabled', false)
        })
    })

    $("#btn-back-detail-penjualan").click((e) => {
		$("#other-page").hide('slow', function () {
			$("#main-page").fadeIn()
			$("#other-page").empty()
		})
        datatableMinMax($('#date_range').val())
	})

    async function datatableKartuStokDetail(){
			await $('#datatable-penjualan-detail').dataTable({
				scrollX: true,
				bPaginate: true,
				bFilter: true,
				bDestroy: true,
				processing: true,
				serverSide: false,
				columnDefs: [{
					orderable: false,
					targets: [1,2,3,4,5]
				}]
			})
		}
</script>