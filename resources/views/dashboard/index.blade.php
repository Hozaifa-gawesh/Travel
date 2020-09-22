@extends('dashboard.layouts.master')
@section('title')
    {{ __('lang.dashboard') }}
@stop
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>  {{ __('lang.dashboard') }}
                        <small> {{ __('lang.statistics_charts') }}</small>
                    </h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <span class="active">{{ __('lang.dashboard') }}</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="javascript:;">
                        <div class="dashboard-stat2 bordered">
                            <div class="display">
                                <div class="number">
                                    <h3 class="font-red-haze">
                                        <span data-counter="counterup" data-value="{{ $countriesCount }}">{{ $countriesCount }}</span>
                                    </h3>
                                    <small>{{ __('lang.total') }} {{ __('lang.countries') }}</small>
                                </div>
                                <div class="icon">
                                    <i class="icon-pointer"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="javascript:;">
                        <div class="dashboard-stat2 bordered">
                            <div class="display">
                                <div class="number">
                                    <h3 class="font-green-sharp">
                                        <span data-counter="counterup" data-value="{{ $citiesCount }}">{{ $citiesCount }}</span>
                                    </h3>
                                    <small>{{ __('lang.total') }} {{ __('lang.cities') }}</small>
                                </div>
                                <div class="icon">
                                    <i class="icon-directions"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="javascript:;">
                        <div class="dashboard-stat2 bordered">
                            <div class="display">
                                <div class="number">
                                    <h3 class="font-blue-sharp">
                                        <span data-counter="counterup" data-value="2">2</span>
                                    </h3>
                                    <small>{{ __('lang.total') }} {{ __('lang.products') }}</small>
                                </div>
                                <div class="icon">
                                    <i class="icon-social-dropbox"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="javascript:;">
                        <div class="dashboard-stat2 bordered">
                            <div class="display">
                                <div class="number">
                                    <h3 class="font-purple-soft">
                                        <span data-counter="counterup" data-value="3">3</span>
                                    </h3>
                                    <small>{{ __('lang.total') }} {{ __('lang.categories') }}</small>
                                </div>
                                <div class="icon">
                                    <i class="icon-grid"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
