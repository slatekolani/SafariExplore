@extends('layouts.main', ['title' => __("label.home"), 'header' => __("label.registration")])

@include('includes.validate_assets')
@section('content')

    {{ Form::open(['url' => 'register', 'autocomplete' => 'off', 'class' => 'needs-validation', 'novalidate']) }}

    <section>
        <div class="row" style="margin: auto">
            <div class="col-md-12">
                <div class="card" style="margin: auto">
                    <div class="card-body">
                        <div class="col-md-6">
                            <p class="textWhite">{{ getLanguageBlock('lang.auth.mandatory-field') }}</p>

                            @include('auth.register.registration_fields')

                            <div class="row">
                                <div class="col-sm-12">
                                    {{ Form::label('captcha', trans("label.captcha"), ['class' => 'required_asterik']) }}
                                    <div class="row">

                                        <div class="col-md-4">
                                            <img src="{{captcha_src()}}"
                                                 onclick="this.src='/captcha/default?'+Math.random()"
                                                 id="captchaCode" alt="" class="captcha">
                                            <a rel="nofollow" href="javascript:;"
                                               onclick="document.getElementById('captchaCode').src='captcha/default?'+Math.random()"
                                               class="reflash" style="color: white">@lang('label.refresh')</a>
                                        </div>

                                        <div class="col-md-4">
                                            {{ Form::text('captcha', null, ['class' => 'form-control', 'autocomplete' => 'off', 'style' => 'width:40%;', 'id' => 'captcha', 'required']) }}

                                            {!! $errors->first('captcha', '<span class="badge badge-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="required_asterik">
                                        {{ Form::checkbox('term_check',1, false, ['required']) }}
                                        {{ __('label.user_registration.agree_terms', ['url' => '']) }}
                                    </div>
                                    {!! $errors->first('term_check', '<span class="badge badge-danger">:message</span>')!!}
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="element-form">
                                        <div class="form-group pull-left">
                                            {{ Form::button(trans('label.register'), ['class' => 'btn btn-primary', 'type'=>'submit','style' => 'border-radius: 5px;']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br/>

    {{ Form::close() }}
@endsection

@push('after-script')
    <script>
        function refreshCaptcha() {
            $.ajax({
                url: "/refereshcapcha",
                type: 'get',
                dataType: 'html',
                success: function (json) {
                    $('.refereshrecapcha').html(json);
                },
                error: function (data) {
                    alert('Try Again.');
                }
            });
        }


    </script>
@endpush

