@php $titlePage = 'Gallery'; @endphp
@extends('dashboard.layouts.master')
@section('title')
    {{ $data->title }} | {{ $titlePage }}
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
                    {{-- Include Offers Tabs --}}
                    @include('dashboard.offers.include')
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">{{ $titlePage }}</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div style="padding: 0;" class="form-body form_add form_offer">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @include('dashboard.includes.flash_msg')
                                                    <form id="fileupload" method="post" action="{{ route('store-gallery-offer', $data->id) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row fileupload-buttonbar">
                                                            <div class="col-lg-7">
                                                                <span class="btn blue_icon f_white fileinput-button">
                                                                    <i class="fa fa-plus"></i>
                                                                    <span> {{ __('lang.add_files') }}... </span>
                                                                    <input type="file" name="images[]" multiple="">
                                                                </span>
                                                                <button type="submit" class="btn f_white main_icon start">
                                                                    <i class="fa fa-upload"></i>
                                                                    <span> {{ __('lang.start_upload') }} </span>
                                                                </button>
                                                                <button type="reset" class="btn f_white gray_icon cancel">
                                                                    <i class="fa fa-ban"></i>
                                                                    <span> {{ __('lang.cancel_upload') }} </span>
                                                                </button>
                                                                <span class="fileupload-process"> </span>
                                                            </div>
                                                            <div class="col-lg-5 fileupload-progress fade">
                                                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                                    <div class="progress-bar progress-bar-success" style="width:0%;"> </div>
                                                                </div>
                                                                <div class="progress-extended"> &nbsp; </div>
                                                            </div>
                                                        </div>
                                                        <table role="presentation" class="table table-striped clearfix">
                                                            <tbody class="files"> </tbody>
                                                        </table>
                                                    </form>
                                                    <div class="clear"></div>
                                                    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
                                                        <div class="slides"> </div>
                                                        <h3 class="title"></h3>
                                                        <a class="close white"> </a>
                                                        <a class="play-pause"> </a>
                                                        <ol class="indicator"> </ol>
                                                    </div>
                                                    <script id="template-upload" type="text/x-tmpl">
                                                        {% for (var i=0, file; file=o.files[i]; i++) { %}
                                                        <tr class="template-upload fade">
                                                            <td>
                                                                <span class="preview"></span>
                                                            </td>
                                                            <td>
                                                                <p class="name">{%=file.name%}</p>
                                                                <strong class="error text-danger label label-danger"></strong>
                                                            </td>
                                                            <td>
                                                                <p class="size">{{ __('lang.processing') }}...</p>
                                                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {% if (!i && !o.options.autoUpload) { %}
                                                                    <button style="display:none;" class="btn blue start" disabled>
                                                                        <i class="fa fa-upload"></i>
                                                                        <span>{{ __('lang.start') }}</span>
                                                                    </button>
                                                                {% } %}
                                                                {% if (!i) { %}
                                                                    <button class="btn red cancel">
                                                                        <i class="fa fa-ban"></i>
                                                                        <span>{{ __('lang.cancel') }}</span>
                                                                    </button>
                                                                {% } %}
                                                            </td>
                                                        </tr>
                                                        {% } %}
                                                    </script>
                                                    <script id="template-download" type="text/x-tmpl">
                                                    {% for (var i=0, file; file=o.files[i]; i++) { %}
                                                        <tr class="template-download fade">
                                                            <td>
                                                                <span class="preview">
                                                                    {% if (file.thumbnailUrl) { %}
                                                                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery>
                                                                            <img src="{%=file.thumbnailUrl%}">
                                                                        </a>
                                                                    {% } %}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <p class="name">
                                                                    <span>{{ __('lang.uploaded_success') }}...</span></p>
                                                                <div>
                                                                    <a class="btn btn-info green-btn" href="{{ url('dashboard/offers/'.$data->id.'/gallery') }}">{{ __('lang.refresh') }} <i class="fa fa-refresh"></i> </a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <span class="size">{%=o.formatFileSize(file.size)%}</span>
                                                            </td>
                                                        </tr> {% } %}
                                                    </script>
                                                    <div class="preview_images">
                                                        @php $gallery = json_decode($data->gallery); @endphp
                                                        @if(count($gallery))
                                                            <div class="row">
                                                            @foreach($gallery as $image)
                                                                <div class="col-md-4">
                                                                    <div class="pre_img">
                                                                        <a href="{{ asset('images/'.$image) }}">
                                                                            <img src="{{ asset('images/thumbnail/'.$image) }}" />
                                                                        </a>
                                                                        <form action="{{ route('delete-gallery-offer', [$data->id, array_search($image, $gallery)]) }}" method="post">
                                                                            @csrf
                                                                            <button title="{{ __('lang.delete_image') }}" class="confirm-btn" type="submit"><i class="fa fa-trash"></i> </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        @else
                                                            @include('dashboard.includes.empty_image')
                                                        @endif
                                                        <div class="clear"></div>
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


