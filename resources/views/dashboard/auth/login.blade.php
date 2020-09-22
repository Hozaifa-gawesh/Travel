@php $setting = \App\Models\Setting::first(); @endphp
<!DOCTYPE html>
<html lang="ar">
    <head>
        <meta charset="utf-8" />
        <title>Travel Go Dashboard | login</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="HoZaifa" name="author" />
        <link rel="shortcut icon" href="{{ asset('images/'.$setting->favicon_white) }}" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin')}}/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin')}}/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin')}}/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin')}}/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{asset('admin')}}/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets') }}/css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body style="overflow: hidden" class=" login">
        <div class="user-login-5 page_login">
            <div class="row bs-reset">
                <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
                    <div class="login-content">
                        <div class="login_logo text-center" style="margin-bottom: 100px;">
                            <img style="width: 250px;" src="{{ asset('images/' . $setting->logo) }}" alt="{{ $setting->site_name }}">
                        </div>
                        <h1><span style="color: #EA943D; font-weight: bold">Login Now </span>Travel Go</h1>
                        <p>
                            [Dashboard] | TravelGo is an app for tourism.
                        </p>
                        <form method="POST" action="{{ url('dashboard/login') }}" class="login-form" >
                            @include('dashboard.includes.flash_msg')
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input class="form-control form-control-solid placeholder-no-fix form-group" placeholder="  Enter Email" id="email" type="email" name="email" value="{{ old('email') }}" required/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <input class="form-control form-control-solid placeholder-no-fix form-group" autocomplete="off" placeholder="Enter Password" id="password" type="password" name="password" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="rem-password">
                                        <label class="rememberme mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" name="remember" value="1" /> remember me
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" class="btn green btn-block" value="Login">
                                </div>
                            </div>
                            <div style="clear: both"></div>
                        </form>
                    </div>
                    <div class="login-footer">
                        <div class="row bs-reset">
                            <div class="col-xs-12 bs-reset">
                                <div class="login-copyright text-center">
                                    <p>Copyright &copy;  <?php echo date('Y') ?> Travel Go.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 hidden-xs bs-reset mt-login-5-bsfix">
                    <div class="login-bg">
                        <img style="width: 100%; height:100vh;" src="{{ asset('admin/assets/pages/img/login/bg.jpg') }}">
                     </div>
                </div>
            </div>
        </div>
        <script src="{{asset('admin')}}/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="{{asset('admin')}}/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="{{asset('admin')}}/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    </body>
</html>
