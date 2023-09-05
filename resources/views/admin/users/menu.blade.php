@extends('layouts.main', ['title' => __('label.administrator.users.manage_users'), 'header' => __('label.administrator.users.manage_users')])

@include('includes.datatable_assets')

@section('content')

    {{--1--}}
    <div class="row">

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{ route('admin.user_manage.system_users') }}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('label.administrator.users.system_users') }}</h5>
                        <p class="list-group-item-text">@lang('label.administrator.users.manage_users')</p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('touristicAttractions.index')}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Touristic Attractions') }}</h5>
                        <p class="list-group-item-text">@lang('Manage Touristic Attractions')</p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('nations.index')}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Nations') }}</h5>
                        <p class="list-group-item-text">@lang('Manage Nations')</p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('specialNeed.index')}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Special needs') }}</h5>
                        <p class="list-group-item-text">@lang('Manage Special needs')</p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('transports.index')}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Transports') }}</h5>
                        <p class="list-group-item-text">@lang('Manage Transport')</p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourType.index')}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Tour Types') }}</h5>
                        <p class="list-group-item-text">@lang('Manage Tour Types')</p>
                    </a>
                </ul>
            </div>
        </div>

    </div>
@endsection
