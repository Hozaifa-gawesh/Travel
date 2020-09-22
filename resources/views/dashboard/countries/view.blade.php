@php $titlePage = $data->title; @endphp
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
                <a href="javascript:;" title="{{ __('lang.delete_country') }}" class="view_details confirm icon_item red_icon"><i class="icon-trash"></i></a>
                <form id="ClickSubmitForm" action="{{ route('delete-country', $data->id) }}" method="POST" style="display: none;">@csrf</form>
                <a class="add_products" title="{{ __('lang.add_item') }}" href="{{ route('create-city-country', $data->id) }}"><i class="icon-plus"></i></a>
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
                    <span class="active">{{ $titlePage }}</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    {{-- Include Messages Flash --}}
                    @include('dashboard.includes.flash_msg')
                    @foreach($items as $get)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="item_box">
                                <div class="item_img">
                                    <img src="{{ asset('images/thumbnail/'.$get->image) }}" title="{{ $get->title }}" alt="{{ $get->title }}">
                                </div>
                                <div class="overlay_box open_img">
                                    <a href="{{ asset('images/'.$get->image) }}" class="preview_img" title="{{ $get->title }}"><i class="fa fa-image"></i></a>
                                </div>
                                <div class="item_info text-center">
                                    <h3>{{ $get->title }}</h3>
                                    <a href="{{ route('view-city-country', [$data->id, $get->id]) }}" title="{{ __('lang.view_hotel') }}" class="view_details icon_item yellow_icon"><i class="icon-eye"></i></a>
                                    <a href="{{ route('edit-city-country', [$data->id, $get->id]) }}" title="{{ __('lang.edit_city') }}" class="view_details icon_item blue_icon"><i class="icon-note"></i></a>
                                    <a href="javascript:;" title="{{ __('lang.delete_city') }}" class="view_details confirm icon_item red_icon"><i class="icon-trash"></i></a>
                                    <form class="ClickSubmitForm" action="{{ route('delete-city-country', [$data->id, $get->id]) }}" method="POST" style="display: none;">@csrf</form>
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
