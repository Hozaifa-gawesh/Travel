@php $titlePage = __('lang.favorites'); @endphp
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
                    <a href="{{ route('view-user', $data->id) }}">{{ $data->username  }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">{{ $titlePage }}</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    @include('dashboard.users.include')
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">{{ $titlePage  }}</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            @include('dashboard.includes.flash_msg')
                                            <div class="tab-pane active" id="tab_1_1">
                                                <div class="row">
                                                    <div class="favourites_user">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                @foreach($favourites as $echo)
                                                                    @php $get = $echo->product; @endphp
                                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                                        <div class="item_box">
                                                                            <a href="{{ route('view-product', $get->id) }}" title="{{ $get->title }}">
                                                                                <div class="item_img">
                                                                                    <img src="{{ count($get->images) > 0 ? asset('images/'.$get->images->last()->image) : asset('images/image.png') }}" title="{{ $get->title }}" alt="{{ $get->title }}">
                                                                                </div>
                                                                                <div class="item_info with_product">
                                                                                    <h3>{{ $get->title }}</h3>
                                                                                    <p>{{ $get->desc }}</p>
                                                                                    <h4>
                                                                                        <span class="price_pro {{ $get->discount !== null ? 'discount_price' : '' }} ">{{ $get->price }}</span>
                                                                                        @if($get->discount !== null)<span class="price_pro"> - {{ $get->discount->discount_rate }}</span>@endif
                                                                                        <span class="sar">{{ __('lang.sar') }}</span>
                                                                                    </h4>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="text-center">
                                                                {{ $favourites->render() }}
                                                            </div>
                                                            @if(count($data->favourites) == 0)
                                                                @include('dashboard.includes.empty')
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


