@extends('main')

@section('judul')
Dashboard AVP
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Data Karyawan</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Data Karyawan</li>
                </ol>
            </div>
        </div>
    </div>
</div>



<!-- Container-fluid starts-->
<div class="container-fluid">
    <h4>Form</h4>
    <div class="row">
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden">
                <a href="{{route('kehadiran')}}">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="user-check"></i></div>
                            <div class="media-body"><span class="m-0">
                                    <h4>Kehadiran</h4>
                                    <p>form hadir dan keluar</p>
                                </span>
                                <i class="icon-bg" data-feather="user-check"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden">
                <a href="{{route('absen')}}">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="user-x"></i></div>
                            <div class="media-body"><span class="m-0">
                                    <h4>Absen</h4>
                                    <p>form ijin, dispen, sakit, cuti</p>
                                </span>
                                <i class="icon-bg" data-feather="user-x"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden">
                <a href="{{route('pengajuan')}}">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="clipboard"></i></div>
                            <div class="media-body"><span class="m-0">
                                    <h4>Pengajuan</h4>
                                    <p>form tukar shift, lembur</p>
                                </span>
                                <i class="icon-bg" data-feather="clipboard"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="container-fluid">
    <h4>Data</h4>
    <div class="row">
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden">
                <a href="{{route('list_presensi')}}">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="user-check"></i></div>
                            <div class="media-body"><span class="m-0">
                                    <h4>List Presensi</h4>
                                    <p>Data Kehadiran</p>
                                </span>
                                <i class="icon-bg" data-feather="user-check"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden">
                <a href="{{route('list_absen_tidakmasuk')}}">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="user-x"></i></div>
                            <div class="media-body"><span class="m-0">
                                    <h4>List Absen</h4>
                                    <p>Data Pengajuan Absen</p>
                                </span>
                                <i class="icon-bg" data-feather="user-x"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden">
                <a href="{{route('list_pengajuan')}}">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="clipboard"></i></div>
                            <div class="media-body"><span class="m-0">
                                    <h4>List Pengajuan</h4>
                                    <p>Data Pengajuan Lembur</p>
                                </span>
                                <i class="icon-bg" data-feather="clipboard"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')


@endsection
