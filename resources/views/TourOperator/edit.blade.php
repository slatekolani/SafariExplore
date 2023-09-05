@extends('layouts.main', ['title' => __("label.registration"), 'header' => __("label.registration")])

@include('includes.validate_assets')
@section('content')

    {{ Form::model($tour_operator_company,['enctype="multipart/form-data"','route' => ['tourOperator.update', $tour_operator_company->uuid], 'method'=>'put','autocomplete' => 'off',
'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate']) }}
    {{ Form::hidden('user_id', $tour_operator_company->id, []) }}

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
                                        {{ Form::label('company_name', __("Company name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('company_name', $tour_operator_company->company_name, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'company_name', 'required']) }}
                                        {!! $errors->first('company_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('email_address', __("label.email"), ['class' => 'required_asterik']) }}
                                        {{ Form::email('email_address', $tour_operator_company->email_address, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'email_address', 'required']) }}
                                        {!! $errors->first('email_address', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('phone_number', __("Phone number"), ['class' => 'required_asterik']) }}
                                        {{ Form::tel('phone_number', $tour_operator_company->phone_number, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'phone_number', 'required']) }}
                                        {!! $errors->first('phone_number', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('about_company', __("About company"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('about_company',$tour_operator_company->about_company, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'about_company', 'required']) }}
                                        {!! $errors->first('about_company', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('company_nation', __("Company nation"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('company_nation',$tour_operator_company->company_nation, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'company_nation', 'required']) }}
                                        <i>Previous nation: {{\App\Models\Nations\nations::find($tour_operator_company->company_nation)->nation_name}}</i>
                                        {!! $errors->first('company_nation', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('company_logo', __("Company logo"), ['class' => 'required_asterik']) }}
                                        <a href="{{url('public/TourOperatorsLogos/',$tour_operator_company->company_logo)}}">Previous image</a>
                                        {{ Form::file('company_logo',null, ['class' => 'form-control','autocomplete' => 'off', 'id' => 'company_logo','required']) }}
                                        {!! $errors->first('company_logo', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('company_team_image', __("Company team image"), ['class' => 'required_asterik']) }}
                                                <a href="{{url('public/CompaniesTeamImage/',$tour_operator_company->company_team_image)}}">Previous Image</a>
                                                {{ Form::file('company_team_image',null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'company_team_image', 'required']) }}
                                                {!! $errors->first('company_team_image', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('verification_certificate', __("Company certification"), ['class' => 'required_asterik']) }}
                                                <a href="{{url('public/VerificationCertificates/',$tour_operator_company->verification_certificate)}}">Previous doc</a>
                                                {{ Form::file('verification_certificate',null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'verification_certificate', 'required']) }}
                                                {!! $errors->first('verification_certificate', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('terms_and_conditions', __("Company Terms and Conditions"), ['class' => 'required_asterik']) }}
                                                <a href="{{url('public/companyTermsAndConditions/',$tour_operator_company->terms_and_conditions)}}">Previous</a>
                                                {{ Form::file('terms_and_conditions',null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'terms_and_conditions', 'required']) }}
                                                {!! $errors->first('terms_and_conditions', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('instagram_url', __("Company instagram url"), ['class' => 'required_asterik']) }}
                                                {{ Form::url('instagram_url',$tour_operator_company->instagram_url, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'instagram_url', 'required']) }}
                                                {!! $errors->first('instagram_url', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('whatsapp_url', __("WhatsApp url"), ['class' => 'required_asterik']) }}
                                                {{ Form::url('whatsapp_url',$tour_operator_company->whatsapp_url, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'whatsapp_url', 'required']) }}
                                                {!! $errors->first('whatsapp_url', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('gps_url', __("Company GPS location url"), ['class' => 'required_asterik']) }}
                                                {{ Form::url('gps_url',$tour_operator_company->gps_url, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'gps_url', 'required']) }}
                                                {!! $errors->first('gps_url', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('website_url', __("Company website url"), ['class' => 'required_asterik']) }}
                                                {{ Form::url('website_url', $tour_operator_company->website_url, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'website_url', 'required']) }}
                                                {!! $errors->first('website_url', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('safari_area_preferences', __("Safari Area Preferences"), ['class' => 'required_asterik']) }}
                                                {{ Form::select('safari_area_preferences[]',$tourist_attractions,$touristAttractionsId, ['class' => 'form-control select2','multiple', 'autocomplete' => 'off', 'id' => 'safari_area_preferences', 'required']) }}
                                                {!! $errors->first('safari_area_preferences', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="element-form">
                                        <div class="form-group pull-left">
                                            {{ Form::button(trans('Update'), ['class' => 'btn btn-primary', 'type'=>'submit','style' => 'border-radius: 5px;']) }}
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

