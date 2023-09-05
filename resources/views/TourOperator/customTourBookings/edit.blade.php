@extends('layouts.main', ['title' => 'Edit Custom Safari', 'header' => __('Edit Custom Safari')])

@include('includes.validate_assets')
@section('content')

    {{ Form::model($customTourBooking,['enctype="multipart/form-data"','route' => ['customTourBookings.update', $customTourBooking->uuid], 'method'=>'put','autocomplete' => 'off',
      'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate']) }}
    {{ Form::hidden('user_id', $customTourBooking->id, []) }}
    <section>
        <div class="row" style="margin: auto">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="background-color: rgba(255,255,255,0.85);margin-top: 3px">
                        <div class="col-md-12">
                            <p>{{ getLanguageBlock('lang.auth.mandatory-field') }}</p>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tourist_name', __("Full Name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('tourist_name',$customTourBooking->tourist_name, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tourist_name', 'required']) }}
                                        {!! $errors->first('tourist_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tourist_email_address', __("Email Address"), ['class' => 'required_asterik']) }}
                                        {{ Form::email('tourist_email_address',$customTourBooking->tourist_email_address, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tourist_email_address', 'required']) }}
                                        {!! $errors->first('tourist_email_address', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tourist_country', __("Country of Residence"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('tourist_country',$customTourBooking->tourist_country, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tourist_country', 'required']) }}
                                        {!! $errors->first('tourist_country', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tourist_phone_number', __("Phone Number"), ['class' => 'required_asterik']) }}
                                        {{ Form::tel('tourist_phone_number', $customTourBooking->tourist_phone_number, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tourist_phone_number', 'required']) }}
                                        {!! $errors->first('tourist_phone_number', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tourist_visit_areas', __("Places you want to visit"), ['class' => 'required_asterik']) }}
                                        {{ Form::select('tourist_visit_areas[]',$tourist_attractions,$customTourBookingTouristAttractionsId, ['class' => 'form-control select2','multiple', 'autocomplete' => 'off', 'id' => 'tourist_visit_areas', 'required']) }}
                                        {!! $errors->first('tourist_visit_areas', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('start_date', __("Start Date"), ['class' => 'required_asterik']) }}
                                        {{ Form::date('start_date',$customTourBooking->start_date, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'start_date', 'required']) }}
                                        {!! $errors->first('start_date', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('end_date', __("End Date"), ['class' => 'required_asterik']) }}
                                        {{ Form::date('end_date',$customTourBooking->end_date, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'end_date', 'required']) }}
                                        {!! $errors->first('end_date', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('total_adult_travellers', __("Number of Travellers (Adults)"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('total_adult_travellers',$customTourBooking->total_adult_travellers, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'total_adult_travellers', 'required']) }}
                                        {!! $errors->first('total_adult_travellers', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('total_children_travellers', __("Number of Travellers (Children)"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('total_children_travellers', $customTourBooking->total_children_travellers, ['class' => 'form-control', 'placeholder'=>'If none write 0','autocomplete' => 'off', 'id' => 'total_children_travellers', 'required']) }}
                                        {!! $errors->first('total_children_travellers', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('message', __("Your Message"), ['class' => 'required_asterik']) }}<br>
                                        <p>To ensure the best response from {{$customTourBooking->tourOperator->company_name}}, it is recommended to introduce yourself and provide an explanation of your interest in this tour </p>
                                        {{ Form::textarea('message',$customTourBooking->message, ['class' => 'form-control','style'=>'height:100px', 'autocomplete' => 'off', 'id' => 'message', 'required']) }}
                                        {!! $errors->first('message', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>By clicking the 'Send request' button you agree to our <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a></p>
                                    <input name="tour_operator_id" value="{{$customTourBooking->tourOperator->id}}" hidden>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="element-form">
                                        <div class="form-group pull-left">
                                            {{ Form::button(trans('Send Request'), ['class' => 'btn btn-primary', 'type'=>'submit','style' => 'border-radius: 5px;']) }}
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

