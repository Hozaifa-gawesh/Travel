@php $titlePage = __('lang.hotels'); @endphp
@extends('dashboard.layouts.master')
@section('title')
    {{ $data->title }} | {{ $titlePage }}
@stop
@section('content')
    <div class="page-content-wrapper boxed-items brands">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>{{ $titlePage }}</h1>
                </div>
                <a href="javascript:;" title="{{ __('lang.delete_city') }}" class="view_details confirm icon_item red_icon"><i class="icon-trash"></i></a>
                <form id="ClickSubmitForm" action="{{ route('delete-city-country', [$data->country_id, $data->id]) }}" method="POST" style="display: none;">@csrf</form>
                <a class="add_products blue_icon" title="{{ __('lang.edit_city') }}" href="{{ route('edit-city-country', [$data->country_id, $data->id]) }}"><i class="icon-note"></i></a>
                <a class="add_products" title="{{ __('lang.add_hotel') }}" href="{{ route('create-hotel') }}"><i class="icon-plus"></i></a>
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
                    <a href="{{ route('view-country', $data->country->id) }}">{{ $data->country->title }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">{{ $data->title }}</span>
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
                                    <a href="javascript:;" class="confirm {{ $get->hide === 0 ? 'show_item' : 'hidden_item' }} "><i class="fa fa-{{ $get->hide === 0 ? 'eye' : 'eye-slash' }}"></i></a>
                                    <form id="ClickSubmitForm" action="{{ route($get->hide === 0 ? 'hide-hotel' : 'show-hotel', $get->id) }}" method="post">@csrf</form>
                                    <a href="{{ asset('images/'.$get->image) }}" class="preview_img" title="{{ $get->title }} - [{{ $data->title }}]"><i class="fa fa-image"></i></a>
                                </div>
                                <div class="item_info text-center">
                                    <h3>{{ $get->title }}</h3>
                                    <a href="{{ route('edit-hotel', $get->id) }}" title="{{ __('lang.edit_hotel') }}" class="view_details icon_item blue_icon"><i class="icon-note"></i></a>
                                    <a href="javascript:;" title="{{ __('lang.delete_hotel') }}" class="view_details confirm icon_item red_icon"><i class="icon-trash"></i></a>
                                    <form class="ClickSubmitForm" action="{{ route('delete-hotel', $get->id) }}" method="POST" style="display: none;">@csrf</form>
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
