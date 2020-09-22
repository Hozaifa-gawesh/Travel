@php
    $admin = auth('admin')->user();
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="HoZaifa" name="author" />
        <link rel="shortcut icon" href="{{ asset('images/'.$setting->favicon_white) }}" />
        <meta name="_token" content="{{ csrf_token() }}">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets') }}/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets') }}/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets') }}/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets') }}/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets') }}/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets') }}/global/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets') }}/global/plugins/bootstrap-colorpicker/css/colorpicker.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets') }}/global/plugins/jquery-minicolors/jquery.minicolors.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets') }}/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets') }}/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets') }}/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets') }}/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('admin/assets') }}/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets') }}/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets') }}/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets') }}/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ asset('admin/assets') }}/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets') }}/css/magnific-popup.css" rel="stylesheet" type="text/css" />
        @yield('css')
        <link href="{{ asset('admin/assets') }}/css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo ">
    <div class="page-header navbar navbar-fixed-top">
        <div class="page-header-inner ">
            <div class="page-logo">
                <a href="{{ url('dashboard/home') }}">
                    <img style="width: 105px;" src="{{ asset('images/'.$setting->logo_white) }}" alt="logo" class="logo-default" /> </a>
                <div class="menu-toggler sidebar-toggler">
                </div>
            </div>
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
            <div class="page-top">
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <li class="separator hide"> </li>
                        <li class="dropdown dropdown-user dropdown-dark">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <span class="username username-hide-on-mobile"> {{ $admin->username }} </span>
                                <img class="img-circle" src="{{ $admin->image != null ? asset('images/'.$admin->image) : asset('images/user.png') }}">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="{{ url('dashboard/profile') }}">
                                        <i class="icon-user"></i>{{ __('lang.profile') }}
                                    </a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="{{ url('dashboard/logout') }}" onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                        <i class="icon-key"></i>  {{ __('lang.logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ url('dashboard/logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"> </div>
    <div class="page-container">
        <div class="page-sidebar-wrapper">
            <div class="page-sidebar navbar-collapse collapse">
                <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                    <li class="nav-item start {{ Request::is('dashboard') || Request::is('dashboard/home') ? 'active open' : '' }}">
                        <a href="{{ route('dashboard') }}" class="nav-link nav-toggle">
                            <i class="icon-home"></i>
                            <span class="title">{{ __('lang.dashboard') }}</span>
                        </a>
                    </li>
                    {{-- Start Countries Link --}}
                    <li class="nav-item {{ Request::is('dashboard/countries*') ? 'active open' : '' }}">
                        <a href="{{ route('countries') }}" class="nav-link nav-toggle">
                            <i class="icon-pointer"></i>
                            <span class="title">{{ __('lang.countries') }}</span>
                        </a>
                    </li>
                    {{-- Start Services Link --}}
                    <li class="nav-item {{ Request::is('dashboard/services*') ? 'active open' : '' }}">
                        <a href="{{ url('dashboard/services') }}" class="nav-link nav-toggle">
                            <i class="icon-social-dropbox"></i>
                            <span class="title">Services</span>
                        </a>
                    </li>
                    {{-- Start Hotels Link --}}
                    <li class="nav-item {{ Request::is('dashboard/hotels*') ? 'active open' : '' }}">
                        <a href="{{ url('dashboard/hotels') }}" class="nav-link nav-toggle">
                            <i class="fa fa-bed"></i>
                            <span class="title">Hotels</span>
                        </a>
                    </li>
                    {{-- Start Offers Link --}}
                    <li class="nav-item {{ Request::is('dashboard/offers*') ? 'active open' : '' }}">
                        <a href="{{ url('dashboard/offers') }}" class="nav-link nav-toggle">
                            <i class="fa fa-diamond"></i>
                            <span class="title">Offers</span>
                        </a>
                    </li>
                    {{-- Start Settings Link --}}
                    <li class="nav-item {{ Request::is('dashboard/setting*') ? 'active open' : '' }}">
                        <a href="{{ url('dashboard/setting') }}" class="nav-link nav-toggle">
                            <i class="icon-settings"></i>
                            <span class="title">{{ __('lang.setting') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @yield('content')
    </div>
    <div class="page-footer">
        <div class="page-footer-inner"> <span class="copyright">© {{ date('Y') }} All Rights Reserved. Made by <a href="{{ $setting->linkedin }}">{{ $setting->site_name }}</a>.</span></div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    @yield('quick')
    <script src="{{ asset('admin/assets') }}/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('.bs-select').attr('data-container', 'body');
        });
    </script>
    <script src="{{ asset('admin/assets') }}/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/jquery-bootpag/jquery.bootpag.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/jquery-file-upload/js/vendor/load-image.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/jquery-minicolors/jquery.minicolors.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/morris/morris.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/scripts/app.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/pages/scripts/components-color-pickers.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/pages/scripts/dashboard.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/pages/scripts/form-fileupload.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/pages/scripts/ui-general.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/js/tinymce/tinymce.min.js"></script>
    <script src="{{ asset('admin/assets') }}/js/tinymce/tiny-init.js"></script>
    <script src="{{ asset('admin/assets') }}/js/jquery.magnific-popup.min.js"></script>
    @yield('js')
    <script src="{{ asset('admin/assets') }}/js/work.js"></script>
    <script>
        $(document).ready(function () {
            var City = $('#country');
            var District = $('#city_id');
            var DIFF = $('#diff').val() == true ? 1 : 0;
            var Loading = $('.loading_request');
            var SelectedCity = "{{ old('country') }}";
            var SelectedDistrict = "{{ old('city_id') }}";
            City.change(function () {
                District.empty();
                District.selectpicker('refresh');
                GetData($(this).val());
            });
            @if(old('country'))
            if(SelectedDistrict !== null) {
                District.empty();
                District.selectpicker('refresh');
                GetData(SelectedCity);
            }
            @endif
            function GetData(country)
            {
                $.ajax({
                    url: '{{ route('cities.country.global') }}',
                    type: 'post',
                    dataType: 'json',
                    beforeSend: function () {
                        Loading.show();
                    },
                    data: {'country': country, 'diff': DIFF, _token: '{{csrf_token()}}'},
                    success: function (data) {
                        Loading.hide();
                        if(data.status === true) {
                            District.prop('disabled', false);
                            District.append('<option selected disabled value="">{{ __('lang.choose') }} {{ __('lang.city') }}</option>');
                            for(var i=0; i<data.data.length; i++) {
                                var Get = data.data[i];
                                var Selected = SelectedDistrict == Get['id'] ? "selected" : "";
                                District.append('<option '+Selected+' value="'+Get['id']+'">'+Get['title']+'</option>');
                            }
                            District.selectpicker('refresh');
                        }
                    },
                    error: function () {
                        location.reload();
                    }
                });
            }
        });
    </script>
    </body>
</html>
