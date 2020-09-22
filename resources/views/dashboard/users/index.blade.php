@extends('dashboard.layouts.master')
@section('title')
    {{ __('lang.users') }}
@stop
@section('content')
    <div class="page-content-wrapper users">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>{{ __('lang.users') }}</h1>
                </div>
                <a class="add_users" title="{{ __('lang.add_user') }}" href="{{ route('add-user') }}"><i class="icon-plus"></i></a>
                <a class="orange_icon" title="{{ __('lang.pending_users') }}" href="{{ route('pending-users') }}"><i class="icon-clock"></i></a>
                <a class="black_icon" title="{{ __('lang.blocking_users') }}" href="{{ route('blocking-users') }}"><i class="icon-ban"></i></a>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">{{ trans('lang.dashboard') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">{{ __('lang.users') }}</span>
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
                                    <a href="{{ route('view-user', $get->id) }}" title="{{ $get->username }}">
                                        <img src="{{ $get->image !== null ? asset('images/'.$get->image) : asset('images/user.png') }}" title="{{ $get->username }}" alt="{{ $get->username }}">
                                    </a>
                                </div>
                                <div class="item_info text-center">
                                    <a href="{{ route('view-user', $get->id) }}" title="{{ trans('lang.view_details') }}"><h3>{{ $get->username }}</h3></a>
                                    <a href="{{ route('view-user', $get->id) }}" title="{{ __('lang.view_details') }}" class="view_details icon_item yellow_icon"><i class="icon-eye"></i></a>
                                    <a href="{{ route('edit-user', $get->id) }}" title="{{ __('lang.edit_user') }}" class="view_details icon_item blue_icon"><i class="icon-note"></i></a>
                                    <a href="{{ route('block-user', $get->id) }}" title="{{ __('lang.block_user') }}" class="view_details confirm-btn icon_item black_icon"><i class="icon-ban"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if(count($data) == 0)
                    @include('dashboard.includes.empty')
                @endif
            </div>
        </div>
    </div>
@stop
