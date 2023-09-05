@extends('layouts.main', ['title' => trans('Approved Tour Package Bookings'), 'header' => trans('Approved Tour Package Bookings')])

@include('includes.datatable_assets')
@push('after-styles')
    {{ Html::style(url('vendor/sweetalert/sweetalert.css')) }}

    <style>

    </style>
@endpush
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div style="display: flex">
                        <a href="{{asset('public/TourOperatorsLogos/'.$tourPackage->tourOperator->company_logo)}}" target="_blank"><img src="{{asset('public/TourOperatorsLogos/'.$tourPackage->tourOperator->company_logo)}}" style="width:50px;height: 50px;border-radius: 50%"></a>
                        <p style="font-size:15px;padding-top: 10px;color: dodgerblue">{{$tourPackage->tourOperator->company_name}}</p><br>
                    </div>
                    <span>Safari To : <b style="color: dodgerblue">{{\App\Models\TouristicAttractions\touristicAttractions::find($tourPackage->main_safari_name)->attraction_name}}</b> - </span>
                    <span>Countdown Days For Tour : <b style="color: dodgerblue">{{$tourPackage->CountDownDaysForTourPackageTripLabel}}</b></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding-top: 10px">
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourPackageBookings.index',$tourPackage->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Total Bookings') }} ~ <badge class="badge badge-primary" style="font-size: 14px">{{$tourPackage->TotalTourPackageBookingsLabel}}</badge></h5>
                        <p class=""></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourPackageBookings.ApprovedTourPackageBookingsIndex',$tourPackage->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Approved Bookings') }} ~ <badge class="badge badge-success" style="font-size: 14px">{{$tourPackage->ApprovedTourPackageBookingsLabel}}</badge></h5>
                        <p class=""></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourPackageBookings.unApprovedTourPackageBookingsIndex',$tourPackage->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Un Approved Bookings') }} ~ <badge class="badge badge-danger" style="font-size: 14px">{{$tourPackage->UnApprovedTourPackageBookingsLabel}}</badge></h5>
                        <p class=""></p>
                    </a>
                </ul>
            </div>
        </div>

    </div>

    <div class="row" style="overflow-x: scroll">
        <div class="col-md-12" style="padding-bottom: 20px">
            <div class="pull-left" >
                <a class ='btn btn-outline-primary'  href="{{route('tourPackageBookings.downloadBookings',$tourPackage->uuid)}}" style="color: white"><i class="fadeInDown"></i>Download bookings</a>
            </div>
        </div>
        <div class="col-md-12">
            <section class="card card-primary mb-4" style="width:250%;background-color:rgba(255,255,255,0.85)">
                <div class="card-actions">
                    {{--Action Links--}}

                </div>
                @include('TourOperator.TourPackageBookings.ApprovedBookings.get_approved_tour_package_bookings')
            </section>
        </div>

    </div>
@endsection

@push('after-scripts')
    {{ Html::script(url('vendor/sweetalert/sweetalert.min.js')) }}
@endpush
