@extends('main')

@section('judul')
Data Laporan Rekap Absensi
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Rekap Absensi</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Data Laporan Rekap Absensi</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-7">
                            <h5>Rekap Data Laporan Keseluruhan</h5>
                        </div>
                        {{-- <div class="col-md-5" style="padding-left:27%">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button class="btn btn-primary" data-toggle="modal" data-original-title=""
                                    data-target="#print" onclick="window.open('{{route('laporan_rekap')}}');">
                                    <i class="fa fa-file-text-o"></i> | REKAP</button>
                            </div>
                        </div> --}}

                    </div>

                    <br>

                    <div class="row">
                        <form action="/list_rekap_zona_filter" method="post" target="_blank">
                            {{ csrf_field() }}
                        <div class="form-group row" style="padding-left:2.5%">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Zona Kerja</label>
                                        <select class="form-control button btn btn-outline-primary js-example-basic-single col-sm-12" name="id_zona"
                                            id="id_zona">
                                            <option>Pilih Zona</option>
                                            @foreach ($data_zona as $zon)
                                            <option value="{{ $zon->id_zona }}">{{ $zon->nama_zona }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Bulan</label>
                                        <select class="form-control button btn btn-outline-primary js-example-basic-single col-sm-12" name="id_bulan"
                                            id="id_bulan">
                                            <option>Pilih Bulan</option>
                                            @foreach ($data_bulan as $bulan)
                                            <option value="{{ $bulan->id_bulan }}">{{ $bulan->nama_bulan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form_group">
                                        <label style="color: white">
                                            Filter
                                        </label>
                                        <button class="btn btn-primary" type="submit">Go</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

{{-- <div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-7">
                            <h5>Rekap Data Laporan Perorangan</h5>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <form action="/list_rekap_zona_filter" method="post">
                            {{ csrf_field() }}
                        <div class="form-group row" style="padding-left:2.5%">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Zona Kerja</label>
                                        <select class="form-control button btn btn-outline-primary js-example-basic-single col-sm-12" name="id_zona"
                                            id="id_zona">
                                            <option>Pilih Zona</option>
                                            @foreach ($data_zona as $zon)
                                            <option value="{{ $zon->id_zona }}">{{ $zon->nama_zona }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Bulan</label>
                                        <select class="form-control button btn btn-outline-primary js-example-basic-single col-sm-12" name="id_bulan"
                                            id="id_bulan">
                                            <option>Pilih Bulan</option>
                                            @foreach ($data_bulan as $bulan)
                                            <option value="{{ $bulan->id_bulan }}">{{ $bulan->nama_bulan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form_group">
                                        <label style="color: white">
                                            Filter
                                        </label>
                                        <button class="btn btn-primary" type="submit">Go</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container-fluid">
    <h4>Rekap Data Laporan Individu</h4>
    <div class="row">
        @foreach ($data_bulan as $bulan )
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden">
                <a href="{{ route('data_presensi_karyawan_all',$bulan->id_bulan)}}">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="calendar"></i></div>
                            <div class="media-body"><span class="m-0">
                                    <h4>{{ $bulan->nama_bulan }}</h4>
                                </span>
                                <i class="icon-bg" data-feather="calendar"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection

@section('script')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
@endsection
