@extends('layouts.master')

@section('title')
Invoices List
@stop

@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		

		@can('add invoice ')
		<a class="modal-effect btn btn-outline-primary btn-block" href="{{route('invoices.create')}}">add invoice</a>
	    @endcan
	</div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row opened -->
<div class="row row-sm">



	<!--div-->
	<div class="col-xl-10">
		<div class="card " style="margin-bottom:20px">
			<div class="card-header pb-0">
				<div class="d-flex justify-content-between">
					<h4 class="card-title mg-b-0">Bordered Table</h4>
					<i class="mdi mdi-dots-horizontal text-gray"></i>
				</div>
				<p class="tx-12 tx-gray-500 mb-2">Example of Valex Bordered Table.. <a href="">Learn more</a></p>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="example" class="table key-buttons text-md-nowrap">
						<thead>
							<tr>
								<th class="border-bottom-0">#</th>
								<th class="border-bottom-0">num</th>
								<th class="border-bottom-0">date</th>
								<th class="border-bottom-0">due date</th>
								<th class="border-bottom-0">Product</th>
								<th class="border-bottom-0">Category</th>
								<th class="border-bottom-0">discount</th>
								<th class="border-bottom-0">Vale VAT</th>
								<th class="border-bottom-0">Rate VAT</th>
								<th class="border-bottom-0">Amount collection</th>
								<th class="border-bottom-0">Amount Commission</th>
								<th class="border-bottom-0">Total</th>
								<th class="border-bottom-0">Status</th>
								<th class="border-bottom-0">Note</th>
								<th class="border-bottom-0">pro</th>


							</tr>
						</thead>
						<tbody>

							@foreach($invoices as $invoice)
							<tr>
								<td>{{$loop->iteration}}</td>
								<td>{{$invoice->invoice_number}}</td>
								<td>{{$invoice->invoice_date}}</td>
								<td>{{$invoice->due_date}}</td>
								<td>{{$invoice->product}}</td>
								<td><a href="{{route('details.show',$invoice->id)}}">{{$invoice->section->name}}</a></td>
								<td>{{$invoice->discount}}</td>
								<td>{{$invoice->value_vat}}</td>
								<td>{{$invoice->rate_vat}}</td>
								<td>{{$invoice->Amount_collection}}</td>
								<td>{{$invoice->Amount_Commission}}</td>
								<td>{{$invoice->total}}</td>
								<td>
									@if($invoice->value_status == 0)
								<span class="text-danger">{{$invoice->status}}</span>
								@elseif($invoice->value_status == 1)
								<span class="text-success">{{$invoice->status}}</span>
								@else
								<span class="text-warning">{{$invoice->status}}</span>
								@endif
								</td>
								<td>{{$invoice->note}}</td>
								<td>
								@can('update invoice')<a class="btn btn-primary" href="{{route('invoices.edit',$invoice->id)}}" >edit</a>@endcan
								@can('change payment status  ')<a class="btn btn-primary" href="{{route('payment-status',$invoice->id)}}">payment status update</a>@endcan
								@can('print invoice')<a class="btn btn-primary" href="{{route('invoicePrint',$invoice->id)}}">print</a>@endcan
								@can('delete invoice ')<a class="btn btn-danger" data-toggle="modal" href="#delete{{$invoice->id}}" >Delete</a>@endcan
									</td>
							</tr>
							@include('invoices.delete')
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!--/div-->


</div>
<!-- /row -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection