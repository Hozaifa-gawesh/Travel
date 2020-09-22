@php $titlePage = __('lang.add_user'); @endphp
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
                    <a href="{{ route('users') }}">{{ __('lang.users') }}</a>
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
                                <form method="post" action="{{ route('store-user') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                                                        <label class="control-label" for="username">{{ __('lang.username') }} <span class="required">*</span></label>
                                                        <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="{{ __('lang.enter') }} {{ __('lang.username') }}" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                                        <label class="control-label" for="email">{{ __('lang.email') }} <span class="required">*</span></label>
                                                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('lang.enter') }} {{ __('lang.email') }}" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                                        <label class="control-label" for="password">{{ __('lang.password') }} <span class="required">*</span></label>
                                                        <input type="password" name="password" id="password" placeholder="{{ __('lang.enter') }} {{ __('lang.password') }}" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                                        <label class="control-label" for="phone">{{ __('lang.phone') }} <span class="required">*</span></label>
                                                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="{{ __('lang.enter') }} {{ __('lang.phone') }}" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                                        <label class="display-block" for="image">{{ trans('lang.choose') }} {{ trans('lang.image') }} <span class="required"> {{ trans('lang.best_size') }} (600 * 600)</span></label>
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail">
                                                                <img src="{{ asset('images/user.png') }}"/>
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
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <button type="submit" id="submit" class="btn green">{{ __('lang.submit') }}</button>
                                                        <a href="{{ route('users') }}" class="btn default">{{ __('lang.cancel') }}</a>
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
@endsection


