@extends('layouts.master')

@section('title')
products
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
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">settings</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">products</span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row opened -->
<div class="row row-sm">

    <!--div-->
    <div class="col-xl-12">
        <div class="card ">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20">
                        @can('add product ')<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-flip-horizontal" data-toggle="modal" href="#modaldemo8">add product</a>@endcan
                    </div>
                    @if(session()->has('Add'))
                    <div class="alert alert-primary" role="alert">
                        {{session()->get('Add')}}
                    </div>
                    @endif

                    @if(session()->has('Error'))
                    <div class="alert alert-danger" role="alert">
                        {{session()->get('Error')}}
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2"><a href=""></a></p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table key-buttons text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">product name</th>
                                <th class="border-bottom-0">section name</th>
                                <th class="border-bottom-0">note</th>
                                <th class="border-bottom-0">pro</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->section->name}}</td>
                                <td>{{$product->description}}</td>
                                <td>
                                @can('update product ')<a class="btn btn-primary" data-effect="effect-flip-horizontal" data-toggle="modal" href="#edit{{$product->id}}">edit</a>@endcan
                                @can('delete product ')<a class="btn btn-danger" data-effect="effect-flip-horizontal" data-toggle="modal" href="#delete{{$product->id}}">Delete</a>@endcan
                                </td>

                            </tr>

                            <!-- edit Modal -->
                            <div class="modal fade" id="edit{{$product->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{$product->id}}</h5>
                                        </div>

                                        <div class="modal-body">
                                            <form action="{{route('products.update',$product->id)}}" method="POST" autocomplete="off">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}

                                                <input class="form-control" value="{{$product->name}}" name="name" type="text" placeholder="name">
                                                <select class="form-control" selected name="section_id" id="section">
                                                    @foreach($sections as $section)
                                                    <option class="form-control" value="{{$section->id}}" {{$product->section_id == $section->id  ? 'selected' : ''}}>{{$section->name}}</option>
                                                    @endforeach
                                                </select>
                                                <input class="form-control" type="text" value="{{$product->description}}" name="description">

                                                <button type="submit" class="btn btn-primary mb-3">enter</button>
                                            </form>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <!-- main-content closed -->


                            <!-- delete Modal -->
                            <div class="modal fade" id="delete{{$product->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{$product->id}}</h5>
                                        </div>
                                        <form action="{{route('products.destroy',$product->id)}}" method="post">
                                            {{ method_field('delete') }}
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <h5></h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                                                <button type="submit" class="btn btn-danger">delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>



                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div-->


</div>




<!-- Modal effects -->
<div class="modal" id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">new product</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('products.store')}}" method="post">
                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="name" class="form-label">product name</label>
                        <input class="form-control" type="text" name="name" id="name">
                    </div>

                    <select class="form-control" name="section_id" id="section">
                        <option class="form-control" value="">-- choose section --</option>
                        @foreach($sections as $section)
                        <option class="form-control" value="{{$section->id}}">{{$section->name}}</option>
                        @endforeach
                    </select>

                    <div class="form-group">
                        <label for="description" class="form-label">notes</label>
                        <input class="form-control" type="text" name="description" id="description">
                    </div>

                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" type="submit">Save</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal effects-->






    <!-- /row -->
</div>


<!-- Container closed -->
</div>

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
<script src="{{URL::asset('assets/js/modal.js')}}"></script>

@endsection