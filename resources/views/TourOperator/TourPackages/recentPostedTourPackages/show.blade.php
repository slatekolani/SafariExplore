@extends('layouts.main', ['title' => __("Recent Tour Packages Posted"), 'header' => __("Recent Tour Packages Posted")])

@push('after-styles')
    {{ Html::style(url('vendor/select2/css/select2.min.css')) }}
    <style>

    </style>
@endpush

@section('content')
    @guest
        <div class="card" style="padding-top: 10px">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3 style="border-left: 5px solid dodgerblue"> Recent Tour Packages Posted</h3>
                        <div class="row">
                            @if(!empty($recentTourPackages) && $recentTourPackages->count())
                                @foreach($recentTourPackages as $recentTourPackage)

                                    <div class="col-md-4" style="margin-top: 15px">
                                        <div class="card">
                                            <div class="top-left">
                                                <span class="badge badge-danger"
                                                      style="font-size: 14px;border-radius: 50%">{{$recentTourPackage->CountDownDaysForTourPackageTripLabel}}</span>
                                            </div>
                                            <div class="top-right">
                                                @if($recentTourPackage->status==1)
                                                    <span class="badge badge-primary" style="font-size: 10px;">Still Valid</span>
                                                @else
                                                    <span></span>
                                                @endif
                                            </div>
                                            <a href="{{route('tourPackages.publicView',$recentTourPackage->uuid)}}"
                                               style="text-decoration: none">
                                                <img class="card-img-top"
                                                     src="{{asset('public/blogImages/'.$recentTourPackage->safari_poster)}}"
                                                     style="height: auto;width: 100%;border-radius:10px;filter: contrast(120%)">
                                                <div class="card-body"
                                                     style="background-color: rgba(255,255,255,0.85);color:black">
                                                    <p class="card-title"
                                                       style="font-family: sans-serif, Verdana">{{$recentTourPackage->safari_package_description}}</p>
                                                    <p class="card-text"><b>Main
                                                            Safari</b>: {{\App\Models\TouristicAttractions\touristicAttractions::find($recentTourPackage->main_safari_name)->attraction_name}}
                                                    </p>
                                                    <p class="card-text"><b>Foreigner</b>:
                                                        ${{number_format($recentTourPackage->trip_price_adult_foreigner)}}
                                                        /Adult -
                                                        ${{number_format($recentTourPackage->trip_price_child_foreigner)}}
                                                        /child</p>
                                                    <p class="card-text"><b>Tanzanian</b>:
                                                        Shs{{number_format($recentTourPackage->trip_price_adult_tanzanian)}}
                                                        /Adult -
                                                        Shs{{number_format($recentTourPackage->trip_price_child_tanzanian)}}
                                                        /Child</p>
                                                    <p class="card-text"><b>Tour
                                                            Types</b>: {{$recentTourPackage->TourPackagesTourTypesLabel}}</p>
                                                    <div style="display: flex">
                                                        <p class="card-text"><b>Start
                                                                date</b>:{{date('jS M Y',strtotime($recentTourPackage->safari_start_date))}}
                                                        </p>
                                                        <p class="card-text" style="padding-left: 10px"><b>End
                                                                date</b>:{{date('jS M Y',strtotime($recentTourPackage->safari_end_date))}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="card-footer">
                                                <div class="card-title">
                                                    <div style="display: flex">
                                                        <img
                                                            src="{{asset('public/TourOperatorsLogos/'.$recentTourPackage->tourOperator->company_logo)}}"
                                                            style="width: 50px;height: 50px;border-radius: 50%">
                                                        <a href="{{route('tourOperator.publicView',$recentTourPackage->tourOperator->uuid)}}"
                                                           style="margin-top: 14px;text-decoration: none;font-size: 15px;padding-left: 15px">
                                                            {{$recentTourPackage->tourOperator->company_name}}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @else
                                <span style="color: white">No packages available</span>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endguest
    @auth
        @if(Auth::user()->hasRole(2))
            @include('TourOperator.overviewDashboard.view')
        @endif
    @endauth
@endsection
