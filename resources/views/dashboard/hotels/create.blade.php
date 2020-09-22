@php $titlePage = __('lang.add_hotel'); @endphp
@extends('dashboard.layouts.master')
@section('title')
    {{ $titlePage }}
@stop
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>{{ $titlePage }}</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">{{ __('lang.dashboard') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ route('hotels') }}">{{ __('lang.hotels') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">{{ $titlePage }}</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-lg-12 col-xs-12 col-sm-12">
                    <div class="tab-pane" id="tab_2">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-equalizer font-green-haze"></i>
                                    <span class="caption-subject font-green-haze bold uppercase">{{ $titlePage }}</span>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                {{-- Include Messages Flash --}}
                                @include('dashboard.includes.flash_msg')
                                <form method="post" action="{{ route('store-hotel') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body form_add">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#General" data-toggle="tab"> {{ __('lang.general') }} </a>
                                                    </li>
                                                    <li>
                                                        <a href="#English" data-toggle="tab"> {{ __('lang.information') }} </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane fade active in" id="General">
                                                        <div class="col-md-12">
                                                            <div class="form-group {{ $errors->has('services') ? 'has-error' : '' }}">
                                                                <label class="control-label" for="services">Services <span class="required">*</span></label>
                                                                <input id="OldServices" value="{{ json_encode(old('services')) }}" style="display: none;" type="hidden">
                                                                <select multiple="multiple" id="services" name="services[]" class="form-control selectServices">
                                                                    @foreach($services as $get)
                                                                        <option {{ old('services') == $get->title ? 'selected' : '' }} value="{{ $get->title }}">{{ $get->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                                                                <label class="control-label" for="country">{{ __('lang.country') }} <span class="required">*</span></label>
                                                                <select name="country" id="country" class="form-control selectpicker" data-live-search="true">
                                                                    <option selected disabled value="">{{ __('lang.choose') }} {{ __('lang.country') }}</option>
                                                                    @foreach($countries as $get)
                                                                        <option {{ old('country') == $get->id ? 'selected' : '' }} value="{{ $get->id }}">{{ $get->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
                                                                <label class="control-label" for="city_id">{{ __('lang.city') }} <span class="required">*</span></label>
                                                                <select name="city_id" disabled id="city_id" class="form-control selectpicker" data-live-search="true">
                                                                    <option selected disabled value="">{{ __('lang.choose') }} {{ __('lang.city') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                                                <label class="display-block" for="image">{{ trans('lang.choose') }} {{ trans('lang.image') }} <span class="required"> * {{ trans('lang.best_size') }} (800 * 800)</span></label>
                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                    <div class="fileinput-new thumbnail">
                                                                        <img src="{{ asset('images/default.png') }}"/>
                                                                    </div>
                                                                    <div class="fileinput-preview fileinput-exists thumbnail"> </div>
                                                                    <div>
                                                                        <span class="btn default btn-file">
                                                                            <span class="fileinput-new"> {{ trans('lang.choose') }} {{ trans('lang.image') }}</span>
                                                                            <span class="fileinput-exists">{{ trans('lang.change') }} {{ trans('lang.image') }} </span>
                                                                            <input type="file" name="image" id="image">
                                                                        </span>
                                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ trans('lang.delete') }} {{ trans('lang.image') }} </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="English">
                                                        <div class="col-md-12">
                                                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                                                <label for="title">Title <span class="required">*</span></label>
                                                                <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control" placeholder="Enter Title Hotel">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
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
                                                        <a href="{{ route('hotels') }}" class="btn default">{{ __('lang.cancel') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script>
        var OldServices = JSON.parse($('#OldServices').val());
        $('.selectServices').select2({
            tags: true,
            data: OldServices,
            tokenSeparators: [',', ' '],
            placeholder: "Select or type accommodation services",
        }).val(OldServices).trigger("change");
    </script>
@stop