@php $titlePage = 'Items'; @endphp
@extends('dashboard.layouts.master')
@section('title')
    {{ $titlePage }}
@stop
@section('content')
    <div class="page-content-wrapper boxed-items brands">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>{{ $titlePage }}</h1>
                </div>
                <a class="add_products" title="{{ __('lang.add_item') }}" href="{{ route('create-city-offer', $data->id) }}"><i class="icon-plus"></i></a>
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
                    <span class="active">{{ $titlePage }}</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    {{-- Include Messages Flash --}}
                    @include('dashboard.includes.flash_msg')
                    @foreach($items as $get)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="item_box of_city">
                                <div class="item_img">
                                    <img src="{{ asset('images/thumbnail/'.$get->city->image) }}" title="{{ $get->city->title }}" alt="{{ $get->city->title }}">
                                </div>
                                <div class="overlay_box open_img">
                                    <a href="{{ asset('images/'.$get->city->image) }}" class="preview_img" title="{{ $get->city->title }}"><i class="fa fa-image"></i></a>
                                </div>
                                <div class="item_info">
                                    <h4>City:  <strong>{{ $get->city->title }}</strong></h4>
                                    <h4>Hotel:  <strong>{{ $get->hotel->title }}</strong></h4>
                                    <h4>Room Type:  <strong>{{ $get->room_type }}</strong></h4>
                                    <h4>Date From:  <strong>{{ $get->date_from }}</strong></h4>
                                    <h4>Date To:  <strong>{{ $get->date_to }}</strong></h4>
                                    <h4>Duration:  <strong>{{ $get->duration }} <small>Days</small></strong></h4>
                                    <h4>Services:  <small>
                                            @php $serv = json_decode($get->hotel->services); @endphp

                                            @foreach($serv as $se)
                                                {{ $se }} ,
                                            @endforeach
                                        </small></h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center">
                    {{ $items->render() }}
                </div>
                @if(count($items) == 0)
                    @include('dashboard.includes.empty')
                @endif
            </div>
        </div>
    </div>
@stop
