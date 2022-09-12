@extends('layouts.master')
@section('css')
<style>
    @media print {
        #print_Button {
            display: none;
        }
    }
</style>
@endsection
@section('title')
print the invoice
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">invoice</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                print </span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row" style="width:95%">
    <div class="col-lg-10 col-md-10">
        <div class=" main-content-body-invoice" id="print">
            <div class="card card-invoice">
                <div class="card-body">
                    <div class="invoice-header">
                        <h1 class="invoice-title">ashrakt amin </h1>
                        <div class="billed-from">
                            <h6>invoices pro .</h6>
                            <p>201 Something St., Something Town, YT 242, Country 6546<br>
                                Tel No: 010 954-25446<br>
                                Email: ashraktamin678@gmail.com</p>
                        </div><!-- billed-from -->
                    </div><!-- invoice-header -->
                    <div class="row mg-t-20">

                        <div class="col-md">
                            <label class="tx-gray-600">invoice data </label>
                            <p class="invoice-info-row"><span>invoice number </span>
                                <span>{{ $invoices->invoice_number }}</span>
                            </p>
                            <p class="invoice-info-row"><span>invoice date </span>
                                <span>{{ $invoices->invoice_date }}</span>
                            </p>
                            <p class="invoice-info-row"><span>due date</span>
                                <span>{{ $invoices->due_date }}</span>
                            </p>
                            <p class="invoice-info-row"><span>section</span>
                                <span>{{ $invoices->section->name }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="table-responsive mg-t-40">
                        <table class="table table-invoice border text-md-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th class="wd-20p">#</th>
                                    <th class="wd-40p">product</th>
                                    <th class="tx-center">Amount_collection </th>
                                    <th class="tx-right">Amount_Commission </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td class="tx-12">{{ $product->name }}</td>
                                    <td class="tx-center">{{ number_format($invoices->Amount_collection, 2) }}</td>
                                    <td class="tx-right">{{ number_format($invoices->Amount_Commission, 2) }}</td>
                                </tr>


                                <tr>
                                    <td class="tx-right">Rate VAT ({{ $invoices->rate_vat }})</td>
                                    <td class="tx-right" colspan="2">287.50</td>
                                </tr>
                                <tr>
                                    <td class="tx-right"> Discount</td>
                                    <td class="tx-right" colspan="2"> {{ number_format($invoices->discount, 2) }}</td>

                                </tr>
                                <tr>
                                    <td class="tx-right tx-uppercase tx-bold tx-inverse"> Total </td>
                                    <td class="tx-right" colspan="2">
                                        <h4 class="tx-primary tx-bold">{{ number_format($invoices->total, 2) }}</h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr class="mg-b-40">



                    <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()">
                        <i class="mdi mdi-printer ml-1"></i>print</button>
                </div>
            </div>
        </div>
    </div><!-- COL-END -->
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>


<script>
    function printDiv() {
        var printContents = document.getElementById('print').innerHTML;
        document.body.innerHTML = printContents;
        window.print();

        location.reload();
    }
</script>

@endsection