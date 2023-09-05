@extends('layouts.main', ['title' => __("Tour Operator"), 'header' => __('Tour Operator')])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12" >
            <div class="pull-left" >
                <a class ='textWhite'  href="{{route('tourOperator.edit',$tourOperator->uuid)}}"  ><i class="fas fa-pencil-alt"></i>&nbsp;{{ trans(' Edit tour company information') }}</a>&nbsp;&nbsp;
                <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">
                            <tr>
                                <th>Company logo</th>
                                <td><a href="{{asset('public/TourOperatorsLogos/'.$tourOperator->company_logo)}}" target="_blank"><img src="{{asset('public/TourOperatorsLogos/'.$tourOperator->company_logo)}}" style="width:100px;height: 100px;border-radius: 50%"></a></td>
                            </tr>
                            <tr>
                                <th>Registration date</th>
                                <td>{{date('jS M Y H:m:s a',strtotime($tourOperator->created_at))}}</td>
                            </tr>

                            <tr>
                                <th>Company name</th>
                                <td>{{$tourOperator->company_name}}</td>
                            </tr>
                            <tr>
                                <th>About</th>
                                <td>{{$tourOperator->about_company}}</td>
                            </tr>
                            <tr>
                                <th>Email address</th>
                                <td>{{$tourOperator->email_address}}</td>
                            </tr>
                            <tr>
                                <th>Phone number</th>
                                <td>{{$tourOperator->phone_number}}</td>
                            </tr>
                            <tr>
                                <th>Company nation</th>
                                <td>{{\App\Models\Nations\nations::find($tourOperator->company_nation)->nation_name}}</td>
                            </tr>
                            <tr>
                                <th>Certification</th>
                                <td><a href="{{asset('public/VerificationCertificates/'.$tourOperator->verification_certificate)}}" target="_blank">Certification for tour operation</a></td>
                            </tr>
                            <tr>
                                <th>Website</th>
                                <td><a href="{{$tourOperator->website_url}}">{{$tourOperator->website_url}}</a></td>
                            </tr>
                            <tr>
                                <th>Instagram</th>
                                <td><a href="{{$tourOperator->instagram_url}}">{{$tourOperator->instagram_url}}</a></td>
                            </tr>
                            <tr>
                                <th>WhatsApp</th>
                                <td><a href="{{$tourOperator->whatsapp_url}}">{{$tourOperator->whatsapp_url}}</a></td>
                            </tr>
                            <tr>
                                <th>Geographic position (GPS)</th>
                                <td><a href="{{$tourOperator->gps_url}}">{{$tourOperator->gps_url}}</a></td>
                            </tr>
                            <tr>
                                <th>Company team image</th>
                                <td><a href="{{asset('public/CompaniesTeamImage/'.$tourOperator->company_team_image)}}" target="_blank">Team image</a></td>
                            </tr>
                            <tr>
                            <th>Company Terms and Conditions</th>
                            <td><a href="{{asset('public/companyTermsAndConditions/'.$tourOperator->terms_and_conditions)}}" target="_blank">Terms and Conditions</a></td>
                            </tr>
                            <tr>
                            <th>Safari Area Preferences</th>
                            <td>{{$tourOperator->TourOperatorSafariPreferencesLabel}}</td>
                            </tr>
                            <tr>
                                <th>Company status</th>
                                @if($tourOperator->status=1)
                                    <td><span class="badge badge-success">Active</span></td>
                                @elseif($tourOperator->status=0)
                                    <td><span class="badge badge-warning">Inactive</span></td>
                                @else
                                    <td><span class="badge badge-danger">Unidentified company</span></td>
                                @endif
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


