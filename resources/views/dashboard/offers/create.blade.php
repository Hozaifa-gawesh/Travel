@php $titlePage = __('lang.add_offer'); @endphp
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
                    <a href="{{ route('offers') }}">{{ __('lang.offers') }}</a>
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
                                <form method="post" action="{{ route('store-offer') }}" enctype="multipart/form-data">
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
                                                            <div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
                                                                <label class="control-label" for="country_id">{{ __('lang.country') }} <span class="required">*</span></label>
                                                                <select name="country_id" id="country_id" class="form-control selectpicker" data-live-search="true">
                                                                    <option selected disabled value="">{{ __('lang.choose') }} {{ __('lang.country') }}</option>
                                                                    @foreach($countries as $get)
                                                                        <option {{ old('country_id') == $get->id ? 'selected' : '' }} value="{{ $get->id }}">{{ $get->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12" id="previewDates">
                                                                <div class="col-md-4">
                                                                    <div class="form-group {{ $errors->has('date_from') ? 'has-error' : '' }}">
                                                                        <label for="date_from">Date From <span class="required">*</span></label>
                                                                        <input type="date" id="date_from" min="{{ date('Y-m-d') }}" name="date_from" value="{{ old('date_from', date('Y-m-d')) }}" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group {{ $errors->has('date_to') ? 'has-error' : '' }}">
                                                                        <label for="date_to">Date To <span class="required">*</span></label>
                                                                        <input type="date" id="date_to" name="date_to" min="{{ old('date_from', \Carbon\Carbon::now()->addDay()->format('Y-m-d')) }}" value="{{ old('date_to', \Carbon\Carbon::now()->addDay()->format('Y-m-d')) }}" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="duration">Duration<span class="required">(Days)</span></label>
                                                                        <input type="number" value="{{ old('duration', 1) }}" name="duration" readonly id="duration" class="form-control">
                                                                    </div>
                                                                </div>
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
                                                        <div class="col-md-6">
                                                            <div class="form-group {{ $errors->has('adult_price') ? 'has-error' : '' }}">
                                                                <label for="adult_price">Price for Adult <span class="required">*</span></label>
                                                                <input type="number" min="0.00" step="0.01" id="adult_price" name="adult_price" value="{{ old('adult_price') }}" class="form-control" placeholder="Enter Price for Adult">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group {{ $errors->has('child_price') ? 'has-error' : '' }}">
                                                                <label for="child_price">Price for Child <span class="required">*</span></label>
                                                                <input type="number" min="0.00" step="0.01" id="child_price" name="child_price" value="{{ old('child_price') }}" class="form-control" placeholder="Enter Price for Child">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                                                <label for="title">Title <span class="required">*</span></label>
                                                                <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control" placeholder="Enter Title Offer">
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
                                                        <a href="{{ route('offers') }}" class="btn default">{{ __('lang.cancel') }}</a>
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

@section('js')
    <script>
        $('#date_from, #date_to').change(function () {
            var From = $('#date_from');
            var To = $('#date_to');
            var Loading = $('.loading_request');
            $.ajax({
                url: '{{ route('date-offer') }}',
                type: 'post',
                dataType: 'json',
                beforeSend: function () {
                    Loading.show();
                },
                data: {'date_from': From.val(), 'date_to': To.val(), '_token': $('meta[name="_token"]').attr('content')},
                success: function (data) {
                    Loading.hide();
                    if(data.status === true) {
                        $('#duration').val(data.data);
                    }
                },
                error: function () {
                    location.reload();
                }
            });
        });
    </script>
@stop
