@extends('dashboard.layouts.master')
@section('title')
    {{ __('lang.edit_place') }}
@stop
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>{{ __('lang.edit_place') }}</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">{{ __('lang.dashboard') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ route('places') }}">{{ __('lang.places') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">{{ __('lang.edit_place') }}</span>
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
                                            <span class="caption-subject font-blue-madison bold uppercase">{{ __('lang.edit_place') }}</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="tab-content">
                                            @include('dashboard.includes.flash_msg')
                                            <div class="tab-pane active provider_data" id="tab_1_1">
                                                <form method="post" action="{{ route('update-place', $data->id) }}">
                                                    @csrf
                                                    <div class="form-body form_add">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="col-md-6">
                                                                    <div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
                                                                        <label for="city_id">{{ __('lang.city') }} <span class="required">*</span> </label>
                                                                        <input type="hidden" value="1" id="diff">
                                                                        <select id="city_id" name="city_id" data-live-search="true" class="form-control bs-select">
                                                                            <option value="" selected disabled>{{ __('lang.choose') }} {{ __('lang.city') }}</option>
                                                                            @foreach($cities as $get)
                                                                                <option {{ $get->id == old('city_id', $data->city_id) ? 'selected' : '' }} value="{{ $get->id }}">{{ $get->title }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group {{ $errors->has('area_id') ? 'has-error' : '' }}">
                                                                        <label for="area_id">{{ __('lang.area') }} <span class="required">*</span> </label>
                                                                        <select id="area_id" name="area_id" data-live-search="true" class="form-control bs-select">
                                                                            <option value="" selected disabled>{{ __('lang.choose') }} {{ __('lang.area') }}</option>
                                                                            @foreach($areas as $get)
                                                                                <option {{ $get->id == old('area_id', $data->area_id) ? 'selected' : '' }} value="{{ $get->id }}">{{ $get->title }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group {{ $errors->has('from') ? 'has-error' : '' }}">
                                                                        <label for="from">{{ __('lang.delivery_on_from') }} {{ __('lang.days') }} <span class="required">*</span> </label>
                                                                        <input type="number" name="from" id="from" step="1" min="1" value="{{ old('from', $data->from) }}" class="form-control IntVal" placeholder="{{ __('lang.enter') }} {{ __('lang.delivery_on_from') }} {{ __('lang.days') }} {{ __('lang.ex') }}:(2)" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group {{ $errors->has('to') ? 'has-error' : '' }}">
                                                                        <label for="to">{{ __('lang.delivery_on_to') }} {{ __('lang.days') }} <span class="required">*</span> </label>
                                                                        <input type="number" name="to" id="to" step="1" value="{{ old('to', $data->to) }}" class="form-control IntVal" placeholder="{{ __('lang.enter') }} {{ __('lang.delivery_on_to') }} {{ __('lang.days') }} {{ __('lang.ex') }}:(5)" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                                                                        <label for="price">{{ __('lang.price') }} <span class="required">*</span> </label>
                                                                        <input type="number" name="price" id="price" step="1" value="{{ old('price', $data->price) }}" class="form-control IntVal" placeholder="{{ __('lang.enter') }} {{ __('lang.price') }} " />
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class=" col-md-9">
                                                                        <button type="submit" id="submit" class="btn green">{{ __('lang.submit') }}</button>
                                                                        <a href="{{ route('places') }}" class="btn default">{{ __('lang.cancel') }}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="loading_request">
                                    <img src="{{ asset('images/loading.gif') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

