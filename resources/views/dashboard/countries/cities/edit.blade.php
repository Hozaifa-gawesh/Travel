@php $titlePage = __('lang.edit_city'); @endphp
@extends('dashboard.layouts.master')
@section('title')
    {{ $item->title }} | {{ $data->title }}
@stop
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>{{ $item->title }}</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">{{ __('lang.dashboard') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ route('countries') }}">{{ __('lang.countries') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ route('view-country', $data->id) }}">{{ $data->title }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ route('view-city-country', [$data->id, $item->id]) }}">{{ $item->title }}</a>
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
                                <form method="post" action="{{ route('update-city-country', [$data->id, $item->id]) }}" enctype="multipart/form-data">
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
                                                        <div class="col-md-8">
                                                            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                                                <label class="display-block" for="image">{{ trans('lang.choose') }} {{ trans('lang.image') }} <span class="required"> * {{ trans('lang.best_size') }} (800 * 800)</span></label>
                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                    <div class="fileinput-new thumbnail">
                                                                        <img src="{{ asset('images/' . $item->image) }}"/>
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
                                                                <input type="text" id="title" name="title" value="{{ old('title', $item->title) }}" class="form-control" placeholder="Enter Title City">
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
                                                        <a href="{{ route('view-country', $data->id) }}" class="btn default">{{ __('lang.cancel') }}</a>
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
            </div>
        </div>
    </div>
@stop


