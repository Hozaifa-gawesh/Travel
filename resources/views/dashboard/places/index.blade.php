@php
    $city = isset($_GET['city']) && isset($_GET['district']) && is_numeric($_GET['city']) ? intval($_GET['city']) : 0;
    $district = isset($_GET['district']) && is_numeric($_GET['district']) ? intval($_GET['district']) : 0;
@endphp
@extends('dashboard.layouts.master')
@section('title')
    {{ __('lang.places') }}
@stop
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>{{ __('lang.places') }}</h1>
                </div>
                <a href="{{ route('add-place') }}" title="{{ __('lang.add_place') }}" class="pull-right add_products"><i class="icon-plus"></i></a>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="{{ route('dashboard/home') }}">{{ __('lang.dashboard') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">{{ __('lang.places') }}</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    @include('dashboard.profile.include')
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">{{ __('lang.places') }}</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            @include('dashboard.includes.flash_msg')
                                            <div class="tab-pane active places_data" id="tab_1_1">
                                                <div class="places_box">
                                                    <div class="portlet-body">
                                                        <div class="panel-group accordion" id="places">
                                                            @foreach($data as $key => $get)
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading main_city">
                                                                        <h4 class="panel-title">
                                                                            <a class="accordion-toggle accordion-toggle-styled {{ $city == $get[0]['city_id'] ? '' : 'collapsed' }}" data-toggle="collapse" data-parent="#places" href="#City_{{ str_replace(' ', '-', $key) }}" aria-expanded="{{ $city == $get[0]['city_id'] ? 'true' : 'false' }}">
                                                                                {{ $key }}
                                                                            </a>
                                                                        </h4>
                                                                        <form action="{{ route('city-delete-place', $get[0]['city_id']) }}" method="post">
                                                                            @csrf
                                                                            <button title="{{ __('lang.delete') }}" class="confirm-btn" type="submit"><i class="icon-trash"></i></button>
                                                                        </form>
                                                                    </div>
                                                                    <div id="City_{{ str_replace(' ', '-', $key) }}" class="panel-collapse collapse {{ $city == $get[0]['city_id'] ? 'in' : '' }}" aria-expanded="{{ $city == $get[0]['city_id'] ? 'true' : 'false' }}" style="{{ $city == $get[0]['city_id'] ? '' : 'height: 0px;' }}">
                                                                        <div class="panel-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <table style="margin-top: 10px;" class="table table-bordered table-striped table-condensed flip-content">
                                                                                        <thead class="flip-content">
                                                                                        <tr>
                                                                                            <th><input type="checkbox" class="checkbox-style" id="roleSelect"></th>
                                                                                            <th> {{ __('lang.area') }} </th>
                                                                                            <th> {{ __('lang.from') }} <small>({{ __('lang.days') }})</small></th>
                                                                                            <th> {{ __('lang.to') }} <small>({{ __('lang.days') }})</small></th>
                                                                                            <th> {{ __('lang.price') }} </th>
                                                                                            <th style="width: 150px;"> {{ __('lang.control') }} </th>
                                                                                        </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                        @foreach($get as $echo)
                                                                                            <tr style="{{ ($city == $get[0]['city_id']) && ($district == $echo->area_id) ? 'background-color: #f6e58d' : '' }}">
                                                                                                <td><input type="checkbox" class="checkbox-style roleCheck" value="{{ $echo->id }}" name="data[]"></td>
                                                                                                <td>{{ $echo->area->title }}</td>
                                                                                                <td>{{ $echo->from }}</td>
                                                                                                <td>{{ $echo->to }}</td>
                                                                                                <td>{{ $echo->price }} {{ __('lang.sar') }}</td>
                                                                                                <td>
                                                                                                    <a href="{{ route('edit-place', $echo->id) }}" title="{{ __('lang.edit') }}" data-id="" class="btn btn-info"><i class="fa fa-edit"></i> </a>
                                                                                                    <form class="inline-block" action="{{ route('delete-place', $echo->id) }}" method="post">
                                                                                                        @csrf
                                                                                                        <button type="submit" title="{{ __('lang.delete') }}" class="btn btn-danger confirm-btn"><i class="fa fa-trash"></i></button>
                                                                                                    </form>
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


