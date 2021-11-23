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

    <!-- noUISlider Css -->
    <link href="{{ asset('public/asset/plugins/nouislider/nouislider.min.css') }}" rel="stylesheet"/>

@endpush

@push('include-js')
    <script src="{{ asset('public/asset/js/pages/forms/advanced-form-elements.js') }}"></script>

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

@endpush

@extends('layouts.app')

@section('top-bar')
    @include('includes.top-bar')
@stop
@section('left-sidebar')
    @include('includes.left-sidebar')
@stop


@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-3">
                    <div class="card profile-card">
                        <div class="profile-header">&nbsp;</div>
                        <div class="profile-body">
                            <div class="image-area">
                                @if ( empty($profile['avatar']) )
                                    <img class="width-140 height-140" src="{{ asset('public/upload/avatar/avatar.png') }}"
                                         alt="Avatar"/>
                                @else
                                    <img class="width-140 height-140" src="{{ asset($profile['avatar']) }}"
                                         alt="Profile Picture"/>
                                @endif

                            </div>
                            <div class="content-area">
                                <h3>{{ $profile["last_name"] }} {{ $profile["first_name"] }}</h3>
                                <p>{{ $profile["designation"] }}</p>
                                <p>{{ App\User::find($profile['user_id'])->role['name'] }}</p>
                            </div>
                        </div>

                    </div>

                    <div class="card card-about-me">
                        <div class="header">
                            <h2>ABOUT ME</h2>
                        </div>
                        <div class="body">
                            <ul>
                                <li>
                                    <div class="title">
                                        <i class="material-icons">library_books</i>
                                        Education
                                    </div>
                                    <div class="content">
                                        {{ $profile["education"] }}
                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <i class="material-icons">location_on</i>
                                        Location
                                    </div>
                                    <div class="content">
                                        {{ $profile["present_address"] }}
                                    </div>
                                </li>

                                <li>
                                    <div class="title">
                                        <i class="material-icons">notes</i>
                                        Description
                                    </div>
                                    <div class="content">
                                        {{ $profile["description"] }}
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-9">
                    <div class="card">
                        <div class="body">
                            <div>
                                <ul class="nav nav-tabs" role="tablist">

                                    <li role="presentation" class="active"><a href="#profile_settings"
                                                                              aria-controls="settings" role="tab"
                                                                              data-toggle="tab">Profile Settings</a>
                                    </li>
                                    <li role="presentation"><a href="#change_password_settings" aria-controls="settings"
                                                               role="tab" data-toggle="tab">Change Password</a></li>
                                </ul>

                                <div class="tab-content">


                                    <div role="tabpanel" class="tab-pane fade in active" id="profile_settings">
                                        <form enctype="multipart/form-data" class="form-horizontal" method="post"
                                              action="{{route('profile.update',['id'=>$profile["id"]])}}">

                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label for="first_name" class="col-sm-2 control-label">First
                                                    Name</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" id="first_name" class="form-control"
                                                               name="first_name" placeholder="First Name"
                                                               value="{{ $profile["first_name"] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="last_name" class="col-sm-2 control-label">Last Name</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="last_name"
                                                               name="last_name" placeholder="Last Name"
                                                               value="{{ $profile["last_name"] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone_number" class="col-sm-2 control-label">Phone Number</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="phone_number"
                                                               name="phone_number" placeholder="Phone Number"
                                                               value="{{ $profile["phone_number"] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="designation"
                                                       class="col-sm-2 control-label">Designation</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="designation"
                                                               name="designation" placeholder="Designation"
                                                               value="{{ $profile["designation"] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="gender" class="col-sm-2 control-label">Gender</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick" name="gender"
                                                                id="gender">
                                                            <option value="0">Gender</option>
                                                            <option @if ($profile["gender"]==1)
                                                                    selected
                                                                    @endif value="1">Male
                                                            </option>
                                                            <option @if ($profile["gender"]==2)
                                                                    selected
                                                                    @endif value="2">Female
                                                            </option>
                                                            <option @if ($profile["gender"]==3)
                                                                    selected
                                                                    @endif value="3">Common
                                                            </option>
                                                            <option @if ($profile["gender"]==4)
                                                                    selected
                                                                    @endif value="4">Not Willing To Say
                                                            </option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NID" class="col-sm-2 control-label">NID</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="NID"
                                                               name="NID" placeholder="NID"
                                                               value="{{ $profile["NID"] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="education" class="col-sm-2 control-label">Education</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="education"
                                                               name="education" placeholder="NID"
                                                               value="{{ $profile["education"] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="permanent_address" class="col-sm-2 control-label">Permanent
                                                    Address</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="permanent_address"
                                                               name="permanent_address" placeholder="Permanent Address"
                                                               value="{{ $profile["permanent_address"] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="present_address" class="col-sm-2 control-label">Present
                                                    Address</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="present_address"
                                                               name="present_address" placeholder="Present Address"
                                                               value="{{ $profile["present_address"] }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="description"
                                                       class="col-sm-2 control-label">Description</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">

                                                        <textarea class="form-control" id="description"
                                                                  name="description" rows="1"
                                                                  placeholder="description">{{ $profile["description"] }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="description"
                                                       class="col-sm-2 control-label">Profile Picture</label>
                                                <div class="col-sm-10">
                                                    <input name="avatar" type="file" class="form-control">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-info">UPDATE</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    <div role="tabpanel" class="tab-pane fade in" id="change_password_settings">

                                        <form class="form-horizontal" action="{{ route('users.password') }}"
                                              method="post">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label for="OldPassword" class="col-sm-3 control-label">Old
                                                    Password</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="OldPassword"
                                                               name="OldPassword" placeholder="Old Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NewPassword" class="col-sm-3 control-label">New
                                                    Password</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="NewPassword"
                                                               name="NewPassword" placeholder="New Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NewPasswordConfirm" class="col-sm-3 control-label">New
                                                    Password (Confirm)</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control"
                                                               id="NewPasswordConfirm" name="NewPasswordConfirm"
                                                               placeholder="New Password (Confirm)" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-danger">SUBMIT</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@stop
