@php $titlePage = __('lang.offers'); @endphp
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
                <a class="add_products" title="{{ __('lang.add_offer') }}" href="{{ route('create-offer') }}"><i class="icon-plus"></i></a>
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
                <div class="col-md-12">
                    {{-- Include Messages Flash --}}
                    @include('dashboard.includes.flash_msg')
                    @foreach($data as $get)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="item_box">
                                <div class="item_img">
                                    <img src="{{ asset('images/thumbnail/'.$get->image) }}" title="{{ $get->title }}" alt="{{ $get->title }}">
                                </div>
                                <div class="overlay_box open_img">
                                    <a href="javascript:;" class="confirm {{ $get->hide === 0 ? 'show_item' : 'hidden_item' }} "><i class="fa fa-{{ $get->hide === 0 ? 'eye' : 'eye-slash' }}"></i></a>
                                    <form id="ClickSubmitForm" action="{{ route($get->hide === 0 ? 'hide-offer' : 'show-offer', $get->id) }}" method="post">@csrf</form>
                                    <a href="{{ asset('images/'.$get->image) }}" class="preview_img" title="{{ $get->title }} - [{{ $get->country->title }}]"><i class="fa fa-image"></i></a>
                                </div>
                                <a href="{{ route('view-offer', $get->id) }}">
                                    <div class="item_info text-center">
                                        <h3>{{ $get->title }}</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center">
                    {{ $data->render() }}
                </div>
                @if(count($data) == 0)
                    @include('dashboard.includes.empty')
                @endif
            </div>
        </div>
    </div>
@stop
