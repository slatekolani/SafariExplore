@extends('layouts.main', ['title' => trans('Deleted Tour Packages'), 'header' => trans('Deleted Tour Packages')])

@include('includes.datatable_assets')
@push('after-styles')
    {{ Html::style(url('vendor/sweetalert/sweetalert.css')) }}
    <style>

    </style>
@endpush

@section('content')
    <div class="row" style="padding-top: 13px">

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourPackages.companyTourPackagesIndex',$tourOperator->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('All Posted packages') }} ~ <badge class="badge badge-primary badge-lg" style="font-size:15px">{{$tourOperator->TotalTourPackagesPostedLabel}}</badge></h5>
                        <p class="list-group-item-text"> </p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourPackages.recentPostedTourPackagesIndex',$tourOperator->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Recent Posted packages') }} ~ <badge class="badge badge-primary badge-lg" style="font-size:15px">{{$tourOperator->TotalRecentTourPackagesPostedLabel}}</badge></h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourPackages.verifiedTourPackagesIndex',$tourOperator->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Verified Packages') }} ~ <badge class="badge badge-primary badge-lg" style="font-size:15px">{{$tourOperator->TotalVerifiedTourPackagesPostedLabel}}</badge></h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourPackages.unverifiedTourPackagesIndex',$tourOperator->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Unverified Packages') }} ~ <badge class="badge badge-primary badge-lg" style="font-size:15px">{{$tourOperator->TotalUnVerifiedTourPackagesPostedLabel}}</badge></h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourPackages.nearToursToBeConductedIndex',$tourOperator->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Near Tours') }} ~ <badge class="badge badge-info badge-lg" style="font-size:15px">{{$tourOperator->TotalNearToursLabel}}</badge></h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourPackages.expiredTourPackagesIndex',$tourOperator->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Expired Packages') }} ~ <badge class="badge badge-danger badge-lg" style="font-size:15px">{{$tourOperator->TotalExpiredTourPackagesLabel}}</badge></h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourPackages.deletedTourPackagesIndex',$tourOperator->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Deleted Tour Packages') }} ~ <badge class="badge badge-danger badge-lg" style="font-size:15px">{{$tourOperator->TotalDeletedTourPackagesLabel}}</badge></h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

    </div>
    <div class="row" style="overflow-x: scroll">
        <div class="col-md-12">
            <section class="card card-primary mb-4" style="width:180%;">
                <div class="card-actions">
                    {{--Action Links--}}

                </div>
                @include('TourOperator.TourPackages.deletedTourPackages.get_deleted_tour_packages')
            </section>
        </div>
    </div>





@endsection

@push('after-scripts')
    {{ Html::script(url('vendor/sweetalert/sweetalert.min.js')) }}
@endpush
