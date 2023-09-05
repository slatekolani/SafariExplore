@extends('layouts.main', ['title' => __("Create Nation"), 'header' => __('Create Nation')])

@include('includes.validate_assets')
@section('content')

    {{ Form::open(['enctype="multipart/form-data"','route'=>'nations.store', 'autocomplete' => 'off','method' => 'post', 'class' => 'needs-validation', 'novalidate']) }}

    <section>
        <div class="row" style="margin: auto">
            <div class="col-md-12">
                <div class="card" style="margin: auto">
                    <div class="card-body">
                        <div class="col-md-12">
                            <p>{{ getLanguageBlock('lang.auth.mandatory-field') }}</p>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('nation_name', __("Nation name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('nation_name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'nation_name', 'required']) }}
                                        {!! $errors->first('nation_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('nation_flag', __("Nation flag"), ['class' => 'required_asterik']) }}
                                        {{ Form::file('nation_flag', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'nation_flag', 'required']) }}
                                        {!! $errors->first('nation_flag', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="element-form">
                                        <div class="form-group pull-left">
                                            {{ Form::button(trans('Add'), ['class' => 'btn btn-primary', 'type'=>'submit','style' => 'border-radius: 5px;']) }}
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
@push('after-scripts')

    <script>
        $(function () {
            $(".select2").select2();


        });

    </script>
@endpush

