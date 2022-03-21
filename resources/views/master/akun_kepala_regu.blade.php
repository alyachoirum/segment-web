@extends('main')

@section('judul')
Akun Kepala Regu
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Data Akun Kepala Regu</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Data Akun Kepala Regu</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    @if( $massage = Session::get('success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Tambah Akun Kepala Regu Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @elseif( $massage = Session::get('edit_success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Edit Akun Kepala Regu Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @elseif( $massage = Session::get('hapus_success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Hapus Akun Kepala Regu Berhasil !</strong>
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
                            <h5>Akun Kepala Regu</h5>
                        </div>

                        <div class="col-md-4" style="padding-left:13%">
                            <td>
                                <a href="#">
                                    <button class="btn btn-outline-primary" type="button" data-toggle="modal"
                                        data-target="#tambah_data" data-original-title="Isi secara lengkap" title="">+
                                        Akun Kepala Regu</button>
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
                                    <th style="text-align: center">NIK</th>
                                    <th style="text-align: center">Profil</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Departemen</th>
                                    <th width="2px" style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_user as $user)
                                <tr>
                                    <td width="2px" style="text-align: center">{{$user->nik}}</td>
                                    <td width="2px" style="text-align: center">
                                        <img class="b-r-8 img-70"
                                            src="{{ asset('assets/foto_profil/'.$user->foto_profil)}}"
                                            itemprop="thumbnail" alt="Foto Profil">
                                    </td>
                                    <td>{{$user->nama_user}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->nama_departemen}}</td>
                                    <td width="2px" style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-original-title="Detail" data-target="#view{{$user->id_user}}"><i
                                                    class="fa fa-eye"></i></button>
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-original-title="Edit" data-target="#edit{{$user->id_user}}"><i
                                                    class="fa fa-edit"></i></button>
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-original-title="Hapus" data-target="#delete{{$user->id_user}}"><i
                                                    class="fa fa-eraser"></i></button>
                                        </div>
                                    </td>

                                    {{-- MODAL VIEW --}}
                                    <div class="modal fade" id="view{{$user->id_user}}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detail Data Kepala Regu</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <img class="b-r-8 img-100 rounded mx-auto d-block"
                                                                src="{{ asset('assets/foto_profil/'.$user->foto_profil)}}"
                                                                itemprop="thumbnail" alt="Foto Profil">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label" for="nama_pengguna">NIK</label>
                                                            <input class="form-control" name="fullname" type="text"
                                                                value="{{$user->nik}}" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label" for="nama_pengguna">Nama
                                                                Lengkap</label>
                                                            <input class="form-control" name="fullname" type="text"
                                                                value="{{$user->nama_user}}" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label"
                                                                for="username">Username</label>
                                                            <input class="form-control" name="username" type="text"
                                                                value="{{$user->username}}" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label"
                                                                for="username">Departemen</label>
                                                            <input class="form-control" type="text" name="password"
                                                                value="{{$user->nama_departemen}}" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label"
                                                                for="jenis_pembayaran">Level</label>
                                                            <input class="form-control" type="text" name="password"
                                                                value="{{$user->level_user}}" readonly>
                                                        </div>
                                                </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- AKHIR MODAL VIEW --}}


                                    {{-- MODAL EDIT --}}
                                    <div class="modal fade" id="edit{{$user->id_user}}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Data Kepala Regu</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="edit_user/{{$user->id_user}}" method="post" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <input class="form-control" name="level_user" type="hidden"
                                                                placeholder="" value="Kepala Regu">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label"><b>Foto Profil</b></label>
                                                            <img class="b-r-8 img-100 rounded mx-auto d-block mb-4"
                                                                src="{{ asset('assets/foto_profil/'.$user->foto_profil)}}"
                                                                itemprop="thumbnail" alt="Foto Profil">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input input-rounded" value="{{$user->foto_profil}}" name="gambar">
                                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label"><b>NIK</b></label>
                                                            <input class="form-control" name="nik" type="text"
                                                                placeholder="nomor induk karyawan" value="{{$user->nik}}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label"><b>Nama </b></label>
                                                            <input class="form-control" name="nama_user" type="text"
                                                                placeholder="nama lengkap" value="{{$user->nama_user}}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label"><b>Username</b></label>
                                                            <input class="form-control" name="username" type="text"
                                                                placeholder="username" value="{{$user->username}}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label"><b>Departemen</b></label>
                                                            <select class="form-control" name="id_departemen" required>
                                                                <option value="{{$user->id_departemen}}">{{$user->nama_departemen}}</option>
                                                                @foreach ($data_departemen as $departemen)
                                                                <option value="{{$departemen->id_departemen}}">
                                                                    {{$departemen->nama_departemen}}</option>
                                                                @endforeach
                                                            </select>
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
                                    <div id="delete{{$user->id_user}}" class="modal fade" tabindex="-1" role="dialog"
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
                                                    <a href="{{ route('delete_user',$user->id_user) }}"
                                                        class="btn btn-outline-light">Hapus
                                                    </a>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
                                    <!-- AKHIR DELETE MODAL -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="tambah_data" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Kepala Regu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('tambah_user')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input class="form-control" name="level_user" type="hidden" placeholder="" value="Kepala Regu">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"><b>Foto Profil</b></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input input-rounded" name="gambar">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"><b>NIK</b></label>
                        <input class="form-control" name="nik" type="text" placeholder="nomor induk karyawan" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"><b>Nama Lengkap</b></label>
                        <input class="form-control" name="nama_user" type="text" placeholder="nama lengkap" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"><b>Username</b></label>
                        <input class="form-control" name="username" type="text" placeholder="username" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"><b>Password</b></label>
                        <input class="form-control" type="password" name="password" placeholder="password" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"><b>Departemen</b></label>
                        <select class="form-control" name="id_departemen">
                            <option>Pilih Departemen</option>
                            @foreach ($data_departemen as $departemen)
                            <option value="{{$departemen->id_departemen}}">{{$departemen->nama_departemen}}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary" type="submit">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- AKHIR MODAL TAMBAH --}}


@endsection

@section('script')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
@endsection
