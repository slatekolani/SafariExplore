@extends('layouts.main', ['title' => __("label.home"), 'header' => __("label.login")])

@include('includes.validate_assets')

@push('after-styles-end')
    <style>

    </style>
@endpush

@section('content')

    <section>
        {{ Form::open(['url' => 'login', 'autocomplete' => 'off', 'class' => 'needs-validation', 'novalidate' , 'name' => 'login']) }}

        <div class="row" style="margin: auto">
            <div class="col-md-12">
                <div class="card" style="padding-top: 60px">
                    <div class="card-body">
                        <div class="col-md-6" style="margin: auto">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                {{ Form::label('email', __("label.email")) }}
                                                {{ Form::text('email', null, ['class' => 'form-control create', 'autocomplete' => 'off', 'id' => 'email', 'aria-describedby' => 'emailHelp', 'required']) }}
                                                <small id="emailHelp"
                                                       class="textWhite">{{ __('label.email_helper') }}</small>
                                                {!!  $errors->first('email', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">

                                        <div class="col-md-8">

                                            <div class="form-group">
                                                {{ Form::label('password', __("label.password")) }}
                                                {{--<a href="{{ route('auth.forgot_password') }}" class="pull-right"><b>Forgot Password?</b></a>--}}
                                                <a href="{{ route('password.request') }}"
                                                   class="pull-right" style="color:white"><b>{{ __('passwords.forgot_password') }}</b></a>
                                                {{ Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'password', 'required']) }}
                                                {!! $errors->first('password', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <br/>
                            {{--Submit and remember me--}}
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="row">

                                        <div class="col-md-8">
                                            <div class="form-group form-check">
                                                {{ Form::checkbox('remember', '1', false, ['class' => 'form-check-input', 'id' => 'remember']) }}
                                                {{ Form::label('remember', __("label.remember"), ['class' => 'form-check-label']) }}
                                                <div class="pull-right">
                                                    <button type="submit"
                                                            class="btn btn-primary">@lang("label.submit")</button>

                                                </div>


                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>


                            <br/>
                            {{--register if not have account--}}
                            <label>@lang('label.account?dont')</label>
                            <a href="{{ route('register') }}" class="textWhite"><b>@lang("label.register")</b></a>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">


                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{ Form::close() }}

    </section>
    <br/>

@endsection

@push('after-scripts')
    <script type="text/javascript">
        $('body').on('submit', 'form[name=login]', function (e) {
            e.preventDefault();
// Str lower email before submit
            var $email = $('#email').val();
            var lower_email = $email.toLowerCase();
            $("input[name=email]").val(lower_email);
            this.submit();
        });
    </script>
@endpush
