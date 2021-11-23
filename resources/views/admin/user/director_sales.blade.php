@extends('layouts.app')


{{--Important Variable--}}

<?php

$moduleName = "Directors";
$createItemName = $moduleName . "Sales";

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " Director Sales List";

$breadcrumbMainIcon = "fas fa-dolly";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\User';
$ParentRouteName = 'user';

// $all = config('role_manage.User.All');
// $create = config('role_manage.User.Create');
// $delete = config('role_manage.User.Delete');
// $edit = config('role_manage.User.Edit');
// $pdf = config('role_manage.User.Pdf');
// $permanently_delete = config('role_manage.User.PermanentlyDelete');
// $restore = config('role_manage.User.Restore');
// $show = config('role_manage.User.Show');
// $trash_show = config('role_manage.User.TrashShow');

?>


@section('title')
    {{ $moduleName }} -> {{ $breadcrumbCurrentName }}
@stop

@section('top-bar')
    @include('includes.top-bar')
@stop
@section('left-sidebar')
    @include('includes.left-sidebar')
@stop
@section('content')
@php

if($director->share === null){
    $share = 0;
    $director_share = 0;
    $agent_share = 0;

}else{
    if($director->agent_share === null){
        $director_share = $director->share;
        $agent_share = 0;
        $share = $director->share;
    }else{
       $director_share = $director->share - $director->agent_share;
       $agent_share = $director->agent_share;
       $share = $director->share;
    }

}
@endphp
    <section class="content">
        <div class="container-fluid">

            <ol class="breadcrumb breadcrumb-col-cyan pull-right">
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="{{ route($ParentRouteName) }}"><i
                                class="{{ $breadcrumbMainIcon  }}"></i> {{ $breadcrumbMainName  }}</a></li>
                <li class="active"><i
                            class="material-icons">{{ $breadcrumbCurrentIcon }}</i>{{ $breadcrumbCurrentName }}</li>
            </ol>

            <!-- Hover Rows -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                        </div>
                            <div class="body table-responsive">
                            <h3>Sales List For : <span>{{ $director->name}}</span> <small class="text-warning">Total Commision: {{ ($share)}}&nbsp;% &nbsp;Director Share: {{$director_share }}&nbsp;% &nbsp; Agent Share: {{$agent_share }} %</small></h3>
                                <table class="table table-hover table-bordered table-sm">
                                    <thead>
                                    <tr>

                                        <th>Product</th>
                                        <th>Product Branch</th>
                                        <th>Product Sell Date</th>
                                        <th>Product Net Sell Price</th>
                                        <th>Director Commision</th>
                                        <th>Agent Name</th>
                                        <th>Agent Commision</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1;?>
                                    @foreach($director_sales as $d)
                                        <tr>
                                            <td>{{ $d->product_id }}</td>
                                        @php
                                            $branch = App\Branch::where('id',$d->branch_id)->first();
                                            $employee = App\Employee::where('id', $d->employee_id)->first();
                                            $product_details = App\Product::where('id',$d->product_id)->first();
                                            $branch_name = is_null($branch) ? " " : $branch->name;
                                        @endphp
                                            <td>{{ $branch_name }}</td>
                                            <td>{{$d->sells_date}}</td>
                                            <td>{{$product_details->net_sells_price}}</td>
                                            <td>{{($product_details->net_sells_price)* ($director_share/100)}}</td>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{($product_details->net_sells_price)* ($agent_share/100)}}</td>
                                        </tr>
                                    <?php $i++;?>
                                    @endforeach
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Product Branch</th>
                                        <th>Product Sell Date</th>
                                        <th>Product Net Sell Price</th>
                                        <th>Director Commision</th>
                                        <th>Agent Name</th>
                                        <th>Agent Commision</th>
                                    </tr>
                                    </thead>

                                    </tbody>
                                </table>
                            </div>
                    </div>

                </div>
            </div>
            <!-- #END# Hover Rows -->
        </div>
    </section>

@stop

@push('include-css')
    <!-- Wait Me Css -->
    <link href="{{ asset('public/asset/plugins/waitme/waitMe.css') }}" rel="stylesheet"/>

    <!-- Colorpicker Css -->
    <link href="{{ asset('public/asset/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" rel="stylesheet"/>

    <!-- Dropzone Css -->
    <link href="{{ asset('public/asset/plugins/dropzone/dropzone.css') }}" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="{{ asset('public/asset/plugins/multi-select/css/multi-select.css') }}" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="{{ asset('public/asset/plugins/jquery-spinner/css/bootstrap-spinner.css') }}" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="{{ asset('public/asset/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('public/asset/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>


@endpush

@push('include-js')

    {{--<script src="{{ asset('public/asset/js/pages/ui/modals.js') }}"></script>--}}
    <script src="{{ asset('public/asset/plugins/autosize/autosize.js') }}"></script>

    <!-- Moment Plugin Js -->
    <script src="{{ asset('public/asset/plugins/momentjs/moment.js') }}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('public/asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

    <script src="{{ asset('public/asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>

    <script src="{{ asset('public/asset/js/pages/forms/basic-form-elements.js') }}"></script>
    <!-- Autosize Plugin Js -->


    <script>
        @if(Session::has('success'))
            toastr["success"]('{{ Session::get('success') }}');
        @endif

                @if(Session::has('error'))
            toastr["error"]('{{ Session::get('error') }}');
        @endif

                @if ($errors->any())
                @foreach ($errors->all() as $error)
            toastr["error"]('{{ $error }}');
        @endforeach
        @endif


    </script>

    {{--All datagrid --}}
    <script src="{{ asset('public/asset/js/dataTable.js')  }}"></script>
    <script>
        BaseController.init();
    </script>
@endpush



