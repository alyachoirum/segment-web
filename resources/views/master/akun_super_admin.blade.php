@extends('main')

@section('judul')
Akun Super Admin
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Data Akun Super Admin</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Data Akun Super Admin</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    @if( $massage = Session::get('success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Tambah Akun Super Admin Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @elseif( $massage = Session::get('edit_success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Edit Akun Super Admin Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @elseif( $massage = Session::get('hapus_success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Hapus Akun Super Admin Berhasil !</strong>
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
                            <h5>Akun Super Admin</h5>
                        </div>

                        {{-- <div class="col-md-4" style="padding-left:13%">
                            <td>
                                <a href="#">
                                    <button class="btn btn-outline-primary" type="button" data-toggle="modal"
                                        data-target="#tambah_data" data-original-title="Isi secara lengkap" title="">+
                                        Akun Super Admin</button>
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
                                    <th style="text-align: center">Foto</th>
                                    <th style="text-align: center">NIK</th>
                                    <th width="500px" style="text-align: center">Nama</th>
                                    <th style="text-align: center">Departemen</th>
                                    <th style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_user as $user)
                                @foreach ($data_kar->where('id_level_user', '=', 1) as $kar )
                                <tr>
                                    <td width="2px" style="text-align: center">
                                        <img class="b-r-8 img-70" src="{{ asset('assets/foto_profil/'.$user->foto)}}"
                                            itemprop="thumbnail" alt="Foto Profil">
                                    </td>
                                    <td width="2px" style="text-align: center">{{$user->nik}}</td>
                                    <td>{{$kar->nama_lengkap}}</td>
                                    <td>{{$user->nama_departemen}}</td>
                                    <td width="2px" style="text-align: center">

                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('data_profile', Crypt::encryptString($user->id_user) ) }}"">
                                                <button class="btn btn-primary" data-original-title="Detail">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </a>
                                            {{-- <button class="btn btn-primary" data-toggle="modal"
                                                data-original-title="Detail" data-target="#view{{$user->id_user}}"><i
                                                    class="fa fa-eye"></i></button>
                                            <a href="{{ route('profile_detail',auth()->user()->id_user)}}">
                                                <button class="btn btn-primary" data-original-title="Edit"><i
                                                        class="fa fa-edit"></i></button>
                                            </a>
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-original-title="Hapus" data-target="#delete{{$user->id_user}}"><i
                                                    class="fa fa-eraser"></i></button> --}}
                                        </div>
                                    </td>

                                    {{-- MODAL VIEW --}}
                                    <div class="modal fade bd-example-modal-lg" id="view{{$user->id_user}}"
                                        tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detail Data Admin</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <img class="b-r-8 img-100 rounded mx-auto d-block"
                                                                src="{{ asset('assets/foto_profil/'.$user->foto)}}"
                                                                itemprop="thumbnail" alt="Foto Profil">
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>NIK</b></label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{$kar->nik}}" name="nik" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-5">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>Password</b></label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{ $user->password}}" name="nama_lengkap"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>Level User</b></label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{ $user->nama_level}}"
                                                                        name="nama_lengkap" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>Departemen</b></label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{ $user->nama_departemen}}"
                                                                        name="nama_lengkap" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-5">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>Nama
                                                                            Lengkap</b></label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{$kar->nama_lengkap}}"
                                                                        name="nama_lengkap" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>Email</b></label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{$user->email}}" name="nama_lengkap"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>Jabatan</b></label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{ $kar->nama_jabatan}}"
                                                                        name="nama_lengkap" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>Zona</b></label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{ $kar->nama_zona}}" name="nama_lengkap"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>Regu</b></label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{ $kar->nama_regu}}" name="nama_lengkap"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>PT</b></label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{$kar->pt}}" name="no_hp" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>No KIB</b></label>
                                                                    <input class="form-control" type="number"
                                                                        value="{{$kar->no_kib}}" name="no_ktp" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label><b>Tanggal Lahir</b></label>
                                                                    <input class="datepicker-here form-control" readonly disabled
                                                                        type="text" name="tgl_jatuhtempo_gada"
                                                                        value="{{$kar->tgl_lahir}}"
                                                                        data-language="en" data-original-title=""
                                                                        title=""> </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>Alamat</b></label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{$kar->alamat}}" name="alamat" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-2">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>RT/RW</b></label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{$kar->rtrw}}" name="rtrw" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>Desa</b></label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{$kar->desa}}" name="desa" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>Kecamatan</b></label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{$kar->kecamatan}}" name="kecamatan" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>Kabupaten</b></label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{$kar->kabupaten}}" name="kabupaten" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6 col-md-5">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>No Hp</b></label>
                                                                    <input class="form-control" type="number"
                                                                        value="{{$kar->no_hp}}" name="no_hp" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-7">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>No KTP</b></label>
                                                                    <input class="form-control" type="number"
                                                                        value="{{$kar->no_ktp}}" name="no_ktp" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>Kompetensi Gada</b></label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{$kar->kompetensi_gada}}" name="kompetensi_gada" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>No Reg</b></label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{$kar->no_reg}}" name="no_reg" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>No KTA</b></label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{$kar->no_kta}}" name="no_kta" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label"><b>No Ijazah</b></label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{$kar->no_ijazah}}" name="no_ijazah" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label><b>Tanggal Jatuh Tempo Gada</b></label>
                                                                    <input class="datepicker-here form-control" readonly disabled
                                                                        type="text" name="tgl_jatuhtempo_gada"
                                                                        value="{{$kar->tgl_jatuhtempo_gada}}"
                                                                        data-language="en" data-original-title=""
                                                                        title=""> </div>
                                                            </div>
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
                                                    <h5 class="modal-title">Edit Data Admin</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="edit_user/{{$user->id_user}}" method="post"
                                                        enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <input class="form-control" name="level_user" type="hidden"
                                                                placeholder="" value="Admin">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="foto_profil"
                                                                value="{{$user->foto}}" hidden>
                                                            <label class="col-form-label"><b>Foto Profil</b></label>
                                                            <img class="b-r-8 img-100 rounded mx-auto d-block mb-4"
                                                                src="{{ asset('assets/foto_profil/'.$user->foto)}}"
                                                                itemprop="thumbnail" alt="Foto Profil">
                                                            <div class="custom-file">
                                                                <input type="file"
                                                                    class="custom-file-input input-rounded"
                                                                    value="{{$user->foto}}" name="gambar">
                                                                <label class="custom-file-label"
                                                                    for="inputGroupFile01">Choose file</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label"><b>NIK</b></label>
                                                            <input class="form-control" name="nik" type="text"
                                                                placeholder="nomor induk karyawan"
                                                                value="{{$user->nik}}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label"><b>Nama </b></label>
                                                            <input class="form-control" name="nama_user" type="text"
                                                                placeholder="nama lengkap"
                                                                value="{{$kar->nama_lengkap}}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-form-label"><b>Departemen</b></label>
                                                            <select class="form-control" name="id_departemen" required>
                                                                <option value="{{$user->id_departemen}}">
                                                                    {{$user->nama_departemen}}</option>
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
                <h5 class="modal-title">Tambah Data Admin</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('tambah_user')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input class="form-control" name="level_user" type="hidden" placeholder="" value="Admin">
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
