@extends('layouts.master')
@section('css')
<style>
    @media print{
        #print_Button{
            display: none;
        }
    }
</style>
@endsection
@section('page-header')

@endsection
@section('content')
<!-- row -->

<div class=" tab-menu-heading">
    <div class="tabs-menu1">
        <!-- Tabs -->
        <ul class="nav panel-tabs main-nav-line">
            <li><a href="#tab1" class="nav-link active" data-toggle="tab">invoice details</a></li>
            <li><a href="#tab2" class="nav-link" data-toggle="tab">status </a></li>
            <li><a href="#tab3" class="nav-link" data-toggle="tab">attachments</a></li>
        </ul>
    </div>
</div>
<div class="panel-body tabs-menu-body main-content-body-right border show1">
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <ul class="showDetails">

                <table class="attachment table-inv">
                    <thead>
                        <tr>

                            <th scope="col">invoice number </th>
                            <th scope="col">invoice date</th>
                            <th scope="col">due date</th>
                            <th scope="col">product</th>
                            <th scope="col">Amount collection</th>
                            <th scope="col">Amount_Commission</th>
                            <th scope="col">section </th>
                            <th scope="col">discount </th>
                            <th scope="col">rate_vat </th>
                            <th scope="col">note </th>




                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            <td>{{$invoice->invoice_number}}</td>
                            <td>{{$invoice->invoice_date}}</td>
                            <td>{{$invoice->due_date}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$invoice->Amount_collection}}</td>
                            <td>{{$invoice->Amount_Commission}}</td>
                            <td>{{$invoice->section->name}}</td>
                            <td>{{$invoice->discount}}</td>
                            <td>{{$invoice->rate_vat}}</td>
                            <td>{{$invoice->note}}</td>
                        </tr>

                    </tbody>
                </table>


            </ul>
        </div>


        <div class="tab-pane" id="tab2">


            <table class="attachment table-inv">
                <thead>
                    <tr>

                        <th scope="col">invoice number </th>
                        <th scope="col">user </th>
                        <th scope="col">section </th>
                        <th scope="col">product </th>
                        <th scope="col">status </th>
                        <th scope="col">note </th>




                    </tr>
                </thead>
                <tbody>
                    @foreach($invoicedetails as $invoice)
                    <tr>
                        <td>{{$invoice->number}}</td>
                        <td>{{$invoice->user}}</td>
                        <td>{{$invoice->section}}</td>
                        <td>{{$product->name}}</td>
                        <td>
                            @if($invoice->status == "paid" )
                            <span class="text-success">{{$invoice->status}} </span>
                            @else <span class="text-danger">{{$invoice->status}} </span>
                            @endif
                        </td>
                        <td>{{$invoice->note}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
        <div class="tab-pane container-inv" id="tab3">
    
            <div class="card-group attach">
                @foreach($attachments as $attachment)
                <div class="card show2" id="print">
                    <a class="d-flex justify-content-center" href="{{route('attachment.show',$attachment->id)}}"><embed src="{{asset('imgs/'.$attachment->file_name)}}" background-color="4283586137" full-frame=""></a>
                    <div class="card-body">

                    <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> 
                        <i class="mdi mdi-printer ml-1"></i>print</button>                     
                    </div>
                </div>
                @endforeach

            </div>




        </div>
    </div>
</div>




<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<script>
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            document.body.innerHTML = printContents;
            window.print();

            location.reload();
        }

    </script>
@endsection