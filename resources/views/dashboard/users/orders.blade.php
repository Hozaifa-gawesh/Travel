@php $titlePage = __('lang.orders'); @endphp
@extends('dashboard.layouts.master')
@section('title')
    {{ $titlePage }}
@stop
@section('content')
    <div class="page-content-wrapper orders">
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
                                                    <div class="col-md-12">
                                                        <table style="margin-top: 10px;" class="table table-bordered table-striped table-condensed flip-content">
                                                            <thead class="flip-content">
                                                            <tr>
                                                                <th>#</th>
                                                                <th> {{ __('lang.date') }} </th>
                                                                <th> {{ __('lang.address') }} </th>
                                                                <th> {{ __('lang.price') }} </th>
                                                                <th> {{ __('lang.products') }} </th>
                                                                <th> {{ __('lang.status') }} </th>
                                                                <th> {{ __('lang.change_status') }} </th>
                                                                <th style="width: 150px;"> {{ __('lang.control') }} </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($orders as $key => $get)
                                                                <tr class="{{ $get->status == "cancel" ? 'order_canceled' : '' }}">
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td class="en_text" style="direction: ltr;">{{ $get->created_at->format('Y-m-d g:i A') }}</td>
                                                                    <td><a class="main_color" href="{{ route('places','city='.$get->address->city_id.'&district='.$get->address->area_id) }}">{{ $get->address->area->title }}</a> </td>
                                                                    <td>{{ round($get->total, 0) }} <small>{{ __('lang.sar') }}</small></td>
                                                                    <td>{{ $get->items_count }}</td>
                                                                    <td><span class="label label_status label-success {{ $get->status }}">{{ $get->getOriginal('status') == 6 ? __('lang.'.$get->status.'_order') :__('lang.'.$get->status) }}</span></td>
                                                                    <td>
                                                                        @if($get->getOriginal('status') != 6)
                                                                            <a href="javascript:;" class="btn_status confirm f_white">{{ __('lang.'.($get->getOriginal('status') + 1)) }}</a>
                                                                            <form id="delete-form" action="{{ route('status-order', [$get->id, ($get->getOriginal('status') + 1)]) }}" method="POST" style="display: none;">
                                                                                {{ csrf_field() }}
                                                                            </form>
                                                                        @else ---- @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ route('view-order', $get->id) }}" title="{{ __('lang.view_details') }}" class="btn btn-warning"><i style="color:#fff!important;" class="fa fa-eye"></i></a>
                                                                        @if($get->status == "cancel")
                                                                            <a href="{{ route('delete-order', $get->id) }}" title="{{ __('lang.delete') }}" class="btn btn-danger confirm-btn"><i class="fa fa-trash"></i></a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    {{ $orders->render() }}
                                                </div>
                                                @if(count($orders) == 0)
                                                    <div class="text-center"><p>{{ __('lang.no_data') }}</p></div>
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
@endsection


