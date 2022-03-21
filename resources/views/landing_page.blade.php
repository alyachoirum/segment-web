<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>Security Management System</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/animate.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/timepicker.css')}}">
    <!-- leaflet css  -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />

<!-- leaflet js  -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
</head>

<body class="landing-page">
    <!-- page-wrapper Start-->
    <div class="page-wrapper landing-page"></div>
    <!-- page-wrapper Start-->
    <div class="page-wrapper landing-page">
        <!-- Page Body Start            -->
        <div class="landing-home">
            <ul class="decoration">
                <li class="one"><img class="img-fluid" src="../assets/images/landing/decore/1.png" alt=""></li>
                <li class="two"><img class="img-fluid" src="../assets/images/landing/decore/2.png" alt=""></li>
                <li class="three"><img class="img-fluid" src="../assets/images/landing/decore/4.png" alt=""></li>
                <li class="four"><img class="img-fluid" src="../assets/images/landing/decore/3.png" alt=""></li>
                <li class="five"><img class="img-fluid" src="../assets/images/landing/2.png" alt=""></li>
                <li class="six"><img class="img-fluid" src="../assets/images/landing/decore/cloud.png" alt=""></li>
                <li class="seven"><img class="img-fluid" src="../assets/images/landing/2.png" alt=""></li>
            </ul>
            <div class="container-fluid">
                <div class="sticky-header">
                    <header>
                        <nav class="navbar navbar-b navbar-trans navbar-expand-xl fixed-top nav-padding"
                            id="sidebar-menu">
                            <a class="navbar-brand p-0" href="#">
                                <img class="img-fluid" src="{{ asset('assets/images/landing/landing_logo.png')}}" alt="">
                            </a>
                            <button class="navbar-toggler navabr_btn-set custom_nav" type="button"
                                data-toggle="collapse" data-target="#navbarDefault" aria-controls="navbarDefault"
                                aria-expanded="false"
                                aria-label="Toggle navigation"><span></span><span></span><span></span></button>
                            <div class="navbar-collapse justify-content-end collapse hidenav" id="navbarDefault">
                                <ul class="navbar-nav navbar_nav_modify" id="scroll-spy">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Profile
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="#strukturs">Struktur Organisasi</a>
                                            <a class="dropdown-item" href="#tugasfungsiperanans">Tugas Fungsi
                                                Peranan</a>
                                            <a class="dropdown-item" href="#prinsips">Prinsip Penyelenggaraan</a>
                                            <a class="dropdown-item" href="#istilahs">Istilah Keamanan</a>
                                        </div>
                                    <li class="nav-item"><a class="nav-link" href="#layout">Wilayah</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#dashboards">Penunjang</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#klasifikasis">Klasifikasi</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#applications">Achievement</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#galeris">Galeri</a></li>

                                    <li class="nav-item btn-pill btn-primary"><a class="nav-link" href="#tambahlaporans" role="button">Lapor</a>
                                        {{-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="#">Absensi</a>
                                            <a class="dropdown-item" href="#">Pelaporan</a>
                                            <a class="dropdown-item" href="#">Penilaian</a>
                                        </div> --}}
                                        {{-- <a class="nav-link js-scroll" href="https://1.envato.market/3GVzd" target="_blank">Purchase</a> --}}
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </header>
                </div>
                <div class="row">
                    <div class="col-xl-5 col-lg-6">
                        <div class="content">
                            <div>
                                <h1 class="wow fadeIn">Departemen Keamanan </h1>
                                <h1 class="wow fadeIn">PT. Petrokimia Gresik </h1>
                                <h2 class="txt-secondary wow fadeIn">Faster, Lighter & Dev. Friendly</h2>
                                <p class="mt-3 wow fadeIn">
                                    Departemen Keamanan PT Petrokimia Gresik
                                </p>
                                <div class="btn-grp mt-4">
                                    <a class="btn btn-pill btn-success btn-air-success btn-lg wow pulse mr-3" href="{{route('login_absensi')}}"
                                        target="_blank">
                                        <img src="../assets/images/landing/icon/absensi.png" alt="">Absensi
                                    </a>
                                    <a class="btn btn-pill btn-success btn-air-success btn-lg wow pulse mr-3" href="{{route('login_absensi')}}"
                                        target="_blank">
                                        <img src="../assets/images/landing/icon/pelaporan.png" alt="">Pelaporan
                                    </a>
                                </div>
                                <div class="btn-grp mt-4">
                                    <a class="btn btn-pill btn-success btn-air-success btn-lg wow pulse mr-3" href="{{route('login_absensi')}}"
                                        target="_blank">
                                        <img src="../assets/images/landing/icon/evaluasi.png" alt="">Penilaian
                                        Kinerja
                                    </a>
                                    <a class="btn btn-pill btn-success btn-air-success btn-lg wow pulse mr-3" href="https://sintasian.securitypg.com/"
                                        target="_blank">
                                        <img src="../assets/images/landing/icon/evaluasi.png" alt="">Sintasian

                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-6">
                        <br>
                        <br><br><br>
                        <br><br>
                        <div class="mt-3">
                            <a class="d-flex justify-content-center">
                                <img style="width: 750px;" src="{{ asset('assets/images/landing/landinglanding.png')}}">
                            </a>
                        </div>
                        <div class="mt-4">
                            <a class="d-flex justify-content-center">
                                <img style="width: 500px;" src="{{ asset('assets/images/landing/logologologo.png')}}">
                            </a>
                        </div>

                        {{-- <div class="wow fadeIn"><img class="screen1" src="../assets/images/landing/screen1.jpg" alt="">
                        </div> --}}
                        {{-- <div class="wow fadeIn"><img class="screen2" src="../assets/images/landing/screen2.jpg" alt="">
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <section class="section-space cuba-demo-section frameworks-section" id="strukturs">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow pulse">
                        <div class="cuba-demo-content mt50">
                            <div class="couting">
                                <h2>Struktur</h2>
                            </div>
                            <p class="mb-0">Organisasi</p>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mt-3">
                            <a class="d-flex justify-content-center">
                                <img style="width: 750px;" src="{{ asset('assets/images/landing/struktur.png')}}">
                            </a>
                        </div>
                    </div>
                    {{-- <div class="col-sm-12 framworks">
                        <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link d-flex active" id="pills-home-tab"
                                    data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home"
                                    aria-selected="true"> <img src="../assets/images/landing/icon/html/html.png" alt="">
                                    <div class="text-left">
                                        <h5 class="mb-0">HTML</h5>
                                        <p class="mb-0">Frameworks</p>
                                    </div>
                                </a></li>
                            <li class="nav-item"><a class="d-flex nav-link" id="pills-profile-tab" data-toggle="pill"
                                    href="#pills-profile" role="tab" aria-controls="pills-profile"
                                    aria-selected="false"> <img src="../assets/images/landing/icon/react/react1.png"
                                        alt="">
                                    <div class="text-left">
                                        <h5 class="mb-0">React</h5>
                                        <p class="mb-0">Frameworks</p>
                                    </div>
                                </a></li>
                            <li class="nav-item"><a class="d-flex nav-link" id="pills-angular-tab" data-toggle="pill"
                                    href="#pills-angular" role="tab" aria-controls="pills-angular"
                                    aria-selected="false"> <img src="../assets/images/landing/icon/angular/angular.svg"
                                        alt="">
                                    <div class="text-left">
                                        <h5 class="mb-0">Angular</h5>
                                        <p class="mb-0">Frameworks</p>
                                    </div>
                                </a></li>
                            <li class="nav-item"><a class="d-flex nav-link" id="pills-contact-tab" data-toggle="pill"
                                    href="#pills-contact" role="tab" aria-controls="pills-contact"
                                    aria-selected="false"> <img src="../assets/images/landing/icon/laravel/laravel.png"
                                        alt="">
                                    <div class="text-left">
                                        <h5 class="mb-0">Laravel</h5>
                                        <p class="mb-0">Frameworks</p>
                                    </div>
                                </a></li>
                        </ul>
                        <div class="tab-content mt-5" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <ul class="framworks-list">
                                    <li class="box wow fadeInUp">
                                        <div> <img src="../assets/images/landing/icon/html/bootstrap.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Booxstrap 4X</h6>
                                    </li>
                                    <li class="box wow fadeInUp">
                                        <div> <img src="../assets/images/landing/icon/html/css.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">CSS</h6>
                                    </li>
                                    <li class="box wow fadeInUp">
                                        <div> <img src="../assets/images/landing/icon/html/sass.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Sass</h6>
                                    </li>
                                    <li class="box wow fadeInUp">
                                        <div> <img src="../assets/images/landing/icon/html/pug.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Pug</h6>
                                    </li>
                                    <li class="box wow fadeInUp">
                                        <div> <img src="../assets/images/landing/icon/html/npm.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">NPM</h6>
                                    </li>
                                    <li class="box wow fadeInUp">
                                        <div> <img src="../assets/images/landing/icon/html/gulp.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Gulp</h6>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div> <img src="../assets/images/landing/icon/html/kit.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Starter Kit</h6>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div> <img src="../assets/images/landing/icon/html/uikits.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">40+ UI Kits</h6>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div> <img src="../assets/images/landing/icon/html/layout.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">8+ Layout</h6>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div> <img src="../assets/images/landing/icon/html/builders.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Builders</h6>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div> <img src="../assets/images/landing/icon/html/iconset.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">11 Icon Sets</h6>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div> <img src="../assets/images/landing/icon/html/forms.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Forms</h6>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div> <img src="../assets/images/landing/icon/html/table.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Tables</h6>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div> <img src="../assets/images/landing/icon/html/apps.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">17+ Apps</h6>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <ul class="framworks-list">
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/react/hook.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">React Hook</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/react/reactstrap.png" alt="">
                                        </div>
                                        <h6 class="mb-0 mt-3">React Strap</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/react/noquery.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">No Jquery</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/react/redux.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Redux</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/react/firebase.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Firebase Auth</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/react/crud.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Firebase Crud</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/react/chat.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Chat</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/react/animation.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Router Animation</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/react/props_state.png" alt="">
                                        </div>
                                        <h6 class="mb-0 mt-3">State & Props</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/react/reactrouter.png" alt="">
                                        </div>
                                        <h6 class="mb-0 mt-3">Reactrouter</h6>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div> <img src="../assets/images/landing/icon/react/chart.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Amazing Chart</h6>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div> <img src="../assets/images/landing/icon/react/map.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Map</h6>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div> <img src="../assets/images/landing/icon/react/gallery.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Gallery</h6>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div> <img src="../assets/images/landing/icon/react/application.png" alt="">
                                        </div>
                                        <h6 class="mb-0 mt-3">9+ Apps</h6>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="pills-angular" role="tabpanel"
                                aria-labelledby="pills-angular-tab">
                                <ul class="framworks-list">
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/angular/1.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">SCSS</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/angular/2.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Ng Bootstrap</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/angular/3.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">RXjs</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/angular/4.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Router</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/angular/5.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Form</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/angular/6.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Apex chart</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/angular/7.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Chart.js</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/angular/8.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Chartist</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/angular/9.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Google Map</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/angular/10.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Gallery</h6>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div> <img src="../assets/images/landing/icon/angular/11.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Ecommerce</h6>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div> <img src="../assets/images/landing/icon/angular/12.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Firebase Auth</h6>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div> <img src="../assets/images/landing/icon/angular/13.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Firebase Crud</h6>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div> <img src="../assets/images/landing/icon/angular/14.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Chat</h6>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                aria-labelledby="pills-contact-tab">
                                <ul class="framworks-list">
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/laravel/laravel.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Laravel 7</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/laravel/bootstrap.png" alt="">
                                        </div>
                                        <h6 class="mb-0 mt-3">Bootstrap 4</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/html/sass.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">SASS</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/laravel/blade.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Blade</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/laravel/layouts.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Layouts</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/laravel/npm.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">NPM</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/laravel/mix.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">MIX</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/laravel/yarn.png" alt=""></div>
                                        <h6 class="mb-0 mt-3">Yarn</h6>
                                    </li>
                                    <li class="box">
                                        <div> <img src="../assets/images/landing/icon/laravel/sasswebpack.png" alt="">
                                        </div>
                                        <h6 class="mb-0 mt-3">Sasswebpack</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>

        <section class="section-space cuba-demo-section" id="tugasfungsiperanans">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow pulse">
                        <div class="cuba-demo-content mt50">
                            <div class="couting">
                                <h2>Tugas, Fungsi</h2>
                            </div>
                            <p>Perananan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container container-modify">
                <div class="row dashboard">
                    <div class="col-lg-4 col-sm-4 wow fadeIn">
                        <div class="img-effect"><a href="index.html" target="_blank"><img class="img-fluid cuba-img"
                                    src="../assets/images/landing/dafault-dashboard.jpg" alt="">
                                <div class="cuba_img_content">
                                    <h4>Tugas Pokok</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-4 col-sm-4 wow fadeIn">
                        <div class="img-effect"><a href="../theme/dashboard-02.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/ecommerce-dashboard.jpg"
                                    alt="">
                                <div class="cuba_img_content">
                                    <h4>Fungsi</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-4 col-sm-4 wow fadeIn">
                        <div class="img-effect"><a href="../theme/dashboard-02.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/ecommerce-dashboard.jpg"
                                    alt="">
                                <div class="cuba_img_content">
                                    <h4>Peranan</h4>
                                </div>
                            </a></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-space cuba-demo-section app_bg" id="prinsips">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow pulse">
                        <div class="cuba-demo-content mt50">
                            <div class="couting">
                                <h2>Prinsip</h2>
                            </div>
                            <p>Penyelenggaraan Pengamanan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container container-modify apps">
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="img-effect"><a href="../theme/social-app.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/social-app.jpg" alt="">
                                <div class="cuba_img_content">
                                    <h4>Memahami Sasaran, Tujuan dan Fungsi Organisasi.</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="img-effect"><a href="../theme/knowledgebase.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/knowlagebase-app.jpg"
                                    alt="">
                                <div class="cuba_img_content">
                                    <h4>Disusun secara sistematis dan pendekatan yang dikoordinasikan antar bagian.</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="img-effect"><a href="../theme/support-ticket.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/support-ticket-app.jpg"
                                    alt="">
                                <div class="cuba_img_content">
                                    <h4>Upaya penanganan situasi dengan tingkatan risiko dan pembiayaan yang efisien &
                                        efektif.</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-2 col-sm-6">

                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="img-effect"><a href="../theme/email-application.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/mail-app.jpg" alt="">
                                <div class="cuba_img_content">
                                    <h4>Senantiasa melakukan koordinasi baik dengan pihak internal perusahaan maupun
                                        eksternal perusahaan.</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="img-effect"><a href="../theme/to-do.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/To-Do-app.jpg" alt="">
                                <div class="cuba_img_content">
                                    <h4>Terus dimonitor dan dikaji ulang.</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-2 col-sm-6">

                    </div>
                </div>
            </div>
        </section>

        <section class="section-space cuba-demo-section" id="istilahs">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow pulse">
                        <div class="cuba-demo-content mt50">
                            <div class="couting">
                                <h2>Istilah</h2>
                            </div>
                            <p>Keamanan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container container-modify">
                <div class="row dashboard">
                    <div class="col-lg-3 col-sm-4 wow fadeIn">
                        <div class="img-effect"><a href="index.html" target="_blank"><img class="img-fluid cuba-img"
                                    src="../assets/images/landing/dafault-dashboard.jpg" alt="">
                                <div class="cuba_img_content">
                                    <h4>INSTALASI</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-3 col-sm-4 wow fadeIn">
                        <div class="img-effect"><a href="../theme/dashboard-02.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/ecommerce-dashboard.jpg"
                                    alt="">
                                <div class="cuba_img_content">
                                    <h4>INSTALASI VITAL</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-3 col-sm-4 wow fadeIn">
                        <div class="img-effect"><a href="../theme/dashboard-02.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/ecommerce-dashboard.jpg"
                                    alt="">
                                <div class="cuba_img_content">
                                    <h4>OBYEK PENGAMANAN</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-3 col-sm-4 wow fadeIn">
                        <div class="img-effect"><a href="../theme/dashboard-02.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/ecommerce-dashboard.jpg"
                                    alt="">
                                <div class="cuba_img_content">
                                    <h4>SATUAN PENGAMANAN</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-4 col-sm-4 wow fadeIn">
                        <div class="img-effect"><a href="../theme/dashboard-02.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/ecommerce-dashboard.jpg"
                                    alt="">
                                <div class="cuba_img_content">
                                    <h4>KERAWANAN</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-4 col-sm-4 wow fadeIn">
                        <div class="img-effect"><a href="../theme/dashboard-02.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/ecommerce-dashboard.jpg"
                                    alt="">
                                <div class="cuba_img_content">
                                    <h4>ANCAMAN</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-4 col-sm-4 wow fadeIn">
                        <div class="img-effect"><a href="../theme/dashboard-02.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/ecommerce-dashboard.jpg"
                                    alt="">
                                <div class="cuba_img_content">
                                    <h4>PENGAMANAN</h4>
                                </div>
                            </a></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-space cuba-demo-section layout" id="layout">
            <div class="container mb-5">
                <div class="row">
                    <div class="col-sm-12 wow pulse">
                        <div class="cuba-demo-content mt50">
                            <div class="couting">
                                <h2>Detail</h2>
                                <p>Wilayah Pengamanan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mt-3">
                            <a class="d-flex justify-content-center">
                                <img style="width: 750px;" src="{{ asset('assets/images/landing/wilayahkerja.jpg')}}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-sm-6">

                    </div>
                    <div class="col-lg-8 col-sm-6 wow fadeIn">
                        <div class="img-effect"><a href="../theme/dashboard-02.html" target="_blank">
                                <div class="cuba_img_content mt-3">
                                    <h5>Seluruh Kawasan Perusahaan di Gresik</h5>
                                    <h5>Unit Pengolahan Air Gunungsari & Babat</h5>
                                    <h5>Booster Pump Kandangan & Lamong</h5>
                                    <hr>
                                    <h6>Luas Area 450 Ha</h6>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-2 col-sm-6">

                    </div>
                    {{-- <div class="col-lg-3 col-sm-6 wow fadeIn">
                        <h5>Dark Layout</h5>
                        <div class="img-effect">
                            <div class="mb-3 text-left"><a class="btn btn-primary btn-air-primary"
                                    href="layout-dark.html" target="_blank">Html</a><a
                                    class="btn btn-primary btn-air-primary ml-2"
                                    href="http://react.pixelstrap.com/cuba/dashboard/default"
                                    target="_blank">React</a><a class="btn btn-primary btn-air-primary ml-2"
                                    href="http://laravel.pixelstrap.com/cuba/page-layouts/layout-dark"
                                    target="_blank">Laravel</a><a class="btn btn-primary btn-air-primary ml-2"
                                    href="http://angular.pixelstrap.com/cuba/" target="_blank">Angular</a><a
                                    class="btn btn-secondary btn-air-secondary f-right" href="layout-rtl.html"
                                    target="_blank">RTL</a></div><a href="layout-dark.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/layout/dark.jpg"
                                    alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeIn">
                        <h5>Semi Dark</h5>
                        <div class="img-effect">
                            <div class="mb-3 text-left"><a class="btn btn-primary btn-air-primary" href="semi-dark.html"
                                    target="_blank">Html</a><a class="btn btn-primary btn-air-primary ml-2"
                                    href="http://react.pixelstrap.com/cuba/dashboard/default"
                                    target="_blank">React</a><a class="btn btn-primary btn-air-primary ml-2"
                                    href="http://laravel.pixelstrap.com/cuba/dashboard/index"
                                    target="_blank">Laravel</a><a class="btn btn-primary btn-air-primary ml-2"
                                    href="http://angular.pixelstrap.com/cuba/" target="_blank">Angular</a><a
                                    class="btn btn-secondary btn-air-secondary f-right" href="layout-rtl.html"
                                    target="_blank">RTL</a></div><a href="lndex.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/layout/semidark.jpg"
                                    alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeIn">
                        <h5>Compact Layout</h5>
                        <div class="img-effect">
                            <div class="mb-3 text-left"><a class="btn btn-primary btn-air-primary" href="compact"
                                    target="_blank">Html</a><a class="btn btn-primary btn-air-primary ml-2"
                                    href="http://react.pixelstrap.com/cuba/dashboard/default"
                                    target="_blank">React</a><a class="btn btn-primary btn-air-primary ml-2"
                                    href="http://laravel.pixelstrap.com/cuba/page-layouts/compact-layout"
                                    target="_blank">Laravel</a><a class="btn btn-primary btn-air-primary ml-2"
                                    href="http://angular.pixelstrap.com/cuba/" target="_blank">Angular</a><a
                                    class="btn btn-secondary btn-air-secondary f-right" href="layout-rtl.html"
                                    target="_blank">RTL</a></div><a href="lndex.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/layout/compact.jpg"
                                    alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeIn">
                        <h5>Box Layout</h5>
                        <div class="img-effect">
                            <div class="mb-3 text-left"><a class="btn btn-primary btn-air-primary"
                                    href="box-layout.html" target="_blank">Html</a><a
                                    class="btn btn-primary btn-air-primary ml-2"
                                    href="http://react.pixelstrap.com/cuba/dashboard/default"
                                    target="_blank">React</a><a class="btn btn-primary btn-air-primary ml-2"
                                    href="http://laravel.pixelstrap.com/cuba/page-layouts/layout-box"
                                    target="_blank">Laravel</a><a class="btn btn-primary btn-air-primary ml-2"
                                    href="http://angular.pixelstrap.com/cuba/" target="_blank">Angular</a><a
                                    class="btn btn-secondary btn-air-secondary f-right" href="layout-rtl.html"
                                    target="_blank">RTL</a></div><a href="box-layout.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/layout/box.jpg" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeIn">
                        <h5>Vertical Layout</h5>
                        <div class="img-effect">
                            <div class="mb-3 text-left"><a class="btn btn-primary btn-air-primary" href="index.html"
                                    target="_blank">Html</a><a class="btn btn-primary btn-air-primary ml-2"
                                    href="http://react.pixelstrap.com/cuba/dashboard/default"
                                    target="_blank">React</a><a class="btn btn-primary btn-air-primary ml-2"
                                    href="http://laravel.pixelstrap.com/cuba/page-layouts/vertical-layout"
                                    target="_blank">Laravel</a><a class="btn btn-primary btn-air-primary ml-2"
                                    href="http://angular.pixelstrap.com/cuba/" target="_blank">Angular</a><a
                                    class="btn btn-secondary btn-air-secondary f-right" href="layout-rtl.html"
                                    target="_blank">RTL</a></div><a href="layout-light.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/layout/vertical.jpg"
                                    alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeIn">
                        <h5>Vetical Box Layout</h5>
                        <div class="img-effect">
                            <div class="mb-3 text-left"><a class="btn btn-primary btn-air-primary" href="index.html"
                                    target="_blank">Html</a><a class="btn btn-primary btn-air-primary ml-2"
                                    href="http://react.pixelstrap.com/cuba/dashboard/default"
                                    target="_blank">React</a><a class="btn btn-primary btn-air-primary ml-2"
                                    href="http://laravel.pixelstrap.com/cuba/page-layouts/vertical-box-layout"
                                    target="_blank">Laravel</a><a class="btn btn-primary btn-air-primary ml-2"
                                    href="http://angular.pixelstrap.com/cuba/" target="_blank">Angular</a><a
                                    class="btn btn-secondary btn-air-secondary f-right" href="layout-rtl.html"
                                    target="_blank">RTL</a></div><a href="general-widget.html" target="_blank"><img
                                    class="img-fluid cuba-img"
                                    src="../assets/images/landing/layout/vertical&amp;box.jpg" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeIn">
                        <h5>Compact Dark Layout</h5>
                        <div class="img-effect">
                            <div class="mb-3 text-left"><a class="btn btn-primary btn-air-primary"
                                    href="compact-dark.html" target="_blank">Html</a><a
                                    class="btn btn-primary btn-air-primary ml-2"
                                    href="http://react.pixelstrap.com/cuba/dashboard/default"
                                    target="_blank">React</a><a class="btn btn-primary btn-air-primary ml-2"
                                    href="http://laravel.pixelstrap.com/cuba/page-layouts/compact-dark-layout"
                                    target="_blank">Laravel</a><a class="btn btn-primary btn-air-primary ml-2"
                                    href="http://angular.pixelstrap.com/cuba/" target="_blank">Angular</a><a
                                    class="btn btn-secondary btn-air-secondary f-right" href="layout-rtl.html"
                                    target="_blank">RTL</a></div><a href="general-widget.html" target="_blank"><img
                                    class="img-fluid cuba-img"
                                    src="../assets/images/landing/layout/compact&amp;dark.jpg" alt=""></a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>

        <section class="section-space cuba-demo-section" id="dashboards">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow pulse">
                        <div class="cuba-demo-content mt50">
                            <div class="couting">
                                <h2>Sistem Penunjang</h2>
                            </div>
                            <p>Pengamanan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container container-modify">
                <div class="row dashboard">
                    <div class="col-lg-6 col-sm-6 wow fadeIn">
                        <div class="img-effect"><a href="index.html" target="_blank"><img class="img-fluid cuba-img"
                                    src="../assets/images/landing/dafault-dashboard.jpg" alt="">
                                <div class="cuba_img_content">
                                    <h4>Default Dashboard</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-6 col-sm-6 wow fadeIn">
                        <div class="img-effect"><a href="../theme/dashboard-02.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/ecommerce-dashboard.jpg"
                                    alt="">
                                <div class="cuba_img_content">
                                    <h4>Ecommerce Dashboard</h4>
                                </div>
                            </a></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-space cuba-demo-section app_bg" id="applications">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow pulse">
                        <div class="cuba-demo-content mt50">
                            <div class="couting">
                                <h2>20+</h2>
                            </div>
                            <p>Achievement</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container container-modify apps">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="img-effect"><a href="../theme/social-app.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/social-app.jpg" alt="">
                                <div class="cuba_img_content">
                                    <h4>Social App</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="img-effect"><a href="../theme/knowledgebase.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/knowlagebase-app.jpg"
                                    alt="">
                                <div class="cuba_img_content">
                                    <h4>knowledgebase</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="img-effect"><a href="../theme/support-ticket.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/support-ticket-app.jpg"
                                    alt="">
                                <div class="cuba_img_content">
                                    <h4>Support Ticket</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="img-effect"><a href="../theme/email-application.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/mail-app.jpg" alt="">
                                <div class="cuba_img_content">
                                    <h4>Email Dashboard</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="img-effect"><a href="../theme/to-do.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/To-Do-app.jpg" alt="">
                                <div class="cuba_img_content">
                                    <h4>To-Do</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="img-effect"><a href="../theme/job-cards-view.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/job-search-app.jpg" alt="">
                                <div class="cuba_img_content">
                                    <h4>Job Search</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="img-effect"><a href="../theme/product-page.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/ecommerce-app.jpg" alt="">
                                <div class="cuba_img_content">
                                    <h4>Ecommerce</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="img-effect"><a href="../theme/kanban.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/apps/kanban.jpg" alt="">
                                <div class="cuba_img_content">
                                    <h4>Kanban</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="img-effect"><a href="../theme/file-manager.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/apps/file.jpg" alt="">
                                <div class="cuba_img_content">
                                    <h4>File Manager</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="img-effect"><a href="../theme/projects.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/apps/project.jpg" alt="">
                                <div class="cuba_img_content">
                                    <h4>Project</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="img-effect"><a href="../theme/contacts.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/apps/contacts.jpg" alt="">
                                <div class="cuba_img_content">
                                    <h4>Contacts</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="img-effect"><a href="../theme/chat.html" target="_blank"><img
                                    class="img-fluid cuba-img" src="../assets/images/landing/apps/chat.jpg" alt="">
                                <div class="cuba_img_content">
                                    <h4>Chat</h4>
                                </div>
                            </a></div>
                    </div>
                    <div class="col-12"><a class="btn-download btn btn-gradient" href="../theme/bookmark.html"
                            target="_blank">View More... </a></div>
                </div>
            </div>
        </section>
        <section class="section-space cuba-demo-section bg-Widget" id="galeris">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow pulse">
                        <div class="cuba-demo-content mt50">
                            <div class="couting">
                                <h2>Cards</h2>
                            </div>
                            <p>Galeri</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row landing-cards">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-sm-5 col-12"><img class="img-fluid landing-card"
                                    src="../assets/images/landing/cards/1.jpg" alt=""></div>
                            <div class="col-sm-4 col-7"><img class="img-fluid landing-card"
                                    src="../assets/images/landing/cards/2.jpg" alt=""></div>
                            <div class="col-sm-3 col-5"><img class="img-fluid landing-card"
                                    src="../assets/images/landing/cards/3.jpg" alt=""></div>
                            <div class="col-sm-8 col-12">
                                <div class="row">
                                    <div class="col-6"><img class="img-fluid landing-card"
                                            src="../assets/images/landing/cards/4.jpg" alt=""></div>
                                    <div class="col-6"><img class="img-fluid landing-card"
                                            src="../assets/images/landing/cards/5.jpg" alt=""></div>
                                    <div class="col-5"><img class="img-fluid landing-card"
                                            src="../assets/images/landing/cards/7.jpg" alt=""></div>
                                    <div class="col-7"><img class="img-fluid landing-card"
                                            src="../assets/images/landing/cards/8.jpg" alt=""></div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="row">
                                    <div class="col-sm-12 col-6"><img class="img-fluid landing-card"
                                            src="../assets/images/landing/cards/6.jpg" alt=""></div>
                                    <div class="col-sm-12 col-6"><img class="img-fluid landing-card"
                                            src="../assets/images/landing/cards/9.jpg" alt=""></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12 col-sm-4"><img class="img-fluid landing-card"
                                    src="../assets/images/landing/cards/10.jpg" alt=""></div>
                            <div class="col-md-6 col-sm-4"><img class="img-fluid landing-card"
                                    src="../assets/images/landing/cards/15.jpg" alt=""><img
                                    class="img-fluid landing-card" src="../assets/images/landing/cards/11.jpg"
                                    alt=""><img class="img-fluid landing-card"
                                    src="../assets/images/landing/cards/21.jpg" alt=""></div>
                            <div class="col-md-6 col-sm-4"><img class="img-fluid landing-card"
                                    src="../assets/images/landing/cards/14.jpg" alt=""><img
                                    class="img-fluid landing-card" src="../assets/images/landing/cards/13.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- <section class="section-space cuba-demo-section email_bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow pulse">
                        <div class="cuba-demo-content mt50">
                            <div class="couting">
                                <h2> Email</h2>
                                <p> Usefull Templates</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><img class="img-fluid" src="../assets/images/landing/email_section_img.jpg" alt="">
        </section> --}}

        <section class="section-space cuba-demo-section components-section" id="klasifikasis">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow pulse">
                        <div class="cuba-demo-content mt50">
                            <div class="couting">
                                <h2>Klasifikasi</h2>
                            </div>
                            <p>Area Pengamanan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container container-modify">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mt-3">
                            <a class="d-flex justify-content-center">
                                <img style="width: 1050px;" src="{{ asset('assets/images/landing/klasifikasi.jpg')}}">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row component_responsive">
                    <div class="col-lg-4 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect mb-2">
                            <img src="../assets/images/landing/icon/1.png" alt="">
                            <hr>
                            <br>
                            <h4 class="m-0 Pt-4  ml-2 mr-2">Area Tertutup (Warna Merah)</h4>
                            <br>
                            <p class="ml-2 mr-2">Area yang aksesnya hanya untuk personel dan kendaraan dengan Ijin Akses Merah. Area ini merupakan area instalasi Pabrik dimana terdapat risiko yang tinggi untuk terjadinya kecelakaan dan/atau kebakaran/peledakan atau area yang terdapat aset perusahaan yang akan mengakibatkan terhentinya aktivitas produksi apabila terjadi gangguan keamanan.</p>
                            <h6><b>Seperti</b></h6>
                            <p>Karyawan Organik dan Non Organik dengan Badge latar belakang merah.</p>
                            <p>Mahasiswa / Pelajar kerja praktek dengan Badge latar belakang merah.</p>
                            <p>Tamu perusahaan dengan Visitor Pass latar belakang merah.</p>
                            <p>Kendaraan roda 4 dengan bahan bakar solar.</p>
                            <h6><b>Meliputi</b></h6>
                            <p>Seluruh area produksi dan pemeliharaan.</p>
                            <p>Rumah dinas Direksi.</p>
                            <p>Gedung Kantor Pusat Lantai 8.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect mb-2">
                            <img src="../assets/images/landing/icon/1.png" alt="">
                            <hr>
                            <br>
                            <h4 class="m-0 Pt-4  ml-2 mr-2">Area Terbatas (Warna Kuning)</h4>
                            <br>
                            <p class="ml-2 mr-2">Area pendukung yang berbatasan langsung dengan Area Tertutup (Warna Merah) serta aksesnya hanya untuk personel dan kendaraan dengan Ijin Akses Kuning dan/atau Merah atau area yang terdapat aset perusahaan yang akan mengakibatkan terganggunya aktivitas produksi apabila terjadi gangguan keamanan.</p>
                            <h6><b>Seperti</b></h6>
                            <p>Karyawan Organik dan Non Organik dengan Badge latar belakang kuning.</p>
                            <p>Mahasiswa / Pelajar kerja praktek dengan Badge latar belakang kuning.</p>
                            <p>Tamu perusahaan dengan Visitor Pass latar belakang kuning.</p>
                            <p>Semua kendaraan boleh masuk.</p>
                            <h6><b>Meliputi</b></h6>
                            <p>Semua area perkantoran (selain lantai 8, kantor Dep Produksi dan Dep Pemeliharaan).</p>
                            <p>Pengolahan air Gunungsari, Babat, Buster Pump Kandangan dan Lamongan.</p>
                            <p>Semua gudang produk jadi.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect mb-2">
                            <img src="../assets/images/landing/icon/1.png" alt="">
                            <hr>
                            <br>
                            <h4 class="m-0 Pt-4  ml-2 mr-2">Area Terbuka Terbatas (Warna Hijau)</h4>
                            <br>
                            <p class="ml-2 mr-2">Area diluar area tertutup dan terbatas tetapi  masih merupakan area perusahaan serta tidak memerlukan Ijin Akses namun masih dalam pengawasan kecuali dalam kondisi tertentu.</p>
                            <h6><b>Seperti</b></h6>
                            <p>Semua orang dan kendaraan boleh masuk.</p>
                            <h6><b>Meliputi</b></h6>
                            <p>Semua fasilitas / sarana olah raga.</p>
                            <p>Perumahan dinas kecuali rumah dinas Direksi.</p>
                        </div>
                    </div>


                    {{-- <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/1.png" alt="">
                            <h6 class="m-0 Pt-4">SweetAlert2</h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/2.png" alt="">
                            <h6 class="m-0">Avatar</h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/3.png" alt="">
                            <h6 class="m-0">Scrollable</h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/4.png" alt="">
                            <h6 class="m-0">Tree view</h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/5.png" alt="">
                            <h6 class="m-0">Bootstrap notify</h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/6.png" alt="">
                            <h6 class="m-0">Rating </h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/7.png" alt="">
                            <h6 class="m-0">Dropzone</h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/8.png" alt="">
                            <h6 class="m-0">Tour</h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/9.png" alt="">
                            <h6 class="m-0">Animated modal</h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/10.png" alt="">
                            <h6 class="m-0">Owl Carousel</h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/11.png" alt="">
                            <h6 class="m-0">Ribbons </h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/12.png" alt="">
                            <h6 class="m-0">Pagination </h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/13.png" alt="">
                            <h6 class="m-0">Steps </h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/14.png" alt="">
                            <h6 class="m-0">Breadcrumb </h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/15.png" alt="">
                            <h6 class="m-0">Range Slider </h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/16.png" alt="">
                            <h6 class="m-0">image cropper </h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/17.png" alt="">
                            <h6 class="m-0">Sticky </h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/18.png" alt="">
                            <h6 class="m-0">Progress </h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/19.png" alt="">
                            <h6 class="m-0">Tooltip </h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/20.png" alt="">
                            <h6 class="m-0">Spinners </h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/21.png" alt="">
                            <h6 class="m-0">Dropdown </h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/22.png" alt="">
                            <h6 class="m-0">Tabs </h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/23.png" alt="">
                            <h6 class="m-0">Accordion </h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/24.png" alt="">
                            <h6 class="m-0">Navs</h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/25.png" alt="">
                            <h6 class="m-0">Shadow</h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/26.png" alt="">
                            <h6 class="m-0">state color</h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/27.png" alt="">
                            <h6 class="m-0">List </h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/28.png" alt="">
                            <h6 class="m-0">Grid </h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/29.png" alt="">
                            <h6 class="m-0">Helper classes </h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/30.png" alt="">
                            <h6 class="m-0">Typography</h6>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
        <section class="section-space cuba-demo-section components-section" id="tambahlaporans">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Form Tambah Laporan</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{route('tambah_laporan_umum')}}" method="post" enctype="multipart/form-data"
                                    class="needs-validation" novalidate="">
                                    {{ csrf_field() }}

                                    <div class="row mb-3">
                                        <div class="col-md-12 mb-6">
                                            <label style="text-align: left"><b><b>Nama Pelapor</b></label>
                                            <input class="form-control" name="nama_pelapor" id="validationTooltip01"
                                                type="text" placeholder="Nama Pelapor" required="">
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 mb-6">
                                            <label style="text-align: left"><b>No Identitas</b></label>
                                            <input class="form-control" name="no_identitas" id="validationTooltip01"
                                                type="text" placeholder="NO Identitas NIK" required="">
                                        </div>
                                        <div class="col-md-4 mb-6">
                                            <label style="text-align: left"><b>Alamat Pelapor</b></label>
                                            <input class="form-control" name="alamat_pelapor" id="validationTooltip01"
                                                type="text" placeholder="Alamat Pelapor" required="">
                                        </div>
                                        <div class="col-md-4 mb-6">
                                            <label style="text-align: left"><b>No Telfon / WA Pelapor</b></label>
                                            <input class="form-control" name="no_wa" id="validationTooltip01"
                                                type="text" placeholder="No Telfon / WA Pelapor" required="">
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row mb-3">
                                        <div class="col-md-12 mb-6">
                                            <label style="text-align: left"><b>Judul Laporan</b></label>
                                            <input class="form-control" name="judul_laporan" id="validationTooltip01"
                                                type="text" placeholder="Judul Laporan" required="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 mb-6">
                                            <label><b>Kategori Laporan</b></label>
                                            <select class="form-control" name="id_kategori" required>
                                                <option>Pilih Kategori</option>
                                                @foreach ($data_kategori as $kategori)
                                                <option value="{{$kategori->id_kategori}}">{{$kategori->nama_kategori}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-6">
                                            <label for="exampleFormControlSelect23"><b>Prioritas</b></label>
                                            <select class="form-control" name="prioritas" required
                                                id="exampleFormControlSelect23">
                                                <option value="Normal">Normal</option>
                                                <option value="Medium">Medium</option>
                                                <option value="High">High</option>
                                                <option value="Urgent">Urgent</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-6">
                                            <label><b>Zona</b></label>
                                            <select class="form-control" name="id_zona" required>
                                                <option>Pilih Zona</option>
                                                @foreach ($data_zona as $zona)
                                                <option value="{{$zona->id_zona}}">{{$zona->nama_zona}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- <div class="row mb-3">
                            <div class="col-md-12 mb-6">
                                <label for="validationTooltip04">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="validationTooltip04" rows="4"
                                    type="text" placeholder="Deskripsi Laporan" required=""></textarea>
                            </div>
                        </div> --}}

                                    <div class="row mb-3">
                                        <div class="col-md-6 mb-6">
                                            <label><b>{{ __('Unit Kerja') }}</b></label>
                                            <select class="js-example-basic-single col-sm-12" id="unit_kerja"
                                                name="unit_kerja" required>
                                                <option>Pilih Unit Kerja</option>
                                                @foreach ($data_departemen as $departemen)
                                                <option value="{{$departemen->id_departemen}}">
                                                    {{$departemen->nama_departemen}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-6">
                                            <label><b>Tanggal Kejadian</b></label>
                                            <input class="datepicker-here form-control" name="tgl_kejadian" type="text"
                                                placeholder="Tanggal Kejadian" data-language="en" data-original-title=""
                                                title="">
                                        </div>
                                        <div class="col-md-3 mb-6">
                                            <label><b>Waktu Kejadian</b></label>
                                            <div class="input-group clockpicker">
                                                <input class="form-control" type="text" placeholder="Jam Kejadian"
                                                    name="waktu_kejadian"><span class="input-group-addon"><span
                                                        class="glyphicon glyphicon-time"></span></span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12 mb-6">
                                            <label for="validationTooltip04"><b>Kronologi Kejadian</b></label>
                                            <textarea class="form-control" name="kronologi_kejadian"
                                                id="validationTooltip04" rows="5" type="text"
                                                placeholder="Kronologi Kejadian" required=""></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-8 mb-6">
                                            <label for="validationTooltip04"><b>Akibat Kejadian</b></label>
                                            <textarea class="form-control" name="akibat_kejadian"
                                                id="validationTooltip04" rows="2" type="text"
                                                placeholder="Akibat Kejadian" required=""></textarea>
                                        </div>
                                        <div class="col-md-4 mb-6">
                                            <label for="exampleFormControlSelect23"><b>Bantuan Pengamanan</b></label>
                                            <select class="form-control" name="bantuan_pengamanan" required
                                                id="exampleFormControlSelect23">
                                                <option value="Pengawalan">Pengawalan</option>
                                                <option value="Patroli">Patroli</option>
                                                <option value="Penyelidikan">Penyelidikan</option>
                                                <option value="Olah TKP">Olah TKP</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12 mb-6">
                                            <label class="col-form-label"><b>Gambar</b></label>
                                            <div class="col-md-12">
                                                <input type="file" class="custom-file-input" name="gambar[]"
                                                    id="formFileMultiple" required="" multiple>
                                                <label class="custom-file-label" for="formFileMultiple">Pilih
                                                    Foto</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-1">
                                        <div class="col-md-12 mb-6">
                                            <label><b>Lokasi</b></label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-xl-12">
                                            <div class="card">
                                                <div id="mapid" style="height: 520px; z-index: 0;">
                                                </div>
                                                <input type="text" id="latlong" hidden>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12 mb-4" style="text-align: center">
                                            <button onclick=fullScreenview() class="btn btn-pill btn-primary" type="button"
                                                title="">F U L L S C R E E N</button>
                                        </div> --}}
                                    </div>

                                    <input type="text" id="lat" name="lat" hidden required>
                                    <input type="text" id="lng" name="lng" hidden required>


                                    <div class="row" style="text-align: center;">
                                        <div class="col-sm-4">

                                        </div>
                                        <div class="col-sm-4">
                                            <button class="btn btn-primary" type="submit">Tambah Laporan</button>
                                        </div>
                                        <div class="col-sm-4">

                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer-bg">
            <div class="container">
                <div class="landing-center ptb50">
                    <div class="title"><img class="img-fluid" src="../assets/images/landing/landing_logo.png" alt="">
                    </div>
                    <div class="footer-content">
                        <h1>Segments Made by Departemen Keamanan</h1>
                        <p>PT. Petrokimia Gresik</p><a
                            class="btn mrl5 btn-lg btn-primary default-view" target="_blank" href="index.html">Check
                            Now</a><a class="btn mrl5 btn-lg btn-secondary btn-md-res" target="_blank"
                            href="https://1.envato.market/3GVzd">Install Now </a>
                    </div>
                </div>
            </div>
            <div id="footer" class="footer3 bg-dark font-14 p-t-20">
                <div class="f3-middle container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 m-b-30">
                            <div><a href="#" class="m-r-20"><img alt="Petro-dark-transp"
                                        data-src="../assets/images/landing/landing.png" class="lazyload logo loaded"
                                        src="../assets/images/landing/landing.png" data-was-processed="true"></a></div>
                            <div class="mt-3">
                                <p>PT Petrokimia Gresik merupakan Produsen Pupuk Terlengkap di Indonesia yang
                                    memproduksi berbagai macam pupuk dan bahan kimia untuk solusi agroindustri. <br></p>
                            </div>
                            <div class="social-media">
                                <div class="round-social light"><a
                                        href="https://www.facebook.com/PetrokimiaGresikOfficial/" target="_blank"
                                        class="link"><i class="fab fa-facebook"></i></a> <a
                                        href="https://twitter.com/petrogresik" target="_blank" class="link"><i
                                            class="fab fa-twitter"></i></a> <a
                                        href="https://www.youtube.com/channel/UC2M0KWQ7_e3oCqnWL4urUVQ" target="_blank"
                                        class="link"><i class="fab fa-youtube"></i></a> <a
                                        href="https://www.instagram.com/petrokimiagresik_official/" target="_blank"
                                        class="link"><i class="fab fa-instagram"></i></a></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 m-b-30">
                            <h6 class="font-semibold text-white text-uppercase">Kantor Pusat</h6>
                            <div class="m-t-20">
                                <div class="m-b-10"><span class="font-semibold text-muted db">ALAMAT</span>
                                    <p>Jl. Jenderal Ahmad Yani - Gresik 61119</p>
                                </div>
                                <div class="m-b-10"><span class="font-semibold text-muted db">TELEPON</span>
                                    <p>031-3981811, 3982100, 3982200</p>
                                </div>
                                <div class="m-b-10"><span class="font-semibold text-muted db">FAX</span>
                                    <p>031-3981722, 3982272</p>
                                </div>
                                <div class="m-b-10"><span class="font-semibold text-muted db">EMAIL</span> <a
                                        href="mailto:pg@petrokimia-gresik.com">pg@petrokimia-gresik.com</a></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 m-b-30">
                            <h6 class="font-semibold text-white text-uppercase">Kantor Perwakilan</h6>
                            <div class="m-t-20">
                                <div class="m-b-10"><span class="font-semibold text-muted db">ALAMAT</span>
                                    <p>Jl. Tanah Abang III no.16 Jakarta 10160</p>
                                </div>
                                <div class="m-b-10"><span class="font-semibold text-muted db">TELEPON</span>
                                    <p>021-3446459, 3446645</p>
                                </div>
                                <div class="m-b-10"><span class="font-semibold text-muted db">FAX</span>
                                    <p>021-3841994</p>
                                </div>
                                <div class="m-b-10"><span class="font-semibold text-muted db">EMAIL</span> <a
                                        href="mailto:perjaka@petrokimia-gresik.com">perjaka@petrokimia-gresik.com</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 m-b-30">
                            <h6 class="font-semibold text-white text-uppercase">Pusat Layanan Pelanggan</h6>
                            <div class="m-t-20">
                                <div class="m-b-10"><span class="font-semibold text-muted db">TELEPON</span>
                                    <p>08001888777 (bebas pulsa)</p>
                                </div>
                                <div class="m-b-10"><span class="font-semibold text-muted db">SMS/WHATSAPP</span> <a
                                        href="  https://api.whatsapp.com/send?phone=0811344774&amp;text=Halo Petrokimia Gresik, saya mau bertanya">0811344774</a>
                                </div>
                                <div class="m-b-10"><span class="font-semibold text-muted db">FAX</span>
                                    <p>031-3979976</p>
                                </div>
                                <div class="m-b-10"><span class="font-semibold text-muted db">EMAIL</span> <a
                                        href="mailto:konsumen@petrokimia-gresik.com">konsumen@petrokimia-gresik.com</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="f3-bottom-bar">
                    <div class="container">
                        <div class="d-flex justify-content-between">
                            <div class="copyright m-t-10 m-b-10">

                            </div>
                            <div class="text-center mb-5"><img alt="Sucofindo 9001"
                                    data-src="https://storage.googleapis.com/pkg-portal-bucket/images/template/sucofindo-9001.png"
                                    height="60" class="lazyload mr-2 loaded"
                                    src="https://storage.googleapis.com/pkg-portal-bucket/images/template/sucofindo-9001.png"
                                    data-was-processed="true"> <img alt="Sucofindo 14001"
                                    data-src="https://storage.googleapis.com/pkg-portal-bucket/images/template/sucofindo-14001.png"
                                    height="60" class="lazyload mr-2 loaded"
                                    src="https://storage.googleapis.com/pkg-portal-bucket/images/template/sucofindo-14001.png"
                                    data-was-processed="true"></div>
                        </div>
                    </div>
                </div>
                <!---->
            </div>
        </footer>

    </div>
    <!-- latest jquery-->
    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="../assets/js/bootstrap/popper.min.js"></script>
    <script src="../assets/js/bootstrap/bootstrap.js"></script>
    <!-- feather icon js-->
    <script src="../assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="../assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="../assets/js/animation/wow/wow.min.js"></script>
    <script src="../assets/js/landing_sticky.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="../assets/js/script.js"></script>
    <!-- login js-->
    <!-- Plugin used-->

    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>

    <script src="{{ asset('assets/js/time-picker/jquery-clockpicker.min.js')}}"></script>
    <script src="{{ asset('assets/js/time-picker/highlight.min.js')}}"></script>
    <script src="{{ asset('assets/js/time-picker/clockpicker.js')}}"></script>

    <script src="{{ asset('assets/js/select2/select2.full.min.js')}}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js')}}"></script>

    <script>
    // set lokasi latitude dan longitude, lokasinya kota palembang
    var mymap = L.map('mapid').setView([-7.145191, 112.643103], 14);
    mymap.zoomControl.setPosition('topright');

    var mapId = document.getElementById('mapid')

    function fullScreenview() {
        mapId.requestFullscreen();
    }


    //setting maps menggunakan api mapbox bukan google maps, daftar dan dapatkan token
    L.tileLayer(
        'https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: ''
        }).addTo(mymap);

    L.control.scale({
        position: 'bottomright'
    }).addTo(mymap);

    var kawasan = L.polygon([
        [-7.157055, 112.638956],
        [-7.157385, 112.639545],
        [-7.157557, 112.640709],
        [-7.157587, 112.641007],
        [-7.152356, 112.642082],
        [-7.152584, 112.643284],
        [-7.15326, 112.643139],
        [-7.153736, 112.644655],
        [-7.154291, 112.644558],
        [-7.154397, 112.645164],
        [-7.152611, 112.645567],
        [-7.153067, 112.647855],
        [-7.152796, 112.64793],
        [-7.152913, 112.648461],
        [-7.153179, 112.648258],
        [-7.153894, 112.648201],
        [-7.156337, 112.647564],
        [-7.157013, 112.647956],
        [-7.160324, 112.645972],
        [-7.159075, 112.643907],
        [-7.160935, 112.642851],
        [-7.159434, 112.641685],
        [-7.163402, 112.639488],
        [-7.162564, 112.638986],
        [-7.162633, 112.638019],
        [-7.161829, 112.63715],
        [-7.161505, 112.636405],
        [-7.161659, 112.635759],
        [-7.161781, 112.635008],
        [-7.160717, 112.634257],
        [-7.157351, 112.638764]
    ], {
        color: 'yellow',
        fillColor: 'yellow',
        fillOpacity: 0.4,
    }).addTo(mymap);

    var kawasan2 = L.polygon([
        [-7.151081, 112.636195],
        [-7.149264, 112.636527],
        [-7.149072, 112.63479],
        [-7.150692, 112.63444],
        [-7.151918, 112.634547],
        [-7.15277, 112.634365],
        [-7.152589, 112.633507],
        [-7.154523, 112.634097],
        [-7.154746, 112.635449]
    ], {
        color: 'yellow',
        fillColor: 'yellow',
        fillOpacity: 0.1,
    }).addTo(mymap);

    var kawasan3 = L.polygon([
        [-7.143503, 112.625983],
        [-7.142518, 112.625285],
        [-7.141957, 112.624009],
        [-7.143509, 112.624143],
        [-7.144243, 112.625694]
    ], {
        color: 'yellow',
        fillColor: 'yellow',
        fillOpacity: 0.1,
    }).addTo(mymap);

    var zona1 = L.polygon([
        [-7.157055, 112.638956],
        [-7.157385, 112.639545],
        [-7.157557, 112.640709],
        [-7.15629, 112.641021],
        [-7.155942, 112.640133],
        [-7.151499, 112.641025],
        [-7.151605, 112.64162],
        [-7.150322, 112.641878],
        [-7.149714, 112.641245],
        [-7.148532, 112.636803],
        [-7.155795, 112.635199]
    ], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.1,
    }).addTo(mymap);

    var zona2 = L.polygon([
        [-7.148821, 112.639376],
        [-7.149928, 112.642337],
        [-7.149385, 112.642526],
        [-7.147969, 112.644586],
        [-7.146902, 112.646837],
        [-7.146615, 112.648007],
        [-7.146087, 112.649301],
        [-7.145679, 112.651022],
        [-7.144604, 112.650937],
        [-7.144456, 112.657113],
        [-7.144062, 112.657167],
        [-7.144062, 112.652596],
        [-7.14221, 112.650122],
        [-7.143083, 112.647633],
        [-7.142301, 112.647223],
        [-7.142215, 112.64683],
        [-7.144601, 112.641786],
        [-7.145484, 112.64214],
        [-7.146336, 112.640326],
        [-7.147735, 112.641229],

    ], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.1,
    }).addTo(mymap);

    var zona3 = L.polygon([
        [-7.142301, 112.647223],
        [-7.142215, 112.64683],
        [-7.144601, 112.641786],
        [-7.145484, 112.64214],
        [-7.146336, 112.640326],
        [-7.147735, 112.641229],
        [-7.14621, 112.638139],
        [-7.145076, 112.637743],
        [-7.141584, 112.639009],
        [-7.140334, 112.642032],


    ], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.1,
    }).addTo(mymap);

    var zona4 = L.polygon([
        [-7.138191, 112.640413],
        [-7.138489, 112.641572],
        [-7.140334, 112.642032],
        [-7.142301, 112.647223],
        [-7.143083, 112.647633],
        [-7.14221, 112.650122],
        [-7.139979, 112.654661],
        [-7.132831, 112.654817],
        [-7.137985, 112.640283]




    ], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.1,
    }).addTo(mymap);

    var tuks = L.polygon([
        [-7.144158, 112.656909],
        [-7.144435, 112.656898],
        [-7.144403, 112.659162],
        [-7.146336, 112.659886],
        [-7.146166, 112.660251],
        [-7.139392, 112.657202],
        [-7.139552, 112.65688],
        [-7.144123, 112.659003]
    ], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.1,
    }).addTo(mymap);

    var zona5 = L.polygon([
        [-7.143094, 112.632051],
        [-7.137525, 112.635374],
        [-7.138164, 112.639089],
        [-7.132392, 112.655264],
        [-7.126431, 112.652475],
        [-7.133287, 112.634493],
        [-7.135074, 112.631213],
        [-7.136384, 112.630194],
        [-7.137139, 112.630751],
        [-7.137865, 112.630025],
        [-7.138259, 112.62929],
        [-7.140304, 112.628285],
        [-7.140994, 112.629413],
        [-7.141981, 112.628989],
        [-7.142901, 112.630887],
        [-7.142625, 112.631202]
    ], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.1,
    }).addTo(mymap);

    var pagsari = L.circle([-7.307213, 112.708989], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.2,
        radius: 100
    }).addTo(mymap);

    var kandangan = L.circle([-7.253174, 112.655651], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.2,
        radius: 100
    }).addTo(mymap);

    var ews = L.circle([-7.219081, 112.655771], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.2,
        radius: 100
    }).addTo(mymap);

    var pababat = L.circle([-7.088484, 112.196959], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.2,
        radius: 100
    }).addTo(mymap);

    var bplamongan = L.circle([-7.109364, 112.410687], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.2,
        radius: 100
    }).addTo(mymap);

    var masjid = L.circle([-7.158817, 112.642303], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.2,
        radius: 100
    }).addTo(mymap);

    L.control.scale({
        position: 'bottomright'
    }).addTo(mymap);

    var popup = L.popup();

    // buat fungsi popup saat map diklik
    function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent("Koordinatnya : " + e.latlng
                .toString()
            ) //set isi konten yang ingin ditampilkan, kali ini kita akan menampilkan latitude dan longitude
            .openOn(mymap);
        var latlng = document.getElementById('latlong').value = e
            .latlng;
        document.getElementById('lat').value = latlng.lat;
        document.getElementById('lng').value = latlng.lng;
        console.log(latlng);
        //value pada form latitde, longitude akan berganti secara otomatis
    }
    mymap.on('click', onMapClick); //jalankan fungsi
</script>
</body>

</html>
