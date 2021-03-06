@extends('layouts.app')

{{--Important Variables--}}

<?php

$moduleName = " Actual Payment Manage";
$createItemName = "Create" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " Create";

$breadcrumbMainIcon = "fas fa-user-graduate";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\ScheduleReceivable';
$ParentRouteName = 'receivable_schedule';


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
                <a class="btn btn-sm btn-info waves-effect"
                   href="{{ route('schedule_manage',['sells_id'=>$sells_id]) }}">Back</a>
            </div>

            <ol class="breadcrumb breadcrumb-col-cyan pull-right">
                <li><a href=""><i class="material-icons">home</i> Home</a></li>
                <li><a href="{{ route('sell') }}"> <i class="fas fa-dolly"></i> Sell</a></li>
                <li><a href="{{ route('schedule_manage',['id'=>$sells_id]) }}"><i class="material-icons">schedule</i>
                        Schedule Manage</a></li>
                <li class="active"><i class="material-icons">archive</i> Create</li>
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
                                      action="{{ route('actual_payment.store',['sells_id'=>$sells_id]) }}">

                                    {{ csrf_field() }}
                                    <div class="row clearfix">

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">

                                                    @php
                                                        $terms = [
                                                            'Booking Money'=>'Booking Money',
                                                            'Down Payment'=>'Down Payment',
                                                            'Additional Payment'=>'Additional Payment',
                                                            'Utility Charge'=>'Utility Charge',
                                                            'Other Charge'=>'Other Charge',
                                                            '1st Installment'=>'1st Installment',
                                                            '2nd Installment'=>'2nd Installment',
                                                            '3rd Installment'=>'3rd Installment',
                                                            '4th Installment'=>'4th Installment',
                                                            '5th Installment'=>'5th Installment',
                                                            '6th Installment'=>'6th Installment',
                                                            '7th Installment'=>'7th Installment',
                                                            '8th Installment'=>'8th Installment',
                                                            '9th Installment'=>'9th Installment',
                                                            '10th Installment'=>'10th Installment',
                                                            '11th Installment'=>'11th Installment',
                                                            '12th Installment'=>'12th Installment',
                                                            '13th Installment'=>'13th Installment',
                                                            '14th Installment'=>'14th Installment',
                                                            '15th Installment'=>'15th Installment',
                                                            '16th Installment'=>'16th Installment',
                                                            '17th Installment'=>'17th Installment',
                                                            '18th Installment'=>'18th Installment',
                                                            '19th Installment'=>'19th Installment',
                                                            '20th Installment'=>'20th Installment',
                                                            '21st Installment'=>'21st Installment',
                                                            '22nd Installment'=>'22nd Installment',
                                                            '23rd Installment'=>'23rd Installment',
                                                            '24th Installment'=>'24th Installment',
                                                            '25th Installment'=>'25th Installment',
                                                            '26th Installment'=>'26th Installment',
                                                            '27th Installment'=>'27th Installment',
                                                            '28th Installment'=>'28th Installment',
                                                            '29th Installment'=>'29th Installment',
                                                            '30th Installment'=>'30th Installment',
                                                            '31st Installment'=>'31st Installment',
                                                            '32nd Installment'=>'32nd Installment',
                                                            '33rd Installment'=>'33rd Installment',
                                                            '34th Installment'=>'34th Installment',
                                                            '35th Installment'=>'35th Installment',
                                                            '36th Installment'=>'36th Installment',
                                                            '37th Installment'=>'37th Installment',
                                                            '38th Installment'=>'38th Installment',
                                                            '39th Installment'=>'39th Installment',
                                                            '40th Installment'=>'40th Installment',
                                                        ];
                                                    @endphp

                                                    <select data-live-search="true" class="form-control show-tick"
                                                            name="term">
                                                        <option value="0">Select Term Name</option>
                                                        @foreach(  $terms as $term )
                                                            <option @if ( $term == old('term' ))
                                                                    selected
                                                                    @endif value="{{ $term  }}">{{ $term  }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ old('received_amount')  }}" name="received_amount"
                                                           type="number"
                                                           class="form-control">
                                                    <label class="form-label">Received Amount</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ old('adjustment')  }}" name="adjustment"
                                                           type="number"
                                                           class="form-control">
                                                    <label class="form-label">Adjustment</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <label class="form-label">Actual Amount</label>
                                                <div class="form-line">
                                                    <input readonly value="{{ old('actual_amount')  }}"
                                                           name="actual_amount" type="number"
                                                           class="form-control">

                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <label class="form-label">Made of Payment</label>
                                                <div class="form-line">
                                                    <input value="{{ old('made_of_payment')  }}" name="made_of_payment"
                                                           type="text"
                                                           class="form-control">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <label class="form-label">Cheque No</label>
                                                <div class="form-line">
                                                    <input value="{{ old('cheque_no')  }}" name="cheque_no" type="text"
                                                           class="form-control">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ old('bank_name')  }}" name="bank_name" type="text"
                                                           class="form-control">
                                                    <label class="form-label">Bank Name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line" id="bs_datepicker_container">
                                                    <label class="form-label">Date Of Collection</label>
                                                    <input autocomplete="off" value="{{ old('date_of_collection') }}"
                                                           name="date_of_collection"
                                                           type="text"
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">

                                                    <textarea class="form-control" name="remark"
                                                              id="">{{ old('remark') }}</textarea>
                                                    <label class="form-label">Remark</label>
                                                </div>
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



        // Validation and calculation
        var UiController = (function () {

            var DOMString = {
                submit_form: 'form.form',

                term: 'select[name=term]',
                received_amount: 'input[name=received_amount]',
                adjustment: 'input[name=adjustment]',
                actual_amount: 'input[name=actual_amount]',
                date_of_collection: 'input[name=date_of_collection]',
            };

            return {
                getDOMString: function () {
                    return DOMString;
                },
                getFields: function () {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),

                        get_term: document.querySelector(DOMString.term),
                        get_received_amount: document.querySelector(DOMString.received_amount),
                        get_adjustment: document.querySelector(DOMString.adjustment),
                        get_actual_amount: document.querySelector(DOMString.actual_amount),
                        get_date_of_collection: document.querySelector(DOMString.date_of_collection),
                    }
                },
                getInputsValue: function () {
                    var Fields = this.getFields();
                    return {
                        term: Fields.get_term.value == "" ? 0 : Fields.get_term.value,
                        received_amount: Fields.get_received_amount.value == "" ? 0 : parseFloat(Fields.get_received_amount.value),
                        adjustment: Fields.get_adjustment.value == "" ? 0 : parseFloat(Fields.get_adjustment.value),
                        actual_amount: Fields.get_actual_amount.value == "" ? 0 : parseFloat(Fields.get_actual_amount.value),
                        date_of_collection: Fields.get_date_of_collection.value == "" ? 0 : Fields.get_date_of_collection.value,
                    }
                },

            }
        })();

        var MainController = (function (UICnt) {

            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();

            var setUpEventListner = function () {

                Fields.get_form.addEventListener('submit', validation);

                Fields.get_received_amount.addEventListener('keyup', ActualAmount);
                Fields.get_adjustment.addEventListener('keyup', ActualAmount);

            };

            var ActualAmount = function () {

                var input_values, Fields, received_amount, adjustment, actual_amount;
                input_values = UICnt.getInputsValue();
                Fields = UICnt.getFields();

                received_amount = input_values.received_amount;
                adjustment = input_values.adjustment;

                actual_amount = received_amount - adjustment;

                total_actual_amount = received_amount - adjustment;
                Fields.get_actual_amount.value = total_actual_amount;
                console.log(total_actual_amount);
            }


            var validation = function (e) {
                var input_values, Fields;
                input_values = UICnt.getInputsValue();
                Fields = UICnt.getFields();

                if (input_values.date_of_collection == 0) {
                    toastr["error"]('Date Of Collection Is Required');
                    e.preventDefault();
                }

                if (input_values.actual_amount == 0) {
                    toastr["error"]('Actual Amount Is Required');
                    e.preventDefault();
                }

                if (input_values.received_amount == 0) {
                    toastr["error"]('Received Amount Is Required');
                    e.preventDefault();
                }


                if (input_values.term == 0) {
                    toastr["error"]('Term Is Required');
                    e.preventDefault();
                }


            };

            return {
                init: function () {
                    console.log("App Is running");
                    setUpEventListner();

                }
            }

        })(UiController);

        MainController.init();


    </script>

@endpush
