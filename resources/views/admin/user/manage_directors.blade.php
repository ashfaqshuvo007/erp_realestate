@extends('layouts.app')


{{--Important Variable--}}

<?php

$moduleName = " Manage Directors";
$createItemName = "Create" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " Director List";

$breadcrumbMainIcon = "fas fa-user";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\User';
$ParentRouteName = 'user';

$all = config('role_manage.User.All');
$create = config('role_manage.User.Create');
$delete = config('role_manage.User.Delete');
$edit = config('role_manage.User.Edit');
$pdf = config('role_manage.User.Pdf');
$permanently_delete = config('role_manage.User.PermanentlyDelete');
$restore = config('role_manage.User.Restore');
$show = config('role_manage.User.Show');
$trash_show = config('role_manage.User.TrashShow');

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

    <section class="content">
        <div class="container-fluid">

            <ol class="breadcrumb breadcrumb-col-cyan pull-right">
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="{{ route($ParentRouteName) }}"><i
                                class="{{ $breadcrumbMainIcon  }}"></i>{{ $breadcrumbMainName  }}</a></li>
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
                                <table class="table table-hover table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th>Director Name</th>
                                        <th>Email</th>
                                        <th>Sell Commision</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $i = 1;?>
                                    @foreach($directors as $director)
                                        <tr>
                                            <td>{{ $director->name }}</td>
                                            <td>{{ $director->email }}</td>
                                            <?php
if (is_null($director->share)) {
    $share = 'NULL';
} else {
    $share = ($director->share) * 100;
}

?>
                                            <td>
                                                {{  $share }}&nbsp;%
                                            </td>

                                            <td class="tdTrashAction">
                                                <a @if ($edit==0)

                                                        class="dis-none"

                                                   @endif class="btn btn-xs btn-info waves-effect"
                                                   href="{{ route($ParentRouteName.'.edit_director',['id'=>$director->user_id]) }}"

                                                   data-toggle="tooltip"
                                                   data-placement="top" title="Edit"><i
                                                            class="material-icons">mode_edit</i></a>

                                            </td>
                                        </tr>
                                    <?php $i++;?>
                                    @endforeach
                                    <thead>
                                    <tr>
                                        <th>Director Name</th>
                                        <th>Email</th>
                                        <th>Sell Commision</th>
                                        <th>Action</th>
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



