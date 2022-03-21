@extends('main')

@section('judul')
Kehadiran Karyawan
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-3">
                <h3>Kehadiran Karyawan</h3>
            </div>
            <div class="col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('data_karyawan')}}">Menu Karyawan</a>
                    </li>
                    <li class="breadcrumb-item">Kehadiran</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    @if( $massage = Session::get('success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Absensi Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @elseif( $massage = Session::get('off'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Absen OFF Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @elseif( $massage = Session::get('hapus_success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Hapus Departemen Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @endif
    <div class="row">

    @if (is_null($cek_data_ada))
        <div class="col-md-6">
            <a href="{{ route('form_masuk', $hash->encodeHex(auth()->user()->id_user))}}">
                <div class="card browser-widget">
                    <div class="media card-body align-self-center">
                        <div class="media-img">
                            <img style="height: 250px;" src="{{ asset('assets/images/dashboard/masuk.png')}}" alt=""
                                data-original-title="" title="">
                        </div>
                    </div>
                    <div class="align-self-center mb-3" style="text-align:center">
                        <h4>Masuk</h4>
                        <p>Wajib mengisi presensi masuk</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 disabled">
            <a href="#">
                <div class="card browser-widget">
                    <div class="media card-body align-self-center">
                        <div class="media-img">
                            <img style="height: 250px;" src="{{ asset('assets/images/dashboard/keluar.png')}}" alt=""
                                data-original-title="" title="">
                        </div>
                    </div>
                    <div class="align-self-center mb-3" style="text-align:center">
                        <h4>Keluar</h4>
                        <p>Wajib mengisi presensi keluar</p>
                    </div>
                </div>
            </a>
        </div>

    @elseif ($cek_data_ada->status == "on_duty")
        <div class="col-md-6 disabled">
            <a href="#">
                <div class="card browser-widget">
                    <div class="media card-body align-self-center">
                        <div class="media-img">
                            <img style="height: 250px;" src="{{ asset('assets/images/dashboard/masuk.png')}}" alt=""
                                data-original-title="" title="">
                        </div>
                    </div>
                    <div class="align-self-center mb-3" style="text-align:center">
                        <h4>Masuk</h4>
                        <p>Wajib mengisi presensi masuk</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="{{ route('form_keluar')}}">
                <div class="card browser-widget">
                    <div class="media card-body align-self-center">
                        <div class="media-img">
                            <img style="height: 250px;" src="{{ asset('assets/images/dashboard/keluar.png')}}" alt=""
                                data-original-title="" title="">
                        </div>
                    </div>
                    <div class="align-self-center mb-3" style="text-align:center">
                        <h4>Keluar</h4>
                        <p>Wajib mengisi presensi keluar</p>
                    </div>
                </div>
            </a>
        </div>

    @elseif ($cek_data_ada->status == "off_duty")
    <div class="col-md-6 disabled">
        <a href="#">
            <div class="card browser-widget">
                <div class="media card-body align-self-center">
                    <div class="media-img">
                        <img style="height: 250px;" src="{{ asset('assets/images/dashboard/masuk.png')}}" alt=""
                            data-original-title="" title="">
                    </div>
                </div>
                <div class="align-self-center mb-3" style="text-align:center">
                    <h4>Masuk</h4>
                    <p>Wajib mengisi presensi masuk</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-6 disabled">
        <a href="#">
            <div class="card browser-widget">
                <div class="media card-body align-self-center">
                    <div class="media-img">
                        <img style="height: 250px;" src="{{ asset('assets/images/dashboard/keluar.png')}}" alt=""
                            data-original-title="" title="">
                    </div>
                </div>
                <div class="align-self-center mb-3" style="text-align:center">
                    <h4>Keluar</h4>
                    <p>Wajib mengisi presensi keluar</p>
                </div>
            </div>
        </a>
    </div>
    @endif
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
@endsection
