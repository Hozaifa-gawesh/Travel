@php $titlePage = 'Add Item'; @endphp
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
                    <a href="{{ route('view-offer', $data->id) }}">{{ $data->title }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ route('cities-offer', $data->id) }}">Items</a>
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
                                <form method="post" action="{{ route('store-city-offer', $data->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body form_add">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#General" data-toggle="tab"> {{ __('lang.general') }} </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane fade active in" id="General">
                                                        <div class="col-md-4">
                                                            <div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
                                                                <label class="control-label" for="city_id">{{ __('lang.city') }} <span class="required">*</span></label>
                                                                <select name="city_id" id="city_id" class="form-control selectpicker" data-live-search="true">
                                                                    <option selected disabled value="">{{ __('lang.choose') }} {{ __('lang.city') }}</option>
                                                                    @foreach($cities as $get)
                                                                        <option {{ old('city_id') == $get->id ? 'selected' : '' }} value="{{ $get->id }}">{{ $get->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group {{ $errors->has('hotel_id') ? 'has-error' : '' }}">
                                                                <label class="control-label" for="hotel_id">{{ __('lang.hotel') }} <span class="required">*</span></label>
                                                                <select name="hotel_id" disabled id="hotel_id" class="form-control selectpicker" data-live-search="true">
                                                                    <option selected disabled value="">{{ __('lang.choose') }} {{ __('lang.hotel') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group {{ $errors->has('room_type') ? 'has-error' : '' }}">
                                                                <label class="control-label" for="room_type">Room Type <span class="required">*</span></label>
                                                                <select name="room_type" id="room_type" class="form-control" data-live-search="true">
                                                                    <option selected disabled value="">{{ __('lang.choose') }} Room Type</option>
                                                                    <option {{ old('room_type') == 'single' ? 'selected' : '' }} selected value="single">Single</option>
                                                                    <option {{ old('room_type') == 'double' ? 'selected' : '' }} value="double">double</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12" id="previewDates">
                                                                <div class="col-md-4">
                                                                    <div class="form-group {{ $errors->has('date_from') ? 'has-error' : '' }}">
                                                                        <label for="date_from">Date From <span class="required">*</span></label>
                                                                        <input type="date" id="date_from" max="{{ $date_from }}" min="{{ $date_from }}" name="date_from" value="{{ old('date_from', $date_from) }}" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group {{ $errors->has('date_to') ? 'has-error' : '' }}">
                                                                        <label for="date_to">Date To <span class="required">*</span></label>
                                                                        <input type="date" id="date_to" name="date_to" max="{{ $data->date_to }}" min="{{ $next_day }}" value="{{ old('date_to', $next_day) }}" class="form-control">
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
                                                        <a href="{{ route('cities-offer', $data->id) }}" class="btn default">{{ __('lang.cancel') }}</a>
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
    <script>
        var Loading = $('.loading_request');
        var City = $('#city_id');
        var Hotel = $('#hotel_id');
        var SelectedCity = "{{ old('city_id') }}";
        var SelectedHotel = "{{ old('hotel_id') }}";

        City.change(function () {
            Hotel.empty();
            Hotel.selectpicker('refresh');
            GetData($(this).val());
        });
        @if(old('city_id'))
        if(SelectedHotel !== null) {
            Hotel.empty();
            Hotel.selectpicker('refresh');
            GetData(SelectedCity);
        }
        @endif

        function GetData(city) {
            $.ajax({
                url: '{{ route('hotels-city-offer', $data->id) }}',
                type: 'post',
                dataType: 'json',
                beforeSend: function () {
                    Loading.show();
                },
                data: {'city_id': city, '_token': $('meta[name="_token"]').attr('content')},
                success: function (data) {
                    Loading.hide();
                    if(data.status === true) {
                        Hotel.prop('disabled', false);
                        Hotel.append('<option selected disabled value="">{{ __('lang.choose') }} {{ __('lang.city') }}</option>');
                        for(var i=0; i<data.data.length; i++) {
                            var Get = data.data[i];
                            var Selected = SelectedHotel == Get['id'] ? "selected" : "";
                            Hotel.append('<option '+Selected+' value="'+Get['id']+'">'+Get['title']+'</option>');
                        }
                        Hotel.selectpicker('refresh');
                    }
                },
                error: function () {
                    location.reload();
                }
            });
        }
    </script>
@stop
