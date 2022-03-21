@extends('main')

@section('judul')
Laporan Selesai
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Data Laporan Selesai</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Data Laporan Selesai</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    @if( $massage = Session::get('success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Tambah Akun Admin Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @elseif( $massage = Session::get('edit_success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Edit Akun Admin Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @elseif( $massage = Session::get('hapus_success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Hapus Akun Admin Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h5>Laporan Selesai</h5>
                        </div>

                        {{-- <div class="col-md-4" style="padding-left:14%">
                            <td>
                                <a href="#">
                                    <button class="btn btn-outline-primary" type="button" data-toggle="modal"
                                        data-target="#tambah_data" data-original-title="Isi secara lengkap"
                                        title="">+ Akun Admin</button>
                                </a>
                            </td>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th width="2px" style="text-align: center">No</th>
                                    <th style="text-align: center">Tanggal</th>
                                    <th style="text-align: center">Judul Laporan</th>
                                    <th style="text-align: center">Kategori</th>
                                    <th style="text-align: center">Pioritas</th>
                                    <th style="text-align: center">Approval 1</th>
                                    <th style="text-align: center">Approval 2</th>
                                    <th style="text-align: center">Approval 3</th>
                                    <th width="2px" style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($data_laporan->where('id_departemen',auth()->user()->id_departemen) as $laporan)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td width="80px">{{ date('d-m-Y', strtotime($laporan->created_at))}}</td>
                                    <td>{{$laporan->judul_laporan}}</td>
                                    <td>{{$laporan->nama_kategori}}</td>
                                    <td>{{$laporan->prioritas}}</td>
                                    <td>{{$laporan->appv1}}</td>
                                    <td>{{$laporan->appv2}}</td>
                                    <td>{{$laporan->appv3}}</td>
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
                                    <div class="modal fade bd-example-modal-lg" id="view" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detail Data Admin</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post">
                                                        {{ csrf_field() }}

                                                        <img class="img-fluid" src="">

                                                        <div class="form-group">
                                                            <label class="col-form-label" for="nama_pengguna">Tanggal</label>
                                                            <input class="form-control" name="fullname" type="text" value="{{ date('d-m-Y', strtotime($laporan->created_at))}}" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label" for="nama_pengguna">Judul Laporan</label>
                                                            <input class="form-control" name="fullname" type="text" value="{{$laporan->judul_laporan}}" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label" for="nama_pengguna">Kategori</label>
                                                            <input class="form-control" name="fullname" type="text" value="{{$laporan->nama_kategori}}" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label" for="nama_pengguna">Prioritas</label>
                                                            <input class="form-control" name="fullname" type="text" value="{{$laporan->prioritas}}" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-form-label" for="nama_pengguna">Kronologi Kejadian</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea25" readonly name="kronologi_kejadian" rows="4">{{$laporan->kronologi_kejadian}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label" for="nama_pengguna">Dibuat Oleh</label>
                                                            <input class="form-control" name="fullname" type="text" value="{{$laporan->nama_lengkap}}" readonly>
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
                                                    <h5 class="modal-title">Edit Data Admin</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="edit_pengguna/" method="post">
                                                        {{ csrf_field() }}

                                                        <div class="form-group">
                                                            <label class="col-form-label" for="nama_pengguna">Nama
                                                                Lengkap</label>
                                                            <input class="form-control" name="fullname" type="text"
                                                                value="" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label"
                                                                for="username">Username</label>
                                                            <input class="form-control" name="username" type="text"
                                                                value="" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label"
                                                                for="username">Password</label>
                                                            <input class="form-control" type="password" name="password"
                                                                value="" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label"
                                                                for="username">Level</label>
                                                            <input class="form-control" name="level" type="text"
                                                                value="" readonly>
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
                                    <div id="delete" class="modal fade" tabindex="-1"
                                        role="dialog" aria-labelledby="fill-danger-modalLabel" aria-hidden="true">
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
                                                    <a href=""
                                                        class="btn btn-outline-light">Hapus
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
                                @endforeach
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
