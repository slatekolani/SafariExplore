@extends('layouts.main', ['title' => __("Trip detail"), 'header' => __('Trip detail')])
@include('includes.validate_assets')
@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="background-color: rgba(255,255,255,0.85)">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{asset('public/blogImages/'.$tourPackage->safari_poster)}}" target="_blank"><img src="{{asset('public/blogImages/'.$tourPackage->safari_poster)}}" style="width:100%;height:auto;border-radius: 5%;filter: contrast(120%)"></a>
                                <div class="bottom-left">
                                    <p style="color: whitesmoke;font-size: 15px">{{$tourPackage->safari_package_description}}</p>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div style="text-align: center">
                                    <a href="{{asset('public/TourOperatorsLogos/'.$tourPackage->tourOperator->company_logo)}}" target="_blank"><img src="{{asset('public/TourOperatorsLogos/'.$tourPackage->tourOperator->company_logo)}}" style="width:70px;height:70px;border-radius: 50%;margin-top:-30px"></a>
                                    <p style="font-size: 14px">Experience the extraordinary with our enchanting tour package. Prepare to be captivated by the awe-inspiring beauty of <b style="color: dodgerblue">{{\App\Models\TouristicAttractions\touristicAttractions::find($tourPackage->main_safari_name)->attraction_name}}</b> and other listed trips below. Immerse yourself in its breathtaking landscapes, indulge in thrilling adventures, and create cherished memories. <b style="color: dodgerblue">{{\App\Models\TouristicAttractions\touristicAttractions::find($tourPackage->main_safari_name)->attraction_name}}</b> beckons you to discover its hidden treasures and cultural marvels. Unforgettable moments await, embrace the magic and let your dreams unfold</p>
                                    <a href="{{route('tourPackageBookings.create',$tourPackage->uuid)}}" class="btn btn-primary btn-sm">Request space to {{\App\Models\TouristicAttractions\touristicAttractions::find($tourPackage->main_safari_name)->attraction_name}} Safari Package&blacktriangleright;</a>
                                    <a href="{{route('tourOperator.publicView',$tourPackage->tourOperator->uuid)}}" class="btn btn-primary btn-sm">See more offered by {{$tourPackage->tourOperator->company_name}}&blacktriangleright;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="margin-top:5px">
                        <div class="card-body" style="background-color: rgba(255,255,255,0.85);color:black">
                            <p style="font-size: 14px">Adult Foreigner: <b style="color: dodgerblue">$ {{number_format($tourPackage->trip_price_adult_foreigner)}}pp </b></p>
                            <p style="font-size: 14px">Child Foreigner: <b style="color: dodgerblue">Tzs {{number_format($tourPackage->trip_price_child_foreigner)}}pp </b></p>
                            <p style="font-size: 14px">Local Adult:     <b style="color: dodgerblue">$ {{number_format($tourPackage->trip_price_adult_tanzanian)}}pp</b> </p>
                            <p style="font-size: 14px">Local Child:     <b style="color: dodgerblue">Tzs {{number_format($tourPackage->trip_price_child_tanzanian)}}pp</b></p>
                            <div style="display: flex">
                                <p style="font-size: 14px"> Start ~ <b style="color: dodgerblue">{{date('jS M Y',strtotime($tourPackage->safari_start_date))}}</b></p>
                                <p style="font-size: 14px;padding-left:29.5px"> End ~ <b style="color:dodgerblue">{{date('jS M Y',strtotime($tourPackage->safari_end_date))}}</b></p>
                            </div>

                            <a href="{{route('tourPackageBookings.create',$tourPackage->uuid)}}" class="btn btn-primary btn-sm" style="position:relative;text-align: center">Request Space &blacktriangleright;</a>
                        </div>
                    </div>

                    <div class="card" style="margin-top:5px">
                        <div class="card-body" style="background-color: rgba(255,255,255,0.85);color:black">
                            <div style="display:flex;">
                                <a href="{{asset('public/TourOperatorsLogos/'.$tourPackage->tourOperator->company_logo)}}"><img src="{{asset('public/TourOperatorsLogos/'.$tourPackage->tourOperator->company_logo)}}" style="width:50px;height:50px;border-radius: 50%"></a>
                                <h4 style="padding-left: 20px;color: dodgerblue">{{$tourPackage->tourOperator->company_name}}</h4>
                                @if($tourPackage->tourOperator->status=1)
                                    <img src="{{url('/public/HomeImages/VerifiedTourOperator.png')}}" style="width:50px;height:50px">
                                @else
                                    <i class="">*</i>
                                @endif
                            </div>
                            <p style="font-size: 14px;padding-top:10px">{{$tourPackage->tourOperator->about_company}}</p>
                            <p>Office In: <img src="{{asset('public/nationFlags/'.\App\Models\Nations\nations::find($tourPackage->tourOperator->company_nation)->nation_flag)}}" style="width:30px;height:30px"> {{\App\Models\Nations\nations::find($tourPackage->tourOperator->company_nation)->nation_name}}</p>
                            @if($tourPackage->tourOperator->status=1)
                                <p>Status ~ <b style="color:dodgerblue"> Verified</b> </p>
                            @else
                                <i class="">Unverified</i>
                            @endif
                            <a href="{{route('tourOperator.publicView',$tourPackage->tourOperator->uuid)}}" class="btn btn-primary btn-sm" style="position:relative;text-align: center">Learn More &blacktriangleright;</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8" style="margin-top: 5px">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="card" style="margin-top: 8px">
                                    <div class="card-body" style="background-color: rgba(255,255,255,0.85);color:black">
                                        <div class="display:flex">
                                            <h4 style="color:dodgerblue" class="card-title">Trip hierarchy</h4>
                                        </div>
                                        @if(!empty($tourPackageTrips) && $tourPackageTrips->count())
                                            @foreach($tourPackageTrips as $tourPackageTrip)
                                                <div style="display: flex">
                                                    <p style="font-size: 14px;color:dodgerblue" class="card-text">Day {{$tourPackageTrip->day_number}} ~ </p>
                                                    <p style="font-size: 14px;padding-left: 30px" class="card-text"> {{$tourPackageTrip->safari_trip_name}} ~ </p>
                                                    <p style="font-size: 14px;padding-left: 30px" class="card-text"> {{$tourPackageTrip->safari_trip_description}}</p>
                                                </div>
                                            @endforeach
                                        @else
                                            <span class="text-danger">No trip hierarchy included!</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="card" style="margin-top: 8px">
                                    <div class="card-body" style="background-color: rgba(255,255,255,0.85);color:black">
                                        <div class="display:flex">
                                            <h4 style="color:dodgerblue" class="card-title">Tour Types Offered</h4>
                                        </div>
                                        <p style="font-size: 14px" class="card-text">{{$tourPackage->TourPackagesTourTypesLabel}}</p>
                                    </div>
                                </div>

                                <div class="card" style="margin-top:8px">
                                    <div class="card-body" style="background-color: rgba(255,255,255,0.85);color:black">
                                        <div class="display:flex">
                                            <h4 style="color:dodgerblue" class="card-title">Transport</h4>
                                        </div>
                                        <p style="font-size: 14px" class="card-text">{{$tourPackage->TourPackageTransportLabel}}</p>
                                    </div>
                                </div>

                                <div class="card" style="margin-top:8px">
                                    <div class="card-body" style="background-color: rgba(255,255,255,0.85);color:black">
                                        <div class="display:flex">
                                            <h4 style="color:dodgerblue" class="card-title">Special need supported</h4>
                                        </div>
                                        <p style="font-size: 14px" class="card-text">{{$tourPackage->TourPackageSpecialNeedCategoryLabel}}</p>
                                    </div>
                                </div>

                                <div class="card" style="margin-top:8px">
                                    <div class="card-body" style="background-color: rgba(255,255,255,0.85);color:black">
                                        <div class="display:flex">
                                            <h4 style="color:dodgerblue" class="card-title">Package features</h4>
                                        </div>
                                        @if(!empty($tourPackageFeatures) && $tourPackageFeatures->count())
                                            @foreach($tourPackageFeatures as $tourPackageFeature)
                                                <div style="display:flex">
                                                    <p style="font-size: 14px" class="card-text"> {{$tourPackageFeature->feature_name}} ~ </p>
                                                    <p style="font-size: 14px" class="card-text">{{$tourPackageFeature->feature_description}}</p>
                                                </div>
                                            @endforeach
                                        @else
                                            <span>No features available!</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="card" style="margin-top:8px">
                                    <div class="card-body" style="background-color: rgba(255,255,255,0.85);color:black">
                                        <div class="display:flex">
                                            <h4 style="color:dodgerblue" class="card-title">Activities Included</h4>
                                        </div>
                                        @if(!empty($tourPackageActivities) && $tourPackageActivities->count())
                                            @foreach($tourPackageActivities as $tourPackageActivity)
                                                <div style="display:flex">
                                                    <p style="font-size: 14px" class="card-text"> {{$tourPackageActivity->activity_name}} ~ </p>
                                                    <p style="font-size: 14px" class="card-text">{{$tourPackageActivity->activity_description}}</p>
                                                </div>
                                            @endforeach
                                        @else
                                            <span>No activities listed! </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="card" style="margin-top:8px">
                                    <div class="card-body" style="background-color: rgba(255,255,255,0.85);color:black">
                                        <div class="display:flex">
                                            <h4 style="color:dodgerblue" class="card-title">Accommodations</h4>
                                        </div>
                                        @if(!empty($tourPackageAccommodations) && $tourPackageAccommodations->count())
                                            @foreach($tourPackageAccommodations as $tourPackageAccommodation)
                                                <div style="display: flex">
                                                    <p style="font-size: 14px" class="card-text">Day {{$tourPackageAccommodation->day_number}} ~ </p>
                                                    <p style="font-size: 14px;padding-left: 30px" class="card-text"> <a href="{{$tourPackageAccommodation->accommodation_link}}" target="_blank">{{$tourPackageAccommodation->accommodation_name}}</a> ~ </p>
                                                    <p style="font-size: 14px;padding-left: 30px" class="card-text">{{$tourPackageAccommodation->accommodation_description}}</p>
                                                </div>
                                            @endforeach
                                        @else
                                            <span>No accommodations listed!</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    <div class="col-md-12">
        <div class="row" style="margin-top: 5px">
            <div class="col-md-12">
            <div class="card">
                <div class="card-body" style="background-color: rgba(255,255,255,0.85);color:black">
                    <p style="font-size: 20px">Interested in This Tour?</p>
                    <a href="{{route('tourPackageBookings.create',$tourPackage->uuid)}}" class="btn btn-primary btn-sm">Request space &blacktriangleright;</a>
                    <p style="padding-top:8px"> &blacktriangleright; Requests are sent directly to the tour operator</p>
                    <p> &blacktriangleright; If preferred, you can <a href="{{route('tourOperator.publicView',$tourPackage->tourOperator->uuid)}}" title="{{$tourPackage->tourOperator->company_name}},{{$tourPackage->tourOperator->phone_number}}, {{$tourPackage->tourOperator->email_address}}">contact</a> the tour operator directly</p>
                    <br>
                    <p style="font-size:14px"><b>Disclaimer</b></p>
                    <p>&blacktriangleright; This tour is offered by <a href="{{route('tourOperator.publicView',$tourPackage->tourOperator->uuid)}}">{{$tourPackage->tourOperator->company_name}} </a>, not Expedition & Exploration Innovations.</p>
                    <p>&blacktriangleright; This tour is subject to the <a href="{{asset('public/companyTermsAndConditions/'.$tourPackage->tourOperator->terms_and_conditions)}}" target="_blank">terms & conditions</a> of {{$tourPackage->tourOperator->company_name}}</p>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection


