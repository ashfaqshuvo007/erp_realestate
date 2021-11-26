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
    $share = $director->share . "%";
}
$director_sales = \App\Sell::where('director_id', $director->id)->get()->toArray();
?>
                                            <td>
                                                {{  $share }}
                                            </td>

                                            <td class="tdTrashAction">
                                                <a @if ($edit==0)

                                                        class="dis-none"

                                                   @endif class="btn btn-xs btn-info waves-effect"
                                                   href="{{ route($ParentRouteName.'.edit_director',['id'=>$director->id]) }}"

                                                   data-toggle="tooltip"
                                                   data-placement="top" title="Edit"><i
                                                            class="material-icons">mode_edit</i></a>

                                                @if((count($director_sales) > 0))
                                                    <a class="btn btn-xs btn-warning waves-effect"
                                                    href="{{ route($ParentRouteName.'.director_sales',['id'=>$director->id]) }}"

                                                    data-toggle="tooltip"
                                                    data-placement="top" title="Sales by director"><i
                                                                class="fas fa-dolly"></i></a>

                                                    <a class="btn btn-xs btn-warning waves-effect m-b-3" href="{{ route($ParentRouteName.'.director_sales_pdf',['id'=>$director->id]) }}"

                                                    data-toggle="tooltip" data-placement="top" title="" data-original-title="Director Sales Summary PDF Generator"> <i class="material-icons">picture_as_pdf</i></a>

                                                @endif

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




