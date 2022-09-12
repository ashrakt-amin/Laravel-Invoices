@extends('layouts.master')
@section('css')
<!--- Internal Select2 css-->
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<!---Internal Fileupload css-->
<link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
<!---Internal Fancy uploader css-->
<link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
<!--Internal Sumoselect css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
<!--Internal  TelephoneInput css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
Edit Invoice
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                edit invoice </span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

@if (session()->has('Add'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<!-- row -->
<div class="row" style="width:95%">

    <div class="col-lg-10 col-md-10">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('invoices.update',$invoices->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    {{-- 1 --}}


                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">invoice number</label>
                            <input type="text" class="form-control" value="{{$invoices->invoice_number}}" id="inputName" name="invoice_number" title="" required>
                        </div>

                        <div class="col">
                            <label>invoice date</label>
                            <input class="form-control fc-datepicker" value="{{$invoices->invoice_date}}" name="invoice_date" placeholder="DD-MM-YYYY" type="date" required>
                        </div>

                        <div class="col">
                            <label>invoice due </label>
                            <input class="form-control fc-datepicker" value="{{$invoices->due_date}}" name="due_date" placeholder="DD-MM-YYYY" type="date" required>
                        </div>

                    </div>

                    {{-- 2 --}}
                    <div class="row">
                        <div class="col">
                            <label for="section" class="control-label">section</label>
                            <select name="section" class="form-control SlectBox" onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                                <!--placeholder-->
                                <option value="" selected disabled> choose section </option>
                                @foreach ($sections as $section)
                                <option value="{{ $section->id }}" {{$invoices->section->id == $section->id ? 'selected':''}}> {{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label for="product" class="control-label">product</label>
                            <select id="product" name="product" class="form-control">
                            </select>
                        </div>


                        <div class="col">
                            <label for="inputName" class="control-label"> Amount collection</label>
                            <input type="text" class="form-control" value="{{$invoices->Amount_collection}}" id="inputName" name="Amount_collection">
                        </div>
                    </div>


                    {{-- 3 --}}

                    <div class="row">

                        <div class="col">
                            <label for="inputName" class="control-label">Amount Commission </label>
                            <input type="text" class="form-control form-control-lg" value="{{$invoices->Amount_Commission}}" id="Amount_Commission" name="Amount_Commission" required>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">discount</label>
                            <input type="text" class="form-control form-control-lg" value="{{$invoices->discount}}" id="Discount" name="discount" value=0 required>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">VAT rate</label>
                            <select name="rate_vat" id="Rate_VAT" class="form-control" onchange="myFunction()">
                                <!--placeholder-->
                                <option value="{{$invoices->rate_vat}}" selected >{{$invoices->rate_vat}}%</option>
                                <option value="5">5%</option>
                                <option value="10">10%</option>
                                <option value="15">15%</option>
                                <option value="20">20%</option>


                            </select>
                        </div>

                    </div>

                    {{-- 4 --}}

                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">VAT value </label>
                            <input type="text" class="form-control" id="Value_VAT" value="{{$invoices->value_vat}}" name="value_vat" readonly>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">total</label>
                            <input type="text" class="form-control" id="Total" value="{{$invoices->total}}" name="total" readonly>
                        </div>
                    </div>

                    {{-- 5 --}}
                    <div class="row">
                        <div class="col">
                            <label for="exampleTextarea">note</label>
                            <textarea class="form-control" value="{{$invoices->note}}" id="exampleTextarea" name="note" rows="3">{{$invoices->note}}</textarea>
                        </div>
                    </div><br>

                    <p class="text-danger">* Attachments format pdf, jpeg ,.jpg , png </p>
                    <h5 class="card-title">Attachments</h5>

                    <div class="col-sm-12 col-md-12">
                        <input type="file" name="pic" class="dropify" value="" accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                    </div><br>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">save </button>
                    </div>


                </form>
            </div>
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
<!-- Internal Select2 js-->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Fileuploads js-->
<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
<!--Internal Fancy uploader js-->
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
<!--Internal  Form-elements js-->
<script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
<script src="{{ URL::asset('assets/js/select2.js') }}"></script>
<!--Internal Sumoselect js-->
<script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();
</script>

<script>
    $(document).ready(function() {
        $('select[name="section"]').on('change', function() {
            var sectionId = $(this).val();
            if (sectionId) {
                $.ajax({
                    url: "{{URL::to('section')}}/" + sectionId,
                    dataType: "json",
                    success: function(data) {

                        $('select[name="product"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="product"]').append('<option value="' +
                                key + '">' + value + '</option>');
                        });
                    }
                    //success

                });
                // close Ajax

            } //if
            else {
                console.log('AJAX load did not work');

            }
        });
    });
</script>

<script>
    function myFunction() {
        var Amount_Commission1 = parseFloat(document.getElementById("Amount_Commission").value);
        var Discount = parseFloat(document.getElementById("Discount").value);
        var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
        var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);


        var Amount_Commission2 = Amount_Commission1 - Discount;
        if (Amount_Commission1 === "undefined" || !Amount_Commission1) {
            alert("you should insert Amount Commission1 ");
        } else {
            var result1 = Amount_Commission2 * (Rate_VAT / 100);
            var result2 = parseFloat(Amount_Commission2 + result1).toFixed(2)

            result1 = parseFloat(result1).toFixed(2);


            document.getElementById("Value_VAT").value = result1;
            document.getElementById("Total").value = result2;

        }


    }
</script>

@endsection