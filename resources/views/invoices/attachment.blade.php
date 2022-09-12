
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
@section('page-header')

@endsection
@section('content')
<!-- row -->

<div class="panel-body d-flex justify-content-center show1" id ="print">
<embed  src="{{asset('imgs/'.$attachment->file_name)}}"
 background-color="4283586137" full-frame="">
 </div>
 <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> 
                        <i class="mdi mdi-printer ml-1"></i>print</button>           





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