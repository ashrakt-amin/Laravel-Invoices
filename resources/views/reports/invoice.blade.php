@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

<!-- Internal Spectrum-colorpicker css -->
<link href="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">

<!-- Internal Select2 css -->
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

@section('title')
reports
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">reports</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ invoices</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')

@if (count($errors) > 0)
<div class="alert alert-danger">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>خطا</strong>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- row -->
<div class="row">

    <div class="col-xl-8">
        <div class="card" style="margin-bottom:20px">


            <div class="card-header pb-0" style="margin-bottom:20px">

                <form action="{{route('search.invoice')}}" method="POST" autocomplete="off">
                    {{ csrf_field() }}


                    <div class="col-lg-3">
                        <label class="rdiobox">
                            <input checked name="radio" type="radio" value="1" id="radio1">
                            <span> serach by invoice name </span></label>
                    </div>


                    <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                        <label class="rdiobox">
                            <input name="radio" value="2" type="radio">
                            <span> serach by invoice number </span></label>
                    </div>

                    <br><br>
                    <div class="row">

                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                            <p class="mg-b-10"> choose invoice status </p><select class="form-control select2" name="type" required>
                                @if(isset($type))
                                <option value="{{$type}}" selected>{{$type}}</option>
                                @else
                                <option>choose</option>
                                @endif
                                <option value="paid">paid invoices </option>
                                <option value="unpaid">un paid invoices </option>
                                <option value="partial">parial paid invoices</option>

                            </select>
                        </div><!-- col-4 -->


                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="number">
                            <p class="mg-b-10">search by invoice number</p>
                            <input type="text" class="form-control" id="number" name="number">

                        </div><!-- col-4 -->

                        <div class="col-lg-3" id="start_at">
                            <label for="exampleFormControlSelect1">from date </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </div>
                                <input class="form-control fc-datepicker" name="start_at" placeholder="YYYY-MM-DD" type="text">
                            </div><!-- input-group -->
                        </div>

                        <div class="col-lg-3" id="end_at">
                            <label for="exampleFormControlSelect1">to date </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </div><input class="form-control fc-datepicker" name="end_at" placeholder="YYYY-MM-DD" type="text">
                            </div><!-- input-group -->
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-sm-2 col-md-2">
                            <button class="btn btn-primary btn-block" type="submit">search</button>
                        </div>
                    </div>
                </form>

            </div>

            @if(isset($invoices))

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                        <thead>
                            <tr>

                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">num</th>
                                <th class="border-bottom-0">date</th>
                                <th class="border-bottom-0">due date</th>
                                <th class="border-bottom-0">Product</th>
                                <th class="border-bottom-0">Section</th>
                                <th class="border-bottom-0">discount</th>
                                <th class="border-bottom-0">Vale VAT</th>
                                <th class="border-bottom-0">Rate VAT</th>
                                <th class="border-bottom-0">Total</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($invoices as $invoice)
                            <?php $i++; ?>
                            <tr>

                                <td>{{ $i }}</td>
                                <td>{{ $invoice->invoice_number }} </td>
                                <td>{{ $invoice->invoice_date }}</td>
                                <td>{{ $invoice->due_date }}</td>
                                <td>{{ $invoice->product }}</td>
                                <td><a href="{{ url('InvoicesDetails') }}/{{ $invoice->id }}">{{ $invoice->section->section_name }}</a></td>
                                <td>{{ $invoice->discount }}</td>
                                <td>{{ $invoice->rate_vat }}</td>
                                <td>{{ $invoice->value_vat }}</td>
                                <td>{{ $invoice->total }}</td>
                                <td>
                                    @if ($invoice->value_status == 1)
                                    <span class="text-success">{{ $invoice->status }}</span>
                                    @elseif($invoice->value_status == 2)
                                    <span class="text-danger">{{ $invoice->status }}</span>
                                    @else
                                    <span class="text-warning">{{ $invoice->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $invoice->note }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            @endif
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
<!-- Internal Data tables -->
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>

<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal Select2.min js -->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
<!-- Ionicons js -->
<script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
<!--Internal  pickerjs js -->
<script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();
</script>

<script>
    $(document).ready(function() {
        $('#number').hide();

        $('input[type="radio"]').click(function() {
            if ($(this).attr('id') == "radio1") {
                $('#number').hide();
                $('#type').show();
                $('#start_at').show();
                $('#end_at').show();

            } else {
                $('#number').show();
                $('#type').hide();
                $('#start_at').hide();
                $('#end_at').hide();

            }
        });
    });
</script>


@endsection