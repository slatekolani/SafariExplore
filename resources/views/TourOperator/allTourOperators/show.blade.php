@extends('layouts.main', ['title' => __("All Tour Operators In Tanzania"), 'header' => __('All Tour Operators In Tanzania')])
@include('includes.validate_assets')
@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                            <h3 style="border-left: 4px solid dodgerblue">Tanzania Tour Operators</h3>
                            @if(!empty($tourOperators) && $tourOperators->count())
                                @foreach($tourOperators as $tourOperator)
                                    <div style="border: 1px solid dodgerblue;margin-top: 10px">
                                        <a href="{{route('tourOperator.publicView',$tourOperator->uuid)}}" style="text-decoration: none">
                                    <div class="row" style="padding-top: 10px;">
                                        <div class="col-md-4">
                                            <img src="{{url('public/CompaniesTeamImage/',$tourOperator->company_team_image)}}" style="width: 100%;height: auto;border-radius: 5%;padding: 0 10px 10px 10px;filter: contrast(120%)">
                                        </div>
                                        <div class="col-md-8" style="padding: 20px 20px 20px 20px">
                                            <p class="card-title">{{$tourOperator->company_name}}</p>
                                            <p> "{{$tourOperator->about_company}}" </p>
                                            <p style="font-size: 15px"><b>Safari Preferences</b>: {{$tourOperator->TourOperatorSafariPreferencesLabel}}</p>
                                            <p style="font-size: 15px"><b>Company nation</b>: {{\App\Models\Nations\nations::find($tourOperator->company_nation)->nation_name}} - <img src="{{url('public/nationFlags/',\App\Models\Nations\nations::find($tourOperator->company_nation)->nation_flag)}}" style="width: 20px;height: 20px;border-radius: 50%"></p>
                                            @if($tourOperator->status==1)
                                            <p style="font-size: 15px"><b>Company Status</b>: <span class="badge badge-primary">Verified</span></p>
                                            @else
                                                <span>Unverified</span>
                                            @endif
                                        </div>
                                    </div>
                                        </a>
                                        <div class="card-footer">
                                            <a href="{{route('tourOperator.publicView',$tourOperator->uuid)}}" style="float: right" class="btn btn-primary btn-sm">Packages posted &blacktriangleright;</a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                            <span>No Available Tour Operators</span>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


