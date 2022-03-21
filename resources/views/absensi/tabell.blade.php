@extends('main')

@section('judul')
Data Karyawan
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Menu Karyawan</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Menu Karyawan</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    @if( $massage = Session::get('success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Tambah Departemen Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @elseif( $massage = Session::get('edit_success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Edit Departemen Berhasil !</strong>
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
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden">
                <a href="{{route('kehadiran')}}">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                            <div class="media-body"><span class="m-0">
                                    <h4>Kehadiran</h4>
                                </span>
                                <i class="icon-bg" data-feather="shopping-bag"></i>
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
                            <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                            <div class="media-body"><span class="m-0">
                                    <h4>Absen</h4>
                                </span>
                                <i class="icon-bg" data-feather="shopping-bag"></i>
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
                            <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                            <div class="media-body"><span class="m-0">
                                    <h4>Pengajuan</h4>
                                </span>
                                <i class="icon-bg" data-feather="shopping-bag"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>


        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h5>Data Karyawan</h5>
                        </div>

                        <div class="col-md-4" style="padding-left:19%">
                            <td>
                                <a href="#">
                                    <button class="btn btn-outline-primary" type="button" data-toggle="modal"
                                        data-target="#tambah_data" data-original-title="Isi secara lengkap" title="">+
                                        Karyawan</button>
                                </a>
                            </td>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center">NIK</th>
                                    <th style="text-align: center">Nama Karyawan</th>
                                    <th style="text-align: center">Zona</th>
                                    <th width="2px" style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                {{-- @foreach ($data_karyawan as $karyawan) --}}
                                <tr>
                                    <td width="2px" style="text-align: center"><?=$no?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-original-title="Detail" data-target="#view"><i
                                                    class="fa fa-eye"></i></button>
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-original-title="Edit" data-target="#edit"><i
                                                    class="fa fa-edit"></i></button>
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-original-title="Hapus" data-target="#delete"><i
                                                    class="fa fa-eraser"></i></button>
                                        </div>
                                    </td>

                                    {{-- MODAL VIEW --}}
                                    <div class="modal fade" id="view" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detail Karyawan</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post">
                                                        {{ csrf_field() }}

                                                        <div class="form-group">
                                                            <label class="col-form-label"
                                                                for="nama_pengguna">Karyawan</label>
                                                            <input class="form-control" name="nama_departemen"
                                                                type="text" value="" readonly>
                                                        </div>
                                                </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- AKHIR MODAL VIEW --}}


                                    {{-- MODAL EDIT --}}
                                    <div class="modal fade" id="edit" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Karyawan</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="edit_karyawan/" method="post">
                                                        {{ csrf_field() }}

                                                        <div class="form-group">
                                                            <label class="col-form-label"
                                                                for="departemen">Departemen</label>
                                                            <input class="form-control" name="nama_departemen"
                                                                type="text" value="" required>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button class="btn btn-primary" type="submit">Edit</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- AKHIR MODAL EDIT --}}

                                    <!-- DELETE MODAL -->
                                    <div id="delete" class="modal fade" tabindex="-1" role="dialog"
                                        aria-labelledby="fill-danger-modalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content modal-filled bg-danger">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="fill-danger-modalLabel">Konfirmasi Hapus
                                                        Data</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Data akan hilang selamanya</p>
                                                    <p>Apakah anda yakin menghapusnya?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-dismiss="modal">Close</button>
                                                    <a href="" class="btn btn-outline-light">Hapus
                                                    </a>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
                                    <!-- AKHIR DELETE MODAL -->


                                </tr>
                                @php
                                $no++
                                @endphp
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h5>Data Laporan</h5>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <form action="" method="post">
                            {{ csrf_field() }}
                            <div class="form-group row" style="padding-left:1.5%">
                                <div class="col-md-3">
                                    <select class="form-control button btn btn-outline-primary" name="year"
                                        id="exampleFormControlSelect7">
                                        <option>Tahun</option>
                                        <option value=2022>2022</option>
                                        <option value=2021>2021</option>
                                        <option value=2020>2020</option>
                                        <option value=2019>2019</option>
                                        <option value=2018>2018</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <select class="form-control button btn btn-outline-primary" name="month"
                                        id="exampleFormControlSelect7">
                                        <option>Bulan</option>
                                        <option value=12>Desember</option>
                                        <option value=11>November</option>
                                        <option value=10>Oktober</option>
                                        <option value=9>September</option>
                                        <option value=8>Agustus</option>
                                        <option value=7>Juli</option>
                                        <option value=6>Juni</option>
                                        <option value=5>Mei</option>
                                        <option value=4>April</option>
                                        <option value=3>Maret</option>
                                        <option value=2>Februari</option>
                                        <option value=1>Januari</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control button btn btn-outline-primary" name="status"
                                        id="exampleFormControlSelect7">
                                        <option>Status</option>
                                        <option value=unpaid>Unpaid</option>
                                        <option value=paid>Paid</option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-primary" type="submit">Go</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="export-button">
                            <thead>
                                <tr>
                                    <th width="1px" style="text-align: center">No</th>
                                    <th width="70px" style="text-align: center">NIK</th>
                                    <th width="2px" style="text-align: center">Nama</th>
                                    <th width="2px" style="text-align: center">Zona</th>
                                    <th width="2px" style="text-align: center">Regu</th>
                                    <th width="2px" style="text-align: center">Jam Masuk</th>
                                    <th width="2px" style="text-align: center">Jam Keluar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                {{-- @foreach ($data_tagihan as $tagihan) --}}
                                <tr>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>7</td>
                                </tr>
                                @php
                                $no++
                                @endphp
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('script')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
@endsection
