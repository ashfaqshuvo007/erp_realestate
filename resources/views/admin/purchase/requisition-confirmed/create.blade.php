@extends('layouts.app')

{{--Important Variables--}}

<?php


$moduleName = " Requisition confirmed Manage";
$createItemName = "Create" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " Create";

$breadcrumbMainIcon = "fas fa-shopping-cart";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\PurchaseRequisition';
$ParentRouteName = 'requisition_confirmed';



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
                                {{ $createItemName  }}
                                <small>Put {{ $moduleName  }} Information</small>
                            </h2>

                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route($ParentRouteName.'.store') }}">

                                    {{ csrf_field() }}
                                    <div class="row clearfix">

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                            name="branch_id">
                                                        <option value="0">Select Project Name</option>

                                                        @foreach( App\Branch::all() as $branch )
                                                            <option @if ( $branch->id == old('branch_id' ))
                                                                    selected
                                                                    @endif value="{{ $branch->id  }}">{{ $branch->name  }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                            name="employee_id">
                                                        <option value="0">Select Employee Name</option>

                                                        @foreach( App\Employee::all() as $employee )
                                                            <option @if ( $employee->id == old('employee_id' ) )
                                                                    selected
                                                                    @endif value="{{ $employee->id  }}">{{ $employee->name  }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input autocomplete="off" value="{{ old('contract_person') }}"
                                                           name="contract_person"
                                                           type="text"
                                                           class="form-control">
                                                    <label class="form-label">Contract Person</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line" id="bs_datepicker_container">
                                                    <input autocomplete="off" value="{{ old('requisition_date') }}"
                                                           name="requisition_date"
                                                           type="text"
                                                           class="form-control"
                                                           placeholder=" Requisition Date">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line" id="bs_datepicker_container">
                                                    <input autocomplete="off" value="{{ old('required_date') }}"
                                                           name="required_date"
                                                           type="text"
                                                           class="form-control"
                                                           placeholder=" Required Date">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">

                                                    <textarea class="form-control" name="comment"
                                                              id="">{{ old('comment') }}</textarea>
                                                    <label class="form-label">Remark</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">

                                                    <textarea class="form-control" name="purpose"
                                                              id="">{{ old('purpose') }}</textarea>
                                                    <label class="form-label">Purpose</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="card">
                                                <div class="header">
                                                    <h4>Requisition Items</h4>

                                                </div>
                                                <div id="items" class="body">
                                                    <br>


                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                            class="form-control show-tick income_expense_head_id"
                                                                            name="income_expense_head_id[]"
                                                                            id="">
                                                                        <option value="0"> Select Item Name</option>

                                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                                <option @if ( $HeadOfAccount->id == old('income_expense_head_id' ))
                                                                                        selected
                                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i class="pointer-cursor  material-icons text-success plus">add_circle_outline</i>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                            class="form-control show-tick income_expense_head_id"
                                                                            name="income_expense_head_id[]"
                                                                            id="">
                                                                        <option value="0"> Select Item Name</option>

                                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                                <option @if ( $HeadOfAccount->id == old('income_expense_head_id' ))
                                                                                        selected
                                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                            class="form-control show-tick income_expense_head_id"
                                                                            name="income_expense_head_id[]"
                                                                            id="">
                                                                        <option value="0"> Select Item Name</option>

                                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                                <option @if ( $HeadOfAccount->id == old('income_expense_head_id' ))
                                                                                        selected
                                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                            class="form-control show-tick income_expense_head_id"
                                                                            name="income_expense_head_id[]"
                                                                            id="">
                                                                        <option value="0"> Select Item Name</option>

                                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                                <option @if ( $HeadOfAccount->id == old('income_expense_head_id' ))
                                                                                        selected
                                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                            class="form-control show-tick income_expense_head_id"
                                                                            name="income_expense_head_id[]"
                                                                            id="">
                                                                        <option value="0"> Select Item Name</option>

                                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                                <option @if ( $HeadOfAccount->id == old('income_expense_head_id' ))
                                                                                        selected
                                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                            class="form-control show-tick income_expense_head_id"
                                                                            name="income_expense_head_id[]"
                                                                            id="">
                                                                        <option value="0"> Select Item Name</option>

                                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                                <option @if ( $HeadOfAccount->id == old('income_expense_head_id' ))
                                                                                        selected
                                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                            class="form-control show-tick income_expense_head_id"
                                                                            name="income_expense_head_id[]"
                                                                            id="">
                                                                        <option value="0"> Select Item Name</option>

                                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                                <option @if ( $HeadOfAccount->id == old('income_expense_head_id' ))
                                                                                        selected
                                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                            class="form-control show-tick income_expense_head_id"
                                                                            name="income_expense_head_id[]"
                                                                            id="">
                                                                        <option value="0"> Select Item Name</option>

                                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                                <option @if ( $HeadOfAccount->id == old('income_expense_head_id' ))
                                                                                        selected
                                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                            class="form-control show-tick income_expense_head_id"
                                                                            name="income_expense_head_id[]"
                                                                            id="">
                                                                        <option value="0"> Select Item Name</option>

                                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                                <option @if ( $HeadOfAccount->id == old('income_expense_head_id' ))
                                                                                        selected
                                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                            class="form-control show-tick income_expense_head_id"
                                                                            name="income_expense_head_id[]"
                                                                            id="">
                                                                        <option value="0"> Select Item Name</option>

                                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                                <option @if ( $HeadOfAccount->id == old('income_expense_head_id' ))
                                                                                        selected
                                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                            class="form-control show-tick income_expense_head_id"
                                                                            name="income_expense_head_id[]"
                                                                            id="">
                                                                        <option value="0"> Select Item Name</option>

                                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                                <option @if ( $HeadOfAccount->id == old('income_expense_head_id' ))
                                                                                        selected
                                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                            class="form-control show-tick income_expense_head_id"
                                                                            name="income_expense_head_id[]"
                                                                            id="">
                                                                        <option value="0"> Select Item Name</option>

                                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                                <option @if ( $HeadOfAccount->id == old('income_expense_head_id' ))
                                                                                        selected
                                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                            class="form-control show-tick income_expense_head_id"
                                                                            name="income_expense_head_id[]"
                                                                            id="">
                                                                        <option value="0"> Select Item Name</option>

                                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                                <option @if ( $HeadOfAccount->id == old('income_expense_head_id' ))
                                                                                        selected
                                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                            class="form-control show-tick income_expense_head_id"
                                                                            name="income_expense_head_id[]"
                                                                            id="">
                                                                        <option value="0"> Select Item Name</option>

                                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                                <option @if ( $HeadOfAccount->id == old('income_expense_head_id' ))
                                                                                        selected
                                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                            class="form-control show-tick income_expense_head_id"
                                                                            name="income_expense_head_id[]"
                                                                            id="">
                                                                        <option value="0"> Select Item Name</option>

                                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                                <option @if ( $HeadOfAccount->id == old('income_expense_head_id' ))
                                                                                        selected
                                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                            class="form-control show-tick income_expense_head_id"
                                                                            name="income_expense_head_id[]"
                                                                            id="">
                                                                        <option value="0"> Select Item Name</option>

                                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                                <option @if ( $HeadOfAccount->id == old('income_expense_head_id' ))
                                                                                        selected
                                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                            class="form-control show-tick income_expense_head_id"
                                                                            name="income_expense_head_id[]"
                                                                            id="">
                                                                        <option value="0"> Select Item Name</option>

                                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                                <option @if ( $HeadOfAccount->id == old('income_expense_head_id' ))
                                                                                        selected
                                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                            class="form-control show-tick income_expense_head_id"
                                                                            name="income_expense_head_id[]"
                                                                            id="">
                                                                        <option value="0"> Select Item Name</option>

                                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                                <option @if ( $HeadOfAccount->id == old('income_expense_head_id' ))
                                                                                        selected
                                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                            class="form-control show-tick income_expense_head_id"
                                                                            name="income_expense_head_id[]"
                                                                            id="">
                                                                        <option value="0"> Select Item Name</option>

                                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                                <option @if ( $HeadOfAccount->id == old('income_expense_head_id' ))
                                                                                        selected
                                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>

                                                    </div>


                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                            class="form-control show-tick income_expense_head_id"
                                                                            name="income_expense_head_id[]"
                                                                            id="">
                                                                        <option value="0"> Select Item Name</option>

                                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                                <option @if ( $HeadOfAccount->id == old('income_expense_head_id' ))
                                                                                        selected
                                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                                            @endforeach
                                                                        @endif

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                           class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>


                                                <hr>
                                                <div class="row">

                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-1 field_area border-1">

                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">

                                                    </div>

                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-7 field_area">
                                                        <h3 class="text-right">Total Amount</h3>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 field_area">
                                                        <h3 id="totaRequisitionlAmount">0</h3>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                                        <input id="total_requisition_amount" type="hidden"
                                                               name="total_requisition_amount">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xl-12 col-sm-12">


                                                <h4>Is Confirmed ?</h4>
                                                <input name="isConfirmed" type="radio" value="1" id="radio_14"
                                                       class="radio-col-cyan">
                                                <label for="radio_14">YES</label>
                                                <input name="isConfirmed" type="radio" value="0" id="radio_15"
                                                       class="radio-col-cyan" checked>
                                                <label for="radio_15">NO</label>


                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                    Create
                                                </button>
                                            </div>
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



        // Validation and calculation on Cr Voucher
        var UiController = (function () {

            var DOMString = {
                submit_form: 'form.form',

                field_area: '.field_area',

                project_id: 'select[name=branch_id]',

                employee_id: 'select[name=employee_id]',

                requisition_date: 'input[name=requisition_date]',
                required_date: 'input[name=required_date]',


                head_of_account_id: '.income_expense_head_id',
                amount: '.amount',


                drCloset: '.dr',

                dr: 'dr',
                plus: 'plus',
                minus: 'minus',

                totaRequisitionlAmount: 'totaRequisitionlAmount',
                total_requisition_amount: 'total_requisition_amount',


            };

            return {
                getDOMString: function () {
                    return DOMString;
                },
                getFields: function () {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),

                        get_project_id: document.querySelector(DOMString.project_id),
                        get_employee_id: document.querySelector(DOMString.employee_id),

                        get_requisition_date: document.querySelector(DOMString.requisition_date),
                        get_required_date: document.querySelector(DOMString.required_date),


                        get_head_of_account_id: document.querySelectorAll(DOMString.head_of_account_id),
                        get_amount: document.querySelectorAll(DOMString.amount),


                        get_dr: document.getElementsByClassName(DOMString.dr),

                        get_plus: document.getElementsByClassName(DOMString.plus),
                        get_minus: document.getElementsByClassName(DOMString.minus),

                        get_totaRequisitionlAmount: document.getElementById(DOMString.totaRequisitionlAmount),
                        get_total_requisition_amount: document.getElementById(DOMString.total_requisition_amount),
                    }
                },
                getValues: function () {
                    var Fields = this.getFields();
                    return {
                        project_id: Fields.get_project_id.value == "" ? 0 : parseFloat(Fields.get_project_id.value),
                        employee_id: Fields.get_employee_id.value == "" ? 0 : parseFloat(Fields.get_employee_id.value),

                        requisition_date: Fields.get_requisition_date.value == "" ? 0 : Fields.get_requisition_date.value,
                        required_date: Fields.get_required_date.value == "" ? 0 : Fields.get_required_date.value,

                    }
                },


                hide: function (Field) {
                    var DomString = this.getDOMString();
                    var Area = Field.closest(DomString.field_area);

                    if (Area) {
                        Field.value = null;
                        Area.style.display = 'none';
                    }
                },
                show: function (Field) {
                    var DomString = this.getDOMString();
                    var Area = Field.closest(DomString.field_area);
                    if (Area) {
                        Area.style.display = 'block';
                    }
                },
                hideHeadAmountArea: function (Field) {
                    Field.querySelector('select').value = 0;
                    if (Field) {
                        Field.style.display = 'none';
                    }
                },

                showHeadAmountArea: function (Field) {
                    var DomString = this.getDOMString();
                    Field.querySelector('select').value = 0;
                    Field.querySelector(DomString.amount).value = "";

                    if (Field) {
                        Field.style.display = 'block';
                    }
                },


            }
        })();


        var MainController = (function (UICnt) {

            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();

            var setUpEventListner = function () {
                Fields.get_form.addEventListener('submit', validation);


                Array.prototype.forEach.call(Fields.get_plus, function (plus, index) {
                    plus.addEventListener('click', function () {
                        addItem(index);
                    }, false);
                });

                Array.prototype.forEach.call(Fields.get_minus, function (minus, index) {
                    minus.addEventListener('click', function () {
                        removeItem(index);
                    }, false);
                });

                Array.prototype.forEach.call(Fields.get_dr, function (dr, index) {

                    var qntity = dr.children[2].querySelector('input');
                    var rate = dr.children[3].querySelector('input');
                    var amount = dr.children[4].querySelector('input');

                    qntity.addEventListener('keyup', function () {
                        calculationAmount(qntity, rate, amount);
                    }, false);

                    rate.addEventListener('keyup', function () {
                        calculationAmount(qntity, rate, amount);
                    }, false);


                });
            };

            var calculationAmount = function (qntity, rate, amount) {

                var qntAmount = (qntity.value == "") ? 0 : parseFloat(qntity.value);
                var rateAmount = (rate.value == "") ? 0 : parseFloat(rate.value);
                var totalAmount = qntAmount * rateAmount;
                amount.value = totalAmount == "" ? 0 : totalAmount;

                amount.style.fontWeight = 'bold';
                amount.style.fontSize = '18px';
                amount.nextElementSibling.style.display = 'none';

                sumRateQntAmount();


            }
            var sumRateQntAmount = function () {

                var totalQnt = 0;
                var totalRate = 0;
                var totalAmount = 0;
                Array.prototype.forEach.call(Fields.get_dr, function (dr, index) {
                    var qntity = dr.children[2].querySelector('input');
                    var rate = dr.children[3].querySelector('input');
                    var amount = dr.children[4].querySelector('input');

                    totalQnt += qntity.value == "" ? 0 : parseFloat(qntity.value);
                    totalRate += rate.value == "" ? 0 : parseFloat(rate.value);
                    totalAmount += amount.value == "" ? 0 : parseFloat(amount.value);
                });

                Fields.get_totaRequisitionlAmount.innerText = totalAmount;
                Fields.get_total_requisition_amount.value = totalAmount;


            }


            var validation = function (e) {
                var Values, Fields;
                Values = UICnt.getValues();
                Fields = UICnt.getFields();

                if (Fields.get_head_of_account_id[0].querySelector('select').value == 0) {
                    toastr["error"]('Select Item Name');
                    e.preventDefault();
                }

                if (Fields.get_amount[3].value == '' || Fields.get_amount[3].value == 0) {
                    toastr["error"]('Put Amount');
                    e.preventDefault();
                }

                if (Values.date == 0) {
                    toastr["error"]('Set Date');
                    e.preventDefault();
                }


                if (Fields.get_dr[1].style.display == 'block') {

                    if (Fields.get_head_of_account_id[2].querySelector('select').value == 0) {
                        toastr["error"]('Select Item Name');
                        e.preventDefault();
                    }


                    if (Fields.get_amount[7].value == '' || Fields.get_amount[7].value == 0) {
                        toastr["error"]('Put Amount ');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[2].style.display == 'block') {

                    if (Fields.get_head_of_account_id[4].querySelector('select').value == 0) {
                        toastr["error"]('Select Item Name');
                        e.preventDefault();
                    }


                    if (Fields.get_amount[11].value == '' || Fields.get_amount[11].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[3].style.display == 'block') {

                    if (Fields.get_head_of_account_id[6].querySelector('select').value == 0) {
                        toastr["error"]('Select Item Name');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[15].value == '' || Fields.get_amount[15].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }
                if (Fields.get_dr[4].style.display == 'block') {


                    if (Fields.get_head_of_account_id[8].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[19].value == '' || Fields.get_amount[19].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }


                 //===== My Changes ======//
                if (Fields.get_dr[5].style.display == 'block') {


                    if (Fields.get_head_of_account_id[10].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[23].value == '' || Fields.get_amount[19].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[6].style.display == 'block') {


                    if (Fields.get_head_of_account_id[12].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[27].value == '' || Fields.get_amount[19].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[7].style.display == 'block') {


                    if (Fields.get_head_of_account_id[14].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[31].value == '' || Fields.get_amount[19].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[8].style.display == 'block') {


                    if (Fields.get_head_of_account_id[16].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[35].value == '' || Fields.get_amount[19].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[9].style.display == 'block') {


                    if (Fields.get_head_of_account_id[18].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[39].value == '' || Fields.get_amount[19].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[10].style.display == 'block') {


                    if (Fields.get_head_of_account_id[20].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[43].value == '' || Fields.get_amount[19].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[11].style.display == 'block') {


                    if (Fields.get_head_of_account_id[22].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[47].value == '' || Fields.get_amount[19].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[12].style.display == 'block') {


                    if (Fields.get_head_of_account_id[24].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[51].value == '' || Fields.get_amount[19].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }
                
                if (Fields.get_dr[13].style.display == 'block') {


                    if (Fields.get_head_of_account_id[26].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[55].value == '' || Fields.get_amount[19].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[14].style.display == 'block') {


                    if (Fields.get_head_of_account_id[28].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[59].value == '' || Fields.get_amount[19].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[15].style.display == 'block') {


                    if (Fields.get_head_of_account_id[30].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[63].value == '' || Fields.get_amount[19].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[16].style.display == 'block') {


                    if (Fields.get_head_of_account_id[32].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[67].value == '' || Fields.get_amount[19].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[17].style.display == 'block') {


                    if (Fields.get_head_of_account_id[34].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[71].value == '' || Fields.get_amount[19].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[18].style.display == 'block') {


                    if (Fields.get_head_of_account_id[36].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[75].value == '' || Fields.get_amount[19].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[19].style.display == 'block') {


                    if (Fields.get_head_of_account_id[38].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[79].value == '' || Fields.get_amount[19].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[20].style.display == 'block') {


                    if (Fields.get_head_of_account_id[40].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[83].value == '' || Fields.get_amount[19].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }
                //===== My Changes ======//




                var head_of_account_Ids = [];

                var get_head_of_account_id_one = Fields.get_head_of_account_id[0].querySelector('select').value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[0].querySelector('select').value);
                var get_head_of_account_id_two = Fields.get_head_of_account_id[2].querySelector('select').value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[2].querySelector('select').value);
                var get_head_of_account_id_three = Fields.get_head_of_account_id[4].querySelector('select').value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[4].querySelector('select').value);
                var get_head_of_account_id_four = Fields.get_head_of_account_id[6].querySelector('select').value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[6].querySelector('select').value);
                var get_head_of_account_id_five = Fields.get_head_of_account_id[8].querySelector('select').value ==
                "" ? 0 : parseFloat(Fields.get_head_of_account_id[8].querySelector('select').value);

                //===== My Changes ======//
                var get_head_of_account_id_six = Fields.get_head_of_account_id[10].querySelector('select').value ==
                "" ? 0 : parseFloat(Fields.get_head_of_account_id[10].querySelector('select').value);
                var get_head_of_account_id_seven = Fields.get_head_of_account_id[12].querySelector('select').value ==
                "" ? 0 : parseFloat(Fields.get_head_of_account_id[12].querySelector('select').value);
                var get_head_of_account_id_eight = Fields.get_head_of_account_id[14].querySelector('select').value ==
                "" ? 0 : parseFloat(Fields.get_head_of_account_id[14].querySelector('select').value);
                var get_head_of_account_id_nine = Fields.get_head_of_account_id[16].querySelector('select').value ==
                "" ? 0 : parseFloat(Fields.get_head_of_account_id[16].querySelector('select').value);
                var get_head_of_account_id_ten = Fields.get_head_of_account_id[18].querySelector('select').value ==
                "" ? 0 : parseFloat(Fields.get_head_of_account_id[18].querySelector('select').value);
                var get_head_of_account_id_eleven = Fields.get_head_of_account_id[20].querySelector('select').value ==
                "" ? 0 : parseFloat(Fields.get_head_of_account_id[20].querySelector('select').value);
                var get_head_of_account_id_twelve = Fields.get_head_of_account_id[22].querySelector('select').value ==
                "" ? 0 : parseFloat(Fields.get_head_of_account_id[22].querySelector('select').value);
                var get_head_of_account_id_thirteen = Fields.get_head_of_account_id[24].querySelector('select').value ==
                "" ? 0 : parseFloat(Fields.get_head_of_account_id[24].querySelector('select').value);
                var get_head_of_account_id_fourteen = Fields.get_head_of_account_id[26].querySelector('select').value ==
                "" ? 0 : parseFloat(Fields.get_head_of_account_id[26].querySelector('select').value);
                var get_head_of_account_id_fifteen = Fields.get_head_of_account_id[28].querySelector('select').value ==
                "" ? 0 : parseFloat(Fields.get_head_of_account_id[28].querySelector('select').value);
                var get_head_of_account_id_sixteen = Fields.get_head_of_account_id[30].querySelector('select').value ==
                "" ? 0 : parseFloat(Fields.get_head_of_account_id[30].querySelector('select').value);
                var get_head_of_account_id_seventeen = Fields.get_head_of_account_id[32].querySelector('select').value ==
                "" ? 0 : parseFloat(Fields.get_head_of_account_id[32].querySelector('select').value);
                var get_head_of_account_id_eighteen = Fields.get_head_of_account_id[34].querySelector('select').value ==
                "" ? 0 : parseFloat(Fields.get_head_of_account_id[34].querySelector('select').value);
                var get_head_of_account_id_nineteen = Fields.get_head_of_account_id[36].querySelector('select').value ==
                "" ? 0 : parseFloat(Fields.get_head_of_account_id[36].querySelector('select').value);
                var get_head_of_account_id_twenty = Fields.get_head_of_account_id[38].querySelector('select').value ==
                "" ? 0 : parseFloat(Fields.get_head_of_account_id[38].querySelector('select').value);
                //===== My Changes ======//


                if (get_head_of_account_id_one > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_one);
                }
                if (get_head_of_account_id_two > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_two);
                }
                if (get_head_of_account_id_three > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_three);
                }
                if (get_head_of_account_id_four > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_four);
                }
                if (get_head_of_account_id_five > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_five);
                }

                 //===== My Changes ======//
                if (get_head_of_account_id_six > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_six);
                }
                if (get_head_of_account_id_seven > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_seven);
                }
                if (get_head_of_account_id_eight > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_eight);
                }
                if (get_head_of_account_id_nine > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_nine);
                }
                if (get_head_of_account_id_ten > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_ten);
                }
                if (get_head_of_account_id_eleven > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_eleven);
                }
                if (get_head_of_account_id_twelve > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_twelve);
                }
                if (get_head_of_account_id_thirteen > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_thirteen);
                }
                if (get_head_of_account_id_fourteen > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_fourteen);
                }
                if (get_head_of_account_id_fifteen > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_fifteen);
                }
                if (get_head_of_account_id_sixteen > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_sixteen);
                }
                if (get_head_of_account_id_seventeen > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_seventeen);
                }
                if (get_head_of_account_id_eighteen > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_eighteen);
                }
                if (get_head_of_account_id_nineteen > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_nineteen);
                }
                if (get_head_of_account_id_twenty > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_twenty);
                }
                 //===== My Changes ======//




                function checkUniqueOrNot(head_of_account_Ids) {
                    var counts = [];
                    for (var i = 0; i <= head_of_account_Ids.length; i++) {
                        if (counts[head_of_account_Ids[i]] === undefined) {
                            counts[head_of_account_Ids[i]] = 1;
                        } else {
                            return true;
                        }
                    }
                    return false;
                }

                if (checkUniqueOrNot(head_of_account_Ids)) {
                    toastr["error"]('Requisition item should unique');
                    e.preventDefault();
                }


                if (Values.requisition_date == 0) {
                    toastr["error"]('Requisition Date is Required');
                    e.preventDefault();
                }
                if (Values.required_date == 0) {
                    toastr["error"]('Required Date is Required');
                    e.preventDefault();
                }

                if (Values.employee_id == 0) {
                    toastr["error"]('Select  Employee Name');
                    e.preventDefault();
                }

                if (Values.project_id == 0) {
                    toastr["error"]('Select  Project Name');
                    e.preventDefault();
                }


            };

            var bankcashChange = function () {
                var Values, Fields;
                Values = UICnt.getValues();
                Fields = UICnt.getFields();

                if (Values.bankcash_id <= 1) {

                    UICnt.hide(Fields.get_cheque_number);
                } else {
                    UICnt.show(Fields.get_cheque_number);
                }

            };

            var addItem = function (index) {
                var Fields;
                Fields = UICnt.getFields();
                UICnt.showHeadAmountArea(Fields.get_dr[index + 1]);
            };
            var removeItem = function (index) {
                var Fields;
                Fields = UICnt.getFields();
                UICnt.hideHeadAmountArea(Fields.get_dr[index + 1]);

                var row = Fields.get_dr[index + 1];

                row.children[2].querySelector('input').value = 0;
                row.children[3].querySelector('input').value = 0;
                row.children[4].querySelector('input').value = 0;

                sumRateQntAmount();


            };


            return {
                init: function () {
                    console.log("App Is running");
                    setUpEventListner();

                    // Default hide fields

                    var Fields = UICnt.getFields();


                    UICnt.hideHeadAmountArea(Fields.get_dr[1]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[2]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[3]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[4]);

                     //===== My Changes ======//
                    UICnt.hideHeadAmountArea(Fields.get_dr[5]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[6]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[7]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[8]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[9]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[10]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[11]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[12]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[13]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[14]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[15]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[16]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[17]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[18]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[19]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[20]);
                     //===== My Changes ======//


                }
            }

        })(UiController);

        MainController.init();

    </script>


@endpush
