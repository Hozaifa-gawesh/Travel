@php $titlePage = 'Services'; @endphp
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
                <button data-toggle="modal" class="add_products FormDistrictAdd" data-target="#FormDistrict" title="Add Service" value="{{ route('store-service') }}"><i class="icon-plus"></i></button>
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
                <div class="col-lg-12 col-xs-12 col-sm-12">
                    <div class="tab-pane" id="tab_2">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption mt-15">
                                    <i class="icon-equalizer font-green-haze"></i>
                                    <span class="caption-subject font-green-haze bold uppercase">{{ $titlePage }}</span>
                                </div>
                                @if(count($data))<button type="button" id="checkMulti" class="deleted_multi btn btn-danger">{{ __('lang.delete_selected') }}</button>@endif
                                <div class="clear"></div>
                            </div>
                            <div class="portlet-body form">
                                {{-- Include Messages Flash --}}
                                @include('dashboard.includes.flash_msg')
                                <form action="{{ route('deletes-service') }}" method="post" id="form_multi">
                                    @csrf
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                        <tr>
                                            <th><input type="checkbox" class="checkbox-style" id="roleSelect"></th>
                                            <th>{{ __('lang.title') }}</th>
                                            <th> {{ __('lang.control') }} </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $get)
                                            <tr>
                                                <td><input type="checkbox" class="checkbox-style roleCheck" value="{{ $get->id }}" name="data[]"></td>
                                                <td>{{ $get->title }}</td>
                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#FormDistrict" value="{{ route('update-service', $get->id) }}" title="Edit" data-id="{{ $get->id }}" class="btn btn-info blue_icon FormDistrictEdit"><i class="fa fa-edit"></i></button>
                                                    <a title="Delete" href="javascript:;" data-url="{{ route('delete-service', $get->id) }}" class="btn btn-danger confirmAjax"><i class="fa fa-trash"></i></a>
                                                </td>
                                                <input type="hidden" class="titleDistrict" value="{{ $get->title }}">
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </form>
                                <div class="text-right">
                                    {{ $data->render() }}
                                </div>
                                @if(count($data) == 0)
                                    <div class="text-center">
                                        <p>{{ __('lang.no_data') }}</p>
                                    </div>
                                @endif
                                <div class="modal fade" id="FormDistrict" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="rule_form">
                                                            <h3 style="margin-bottom: 15px;">Information Service:</h3>
                                                            <form id="FieldsForm" method="post">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <ul style="margin-top: 0;" class="nav nav-tabs sub_tabs">
                                                                            <li class="active">
                                                                                <a href="#English" data-toggle="tab"> {{ __('lang.english') }} </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="tab-content sub_content">
                                                                        <div class="tab-pane fade active in" id="English">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                                                                    <label for="title">Title <span class="required">*</span></label>
                                                                                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control" placeholder="Enter Title">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="clear"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-actions">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="row">
                                                                                <div class="col-md-9">
                                                                                    <button type="submit" id="submit" class="btn green">{{ __('lang.submit') }}</button>
                                                                                    <button type="button" data-dismiss="modal" class="btn default">{{ __('lang.cancel') }}</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
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
@stop

