@extends('layouts.app')

{{--Important Variables--}}

<?php

$moduleName = " Product Manage";
$createItemName = "Create" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " Create";

$breadcrumbMainIcon = "fas fa-boxes";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Product';
$ParentRouteName = 'product';




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
                                <form enctype="multipart/form-data" class="form" id="form_validation" method="post"
                                      action="{{ route($ParentRouteName.'.store') }}">

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
                                                                <option @if ( $branch->id == old('branch_id' ))
                                                                        selected
                                                                        @endif value="{{ $branch->id  }}">{{ $branch->name  }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    {{-- <input value="{{ old('flat_type')  }}" name="flat_type" type="text"
                                                           class="form-control">

                                                    <label class="form-label">Flat Type</label> --}}

                                                    <select data-live-search="true" class="form-control show-tick"
                                                            name="flat_type">
                                                        <option value="0">Select Flat Type</option>

                                                        @php
                                                            $flatTypes= [
                                                                'A'=>'A',
                                                                'B'=>'B',
                                                                'C'=>'C',
                                                                'D'=>'D',
                                                                'E'=>'E',
                                                                'G'=>'F',
                                                                'H'=>'I',
                                                                'J'=>'J',
                                                                'K'=>'K',
                                                            ];
                                                        @endphp

                                                        @foreach ($flatTypes as $key=>$value )
                                                            <option @if ($key==old('flat_type'))
                                                                    selected
                                                                    @endif value="{{ $key }} ">{{ $value }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    {{-- <input value="{{ old('floor_number')  }}" name="floor_number" type="text"
                                                        class="form-control">
                                                    <label class="form-label">Floor Number</label> --}}
                                                    <select data-live-search="true" class="form-control show-tick"
                                                            name="floor_number">
                                                        <option value="0">Select Floor Number</option>

                                                        @php
                                                            $floor_numbers= [
                                                                '1st'=>'1st',
                                                                '2nd'=>'2nd',
                                                                '3rd'=>'3rd',
                                                                '4th'=>'4th',
                                                                '5th'=>'5th',
                                                                '6th'=>'6th',
                                                                '7th'=>'7th',
                                                                '8th'=>'8th',
                                                                '9th'=>'9th',
                                                                '10th'=>'10th',
                                                                '12th'=>'12th',
                                                                '13th'=>'13th',
                                                                '14th'=>'14th',
                                                                '15th'=>'15th',
                                                                '16th'=>'16th',
                                                                '17th'=>'17th',
                                                                '18th'=>'18th',
                                                                '19th'=>'19th',
                                                                '20th'=>'20th',
                                                                
                                                            ];
                                                        @endphp

                                                        @foreach ($floor_numbers as $key=>$value )
                                                            <option @if ($key==old('floor_number'))
                                                                    selected
                                                                    @endif value="{{ $key }} ">{{ $value }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <label class="form-label">Flat Size</label>
                                                <div class="form-line">
                                                    <input value="{{ old('flat_size')  }}" name="flat_size"
                                                           type="number"
                                                           class="form-control">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <label class="form-label">Unite Price</label>
                                                <div class="form-line">
                                                    <input value="{{ old('unite_price')  }}" name="unite_price"
                                                           type="number"
                                                           class="form-control">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <label class="form-label">Total Flat Price</label>
                                                <div class="form-line">
                                                    <input readonly value="{{ old('total_flat_price')  }}"
                                                           name="total_flat_price" type="number"
                                                           class="form-control">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ old('car_parking_charge')  }}"
                                                           name="car_parking_charge" type="number"
                                                           class="form-control">
                                                    <label class="form-label">Car Parking Charge</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ old('utility_charge')  }}" name="utility_charge"
                                                           type="number"
                                                           class="form-control">
                                                    <label class="form-label">Utility Charge</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ old('additional_work_charge')  }}"
                                                           name="additional_work_charge" type="number"
                                                           class="form-control">
                                                    <label class="form-label">Additional Work Charge</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ old('other_charge')  }}" name="other_charge"
                                                           type="number"
                                                           class="form-control">
                                                    <label class="form-label">Other Charge</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ old('discount_or_deduction')  }}"
                                                           name="discount_or_deduction" type="number"
                                                           class="form-control">
                                                    <label class="form-label">Discount Or Deduction</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ old('refund_additional_work_charge')  }}"
                                                           name="refund_additional_work_charge" type="number"
                                                           class="form-control">
                                                    <label class="form-label">Refund Additional Work Charge</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <label class="form-label">Net Sells Price</label>
                                                <div class="form-line">
                                                    <input readonly value="{{ old('net_sells_price')  }}"
                                                           name="net_sells_price" type="number"
                                                           class="form-control">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                                            <div class="form-group ">
                                                <div class="form-line">
                                                    <input name="product_img" type="file" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">

                                                    <textarea class="form-control" name="description"
                                                              id="">{{ old('description') }}</textarea>
                                                    <label class="form-label">Description</label>
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
                branch_id: 'select[name=branch_id]',
                flat_type: 'select[name=flat_type]',
                floor_number: 'select[name=floor_number]',

                flat_size: 'input[name=flat_size]',
                unite_price: 'input[name=unite_price]',
                total_flat_price: 'input[name=total_flat_price]',

                car_parking_charge: 'input[name=car_parking_charge]',
                utility_charge: 'input[name=utility_charge]',
                additional_work_charge: 'input[name=additional_work_charge]',
                other_charge: 'input[name=other_charge]',
                discount_or_deduction: 'input[name=discount_or_deduction]',
                refund_additional_work_charge: 'input[name=refund_additional_work_charge]',

                net_sells_price: 'input[name=net_sells_price]',


            };

            return {
                getDOMString: function () {
                    return DOMString;
                },
                getFields: function () {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),
                        get_branch_id: document.querySelector(DOMString.branch_id),
                        get_flat_type: document.querySelector(DOMString.flat_type),
                        get_floor_number: document.querySelector(DOMString.floor_number),

                        get_flat_size: document.querySelector(DOMString.flat_size),
                        get_unite_price: document.querySelector(DOMString.unite_price),
                        get_total_flat_price: document.querySelector(DOMString.total_flat_price),

                        get_car_parking_charge: document.querySelector(DOMString.car_parking_charge),
                        get_utility_charge: document.querySelector(DOMString.utility_charge),
                        get_additional_work_charge: document.querySelector(DOMString.additional_work_charge),
                        get_other_charge: document.querySelector(DOMString.other_charge),
                        get_discount_or_deduction: document.querySelector(DOMString.discount_or_deduction),
                        get_refund_additional_work_charge: document.querySelector(DOMString.refund_additional_work_charge),
                        get_net_sells_price: document.querySelector(DOMString.net_sells_price),


                    }
                },
                getInputsValue: function () {
                    var Fields = this.getFields();
                    return {

                        branch_id: Fields.get_branch_id.value == "" ? 0 : parseFloat(Fields.get_branch_id.value),

                        flat_type: Fields.get_flat_type.value == "" ? 0 : Fields.get_flat_type.value,
                        floor_number: Fields.get_floor_number.value == "" ? 0 : Fields.get_floor_number.value,

                        flat_size: Fields.get_flat_size.value == "" ? 0 : parseFloat(Fields.get_flat_size.value),
                        unite_price: Fields.get_unite_price.value == "" ? 0 : parseFloat(Fields.get_unite_price.value),
                        total_flat_price: Fields.get_total_flat_price.value == "" ? 0 : parseFloat(Fields.get_total_flat_price.value),

                        car_parking_charge: Fields.get_car_parking_charge.value == "" ? 0 : parseFloat(Fields.get_car_parking_charge.value),
                        utility_charge: Fields.get_utility_charge.value == "" ? 0 : parseFloat(Fields.get_utility_charge.value),
                        additional_work_charge: Fields.get_additional_work_charge.value == "" ? 0 : parseFloat(Fields.get_additional_work_charge.value),
                        other_charge: Fields.get_other_charge.value == "" ? 0 : parseFloat(Fields.get_other_charge.value),
                        discount_or_deduction: Fields.get_discount_or_deduction.value == "" ? 0 : parseFloat(Fields.get_discount_or_deduction.value),
                        refund_additional_work_charge: Fields.get_refund_additional_work_charge.value == "" ? 0 : parseFloat(Fields.get_refund_additional_work_charge.value),
                        net_sells_price: Fields.get_net_sells_price.value == "" ? 0 : parseFloat(Fields.get_net_sells_price.value),


                    }
                },

            }
        })();

        var MainController = (function (UICnt) {

            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();
            var input_values = UICnt.getInputsValue();
            var setUpEventListner = function () {

                Fields.get_form.addEventListener('submit', validation);

                Fields.get_flat_size.addEventListener('keyup', ShowTotalFlatPriceAndNetSellsPrice);
                Fields.get_unite_price.addEventListener('keyup', ShowTotalFlatPriceAndNetSellsPrice);


                Fields.get_car_parking_charge.addEventListener('keyup', ShowTotalFlatPriceAndNetSellsPrice);
                Fields.get_utility_charge.addEventListener('keyup', ShowTotalFlatPriceAndNetSellsPrice);
                Fields.get_additional_work_charge.addEventListener('keyup', ShowTotalFlatPriceAndNetSellsPrice);
                Fields.get_other_charge.addEventListener('keyup', ShowTotalFlatPriceAndNetSellsPrice);
                Fields.get_discount_or_deduction.addEventListener('keyup', ShowTotalFlatPriceAndNetSellsPrice);
                Fields.get_refund_additional_work_charge.addEventListener('keyup', ShowTotalFlatPriceAndNetSellsPrice);


            };

            var validation = function (e) {
                var input_values, Fields;
                input_values = UICnt.getInputsValue();
                Fields = UICnt.getFields();


                if (input_values.net_sells_price == 0) {
                    toastr["error"]('Net Selles Price Required');
                    e.preventDefault();
                }


                if (input_values.flat_size == 0) {
                    toastr["error"]('Flat Size Required');
                    e.preventDefault();
                }


                if (input_values.total_flat_price == 0) {
                    toastr["error"]('Total Flat Price Required');
                    e.preventDefault();
                }


                if (input_values.unite_price == 0) {
                    toastr["error"]('Unite Price Required');
                    e.preventDefault();
                }


                if (input_values.flat_size == 0) {
                    toastr["error"]('Flat Size Required');
                    e.preventDefault();
                }


                if (input_values.floor_number == 0) {
                    toastr["error"]('Floor Number Required');
                    e.preventDefault();
                }

                if (input_values.flat_type == 0) {
                    toastr["error"]('Flat Type Required');
                    e.preventDefault();
                }

                if (input_values.branch_id == 0) {
                    toastr["error"]('Project Name Required');
                    e.preventDefault();
                }
            };

            let ShowTotalFlatPriceAndNetSellsPrice = () => {
                let input_values, Fields;
                input_values = UICnt.getInputsValue();
                Fields = UICnt.getFields();

                let total_flat_price = input_values.flat_size * input_values.unite_price;

                Fields.get_total_flat_price.style.fontWeight = 'bold';
                Fields.get_total_flat_price.style.fontSize = '20px';


                Fields.get_total_flat_price.value = total_flat_price;

                if (total_flat_price > 0) {

                    total_flat_price += input_values.car_parking_charge;
                    total_flat_price += input_values.utility_charge;
                    total_flat_price += input_values.additional_work_charge;
                    total_flat_price += input_values.other_charge;
                    total_flat_price -= input_values.discount_or_deduction;
                    total_flat_price -= input_values.refund_additional_work_charge;

                    Fields.get_net_sells_price.style.fontWeight = 'bold';
                    Fields.get_net_sells_price.style.fontSize = '20px';

                    Fields.get_net_sells_price.value = total_flat_price;

                } else {
                    Fields.get_net_sells_price.style.fontWeight = 'bold';
                    Fields.get_net_sells_price.style.fontSize = '20px';
                    Fields.get_net_sells_price.value = 0;

                }


            }


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
