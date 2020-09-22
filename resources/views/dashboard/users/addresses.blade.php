@php $titlePage = __('lang.addresses'); @endphp
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
                                                <div class="panel-group accordion" id="places">
                                                    @foreach($addresses as $key => $get)
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading main_city">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#places" href="#City_{{ str_replace(' ', '-', $key) }}" aria-expanded="false">
                                                                        {{ $key }}
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div id="City_{{ str_replace(' ', '-', $key) }}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <table style="margin-top: 10px;" class="table table-bordered table-striped table-condensed flip-content">
                                                                                <thead class="flip-content">
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th> {{ __('lang.area') }} </th>
                                                                                    <th> {{ __('lang.phone') }} </th>
                                                                                    <th> {{ __('lang.address') }} </th>
                                                                                    <th> {{ __('lang.street') }} </th>
                                                                                    <th> {{ __('lang.building_number') }} </th>
                                                                                    <th style="width: 150px;"> {{ __('lang.status') }} </th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                @foreach($get as $echo)
                                                                                    <tr>
                                                                                        <td style="width: 50px;">{{ $echo->id }}</td>
                                                                                        <td style="width: 200px;">{{ $echo->area->title }}</td>
                                                                                        <td style="width: 150px;">{{ $echo->phone }}</td>
                                                                                        <td style="width: 250px;">{{ $echo->address }}</td>
                                                                                        <td style="width: 350px;">{{ $echo->street }}</td>
                                                                                        <td style="width: 100px;">{{ $echo->building_number }}</td>
                                                                                        <td style="width: 30px;">
                                                                                            <span title="{{ $echo->deleted === 1 ? __('lang.done_deleted') : __('lang.active') }}"><i class="fa fa-eye{{ $echo->deleted === 1 ? '-slash' : '' }}"></i></span>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @if(count($addresses) == 0)
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


