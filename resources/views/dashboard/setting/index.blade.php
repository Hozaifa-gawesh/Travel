@php $titlePage = __('lang.setting'); @endphp
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
                                <form method="post" action="{{ route('update-setting') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body form_add">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group {{ $errors->has('site_name') ? 'has-error' : '' }}">
                                                    <label for="site_name">{{ __('lang.site_name') }} <span class="required">*</span> </label>
                                                    <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $data->site_name) }}" class="form-control" placeholder="{{ __('lang.enter') }} {{ __('lang.site_name') }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group {{ $errors->has('sm_description') ? 'has-error' : '' }}">
                                                    <label for="sm_description">{{ __('lang.small_desc') }} <span class="required">*</span> </label>
                                                    <textarea name="sm_description" id="sm_description" class="form-control" placeholder="{{ __('lang.enter') }} {{ __('lang.small_desc') }}">{{ old('sm_description', $data->sm_description) }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('phone_1') ? 'has-error' : '' }}">
                                                    <label for="phone_1">{{ __('lang.phone') }} 1 <span class="required">*</span> </label>
                                                    <input type="text" name="phone_1" id="phone_1" value="{{ old('phone_1', $data->phone_1) }}" style="direction: ltr" class="form-control" placeholder="{{ __('lang.enter') }} {{ __('lang.phone') }} 1" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('phone_2') ? 'has-error' : '' }}">
                                                    <label for="phone_2">{{ __('lang.phone') }} 2 </label>
                                                    <input type="text" name="phone_2" id="phone_2" value="{{ old('phone_2', $data->phone_2) }}" style="direction: ltr" class="form-control" placeholder="{{ __('lang.enter') }} {{ __('lang.phone') }} 2" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('email_1') ? 'has-error' : '' }}">
                                                    <label for="email_1">{{ __('lang.email') }} 1<span class="required">*</span></label>
                                                    <input type="email" name="email_1" id="email_1" value="{{ old('email_1', $data->email_1) }}" class="form-control" placeholder="{{ __('lang.enter') }} {{ __('lang.email') }} 1" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('email_2') ? 'has-error' : '' }}">
                                                    <label for="email_2">{{ __('lang.email') }} 2</label>
                                                    <input type="email" name="email_2" id="email_2" value="{{ old('email_2', $data->email_2) }}" class="form-control" placeholder="{{ __('lang.enter') }} {{ __('lang.email') }} 2" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                                    <label for="email_2">{{ __('lang.address') }} <span class="required">*</span></label>
                                                    <input type="text" name="address" id="address" value="{{ old('address', $data->address) }}" class="form-control" placeholder="{{ __('lang.enter') }} {{ __('lang.address') }} " />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('facebook') ? 'has-error' : '' }}">
                                                    <label for="facebook">{{ __('lang.facebook') }}</label>
                                                    <input type="url" name="facebook" id="facebook" value="{{ old('facebook', $data->facebook) }}" class="form-control" placeholder="{{ __('lang.enter') }} {{ __('lang.facebook') }} {{ __('lang.link') }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('twitter') ? 'has-error' : '' }}">
                                                    <label for="twitter">{{ __('lang.twitter') }}</label>
                                                    <input type="url" name="twitter" id="twitter" value="{{ old('twitter', $data->twitter) }}" class="form-control" placeholder="{{ __('lang.enter') }} {{ __('lang.twitter') }} {{ __('lang.link') }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('instagram') ? 'has-error' : '' }}">
                                                    <label for="instagram">{{ __('lang.instagram') }}</label>
                                                    <input type="url" name="instagram" id="instagram" value="{{ old('instagram', $data->instagram) }}" class="form-control" placeholder="{{ __('lang.enter') }} {{ __('lang.instagram') }} {{ __('lang.link') }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('linkedin') ? 'has-error' : '' }}">
                                                    <label for="linkedin">{{ __('lang.linkedin') }}</label>
                                                    <input type="url" name="linkedin" id="linkedin" value="{{ old('linkedin', $data->linkedin) }}" class="form-control" placeholder="{{ __('lang.enter') }} {{ __('lang.linkedin') }} {{ __('lang.link') }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="img_form_height">
                                                    <img src="{{ asset('images/'.$data->logo) }}">
                                                </div>
                                                <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                                    <label class="control-label" for="logo">{{ __('lang.logo') }} <span class="required">Best Size (x * x)</span> </label>
                                                    <input type="file" name="logo" id="logo" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="img_form_height favicon_img">
                                                    <img src="{{ asset('images/'.$data->favicon) }}">
                                                </div>
                                                <div class="form-group {{ $errors->has('favicon') ? 'has-error' : '' }}">
                                                    <label class="control-label" for="favicon">{{ __('lang.favicon') }} <span class="required">Best Size (100 * 100)</span></label>
                                                    <input type="file" name="favicon" id="favicon" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="img_form_height black_icon">
                                                    <img src="{{ asset('images/'.$data->logo_white) }}">
                                                </div>
                                                <div class="form-group {{ $errors->has('logo_white') ? 'has-error' : '' }}">
                                                    <label class="control-label" for="logo_white">{{ __('lang.logo') }} White <span class="required">Best Size (x * x)</span> </label>
                                                    <input type="file" name="logo_white" id="logo_white" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="img_form_height black_icon favicon_img">
                                                    <img src="{{ asset('images/'.$data->favicon_white) }}">
                                                </div>
                                                <div class="form-group {{ $errors->has('favicon_white') ? 'has-error' : '' }}">
                                                    <label class="control-label" for="favicon_white">{{ __('lang.favicon') }} White <span class="required">Best Size (100 * 100)</span></label>
                                                    <input type="file" name="favicon_white" id="favicon_white" class="form-control" />
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
                                                        <a href="{{ route('dashboard') }}" class="btn default">{{ __('lang.cancel') }}</a>
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
