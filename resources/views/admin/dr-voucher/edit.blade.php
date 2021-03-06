@extends('layouts.app')

{{--Important Variables--}}

<?php

$moduleName = " Dr Voucher";
$createItemName = " Edit" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " Edit";

$breadcrumbMainIcon = "account_balance_wallet";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Transaction';
$ParentRouteName = 'dr_voucher';


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
                <a class="btn btn-sm btn-info waves-effect" href="{{ route($ParentRouteName) }}">Back</a>
            </div>

            <ol class="breadcrumb breadcrumb-col-cyan pull-right">
                <li><a href="{{ route($ParentRouteName) }}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="{{ route($ParentRouteName) }}"><i
                                class="material-icons">{{ $breadcrumbMainIcon  }}</i>{{  $breadcrumbMainName }}</a>
                </li>
                <li class="active"><i
                            class="material-icons">{{ $breadcrumbCurrentIcon  }}</i> {{ $breadcrumbCurrentName  }}</li>
            </ol>

            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="m-b-20">
                                {{ $createItemName  }}
                                <small>Edit {{ $moduleName  }} Information</small>
                            </h2>

                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route($ParentRouteName.'.update',['id'=>$item[0]->voucher_no]) }}">

                                    {{ csrf_field() }}


                                    <div class="row clearfix">

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 field_area">

                                            <div class="form-group form-float">

                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                            name="branch_id">
                                                        <option value="0">Select Project Name</option>

                                                        @if (App\Branch::all()->count() >0 )

                                                            @foreach( App\Branch::all() as $branch )
                                                                <option @if ( $branch->id == $item[0]->branch_id ))
                                                                        selected
                                                                        @endif value="{{ $branch->id  }}">{{ $branch->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                            name="bank_cash_id"
                                                            id="">
                                                        <option value="0"> Select Bank Cash Name</option>

                                                        @if (App\BankCash::all()->count() >0 )
                                                            @foreach( App\BankCash::all() as $bank_cash )
                                                                <option @if ( $bank_cash->id == $item[0]->bank_cash_id))
                                                                        selected
                                                                        @endif value="{{ $bank_cash->id  }}">{{ $bank_cash->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $item[0]->cheque_number  }}" name="cheque_number"
                                                           type="text"
                                                           class="form-control">
                                                    <label class="form-label">Cheque Number</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name</option>

                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                <option @if ( $HeadOfAccount->id == $item[0]->income_expense_head_id)
                                                                        selected
                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $item[0]->amount }}" name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>

                                            </div>
                                        </div>
                                    </div>

                                    @if ( !empty($item[1]->income_expense_head_id) )
                                        <?php $headOfAccountID1 = $item[1]->income_expense_head_id ?>
                                    @else
                                        <?php $headOfAccountID1 = ""; ?>
                                    @endif

                                    @if ( !empty($item[1]->amount) )
                                        <?php $amount1 = $item[1]->amount; ?>

                                    @else
                                        <?php $amount1 = ""; ?>
                                    @endif

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name</option>

                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                <option @if ( $HeadOfAccount->id == $headOfAccountID1 )
                                                                        selected
                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $amount1 }}" name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>


                                    @if ( !empty($item[2]->income_expense_head_id) )
                                        <?php $headOfAccountID2 = $item[2]->income_expense_head_id ?>
                                    @else
                                        <?php $headOfAccountID2 = ""; ?>
                                    @endif

                                    @if ( !empty($item[2]->amount) )
                                        <?php $amount2 = $item[2]->amount; ?>

                                    @else
                                        <?php $amount2 = ""; ?>
                                    @endif

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name</option>

                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                <option @if ( $HeadOfAccount->id == $headOfAccountID2)
                                                                        selected
                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $amount2 }}" name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>

                                    @if ( !empty($item[3]->income_expense_head_id) )
                                        <?php $headOfAccountID3 = $item[3]->income_expense_head_id ?>
                                    @else
                                        <?php $headOfAccountID3 = ""; ?>
                                    @endif

                                    @if ( !empty($item[3]->amount) )
                                        <?php $amount3 = $item[3]->amount; ?>

                                    @else
                                        <?php $amount3 = ""; ?>
                                    @endif

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name</option>

                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                <option @if ( $HeadOfAccount->id == $headOfAccountID3)
                                                                        selected
                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $amount3 }}" name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>


                                    @if ( !empty($item[4]->income_expense_head_id) )
                                        <?php $headOfAccountID4 = $item[4]->income_expense_head_id ?>
                                    @else
                                        <?php $headOfAccountID4 = ""; ?>
                                    @endif

                                    @if ( !empty($item[4]->amount) )
                                        <?php $amount4 = $item[4]->amount; ?>

                                    @else
                                        <?php $amount4 = ""; ?>
                                    @endif

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name</option>

                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                <option @if ( $HeadOfAccount->id == $headOfAccountID4)
                                                                        selected
                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $amount4 }}" name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>


                                    @if ( !empty($item[5]->income_expense_head_id) )
                                        <?php $headOfAccountID5 = $item[5]->income_expense_head_id ?>
                                    @else
                                        <?php $headOfAccountID5 = ""; ?>
                                    @endif

                                    @if ( !empty($item[5]->amount) )
                                        <?php $amount5 = $item[5]->amount; ?>

                                    @else
                                        <?php $amount5 = ""; ?>
                                    @endif

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name</option>

                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                <option @if ( $HeadOfAccount->id == $headOfAccountID5)
                                                                        selected
                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $amount5 }}" name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>


                                    @if ( !empty($item[6]->income_expense_head_id) )
                                        <?php $headOfAccountID6 = $item[6]->income_expense_head_id ?>
                                    @else
                                        <?php $headOfAccountID6 = ""; ?>
                                    @endif

                                    @if ( !empty($item[6]->amount) )
                                        <?php $amount6 = $item[6]->amount; ?>

                                    @else
                                        <?php $amount6 = ""; ?>
                                    @endif

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name</option>

                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                <option @if ( $HeadOfAccount->id == $headOfAccountID6)
                                                                        selected
                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $amount6 }}" name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>


                                     @if ( !empty($item[7]->income_expense_head_id) )
                                        <?php $headOfAccountID7 = $item[7]->income_expense_head_id ?>
                                    @else
                                        <?php $headOfAccountID7 = ""; ?>
                                    @endif

                                    @if ( !empty($item[7]->amount) )
                                        <?php $amount7 = $item[7]->amount; ?>

                                    @else
                                        <?php $amount7 = ""; ?>
                                    @endif

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name</option>

                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                <option @if ( $HeadOfAccount->id == $headOfAccountID7)
                                                                        selected
                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $amount7 }}" name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>


                                    @if ( !empty($item[8]->income_expense_head_id) )
                                        <?php $headOfAccountID8 = $item[8]->income_expense_head_id ?>
                                    @else
                                        <?php $headOfAccountID8 = ""; ?>
                                    @endif

                                    @if ( !empty($item[8]->amount) )
                                        <?php $amount8 = $item[8]->amount; ?>

                                    @else
                                        <?php $amount8 = ""; ?>
                                    @endif

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name</option>

                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                <option @if ( $HeadOfAccount->id == $headOfAccountID8)
                                                                        selected
                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $amount8 }}" name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>


                                    @if ( !empty($item[9]->income_expense_head_id) )
                                        <?php $headOfAccountID9 = $item[9]->income_expense_head_id ?>
                                    @else
                                        <?php $headOfAccountID9 = ""; ?>
                                    @endif

                                    @if ( !empty($item[9]->amount) )
                                        <?php $amount9 = $item[9]->amount; ?>

                                    @else
                                        <?php $amount9 = ""; ?>
                                    @endif

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name</option>

                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                <option @if ( $HeadOfAccount->id == $headOfAccountID9)
                                                                        selected
                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $amount9 }}" name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>


                                    @if ( !empty($item[10]->income_expense_head_id) )
                                        <?php $headOfAccountID10 = $item[10]->income_expense_head_id ?>
                                    @else
                                        <?php $headOfAccountID10 = ""; ?>
                                    @endif

                                    @if ( !empty($item[10]->amount) )
                                        <?php $amount10 = $item[10]->amount; ?>

                                    @else
                                        <?php $amount10 = ""; ?>
                                    @endif

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name</option>

                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                <option @if ( $HeadOfAccount->id == $headOfAccountID10)
                                                                        selected
                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $amount10 }}" name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>

                                     @if ( !empty($item[11]->income_expense_head_id) )
                                        <?php $headOfAccountID11 = $item[11]->income_expense_head_id ?>
                                    @else
                                        <?php $headOfAccountID11 = ""; ?>
                                    @endif

                                    @if ( !empty($item[11]->amount) )
                                        <?php $amount11 = $item[11]->amount; ?>

                                    @else
                                        <?php $amount11 = ""; ?>
                                    @endif

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name</option>

                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                <option @if ( $HeadOfAccount->id == $headOfAccountID11)
                                                                        selected
                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $amount11 }}" name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>


                                     @if ( !empty($item[12]->income_expense_head_id) )
                                        <?php $headOfAccountID12 = $item[12]->income_expense_head_id ?>
                                    @else
                                        <?php $headOfAccountID12 = ""; ?>
                                    @endif

                                    @if ( !empty($item[12]->amount) )
                                        <?php $amount12 = $item[12]->amount; ?>

                                    @else
                                        <?php $amount12 = ""; ?>
                                    @endif

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name</option>

                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                <option @if ( $HeadOfAccount->id == $headOfAccountID12)
                                                                        selected
                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $amount12 }}" name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>

                                     @if ( !empty($item[13]->income_expense_head_id) )
                                        <?php $headOfAccountID13 = $item[13]->income_expense_head_id ?>
                                    @else
                                        <?php $headOfAccountID13 = ""; ?>
                                    @endif

                                    @if ( !empty($item[13]->amount) )
                                        <?php $amount13 = $item[13]->amount; ?>

                                    @else
                                        <?php $amount13 = ""; ?>
                                    @endif

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name</option>

                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                <option @if ( $HeadOfAccount->id == $headOfAccountID13)
                                                                        selected
                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $amount13 }}" name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>


                                     @if ( !empty($item[14]->income_expense_head_id) )
                                        <?php $headOfAccountID14 = $item[14]->income_expense_head_id ?>
                                    @else
                                        <?php $headOfAccountID14 = ""; ?>
                                    @endif

                                    @if ( !empty($item[14]->amount) )
                                        <?php $amount14 = $item[14]->amount; ?>

                                    @else
                                        <?php $amount14 = ""; ?>
                                    @endif

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name</option>

                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                <option @if ( $HeadOfAccount->id == $headOfAccountID14)
                                                                        selected
                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $amount14 }}" name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>


                                     @if ( !empty($item[15]->income_expense_head_id) )
                                        <?php $headOfAccountID15 = $item[15]->income_expense_head_id ?>
                                    @else
                                        <?php $headOfAccountID15 = ""; ?>
                                    @endif

                                    @if ( !empty($item[15]->amount) )
                                        <?php $amount15 = $item[15]->amount; ?>

                                    @else
                                        <?php $amount15 = ""; ?>
                                    @endif

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name</option>

                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                <option @if ( $HeadOfAccount->id == $headOfAccountID15)
                                                                        selected
                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $amount15 }}" name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>


                                     @if ( !empty($item[16]->income_expense_head_id) )
                                        <?php $headOfAccountID16 = $item[16]->income_expense_head_id ?>
                                    @else
                                        <?php $headOfAccountID16 = ""; ?>
                                    @endif

                                    @if ( !empty($item[16]->amount) )
                                        <?php $amount16 = $item[16]->amount; ?>

                                    @else
                                        <?php $amount16 = ""; ?>
                                    @endif

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name</option>

                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                <option @if ( $HeadOfAccount->id == $headOfAccountID16)
                                                                        selected
                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $amount16 }}" name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>


                                     @if ( !empty($item[17]->income_expense_head_id) )
                                        <?php $headOfAccountID17 = $item[17]->income_expense_head_id ?>
                                    @else
                                        <?php $headOfAccountID17 = ""; ?>
                                    @endif

                                    @if ( !empty($item[17]->amount) )
                                        <?php $amount17 = $item[17]->amount; ?>

                                    @else
                                        <?php $amount17 = ""; ?>
                                    @endif

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name</option>

                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                <option @if ( $HeadOfAccount->id == $headOfAccountID17)
                                                                        selected
                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $amount17 }}" name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>


                                     @if ( !empty($item[18]->income_expense_head_id) )
                                        <?php $headOfAccountID18 = $item[18]->income_expense_head_id ?>
                                    @else
                                        <?php $headOfAccountID18 = ""; ?>
                                    @endif

                                    @if ( !empty($item[18]->amount) )
                                        <?php $amount18 = $item[18]->amount; ?>

                                    @else
                                        <?php $amount18 = ""; ?>
                                    @endif

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name</option>

                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                <option @if ( $HeadOfAccount->id == $headOfAccountID18)
                                                                        selected
                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $amount18 }}" name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>



                                    @if ( !empty($item[19]->income_expense_head_id) )
                                        <?php $headOfAccountID19 = $item[19]->income_expense_head_id ?>
                                    @else
                                        <?php $headOfAccountID19 = ""; ?>
                                    @endif

                                    @if ( !empty($item[19]->amount) )
                                        <?php $amount19 = $item[19]->amount; ?>

                                    @else
                                        <?php $amount19 = ""; ?>
                                    @endif

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name</option>

                                                        @if (App\IncomeExpenseHead::all()->count() >0 )
                                                            @foreach( App\IncomeExpenseHead::all() as $HeadOfAccount )
                                                                <option @if ( $HeadOfAccount->id == $headOfAccountID19)
                                                                        selected
                                                                        @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $amount19 }}" name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line" id="bs_datepicker_container">
                                                    <input autocomplete="off" value="{{ date("m/d/Y", strtotime
                                                    ($item[0]->voucher_date)) }}"
                                                           name="voucher_date"
                                                           type="text"
                                                           class="form-control"
                                                           placeholder="Please choose a date...">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <textarea name="particulars" rows="2" class="form-control no-resize"
                                                              placeholder="Particulars">{{ $item[0]->particulars  }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                    Update
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

                bankcash_id: 'select[name=bank_cash_id]',
                cheque_number: 'input[name=cheque_number]',

                head_of_account_id: '.income_expense_head_id',
                amount: '.amount',

                date: 'input[name=voucher_date]',
                particulars: 'textarea[name=particulars]',

                drCloset: '.dr',

                dr: 'dr',
                plus: 'plus',
                minus: 'minus',


            };

            return {
                getDOMString: function () {
                    return DOMString;
                },
                getFields: function () {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),

                        get_project_id: document.querySelector(DOMString.project_id),


                        get_bankcash_id: document.querySelector(DOMString.bankcash_id),
                        get_cheque_number: document.querySelector(DOMString.cheque_number),


                        get_head_of_account_id: document.querySelectorAll(DOMString.head_of_account_id),
                        get_amount: document.querySelectorAll(DOMString.amount),

                        get_date: document.querySelector(DOMString.date),
                        get_particulars: document.querySelector(DOMString.particulars),
                        get_dr: document.getElementsByClassName(DOMString.dr),

                        get_plus: document.getElementsByClassName(DOMString.plus),
                        get_minus: document.getElementsByClassName(DOMString.minus),
                    }
                },
                getValues: function () {
                    var Fields = this.getFields();
                    return {
                        project_id: Fields.get_project_id.value == "" ? 0 : parseFloat(Fields.get_project_id.value),

                        bankcash_id: Fields.get_bankcash_id.value == "" ? 0 : parseFloat(Fields.get_bankcash_id.value),
                        cheque_number: Fields.get_cheque_number.value == "" ? 0 : parseFloat(Fields.get_cheque_number.value),

                        date: Fields.get_date.value == "" ? 0 : Fields.get_date.value,
                        particulars: Fields.get_particulars.value == "" ? 0 : Fields.get_particulars.value,

                    }
                },


                hide: function (Field) {
                    var DomString = this.getDOMString();
                    var Area = Field.closest(DomString.field_area);
                    if (Area) {
                        var fields=this.getFields();
                        fields.get_cheque_number.value=null;
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
                    if (Field) {
                        Field.style.display = 'none';
                    }
                },

                showHeadAmountArea: function (Field) {
                    var DomString = this.getDOMString();
                    // Field.querySelector('select').value = 0;
                    // Field.querySelector(DomString.amount).value = "";

                    if (Field) {
                        Field.style.display = 'block';
                    }
                },

                setZero: function (Field) {
                    Field.value = 0;
                },
                setEmpty: function (Field) {
                    Field.value = "";
                },

            }
        })();


        var MainController = (function (UICnt) {

            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();

            var setUpEventListner = function () {
                Fields.get_form.addEventListener('submit', validation);

                Fields.get_bankcash_id.addEventListener('change', bankcashChange);

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

            };

            var validation = function (e) {
                var Values, Fields;
                Values = UICnt.getValues();
                Fields = UICnt.getFields();

                if (Values.project_id == 0) {
                    toastr["error"]('Select  Project');
                    e.preventDefault();
                }

                if (Values.bankcash_id == 0) {
                    toastr["error"]('Select Bank Cash Name');
                    e.preventDefault();
                }

                if (Fields.get_head_of_account_id[0].querySelector('select').value == 0) {
                    toastr["error"]('Select Head Of Account');
                    e.preventDefault();
                }

                if (Fields.get_amount[0].value == '') {
                    toastr["error"]('Put Amount');
                    e.preventDefault();
                }

                if (Values.date == 0) {
                    toastr["error"]('Set Date');
                    e.preventDefault();
                }


                if (Fields.get_dr[1].style.display == 'block') {

                    if (Fields.get_head_of_account_id[2].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[1].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[2].style.display == 'block') {

                    if (Fields.get_head_of_account_id[4].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[2].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[3].style.display == 'block') {

                    if (Fields.get_head_of_account_id[6].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[3].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[4].style.display == 'block') {

                    if (Fields.get_head_of_account_id[8].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[4].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }


                //===== My Changes ===== //
                if (Fields.get_dr[5].style.display == 'block') {


                    if (Fields.get_head_of_account_id[10].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[5].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[6].style.display == 'block') {


                    if (Fields.get_head_of_account_id[12].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[6].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                 if (Fields.get_dr[7].style.display == 'block') {


                    if (Fields.get_head_of_account_id[14].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[7].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                if (Fields.get_dr[8].style.display == 'block') {


                    if (Fields.get_head_of_account_id[16].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[8].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                 if (Fields.get_dr[9].style.display == 'block') {


                    if (Fields.get_head_of_account_id[18].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[9].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                 if (Fields.get_dr[10].style.display == 'block') {


                    if (Fields.get_head_of_account_id[20].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[10].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                 if (Fields.get_dr[11].style.display == 'block') {


                    if (Fields.get_head_of_account_id[22].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[11].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                 if (Fields.get_dr[12].style.display == 'block') {


                    if (Fields.get_head_of_account_id[24].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[12].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                 if (Fields.get_dr[13].style.display == 'block') {


                    if (Fields.get_head_of_account_id[26].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[13].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                 if (Fields.get_dr[14].style.display == 'block') {


                    if (Fields.get_head_of_account_id[28].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[14].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                 if (Fields.get_dr[15].style.display == 'block') {


                    if (Fields.get_head_of_account_id[30].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[15].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                 if (Fields.get_dr[16].style.display == 'block') {


                    if (Fields.get_head_of_account_id[32].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[16].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                 if (Fields.get_dr[17].style.display == 'block') {


                    if (Fields.get_head_of_account_id[34].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[17].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                 if (Fields.get_dr[18].style.display == 'block') {


                    if (Fields.get_head_of_account_id[36].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[18].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                 if (Fields.get_dr[19].style.display == 'block') {


                    if (Fields.get_head_of_account_id[38].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[19].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                 if (Fields.get_dr[20].style.display == 'block') {


                    if (Fields.get_head_of_account_id[40].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[20].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                //===== My Changes ====== //


                var head_of_account_Ids = [];

                var get_head_of_account_id_one = Fields.get_head_of_account_id[0].querySelector('select').value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[0].querySelector('select').value);
                var get_head_of_account_id_two = Fields.get_head_of_account_id[2].querySelector('select').value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[2].querySelector('select').value);
                var get_head_of_account_id_three = Fields.get_head_of_account_id[4].querySelector('select').value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[4].querySelector('select').value);
                var get_head_of_account_id_four = Fields.get_head_of_account_id[6].querySelector('select').value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[6].querySelector('select').value);
                var get_head_of_account_id_five = Fields.get_head_of_account_id[8].querySelector('select').value == "" ?
                    0 : parseFloat(Fields.get_head_of_account_id[8].querySelector('select').value);

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
                    toastr["error"]('Head of Account should unique');
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
                var Fields, DomString;
                Fields = UICnt.getFields();
                DomString = UICnt.getDOMString();
                UICnt.hideHeadAmountArea(Fields.get_dr[index + 1]);

                UICnt.setZero(Fields.get_dr[index + 1].querySelector('select'));
                UICnt.setEmpty(Fields.get_dr[index + 1].querySelector(DomString.amount));

            };


            return {
                init: function () {
                    console.log("App Is running");
                    setUpEventListner();

                    // Default hide fields

                    var Fields = UICnt.getFields();
                    var Values = UICnt.getValues();

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


                    @if ( !empty($item[1]->income_expense_head_id) )
                        UICnt.showHeadAmountArea(Fields.get_dr[1]);

                    @endif

                    @if ( !empty($item[2]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[2]);
                    @endif

                    @if ( !empty($item[3]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[3]);
                    @endif

                    @if ( !empty($item[4]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[4]);
                    @endif


                    //===== My Changes =====//
                    @if ( !empty($item[5]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[5]);
                    @endif

                    @if ( !empty($item[6]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[6]);
                    @endif

                    @if ( !empty($item[7]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[7]);
                    @endif

                    @if ( !empty($item[8]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[8]);
                    @endif

                    @if ( !empty($item[9]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[9]);
                    @endif

                    @if ( !empty($item[10]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[10]);
                    @endif

                    @if ( !empty($item[11]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[11]);
                    @endif

                    @if ( !empty($item[12]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[12]);
                    @endif

                    @if ( !empty($item[13]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[13]);
                    @endif

                    @if ( !empty($item[14]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[14]);
                    @endif

                    @if ( !empty($item[15]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[15]);
                    @endif

                    @if ( !empty($item[16]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[16]);
                    @endif

                    @if ( !empty($item[17]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[17]);
                    @endif

                    @if ( !empty($item[18]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[18]);
                    @endif

                    @if ( !empty($item[19]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[19]);
                    @endif

                    @if ( !empty($item[20]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[20]);
                    @endif
                    
                    //===== My Changes =====//



                    if (Values.bankcash_id <= 1) {

                        UICnt.hide(Fields.get_cheque_number);
                    } else {
                        UICnt.show(Fields.get_cheque_number);
                    }





                }
            }

        })(UiController);

        MainController.init();


    </script>

@endpush
