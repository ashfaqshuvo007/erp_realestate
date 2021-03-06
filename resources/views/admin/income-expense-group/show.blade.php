@extends('layouts.app')

{{--Important Variables--}}

<?php

$moduleName = " Ledger Group";
$createItemName = " Show" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " Show";

$breadcrumbMainIcon = "fas fa-file-invoice-dollar";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\IncomeExpenseGroup';
$ParentRouteName = 'income_expense_group';





?>

@section('title')
    {{ $moduleName }}->{{ $createItemName }}
@stop

@section('top-bar')
    @include('includes.top-bar')
@stop
@section('left-sidebar')
    @include('includes.left-sidebar')
@stop
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header pull-left">
                <a class="btn btn-sm btn-info waves-effect" href="{{ url()->previous() }}">Back</a>
            </div>

            <ol class="breadcrumb breadcrumb-col-cyan pull-right">
                <li><a href="{{ route($ParentRouteName) }}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="{{ route($ParentRouteName) }}"><i
                                class="{{ $breadcrumbMainIcon  }} "></i>{{  $breadcrumbMainName }}</a>
                </li>
                <li class="active"><i
                            class="material-icons">{{ $breadcrumbCurrentIcon  }}</i> {{ $breadcrumbCurrentName  }}</li>
            </ol>

            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                {{  $items->name  }}
                                <small>Details {{ $items->name  }} Information</small>
                            </h2>

                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route($ParentRouteName.'.store') }}">

                                    {{ csrf_field() }}
                                    <div class="row clearfix">


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table class="table  table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th scope="col" class="text-center">S.L</th>
                                                    <th scope="col" class="text-center">Module Name</th>
                                                    <th scope="col" class="text-center">Module Show</th>
                                                    <th scope="col" class="text-center">Show</th>
                                                    <th scope="col" class="text-center">Create</th>
                                                    <th scope="col" class="text-center">Edit</th>
                                                    <th scope="col" class="text-center">Delete</th>
                                                    <th scope="col" class="text-center">PDF</th>
                                                    <th scope="col" class="text-center">Trash Show</th>
                                                    <th scope="col" class="text-center">Restore</th>
                                                    <th scope="col" class="text-center">Permanently Delete</th>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                @if ($items->content)

                                                    @foreach( $items->content as $itemKey=>$item)
                                                        <tr>
                                                            <th scope="row" class="text-center">{{ $itemKey+1  }}</th>

                                                            @foreach($item as $key=>$value)
                                                                <td class="text-center">
                                                                    @if ($key==0)
                                                                        {{ $value }}
                                                                    @elseif ($value=='on')
                                                                        <i class="fas fa-check text-success"></i>
                                                                    @else
                                                                        <i class="fas fa-times text-danger"></i>
                                                                    @endif
                                                                </td>
                                                            @endforeach

                                                        </tr>
                                                    @endforeach

                                                @else
                                                    <tr>
                                                        <th class="text-danger">No Item Available</th>
                                                    </tr>
                                                @endif

                                                </tbody>
                                            </table>

                                        </div>


                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Inline Layout | With Floating Label -->
            </div>
        </div>
    </section>

@stop

@push('include-css')

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



    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('public/asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}"
          rel="stylesheet"/>

    <!-- Bootstrap DatePicker Css -->
    <link href="{{ asset('public/asset/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet"/>


    <!-- noUISlider Css -->
    <link href="{{ asset('public/asset/plugins/nouislider/nouislider.min.css') }}" rel="stylesheet"/>

    <!-- Sweet Alert Css -->
    <link href="{{ asset('public/asset/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet"/>


@endpush

@push('include-js')


    <!-- Moment Plugin Js -->
    <script src="{{ asset('public/asset/plugins/momentjs/moment.js') }}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('public/asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="{{ asset('public/asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>


    <!-- Sweet Alert Plugin Js -->
    <script src="{{ asset('public/asset/plugins/sweetalert/sweetalert.min.js') }}"></script>


    <!-- Autosize Plugin Js -->
    <script src="{{ asset('public/asset/plugins/autosize/autosize.js') }}"></script>

    <script src="{{ asset('public/asset/js/pages/forms/basic-form-elements.js') }}"></script>



@endpush
