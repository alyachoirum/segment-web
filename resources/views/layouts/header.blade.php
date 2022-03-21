<div class="page-header">
    <div class="header-wrapper row m-0">

        <div class="header-logo-wrapper">
            <div class="logo-wrapper"><a href=""><img class="img-fluid"
                        src="{{ asset('assets/images/logo/logo_putih.png')}}" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="sliders"></i></div>
        </div>
        <div class="nav-left col horizontal-wrapper pl-0">
            <ul class="horizontal-menu">
                <li class="mega-menu outside">
                    <a class="d-flex justify-content-center">
                        <img class="img-fluid" style="width: 130px;" src="{{ asset('assets/images/logo/logo_login.png')}}">
                    </a>
                </li>
            </ul>
        </div>
        <div class="nav-right col-8 pull-right right-header p-0">
            <ul class="nav-menus">
                <li>
                    <div class="mode"><i class="fa fa-moon-o"></i></div>
                </li>

                <li class="onhover-dropdown">
                    <div class="notification-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                            <path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0">
                            </path>
                        </svg>
                        <span id="jml_notif" class="badge badge-pill badge-danger"></span>
                    </div>
                    <ul class="notification-dropdown onhover-show-div">
                        <li class="bg-primary text-center">
                            <h6 class="f-18 mb-0">Notifikasi</h6>
                            <p class="mb-0">Kamu mempunyai <span id="jml" style="color: white"></span> notifikasi baru</p>
                        </li>


                        <li id="notif">
                            <p id="judul">
                                <i class="fa fa-circle-o mr-3 font-primary"></i>
                                <span class="pull-right" id="waktu"></span>
                            </p>
                        </li>

                        <li>
                            <a class="btn btn-primary" href="{{ route('notifikasi', Crypt::encryptString(auth()->user()->id_user))}}">Semua Notifikasi</a>
                        </li>
                        {{-- <li>
                            <p><i class="fa fa-circle-o mr-3 font-success"></i>Order Complete<span class="pull-right">1
                                    hr</span></p>
                        </li>
                        <li>
                            <p><i class="fa fa-circle-o mr-3 font-info"></i>Tickets Generated<span class="pull-right">3
                                    hr</span></p>
                        </li>
                        <li>
                            <p><i class="fa fa-circle-o mr-3 font-danger"></i>Delivery Complete<span
                                    class="pull-right">6 hr</span></p>
                        </li> --}}

                    </ul>
                </li>

                <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i
                            data-feather="maximize"></i></a>
                </li>

                <li class="profile-nav onhover-dropdown p-0 mr-0">
                    <div class="media profile-media">
                        <img class="b-r-4 img-40" src="{{ asset('assets/foto_profil/'.auth()->user()->foto)}}" alt="" data-original-title="" title="">
                        <div class="media-body"><span>{{auth()->user()->karyawan->nama_lengkap}}</span>
                            <p class="mb-0 font-roboto">{{auth()->user()->level_user->nama_level}} <i class="middle fa fa-angle-down"></i></p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li>
                            <a href="{{ route('data_profile', Crypt::encryptString(auth()->user()->id_user) ) }}">
                                <i data-feather="user"></i><span>Profil </span>
                            </a>
                        </li>
                        {{-- <li><a href="#"><i data-feather="mail"></i><span>Inbox</span></a></li>
                                <li><a href="#"><i data-feather="file-text"></i><span>Taskboard</span></a></li>
                                <li><a href="#"><i data-feather="settings"></i><span>Settings</span></a></li> --}}
                        <li><a href="{{ route('logout')}}"><i data-feather="log-out"></i><span>Log out</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName"></div>
            </div>
            </div>
        </script>
    </div>
</div>
