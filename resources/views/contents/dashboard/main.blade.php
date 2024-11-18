@extends('main')

@push('styles')
	<link href="{{asset('assets/plugins/highcharts/css/highcharts.css')}}" rel="stylesheet" />
@endpush

@section('content')
	<div class="row row-cols-1 row-cols-lg-3">
		<div class="col">
			<div class="card radius-10">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div class="flex-grow-1">
							<p class="mb-0">Penjualan Harian</p>
							<h4 class="font-weight-bold">{{number_format($terjual_harian,0,',','.')}}<small class="text-success font-13"></small></h4>
							<p class="text-secondary mb-0 font-13">Produk terjual {{date('d-m-Y')}}</p>
						</div>
						<div class="widgets-icons bg-gradient-cosmic text-white"><i class='bx bx-package'></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card radius-10">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div class="flex-grow-1">
							<p class="mb-0">Penjualan Bulanan</p>
							<h4 class="font-weight-bold">{{number_format($terjual_bulanan,0,',','.')}}<small class="text-success font-13"></small></h4>
							<p class="text-secondary mb-0 font-13">Produk terjual ({{date('1-m-Y')}} - {{date('t-m-Y')}})</p>
						</div>
						<div class="widgets-icons bg-gradient-burning text-white"><i class='bx bx-package'></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card radius-10">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div class="flex-grow-1">
							<p class="mb-0">Pendapatan Harian</p>
							<h4 class="font-weight-bold">Rp. {{number_format($pendapatan_harian,0,',','.')}}<small class="text-success font-13"></small></h4>
							<p class="text-secondary mb-0 font-13">{{date('d-m-Y')}}</p>
						</div>
						<div class="widgets-icons bg-gradient-lush text-white"><i class='bx bx-money'></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card radius-10">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div class="flex-grow-1">
							<p class="mb-0">Pendapatan Bulanan</p>
							<h4 class="font-weight-bold">Rp. {{number_format($pendapatan_bulanan,0,',','.')}}</h4>
							<p class="text-secondary mb-0 font-13">{{date('1-m-Y')}} - {{date('t-m-Y')}}</p>
						</div>
						<div class="widgets-icons bg-gradient-kyoto text-white"><i class='bx bx-money'></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card radius-10">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div class="flex-grow-1">
							<p class="mb-0">Uang Masuk</p>
							<h4 class="font-weight-bold">Rp. {{number_format($uang_masuk,0,',','.')}}<small class="text-danger font-13"></small></h4>
							<p class="text-secondary mb-0 font-13">{{date('1-m-Y')}} - {{date('t-m-Y')}}</p>
						</div>
						<div class="widgets-icons bg-gradient-blues text-white"><i class='bx bx-money'></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card radius-10">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div class="flex-grow-1">
							<p class="mb-0">Uang Keluar</p>
							<h4 class="font-weight-bold">Rp. {{number_format($uang_keluar,0,',','.')}}<small class="text-danger font-13"></small></h4>
							<p class="text-secondary mb-0 font-13">{{date('1-m-Y')}} - {{date('t-m-Y')}}</p>
						</div>
						<div class="widgets-icons bg-gradient-moonlit text-white"><i class='bx bx-money'></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end row-->
	<div class="row">
		<div class="col-12 col-lg-6">
			<div class="card radius-10">
				<div class="card-body">
					<div id="chart1"></div>
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-6">
			<div class="card radius-10">
				<div class="card-body">
					<div id="chart2"></div>
				</div>
			</div>
		</div>
	</div>
	<!--end row-->
	<div class="row">
		<div class="col-12 col-lg-8 d-lg-flex align-items-lg-stretch">
			<div class="card radius-10 w-100">
				<div class="card-header border-bottom-0 bg-transparent">
					<div class="d-lg-flex align-items-center">
						<div class="">
							<h5 class="mb-1">Website Audience Overview</h5>
							<p class="text-secondary mb-2 mb-lg-0 font-14">There are plenty of free web proxy sites that you can use</p>
						</div>
						<div class="ms-lg-auto">
							<div class="btn-group-round">
								<div class="btn-group">
									<button type="button" class="btn btn-white">Day</button>
									<button type="button" class="btn btn-white">Week</button>
									<button type="button" class="btn btn-white">Month</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div id="chart3"></div>
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-4 d-lg-flex align-items-lg-stretch">
			<div class="card radius-10 w-100">
				<div class="card-header bg-transparent">Traffic Sources</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped mb-0">
							<thead>
								<tr>
									<th>Source</th>
									<th>Visitors</th>
									<th>Bounce Rate</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>(direct)</td>
									<td>56</td>
									<td>10%</td>
								</tr>
								<tr>
									<td>google</td>
									<td>29</td>
									<td>12%</td>
								</tr>
								<tr>
									<td>linkedin.com</td>
									<td>68</td>
									<td>33%</td>
								</tr>
								<tr>
									<td>bing</td>
									<td>14</td>
									<td>24%</td>
								</tr>
								<tr>
									<td>facebook.com</td>
									<td>87</td>
									<td>22%</td>
								</tr>
								<tr>
									<td>other</td>
									<td>98</td>
									<td>27%</td>
								</tr>
								<tr>
									<td>linkedin.com</td>
									<td>68</td>
									<td>33%</td>
								</tr>
								<tr>
									<td>bing</td>
									<td>14</td>
									<td>24%</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end row-->
		
	<div class="row row-cols-1 row-cols-lg-3">
		<div class="col">
			<div class="card radius-10">
				<div class="card-body">
					<div id="chart4"></div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card radius-10">
				<div class="card-body">
					<div id="chart5"></div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card radius-10">
				<div class="card-body">
					<div id="chart6"></div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<!-- highcharts js -->
	<script src="{{asset('assets/plugins/highcharts/js/highcharts.js')}}"></script>
	<script src="{{asset('assets/plugins/highcharts/js/highcharts-more.js')}}"></script>
	<script src="{{asset('assets/plugins/highcharts/js/variable-pie.js')}}"></script>
	<script src="{{asset('assets/plugins/highcharts/js/solid-gauge.js')}}"></script>
	<script src="{{asset('assets/plugins/highcharts/js/highcharts-3d.js')}}"></script>
	<script src="{{asset('assets/plugins/highcharts/js/cylinder.js')}}"></script>
	<script src="{{asset('assets/plugins/highcharts/js/funnel3d.js')}}"></script>
	<script src="{{asset('assets/plugins/highcharts/js/exporting.js')}}"></script>
	<script src="{{asset('assets/plugins/highcharts/js/export-data.js')}}"></script>
	<script src="{{asset('assets/plugins/highcharts/js/accessibility.js')}}"></script>
	<script src="{{asset('assets/js/index4.js')}}"></script>
@endpush