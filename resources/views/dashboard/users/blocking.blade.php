@extends('dashboard.layouts.master')
@section('title')
    {{ __('lang.blocking_users') }}
@stop
@section('content')
    <div class="page-content-wrapper users">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>{{ __('lang.blocking_users') }}</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">{{ trans('lang.dashboard') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ route('users') }}">{{ trans('lang.users') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">{{ __('lang.blocking_users') }}</span>
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
                                    <a href="{{ route('unblock-user', $get->id) }}" title="{{ __('lang.unblock') }}" class="view_details confirm-btn icon_item"><i class="icon-check"></i></a>
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
