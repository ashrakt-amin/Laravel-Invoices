@extends('layouts.master')
@section('css')
@endsection
@section('title')
Change Payment Status
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Change Payment Status</span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row" style="width:95%">

    <div class="col-lg-10 col-md-10">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('statusUpdate',$invoices->id) }}" method="post" autocomplete="off">
                    {{ csrf_field() }}
                    {{-- 1 --}}
                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">invoice number </label>
                            <input type="hidden" name="invoice_id" value="{{ $invoices->id }}">
                            <input type="text" class="form-control" id="inputName" name="invoice_number" value="{{ $invoices->invoice_number }}" required readonly>
                        </div>

                        <div class="col">
                            <label>invoice date </label>
                            <input class="form-control fc-datepicker" name="invoice_date" placeholder="YYYY-MM-DD" type="text" value="{{ $invoices->invoice_date }}" required readonly>
                        </div>

                        <div class="col">
                            <label>invoice due </label>
                            <input class="form-control fc-datepicker" name="due_date" placeholder="YYYY-MM-DD" type="text" value="{{ $invoices->due_date }}" required readonly>
                        </div>

                    </div>

                    {{-- 2 --}}
                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">section</label>
                            <input class="form-control fc-datepicker" name="Section" value=" {{ $invoices->section->name }}" required readonly>

                         
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">product</label>
                            <select id="product" name="product" class="form-control" readonly>
                                <option value="{{ $invoices->product }}"> {{ $invoices->product }}</option>
                            </select>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">Amount collection </label>
                            <input type="text" class="form-control" id="inputName" name="Amount_collection" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{ $invoices->Amount_collection }}" readonly>
                        </div>
                    </div>


                    {{-- 3 --}}

                    <div class="row">

                        <div class="col">
                            <label for="inputName" class="control-label">Amount Commission </label>
                            <input type="text" class="form-control form-control-lg" id="Amount_Commission" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{ $invoices->Amount_Commission}}" required readonly>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">discount</label>
                            <input type="text" class="form-control form-control-lg" id="Discount" name="discount" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{ $invoices->discount }}" required readonly>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">VAT rate </label>
                            <select name="rate_vat" id="Rate_VAT" class="form-control" onchange="myFunction()" readonly>
                                <!--placeholder-->
                                <option value=" {{ $invoices->rate_vat}}">
                                    {{ $invoices->value_vat}}
                            </select>
                        </div>

                    </div>

                    {{-- 4 --}}

                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">VAT value</label>
                            <input type="text" class="form-control" id="Value_VAT" name="value_vat" value="{{ $invoices->value_vat }}" readonly>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">total</label>
                            <input type="text" class="form-control" id="Total" name="total" readonly value="{{ $invoices->total }}">
                        </div>
                    </div>

                    {{-- 5 --}}
                    <div class="row">
                        <div class="col">
                            <label for="exampleTextarea">notes</label>
                            <textarea class="form-control" id="exampleTextarea" name="note" rows="3" readonly>
                            {{ $invoices->note }}</textarea>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col">
                            <label for="exampleTextarea">payment staus </label>
                            <select class="form-control" id="Status" name="status" required>
                                <option selected="true" disabled="disabled">-- choose payment status --</option>
                                <option value="paid">paid</option>
                                <option value="unpaid">un paid</option>
                                <option value="partial">partial paid </option>
                            </select>
                        </div>

                        <div class="col">
                            <label>payment date </label>
                            <input class="form-control fc-datepicker" name="payment_date" placeholder="YYYY-MM-DD" type="text" required>
                        </div>


                    </div><br>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">payment status update </button>
                    </div>

                </form>
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
@endsection