@extends('layouts.main', ['title' => trans('Manage Tour Types'), 'header' => trans('Manage Tour Types')])

@include('includes.datatable_assets')
@push('after-styles')
    {{ Html::style(url('vendor/sweetalert/sweetalert.css')) }}

    <style>

    </style>
@endpush
@section('content')
    <div class="row" style="overflow-x: scroll">
        <div class="col-md-12" >
            <div class="pull-left" >
                <a class =''  href="{{ route('tourType.create') }}"  ><i class="fas fa-pencil-alt"></i>&nbsp;{{ trans('label.crud.add') }}</a>&nbsp;&nbsp;
                <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
            </div>
        </div>
        <div class="col-md-12">
            <section class="card card-primary mb-4" style="width:100%">
                <div class="card-actions">
                    {{--Action Links--}}

                </div>
                @include('TourType.get_tour_type')
            </section>
        </div>

    </div>





@endsection

@push('after-scripts')
    {{ Html::script(url('vendor/sweetalert/sweetalert.min.js')) }}
@endpush
