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
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
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

    <!-- login page start-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div class="login-main">
                            <div>
                                <a class="d-flex justify-content-center">
                                    <img style="width: 250px;" src="{{ asset('assets/images/login/new_icon.png')}}">
                                </a>
                                <a class="logo d-flex justify-content-center" href="#">
                                    <img style="width: 300px;" class="img-fluid for-light"
                                        src="{{ asset('assets/images/logo/logo_login.png')}}" alt="looginpage">
                                    <img class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo_dark.png')}}"
                                        alt="looginpage">
                                </a>
                            </div>
                            <div class='theme-fom'>
                                {{-- <h4>Login</h4>
                                <p>Masukkan username & password untuk login</p> --}}
                                <form class="theme-form" action="{{route('postauth')}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="col-form-label">NIK</label>
                                        <input class="form-control" name="nik" type="text" placeholder="Nomor Induk Karyawan"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Password</label>
                                        <input class="form-control" type="password" name="password"
                                            placeholder="********" required>
                                        {{-- <div class="show-hide"><span class="show"> </span></div> --}}
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="checkbox p-0">
                                            <input id="remember_me" type="checkbox" value="remember_me" name="remember_me">
                                            <label class="text-muted" for="remember_me">Ingat saya</label>
                                        </div><a class="link" href="{{route('lupa_password')}}">Lupa password?</a>
                                        <a href="/dashboard">
                                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                                        </a>
                                    </div>

                                    {{-- <p class="mt-4 mb-0">Punya Kendala?<a class="ml-2">Hubungi Admin</a></p> --}}

                                </form>
                                {{-- <p class="mt-4 mb-0">Don't have account?<a class="ml-2" href="sign-up.html">Create
                                        Account</a></p> --}}


                            </div>

                        </div>

                        <br>
                        {{-- <div class="d-flex justify-content-center">
                            <a class="mb-2">Powered by</a>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-12 justify-content-center">
                                <a class="d-flex justify-content-center">
                                    <img style="width: 480px;" src="{{ asset('assets/images/landing/logologologo.png')}}">
                                </a>
                                {{-- <a class=" col-md-4">
                                    <img style="width: 150px;" src="{{ asset('assets/images/login/petro.png')}}">
                                </a>
                                <a class="col-md-4">
                                    <img style="width: 150px;"
                                        src="{{ asset('assets/images/login/pupukindonesia.png')}}">
                                </a>
                                <a class="col-md-4">
                                    <img style="width: 150px;" src="{{ asset('assets/images/login/bumn.png')}}">
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- latest jquery-->
        <script src="{{ asset('assets/js/jquery-3.5.1.min.js')}}"></script>
        <!-- Bootstrap js-->
        <script src="{{ asset('assets/js/bootstrap/popper.min.js')}}"></script>
        <script src="{{ asset('assets/js/bootstrap/bootstrap.js')}}"></script>
        <!-- feather icon js-->
        <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
        <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
        <!-- Sidebar jquery-->
        <script src="{{ asset('assets/js/config.js')}}"></script>
        <!-- Plugins JS start-->
        <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
        <!-- Plugins JS Ends-->
        <!-- Theme js-->
        <script src="{{ asset('assets/js/script.js')}}"></script>
        <!-- login js-->

        <script src="../pwa/js/upup.min.js"></script>
        <script src="../pwa/js/addtohomescreen.min.js"></script>

        <script>
            UpUp.start({
                'cache-version': 'v2',
                'content-url': '/offline',
                'assets': ['../pwa/js/addtohomescreen.min.js', '../pwa/js/upup.min.js',
                    '../pwa/css/addtohomescreen.css',
                    '../pwa/manifest/manifest.json', '../pwa/manifest/icon-192x192.png',
                    '/pwa/manifest/icon-256x256.png',
                    '../pwa/manifest/icon-384x384.png', '../pwa/manifest/icon-512x512.png'
                ],
                'service-worker-url': '../upup.sw.min.js'
            });

            addToHomescreen();
        </script>
        <!-- Plugin used-->
        <script>
            $(document).on('click', '#error', function (e) {
                if ($('.email').val() == '' || $('.pwd').val() == '') {
                    swal(
                        "Error!", "Sorry, looks like some data are not filled, please try again !", "error"
                    )
                }
            });
        </script>
    </div>
</body>

</html>
