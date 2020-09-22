@php $setting = \App\Models\Setting::first(); @endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
    <title>404 | {{ trans('lang.page_not_found') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="{{ $setting->description }}" name="description" />
    <meta content="HoZaifa" name="author" />
    <link rel="shortcut icon" href="{{ asset('images/'.$setting->favicon) }}" />
    <link href="{{ asset('admin/assets') }}/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets') }}/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets') }}/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets') }}/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets') }}/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ asset('admin/assets') }}/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets') }}/pages/css/error.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets') }}/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body class=" page-404-full-page">
<div class="row">
    <div class="col-md-12 page-404">
        <div class="number main_color"> 404 </div>
        <div class="details">
            <h3>{{ trans('lang.sorry') }}! {{ trans('lang.page_not_found') }}.</h3>
            <p> {{ trans('lang.we_can_find') }}.
                <br/>
                <a href="{{ url('dashboard') }}"> {{ trans('lang.go_to_home') }}</a>. </p>
        </div>
    </div>
</div>
<script src="{{ asset('admin/assets') }}/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/global/scripts/app.min.js" type="text/javascript"></script>
</body>

</html>
