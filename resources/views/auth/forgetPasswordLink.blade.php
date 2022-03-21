    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#357644" />
        <link rel="apple-touch-icon" href="/pwa/manifest/icon-192x192.png">
        <link rel="icon" href="{{ asset('assets/images/favicon.png')}}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png')}}" type="image/x-icon">
        <title>Segments - Security Management Systems</title>
        <!-- Google font-->
        <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
            rel="stylesheet">
        <link
            href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
            rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css')}}">
        <!-- ico-font-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/icofont.css')}}">
        <!-- Themify icon-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css')}}">
        <!-- Flag icon-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/flag-icon.css')}}">
        <!-- Feather icon-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css')}}">
        <!-- Plugins css start-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/sweetalert2.css')}}">
        <!-- Plugins css Ends-->
        <!-- Bootstrap css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css')}}">
        <!-- App css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css')}}">
        <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css')}}" media="screen">
        <!-- Responsive css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css')}}">

        <!-- Manifest -->
        <link rel="manifest" href="{{ asset('/pwa/manifest/manifest.json')}}">
        <!-- PWA -->
        <link rel="stylesheet" href="{{ asset('/pwa/css/addtohomescreen.css')}}">

    </head>

    <body>
        @include('sweetalert::alert')

        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="login-card">
                        <div>
                            <div><a class="logo" href="index.html"><img  style="width: 250px;"class="img-fluid for-light"
                                        src="{{ asset('assets/images/login/new_icon.png')}}" alt="looginpage"><img
                                        class="img-fluid for-dark" src="{{ asset('assets/images/login/new_icon.png')}}"
                                        alt="looginpage"></a></div>
                            <div class="login-main">
                                <form action="{{ route('reset.password.post') }}" class="theme-form" method="POST">
                                {{ csrf_field() }}
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <h6 class="mt-4">Buat Password Baru</h6>
                                    <div class="form-group">
                                        <label class="col-form-label">Email</label>
                                        <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-form-label">Password Baru</label>
                                        <input type="password" id="password" class="form-control" name="password" required autofocus>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-form-label">Konfirmasi Password</label>
                                        <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-0">
                                        <button class="btn btn-primary btn-block" type="submit">Kirim</button>
                                    </div>
                                    {{-- <p class="mt-4 mb-0">Sudah punya akun?<a class="ml-2" href="{{ route('login_absensi') }}">Masuk</a></p> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
