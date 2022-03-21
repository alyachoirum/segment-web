<div class="sidebar-wrapper">
    <div class="logo-wrapper"><a href="#"><img class="img-fluid for-light"
                src="{{ asset('assets/images/logo/logo_putih.png')}}" alt=""><img class="img-fluid for-dark"
                src="{{ asset('assets/images/logo/logo_hitam.png')}}" alt=""></a>
        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
    </div>
    <div class="logo-icon-wrapper"><a href="dashboard"><img class="img-fluid"
                src="{{ asset('assets/images/logo/logo_icons.png')}}" alt=""></a></div>
    <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
            <ul class="sidebar-links custom-scrollbar">
                <li class="back-btn"><a href="{{route('dashboard_absensi')}}"><img class="img-fluid"
                            src="{{ asset('assets/images/logo/logo_icons.png')}}" alt=""></a>
                    <div class="mobile-back text-right"><span>Back</span><i class="fa fa-angle-right pl-2"
                            aria-hidden="true"></i></div>
                </li>

                @if(Auth::user()->id_level_user == '1')
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="home"></i><span>Dashboard</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('dashboard_absensi')}}">Absensi</a></li>
                        <li><a href="{{route('dashboard_eksekutif')}}">Analytics</a></li>
                        {{-- <li><a href="{{route('dashboard_laporan')}}">Laporan</a></li> --}}
                        <li><a href="{{route('dashboard_karyawan')}}">Karyawan</a></li>

                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Master</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="users"></i><span>Akun</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('data_super_admin')}}">Super Admin</a></li>
                        <li><a href="{{route('data_vp')}}">VP</a></li>
                        <li><a href="{{route('data_avp')}}">AVP</a></li>
                        <li><a href="{{route('data_supervisor')}}">Supervisor</a></li>
                        <li><a href="{{route('data_staff')}}">Staff</a></li>
                        <li><a href="{{route('data_foreman')}}">Foreman</a></li>
                        <li><a href="{{route('data_kajaga')}}">Kajaga</a></li>
                        <li><a href="{{route('data_security')}}">Security</a></li>
                        <li><a href="{{route('data_satpam')}}">Satpam</a></li>
                        <li><a href="{{route('data_pamtup')}}">Pamtup</a></li>
                        <li><a href="{{route('data_admin')}}">Admin</a></li>
                    </ul>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="info"></i><span>Informasi</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('data_kategori')}}">Kategori</a></li>
                        <li><a href="{{route('data_departemen')}}">Departemen</a></li>
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Absensi</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_karyawan')}}">
                        <i data-feather="award"></i><span>Karyawan</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_jadwal')}}">
                        <i data-feather="calendar"></i><span>Jadwal Presensi</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('list_rekap_zona')}}">
                        <i data-feather="book"></i><span>Rekap Presensi</span>
                    </a>
                </li>

                {{-- <li class="sidebar-main-title">
                    <div>
                        <h6>Data Pelaporan</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_laporan_publish')}}">
                        <i data-feather="file-text"></i><span>Laporan Publish</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#"><i data-feather="layers"></i><span>Data Laporan</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('data_semua_laporan')}}">Semua Laporan Masuk</a></li>
                        <li><a href="{{route('data_laporan_proses1')}}">Laporan Proses Aprv 1</a></li>
                        <li><a href="{{route('data_laporan_proses2')}}">Laporan Proses Aprv 2</a></li>
                        <li><a href="{{route('data_laporan_proses3')}}">Laporan Proses Aprv 3</a></li>
                        <li><a href="{{route('data_laporan_selesai')}}">Laporan Selesai</a></li>
                    </ul>
                </li> --}}

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Berita</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_berita')}}">
                        <i data-feather="slack"></i><span>Berita</span>
                    </a>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Struktur Master</h6>
                        <p>detail</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('struktur')}}">
                        <i data-feather="align-justify"></i><span>Struktur Depkam</span>
                    </a>
                </li>


                @elseif(Auth::user()->id_level_user == '2')
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="home"></i><span>Dashboard</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('dashboard_absensi')}}">Absensi</a></li>
                        <li><a href="{{route('dashboard_eksekutif')}}">Analytics</a></li>
                        {{-- <li><a href="{{route('dashboard_laporan')}}">Laporan</a></li> --}}
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Master</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="users"></i><span>Akun</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('data_vp')}}">VP</a></li>
                        <li><a href="{{route('data_avp')}}">AVP</a></li>
                        <li><a href="{{route('data_supervisor')}}">Supervisor</a></li>
                        <li><a href="{{route('data_staff')}}">Staff</a></li>
                        <li><a href="{{route('data_foreman')}}">Foreman</a></li>
                        <li><a href="{{route('data_kajaga')}}">Kajaga</a></li>
                        <li><a href="{{route('data_security')}}">Security</a></li>
                        <li><a href="{{route('data_satpam')}}">Satpam</a></li>
                        <li><a href="{{route('data_pamtup')}}">Pamtup</a></li>
                        <li><a href="{{route('data_admin')}}">Admin</a></li>
                        {{-- <li><a href="{{route('data_kepala_bagian')}}">Kepala Bagian</a></li>
                        <li><a href="{{route('data_kepala_seksi')}}">Kepala Seksi</a></li>
                        <li><a href="{{route('data_kepala_regu')}}">Kepala Regu</a></li>
                        <li><a href="{{route('data_pelaksana')}}">Pelaksana</a></li> --}}
                    </ul>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="info"></i><span>Informasi</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('data_kategori')}}">Kategori</a></li>
                        <li><a href="{{route('data_departemen')}}">Departemen</a></li>
                    </ul>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_karyawan')}}">
                        <i data-feather="award"></i><span>Karyawan</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('list_rekap_zona')}}">
                        <i data-feather="book"></i><span>Rekap Presensi</span>
                    </a>
                </li>

                {{-- <li class="sidebar-main-title">
                    <div>
                        <h6>Data Pelaporan</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_laporan_publish')}}">
                        <i data-feather="file-text"></i><span>Laporan Publish</span>
                    </a>
                </li> --}}

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Berita</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_berita')}}">
                        <i data-feather="slack"></i><span>Berita</span>
                    </a>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Struktur Master</h6>
                        <p>detail</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('struktur')}}">
                        <i data-feather="align-justify"></i><span>Struktur Depkam</span>
                    </a>
                </li>

                @elseif(Auth::user()->id_level_user == '3')

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="home"></i><span>Dashboard</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('dashboard_absensi')}}">Absensi</a></li>
                        {{-- <li><a href="{{route('dashboard_laporan')}}">Laporan</a></li> --}}
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Master</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="users"></i><span>Akun</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('data_avp')}}">AVP</a></li>
                        <li><a href="{{route('data_supervisor')}}">Supervisor</a></li>
                        <li><a href="{{route('data_staff')}}">Staff</a></li>
                        <li><a href="{{route('data_foreman')}}">Foreman</a></li>
                        <li><a href="{{route('data_kajaga')}}">Kajaga</a></li>
                        <li><a href="{{route('data_security')}}">Security</a></li>
                        <li><a href="{{route('data_satpam')}}">Satpam</a></li>
                        <li><a href="{{route('data_pamtup')}}">Pamtup</a></li>
                        <li><a href="{{route('data_admin')}}">Admin</a></li>
                    </ul>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="info"></i><span>Informasi</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('data_kategori')}}">Kategori</a></li>
                        <li><a href="{{route('data_departemen')}}">Departemen</a></li>
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Absensi</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_karyawan')}}">
                        <i data-feather="award"></i><span>Karyawan</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_jadwal')}}">
                        <i data-feather="calendar"></i><span>Jadwal Presensi</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('list_rekap_zona')}}">
                        <i data-feather="book"></i><span>Rekap Presensi</span>
                    </a>
                </li>
                {{-- <li class="sidebar-main-title">
                    <div>
                        <h6>Data Pelaporan</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_laporan_publish')}}">
                        <i data-feather="file-text"></i><span>Laporan Publish</span>
                    </a>
                </li> --}}

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Berita</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_berita')}}">
                        <i data-feather="slack"></i><span>Berita</span>
                    </a>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Struktur Master</h6>
                        <p>detail</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('struktur')}}">
                        <i data-feather="align-justify"></i><span>Struktur Depkam</span>
                    </a>
                </li>

                @elseif(Auth::user()->id_level_user == '4')
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="home"></i><span>Dashboard</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('dashboard_absensi')}}">Absensi</a></li>
                        {{-- <li><a href="{{route('dashboard_laporan')}}">Laporan</a></li> --}}
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Master</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="users"></i><span>Akun</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('data_supervisor')}}">Supervisor</a></li>
                        <li><a href="{{route('data_staff')}}">Staff</a></li>
                        <li><a href="{{route('data_foreman')}}">Foreman</a></li>
                        <li><a href="{{route('data_kajaga')}}">Kajaga</a></li>
                        <li><a href="{{route('data_security')}}">Security</a></li>
                        <li><a href="{{route('data_satpam')}}">Satpam</a></li>
                        <li><a href="{{route('data_pamtup')}}">Pamtup</a></li>
                        <li><a href="{{route('data_admin')}}">Admin</a></li>
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Absensi</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_karyawan')}}">
                        <i data-feather="award"></i><span>Karyawan</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_jadwal')}}">
                        <i data-feather="calendar"></i><span>Jadwal Presensi</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('list_rekap_zona')}}">
                        <i data-feather="book"></i><span>Rekap Presensi</span>
                    </a>
                </li>

                {{-- <li class="sidebar-main-title">
                    <div>
                        <h6>Data Pelaporan</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_laporan_publish')}}">
                        <i data-feather="file-text"></i><span>Laporan Publish</span>
                    </a>
                </li> --}}

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Berita</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_berita')}}">
                        <i data-feather="slack"></i><span>Berita</span>
                    </a>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Struktur Master</h6>
                        <p>detail</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('struktur')}}">
                        <i data-feather="align-justify"></i><span>Struktur Depkam</span>
                    </a>
                </li>

                @elseif(Auth::user()->id_level_user == '5')
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="home"></i><span>Dashboard</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('dashboard_absensi')}}">Absensi</a></li>
                        {{-- <li><a href="{{route('dashboard_laporan')}}">Laporan</a></li> --}}
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Master</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="users"></i><span>Akun</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('data_staff')}}">Staff</a></li>
                        <li><a href="{{route('data_foreman')}}">Foreman</a></li>
                        <li><a href="{{route('data_kajaga')}}">Kajaga</a></li>
                        <li><a href="{{route('data_security')}}">Security</a></li>
                        <li><a href="{{route('data_satpam')}}">Satpam</a></li>
                        <li><a href="{{route('data_pamtup')}}">Pamtup</a></li>
                        <li><a href="{{route('data_admin')}}">Admin</a></li>
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Absensi</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_karyawan')}}">
                        <i data-feather="award"></i><span>Karyawan</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_jadwal')}}">
                        <i data-feather="calendar"></i><span>Jadwal Presensi</span>
                    </a>
                </li>

                {{-- <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('list_rekap_zona')}}">
                        <i data-feather="book"></i><span>Rekap Presensi</span>
                    </a>
                </li> --}}

                {{-- <li class="sidebar-main-title">
                    <div>
                        <h6>Data Pelaporan</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_laporan_publish')}}">
                        <i data-feather="file-text"></i><span>Laporan Publish</span>
                    </a>
                </li> --}}

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Berita</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_berita')}}">
                        <i data-feather="slack"></i><span>Berita</span>
                    </a>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Struktur Master</h6>
                        <p>detail</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('struktur')}}">
                        <i data-feather="align-justify"></i><span>Struktur Depkam</span>
                    </a>
                </li>

                @elseif(Auth::user()->id_level_user == '6')
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="home"></i><span>Dashboard</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('dashboard_absensi')}}">Absensi</a></li>
                        {{-- <li><a href="{{route('dashboard_laporan')}}">Laporan</a></li> --}}
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Master</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="users"></i><span>Akun</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('data_foreman')}}">Foreman</a></li>
                        <li><a href="{{route('data_kajaga')}}">Kajaga</a></li>
                        <li><a href="{{route('data_security')}}">Security</a></li>
                        <li><a href="{{route('data_satpam')}}">Satpam</a></li>
                        <li><a href="{{route('data_pamtup')}}">Pamtup</a></li>
                        <li><a href="{{route('data_admin')}}">Admin</a></li>
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Absensi</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_karyawan')}}">
                        <i data-feather="award"></i><span>Karyawan</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_jadwal')}}">
                        <i data-feather="calendar"></i><span>Jadwal Presensi</span>
                    </a>
                </li>

                {{-- <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('list_rekap_zona')}}">
                        <i data-feather="book"></i><span>Rekap Presensi</span>
                    </a>
                </li> --}}

                {{-- <li class="sidebar-main-title">
                    <div>
                        <h6>Data Pelaporan</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_laporan_publish')}}">
                        <i data-feather="file-text"></i><span>Laporan Publish</span>
                    </a>
                </li> --}}

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Struktur Master</h6>
                        <p>detail</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('struktur')}}">
                        <i data-feather="align-justify"></i><span>Struktur Depkam</span>
                    </a>
                </li>

                @elseif(Auth::user()->id_level_user == '7')
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="home"></i><span>Dashboard</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('dashboard_absensi')}}">Absensi</a></li>
                        {{-- <li><a href="{{route('dashboard_laporan')}}">Laporan</a></li> --}}
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Master</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="users"></i><span>Akun</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('data_kajaga')}}">Kajaga</a></li>
                        <li><a href="{{route('data_satpam')}}">Satpam</a></li>
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Absensi</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_karyawan')}}">
                        <i data-feather="award"></i><span>Karyawan</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_jadwal')}}">
                        <i data-feather="calendar"></i><span>Jadwal Presensi</span>
                    </a>
                </li>

                {{-- <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('list_rekap_zona')}}">
                        <i data-feather="book"></i><span>Rekap Presensi</span>
                    </a>
                </li> --}}

                {{-- <li class="sidebar-main-title">
                    <div>
                        <h6>Data Pelaporan</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_laporan_publish')}}">
                        <i data-feather="file-text"></i><span>Laporan Publish</span>
                    </a>
                </li> --}}

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Struktur Master</h6>
                        <p>detail</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('struktur')}}">
                        <i data-feather="align-justify"></i><span>Struktur Depkam</span>
                    </a>
                </li>

                @elseif(Auth::user()->id_level_user == '8')
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="home"></i><span>Dashboard</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('dashboard_karyawan')}}">Karyawan</a></li>
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Master</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="users"></i><span>Akun</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('data_satpam')}}">Satpam</a></li>
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Absensi</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_karyawan')}}">
                        <i data-feather="award"></i><span>Karyawan</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_jadwal')}}">
                        <i data-feather="calendar"></i><span>Jadwal Presensi</span>
                    </a>
                </li>

                {{-- <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('list_rekap_zona')}}">
                        <i data-feather="book"></i><span>Rekap Presensi</span>
                    </a>
                </li> --}}

                {{-- <li class="sidebar-main-title">
                    <div>
                        <h6>Data Pelaporan</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_laporan_publish')}}">
                        <i data-feather="file-text"></i><span>Laporan Publish</span>
                    </a>
                </li> --}}

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Struktur Master</h6>
                        <p>detail</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('struktur')}}">
                        <i data-feather="align-justify"></i><span>Struktur Depkam</span>
                    </a>
                </li>

                @elseif(Auth::user()->id_level_user == '9')
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="home"></i><span>Dashboard</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('dashboard_karyawan')}}">Karyawan</a></li>
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Master</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="users"></i><span>Akun</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('data_security')}}">Security</a></li>
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Absensi</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_karyawan')}}">
                        <i data-feather="award"></i><span>Karyawan</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_jadwal')}}">
                        <i data-feather="calendar"></i><span>Jadwal Presensi</span>
                    </a>
                </li>

                {{-- <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('list_rekap_zona')}}">
                        <i data-feather="book"></i><span>Rekap Presensi</span>
                    </a>
                </li> --}}

                {{-- <li class="sidebar-main-title">
                    <div>
                        <h6>Data Pelaporan</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_laporan_publish')}}">
                        <i data-feather="file-text"></i><span>Laporan Publish</span>
                    </a>
                </li> --}}

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Struktur Master</h6>
                        <p>detail</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('struktur')}}">
                        <i data-feather="align-justify"></i><span>Struktur Depkam</span>
                    </a>
                </li>

                @elseif(Auth::user()->id_level_user == '10')

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="home"></i><span>Dashboard</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('dashboard_karyawan')}}">Karyawan</a></li>
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Master</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="users"></i><span>Akun</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('data_pamtup')}}">Pamtup</a></li>
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Absensi</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_karyawan')}}">
                        <i data-feather="award"></i><span>Karyawan</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_jadwal')}}">
                        <i data-feather="calendar"></i><span>Jadwal Presensi</span>
                    </a>
                </li>

                {{-- <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('list_rekap_zona')}}">
                        <i data-feather="book"></i><span>Rekap Presensi</span>
                    </a>
                </li> --}}

                {{-- <li class="sidebar-main-title">
                    <div>
                        <h6>Data Pelaporan</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_laporan_publish')}}">
                        <i data-feather="file-text"></i><span>Laporan Publish</span>
                    </a>
                </li> --}}

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Struktur Master</h6>
                        <p>detail</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('struktur')}}">
                        <i data-feather="align-justify"></i><span>Struktur Depkam</span>
                    </a>
                </li>

                @elseif(Auth::user()->id_level_user == '11')
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="home"></i><span>Dashboard</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('dashboard_karyawan')}}">Karyawan</a></li>
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Master</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="users"></i><span>Akun</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('data_admin')}}">Admin</a></li>
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Absensi</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_karyawan')}}">
                        <i data-feather="award"></i><span>Karyawan</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_jadwal')}}">
                        <i data-feather="calendar"></i><span>Jadwal Presensi</span>
                    </a>
                </li>

                {{-- <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('list_rekap_zona')}}">
                        <i data-feather="book"></i><span>Rekap Presensi</span>
                    </a>
                </li> --}}

                {{-- <li class="sidebar-main-title">
                    <div>
                        <h6>Data Pelaporan</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_laporan_publish')}}">
                        <i data-feather="file-text"></i><span>Laporan Publish</span>
                    </a>
                </li> --}}

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Struktur Master</h6>
                        <p>detail</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('struktur')}}">
                        <i data-feather="align-justify"></i><span>Struktur Depkam</span>
                    </a>
                </li>


                @elseif(Auth::user()->id_level_user == '12')
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="home"></i><span>Dashboard</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('dashboard_absensi')}}">Absensi</a></li>
                        {{-- <li><a href="{{route('dashboard_laporan')}}">Laporan</a></li> --}}
                        <li><a href="{{route('dashboard_karyawan')}}">Karyawan</a></li>
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Master</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="users"></i><span>Akun</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('data_super_admin')}}">Super Admin</a></li>
                        <li><a href="{{route('data_vp')}}">VP</a></li>
                        <li><a href="{{route('data_avp')}}">AVP</a></li>
                        <li><a href="{{route('data_supervisor')}}">Supervisor</a></li>
                        <li><a href="{{route('data_staff')}}">Staff</a></li>
                        <li><a href="{{route('data_foreman')}}">Foreman</a></li>
                        <li><a href="{{route('data_kajaga')}}">Kajaga</a></li>
                        <li><a href="{{route('data_security')}}">Security</a></li>
                        <li><a href="{{route('data_satpam')}}">Satpam</a></li>
                        <li><a href="{{route('data_pamtup')}}">Pamtup</a></li>
                        <li><a href="{{route('data_admin')}}">Admin</a></li>
                        {{-- <li><a href="{{route('data_kepala_bagian')}}">Kepala Bagian</a></li>
                        <li><a href="{{route('data_kepala_seksi')}}">Kepala Seksi</a></li>
                        <li><a href="{{route('data_kepala_regu')}}">Kepala Regu</a></li>
                        <li><a href="{{route('data_pelaksana')}}">Pelaksana</a></li> --}}
                    </ul>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="info"></i><span>Informasi</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('data_kategori')}}">Kategori</a></li>
                        <li><a href="{{route('data_departemen')}}">Departemen</a></li>
                    </ul>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Absensi</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_karyawan')}}">
                        <i data-feather="award"></i><span>Karyawan</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_jadwal')}}">
                        <i data-feather="calendar"></i><span>Jadwal Presensi</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('list_rekap_zona')}}">
                        <i data-feather="book"></i><span>Rekap Presensi</span>
                    </a>
                </li>

                {{-- <li class="sidebar-main-title">
                    <div>
                        <h6>Data Pelaporan</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_laporan_publish')}}">
                        <i data-feather="file-text"></i><span>Laporan Publish</span>
                    </a>
                </li> --}}

                {{-- <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#"><i data-feather="layers"></i><span>Data Laporan</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('data_semua_laporan')}}">Semua Laporan Masuk</a></li>
                        <li><a href="{{route('data_laporan_proses1')}}">Laporan Proses Aprv 1</a></li>
                        <li><a href="{{route('data_laporan_proses2')}}">Laporan Proses Aprv 2</a></li>
                        <li><a href="{{route('data_laporan_proses3')}}">Laporan Proses Aprv 3</a></li>
                        <li><a href="{{route('data_laporan_selesai')}}">Laporan Selesai</a></li>
                    </ul>
                </li> --}}

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Berita</h6>
                        <p>Kelola Data</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('data_berita')}}">
                        <i data-feather="slack"></i><span>Berita</span>
                    </a>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Data Struktur Master</h6>
                        <p>detail</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('struktur')}}">
                        <i data-feather="align-justify"></i><span>Struktur Depkam</span>
                    </a>
                </li>

                @endif


            </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
</div>
