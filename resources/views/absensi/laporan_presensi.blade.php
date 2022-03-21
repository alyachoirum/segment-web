@extends('main')

@section('judul')
Laporan Presensi
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Laporan Presensi</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Laporan Presensi</li>
                </ol>
            </div>
        </div>
    </div>
</div>



<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-7">
                            <h5>Data Laporan</h5>
                        </div>
                        <div class="col-md-5" style="padding-left:27%">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button class="btn btn-primary" data-toggle="modal" data-original-title=""
                                    data-target="#print" onclick="window.open('{{route('laporan_rekap')}}');">
                                    <i class="fa fa-file-text-o"></i> | REKAP</button>
                            </div>
                        </div>

                    </div>

                    <br>

                    <div class="row">
                        <form action="" method="post">
                            {{ csrf_field() }}
                            <div class="form-group row" style="padding-left:1.5%">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Periode Laporan</label>
                                        <div class="row no-gutters">
                                            <div class="col-6">
                                                <input autocomplete="off" class="datepicker-here form-control" type="text"
                                                    name="start_date" placeholder="Tanggal Awal" data-language="en"
                                                    data-original-title="" title="" data-date-format="yyyy/mm/dd">
                                            </div>
                                            <div class="col-6">
                                                <input autocomplete="off" class="datepicker-here form-control" type="text" name="end_date"
                                                    placeholder="Tanggal Akhir" data-language="en"
                                                    data-original-title="" title="" data-date-format="yyyy/mm/dd">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Zona Kerja</label>
                                        <select class="form-control button btn btn-outline-primary js-example-basic-single col-sm-12" name="id_zona"
                                            id="id_zona">
                                            <option>Pilih Zona</option>
                                            @foreach ($zona as $zon)
                                            <option value="{{ $zon->id_zona }}">{{ $zon->nama_zona }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
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

                {{-- <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="tabel_karyawan">
                            <thead>
                                <tr>
                                    <th width="1px" style="text-align: center">No</th>
                                    <th width="100px" style="text-align: center">NIK</th>
                                    <th style="text-align: center">Nama</th>
                                    <th width="2px" style="text-align: center">Zona</th>
                                    <th width="2px" style="text-align: center">Regu</th>
                                    <th width="1px" style="text-align: center">Detail</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')

@endsection
