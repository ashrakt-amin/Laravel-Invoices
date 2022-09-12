@extends('layouts.master')

@section('title')
Home
@stop

@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="left-content">
		<div>
			<h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, welcome back!</h2>
			<p class="mg-b-0">invoices dashborad</p>
		</div>
	</div>
	<div class="main-dashboard-header-right">
		<div>
			<label class="tx-13"></label>
			<div class="main-star">
			</div>
		</div>
		<div>
			<label class="tx-13"></label>
			<h5></h5>
		</div>
		<div>
			<label class="tx-13"></label>
			<h5></h5>
		</div>
	</div>
</div>
<!-- /breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row row-sm" style="width:80%">
	<div class="col-xl-3 col-lg-6 col-md-6">
		<div class="card overflow-hidden sales-card bg-primary-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">Total Invoices</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-3 text-white">
								{{number_format(\App\Models\Invoices::sum('total'),2)}}
							</h4>
							<p class="mb-0 tx-12 text-white op-7">
								Number Of Invoices : {{\App\Models\Invoices::count()}}
							</p>
						</div>
						<span class="float-right my-auto mr-auto">
							<i class="fas fa-arrow-circle-up text-white"></i>
							<span class="text-white op-7"> 100%</span>
						</span>
					</div>
				</div>
			</div>
			<span id="compositeline" class="pt-1"></span>
		</div>
	</div>
	<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-danger-gradient" style="background-color:#90B77D">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">Paid Invoices</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-3 text-white">
								{{number_format(\App\Models\Invoices::where('value_status',1)->sum('total')),2}}

							</h4>
							<p class="mb-0 tx-12 text-white op-7">
								Number Of Un Paid Invoices : {{\App\Models\Invoices::where('value_status',1)->count()}}

							</p>
						</div>
						<span class="float-right my-auto mr-auto">
							<i class="fas fa-arrow-circle-down text-white"></i>
							<span class="text-white op-7">
								{{round((\App\Models\Invoices::where('value_status',1)->count() / \App\Models\Invoices::count())*100)}}%


							</span>
						</span>
					</div>
				</div>
			</div>
			<span id="compositeline2" class="pt-1"></span>
		</div>
	</div>
	<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-success-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">Un Paid Invoices</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-3 text-white">
								{{number_format(\App\Models\Invoices::where('value_status',0)->sum('total')),2}}

							</h4>
							<p class="mb-0 tx-12 text-white op-7">
								Un Paid Invoices Num : {{\App\Models\Invoices::where('value_status',0)->count()}}

							</p>
						</div>
						<span class="float-right my-auto mr-auto">
							<i class="fas fa-arrow-circle-up text-white"></i>
							<span class="text-white op-7">
								{{round((\App\Models\Invoices::where('value_status',0)->count() / \App\Models\Invoices::count())*100)}}%</span>
						</span>
					</div>
				</div>
			</div>
			<span id="compositeline3" class="pt-1"></span>
		</div>
	</div>
	<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-warning-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">Parial In voices</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-3 text-white">
								{{number_format(\App\Models\Invoices::where('value_status',2)->sum('total')),2}}

							</h4>
							<p class="mb-0 tx-12 text-white op-7">
								Partial Invoices Num : {{round((\App\Models\Invoices::where('value_status',1)->count() / \App\Models\Invoices::count())*100)}}%

							</p>
						</div>
						<span class="float-right my-auto mr-auto">
							<i class="fas fa-arrow-circle-down text-white"></i>
							<span class="text-white op-7">{{round((\App\Models\Invoices::where('value_status',2)->count() / \App\Models\Invoices::count())*100)}}%</span>
						</span>
					</div>
				</div>
			</div>
			<span id="compositeline4" class="pt-1"></span>
		</div>
	</div>
</div>
<!-- row closed -->

<!-- row opened -->
<div class="chart">
<h2 class="mb-3 text-center">Statistical ratio of invoices</h2>
<div class="row " >
	


		<div class="card col-md-5" style="margin:0px 10px" >

			{!! $chartjs->render() !!}
		</div>
	

	<div class="card col-md-5"  style="margin:0px 10px">
		{!! $chart->render() !!}

	</div>
</div>
</div>

<!-- row closed -->



</div>
</div>
<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
@endsection