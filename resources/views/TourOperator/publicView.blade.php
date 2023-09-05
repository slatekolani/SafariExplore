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
                                <a href="{{asset('public/CompaniesTeamImage/'.$tourOperator->company_team_image)}}"
                                   target="_blank"><img
                                        src="{{asset('public/CompaniesTeamImage/'.$tourOperator->company_team_image)}}"
                                        style="width: 100%;height: auto;border-radius: 10px;filter: contrast(120%)"></a>
                            </div>
                            <div class="col-md-8">
                                <div style="text-align: center">
                                    <a href="{{asset('public/TourOperatorsLogos/'.$tourOperator->company_logo)}}"
                                       target="_blank"><img
                                            src="{{asset('public/TourOperatorsLogos/'.$tourOperator->company_logo)}}"
                                            style="width:70px;height:70px;border-radius: 50%;margin-top:-30px"></a>
                                    <h4 style="color: dodgerblue">{{$tourOperator->company_name}} </h4>

                                    <p style="font-size: 14px">"Welcome to our esteemed tour
                                        company, {{$tourOperator->company_name}}. As
                                        a verified Tanzanian enterprise, we take pride in offering exceptional travel
                                        experiences. Contact us via email at <a
                                            href="#">{{$tourOperator->email_address}}</a> or give us
                                        a call at <a
                                            href="{{$tourOperator->phone_number}}">{{$tourOperator->phone_number}}</a>
                                        to begin your journey of a lifetime.
                                        Explore our <a href="{{$tourOperator->website_url}}">website</a> for a
                                        comprehensive
                                        overview of our captivating itineraries. Stay updated
                                        with our latest adventures by following us on
                                        <a href="{{$tourOperator->instagram_url}}">Instagram</a>. For
                                        quick and convenient communication, reach out to us on
                                        <a href="{{$tourOperator->whatsapp_url}}">WhatsApp</a>. Discover the exact
                                        locations of our
                                        enchanting destinations using our <a href="{{$tourOperator->gps_url}}">GPS
                                            location link</a>. Trust us to deliver unrivaled experiences as we showcase
                                        the best
                                        of Tanzania and beyond. We also serve to take you
                                        to {{$tourOperator->TourOperatorSafariPreferencesLabel}}"</p>
                                    <a href="{{route('customTourBookings.create',$tourOperator->uuid)}}"
                                       class="btn btn-primary btn-sm" style="margin-top: 10px">Request Custom Tour
                                        &blacktriangleright;</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
    <div class="card" style="padding-top: 5px">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="border-left: 5px solid dodgerblue;font-size: 16px" class="card-title">Packages Posted by {{$tourOperator->company_name}}</h3>
                    <div class="row">
                        @if(!empty($tourPackages) && $tourPackages->count())
                            @foreach($tourPackages as $tourPackage)

                                <div class="col-md-4" style="margin-top: 15px">
                                    <div class="card">
                                        <div class="top-left">
                                                <span class="badge badge-danger"
                                                      style="font-size: 14px;border-radius: 50%">{{$tourPackage->CountDownDaysForTourPackageTripLabel}}</span>
                                        </div>
                                        <div class="top-right">
                                            @if($tourPackage->status==1)
                                                <span class="badge badge-primary" style="font-size: 10px;">Still Valid</span>
                                            @else
                                                <span>Invalid</span>
                                            @endif
                                        </div>
                                        <a href="{{route('tourPackages.publicView',$tourPackage->uuid)}}"
                                           style="text-decoration: none">
                                            <img class="card-img-top"
                                                 src="{{asset('public/blogImages/'.$tourPackage->safari_poster)}}"
                                                 style="height: auto;width: 100%;border-radius:10px">
                                            <div class="card-body"
                                                 style="background-color: rgba(255,255,255,0.85);color:black">
                                                <p class="card-title"
                                                   style="font-family: sans-serif, Verdana">{{$tourPackage->safari_package_description}}</p>
                                                <p class="card-text"><b>Main
                                                        Safari</b>: {{\App\Models\TouristicAttractions\touristicAttractions::find($tourPackage->main_safari_name)->attraction_name}}
                                                </p>
                                                <p class="card-text"><b>Foreigner</b>:
                                                    ${{number_format($tourPackage->trip_price_adult_foreigner)}}
                                                    /Adult -
                                                    ${{number_format($tourPackage->trip_price_child_foreigner)}}
                                                    /child</p>
                                                <p class="card-text"><b>Tanzanian</b>:
                                                    Shs{{number_format($tourPackage->trip_price_adult_tanzanian)}}
                                                    /Adult -
                                                    Shs{{number_format($tourPackage->trip_price_child_tanzanian)}}
                                                    /Child</p>
                                                <p class="card-text"><b>Tour
                                                        Types</b>: {{$tourPackage->TourPackagesTourTypesLabel}}</p>
                                                <div style="display: flex">
                                                    <p class="card-text"><b>Start
                                                            date</b>:{{date('jS M Y',strtotime($tourPackage->safari_start_date))}}
                                                    </p>
                                                    <p class="card-text" style="padding-left: 10px"><b>End
                                                            date</b>:{{date('jS M Y',strtotime($tourPackage->safari_end_date))}}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="card-footer">
                                            <div class="card-title">
                                                <div style="display: flex">
                                                    <img
                                                        src="{{asset('public/TourOperatorsLogos/'.$tourPackage->tourOperator->company_logo)}}"
                                                        style="width: 50px;height: 50px;border-radius: 50%">
                                                    <a href="{{route('tourOperator.publicView',$tourPackage->tourOperator->uuid)}}"
                                                       style="margin-top: 14px;text-decoration: none;font-size: 15px;padding-left: 15px">
                                                        {{$tourPackage->tourOperator->company_name}}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        @else
                            <span style="color: black">No packages available</span>
                        @endif

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="#" class="btn btn-primary btn-sm" style="float: right">See all
                                &blacktriangleright;</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="col-md-12">
        <div class="row" style="padding-top: 5px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p style="font-size: 18px">Reviews ~ <span class="badge badge-primary">{{$totalTouristReviews}}</span></p>
                        @if(!empty($touristReviews) && $touristReviews->count())
                            @foreach($touristReviews as $touristReview)
                                <div style="padding-top: 10px">
                                <div style="display: flex">
                                    <img src="{{url('/public/HomeImages/avatar.png')}}" style="width:40px;height: 40px;">
                                    <p style="padding-left: 20px;padding-top:5px;font-size: 15px"><strong>{{\App\Models\TourOperator\TourPackages\TourPackageBookings\tourPackageBookings::find($touristReview->tour_package_booking_id)->tourist_name}}</strong> </p>
                                </div>
                                    <p>Reviewed by: {{$touristReview->tourist_name}} (Safari companion of {{\App\Models\TourOperator\TourPackages\TourPackageBookings\tourPackageBookings::find($touristReview->tour_package_booking_id)->tourist_name}})</p>
                                <div class="container" style="border: 1px solid dodgerblue">
                                    <p style="font-size: 20px">"{{$touristReview->review_title}}"</p>
                                    <p>{{$touristReview->review_message}}</p>
                                    <p> Booked Trip: <strong style="color: dodgerblue"> {{\App\Models\TouristicAttractions\touristicAttractions::find(\App\Models\TourOperator\TourPackages\TourPackageBookings\tourPackageBookings::find($touristReview->tour_package_booking_id)->tour_package_id)->attraction_name}} Package</strong></p>
                                    <p> Reviewed: <strong style="color: dodgerblue"> {{date('jS M Y',strtotime($touristReview->created_at))}}</strong></p>

                                </div>
                                </div>
                            @endforeach
                                <div class="row" style="padding-top: 5px">
                                    <div class="col-md-12">
                                        <a href="{{route('touristReview.allTouristReviews',$touristReview->tour_operator_id)}}" class="btn btn-primary btn-sm" style="float: right">See all
                                            &blacktriangleright;</a>
                                    </div>
                                </div>
                        @else
                        <span style="color: black">No Comments Available</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


