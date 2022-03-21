@extends('main')

@section('judul')
Edit Profil
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Edit Profile</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href=""><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Profile</li>
                    <li class="breadcrumb-item">Edit Profile</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="edit-profile">
        <div class="row">
            @foreach ($profile as $profil)
            @foreach ($user as $us)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="card-title mb-0">Edit Profil</h4>
                                <div class="card-options">
                                    <a class="card-options-collapse" href="#" data-toggle="card-collapse">
                                        <i class="fe fe-chevron-up"></i>
                                    </a>
                                    <a class="card-options-remove" href="#" data-toggle="card-remove">
                                        <i class="fe fe-x"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3" style="padding-left:11%">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ URL::previous() }}" class="btn btn-primary" data-original-title="" title="">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('profile_edit', $us->id_user)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                            <div class="row mb-2">
                                <div class="col-auto">
                                    <img class="img-70 rounded-circle" alt="" src="{{ asset('assets/foto_profil/'.$us->foto)}}">
                                </div>
                                <div class="col">
                                    <h3 class="mb-1">{{$profil->nama_lengkap}}</h3>
                                    <p class="mb-4">{{$profil->nama_jabatan}}</p>
                                </div>

                                @if(Auth::user()->id_level_user == '1')
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Status Aktif</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="status_aktif">
                                            <option>{{$profil->status_aktif}}</option>
                                            <option value="1">1 | Aktif</option>
                                            <option value="0">0 | Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                @elseif(Auth::user()->id_level_user == '12')
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Status Aktif</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="status_aktif">
                                            <option>{{$profil->status_aktif}}</option>
                                            <option value="1">1 | Aktif</option>
                                            <option value="0">0 | Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                @else
                                    <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Status Aktif</b></label>
                                        @if ($profil->status_aktif == 1)
                                        <input class="form-control" type="text" value="Aktif" name="status_aktif" readonly>
                                        @else
                                        <input class="form-control" type="text" value="Tidak Aktif" name="status_aktif" readonly>
                                        @endif
                                    </div>
                                </div>
                                @endif

                            </div>


                            @if(Auth::user()->id_level_user == '1')
                            <div class="row mb-3">
                                <div class="col-md-12 mb-6">
                                    <label class="col-form-label">Ganti Foto</label>
                                    <div class="col-md-12">
                                        <input type="file" class="custom-file-input" name="foto" id="inputGroupFile01">
                                        <input class="form-control" type="text" value="{{$us->foto}}" name="foto_profil" hidden>
                                        <label class="custom-file-label" for="formFileMultiple">Pilih Foto</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>NIK</b></label>
                                        <input class="form-control" type="text" value="{{$profil->nik}}" name="nik" readonly>
                                        <input class="form-control" type="text" value="{{$profil->id_karyawan}}" name="id_karyawan" hidden>
                                        <input class="form-control" type="text" value="{{$us->id_user}}" name="id_user" hidden>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-6 col-md-5">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Password</b></label>
                                        <input class="form-control" type="text" value="{{ $us->password}}" name="nama_lengkap">
                                    </div>
                                </div> --}}
                                <div class="col-md-5">
                                    <div class="form-group mb-3">
                                        <label><b>Level User</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="id_level_user">
                                            <option value="{{$us->id_level_user}}">{{$us->nama_level}}</option>
                                            @foreach ($level as $lev )
                                            <option value="{{$lev->id_level_user}}">{{$lev->nama_level}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label><b>Departemen</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="id_departemen">
                                            <option value="{{$us->id_departemen}}">{{$us->nama_departemen}}</option>
                                            @foreach ($departemen as $dep )
                                            <option value="{{$dep->id_departemen}}">{{$dep->nama_departemen}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-8">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Nama Lengkap</b></label>
                                        <input class="form-control" type="text" value="{{$profil->nama_lengkap}}" name="nama_lengkap">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Email</b></label>
                                        <input class="form-control" type="text" value="{{$us->email}}" name="email">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group mb-3">
                                        <label><b>Jabatan</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="id_jabatan">
                                            <option value="{{$profil->id_jabatan}}">{{$profil->nama_jabatan}}</option>
                                            @foreach ($jabatan as $jab )
                                            <option value="{{$jab->id_jabatan}}">{{$jab->nama_jabatan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group mb-3">
                                        <label><b>Zona</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="id_zona">
                                            <option value="{{$profil->id_zona}}">{{$profil->nama_zona}}</option>
                                            @foreach ($zona as $zon )
                                            <option value="{{$zon->id_zona}}">{{$zon->nama_zona}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group mb-3">
                                        <label><b>Regu</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="id_regu">
                                            <option value="{{$profil->id_regu}}">{{$profil->nama_regu}}</option>
                                            @foreach ($regu as $reg )
                                            <option value="{{$reg->id_regu}}">{{$reg->nama_regu}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>PT</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="pt">
                                            <option>{{$profil->pt}}</option>
                                            <option value="PG">PG</option>
                                            <option value="FJM">FJM</option>
                                            <option value="AJG">AJG</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>No KIB</b></label>
                                        <input class="form-control" type="text" value="{{$profil->no_kib}}" name="no_kib">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label><b>Tanggal Lahir</b></label>
                                        <input class="datepicker-here form-control" type="text" name="tgl_lahir"
                                            value="{{$profil->tgl_lahir}}" data-language="en"
                                            data-original-title="" title=""> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Alamat</b></label>
                                        <input class="form-control" type="text" value="{{$profil->alamat}}" name="alamat">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>RT/RW</b></label>
                                        <input class="form-control" type="text" value="{{$profil->rtrw}}" name="rtrw">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Desa</b></label>
                                        <input class="form-control" type="text" value="{{$profil->desa}}" name="desa">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Kecamatan</b></label>
                                        <input class="form-control" type="text" value="{{$profil->kecamatan}}" name="kecamatan">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Kabupaten</b></label>
                                        <input class="form-control" type="text" value="{{$profil->kabupaten}}" name="kabupaten">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>No Hp</b></label>
                                        <input class="form-control" type="number" value="{{$profil->no_hp}}" name="no_hp">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>No KTP</b></label>
                                        <input class="form-control" type="number" value="{{$profil->no_ktp}}" name="no_ktp">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Kompetensi Gada</b></label>
                                        <input class="form-control" type="text" value="{{$profil->kompetensi_gada}}" name="kompetensi_gada">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>No Reg</b></label>
                                        <input class="form-control" type="text" value="{{$profil->no_reg}}" name="no_reg">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>No KTA</b></label>
                                        <input class="form-control" type="text" value="{{$profil->no_kta}}" name="no_kta">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>No Ijazah</b></label>
                                        <input class="form-control" type="text" value="{{$profil->no_ijazah}}" name="no_ijazah">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><b>Tanggal Jatuh Tempo Gada</b></label>
                                        <input class="datepicker-here form-control" type="text" name="tgl_jatuhtempo_gada"
                                            value="{{$profil->tgl_jatuhtempo_gada}}" data-language="en"
                                            data-original-title="" title=""> </div>
                                </div>
                            </div>

                            @elseif(Auth::user()->id_level_user == '12')
                            <div class="row mb-3">
                                <div class="col-md-12 mb-6">
                                    <label class="col-form-label">Ganti Foto</label>
                                    <div class="col-md-12">
                                        <input type="file" class="custom-file-input" name="foto" id="inputGroupFile01">
                                        <input class="form-control" type="text" value="{{$us->foto}}" name="foto_profil" hidden>
                                        <label class="custom-file-label" for="formFileMultiple">Pilih Foto</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>NIK</b></label>
                                        <input class="form-control" type="text" value="{{$profil->nik}}" name="nik" readonly>
                                        <input class="form-control" type="text" value="{{$profil->id_karyawan}}" name="id_karyawan" hidden>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-6 col-md-5">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Password</b></label>
                                        <input class="form-control" type="text" value="{{ $us->password}}" name="nama_lengkap">
                                    </div>
                                </div> --}}
                                <div class="col-md-5">
                                    <div class="form-group mb-3">
                                        <label><b>Level User</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="id_level_user">
                                            <option value="{{$us->id_level_user}}">{{$us->nama_level}}</option>
                                            @foreach ($level as $lev )
                                            <option value="{{$lev->id_level_user}}">{{$lev->nama_level}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label><b>Departemen</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="id_departemen">
                                            <option value="{{$us->id_departemen}}">{{$us->nama_departemen}}</option>
                                            @foreach ($departemen as $dep )
                                            <option value="{{$dep->id_departemen}}">{{$dep->nama_departemen}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-8">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Nama Lengkap</b></label>
                                        <input class="form-control" type="text" value="{{$profil->nama_lengkap}}" name="nama_lengkap">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Email</b></label>
                                        <input class="form-control" type="text" value="{{$us->email}}" name="email">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group mb-3">
                                        <label><b>Jabatan</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="id_jabatan">
                                            <option value="{{$profil->id_jabatan}}">{{$profil->nama_jabatan}}</option>
                                            @foreach ($jabatan as $jab )
                                            <option value="{{$jab->id_jabatan}}">{{$jab->nama_jabatan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group mb-3">
                                        <label><b>Zona</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="id_zona">
                                            <option value="{{$profil->id_zona}}">{{$profil->nama_zona}}</option>
                                            @foreach ($zona as $zon )
                                            <option value="{{$zon->id_zona}}">{{$zon->nama_zona}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group mb-3">
                                        <label><b>Regu</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="id_regu">
                                            <option value="{{$profil->id_regu}}">{{$profil->nama_regu}}</option>
                                            @foreach ($regu as $reg )
                                            <option value="{{$reg->id_regu}}">{{$reg->nama_regu}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>PT</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="pt">
                                            <option>{{$profil->pt}}</option>
                                            <option value="PG">PG</option>
                                            <option value="FJM">FJM</option>
                                            <option value="AJG">AJG</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>No KIB</b></label>
                                        <input class="form-control" type="text" value="{{$profil->no_kib}}" name="no_kib">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label><b>Tanggal Lahir</b></label>
                                        <input class="datepicker-here form-control" type="text" name="tgl_lahir"
                                            value="{{$profil->tgl_lahir}}" data-language="en"
                                            data-original-title="" title=""> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Alamat</b></label>
                                        <input class="form-control" type="text" value="{{$profil->alamat}}" name="alamat">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>RT/RW</b></label>
                                        <input class="form-control" type="text" value="{{$profil->rtrw}}" name="rtrw">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Desa</b></label>
                                        <input class="form-control" type="text" value="{{$profil->desa}}" name="desa">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Kecamatan</b></label>
                                        <input class="form-control" type="text" value="{{$profil->kecamatan}}" name="kecamatan">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Kabupaten</b></label>
                                        <input class="form-control" type="text" value="{{$profil->kabupaten}}" name="kabupaten">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>No Hp</b></label>
                                        <input class="form-control" type="number" value="{{$profil->no_hp}}" name="no_hp">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>No KTP</b></label>
                                        <input class="form-control" type="number" value="{{$profil->no_ktp}}" name="no_ktp">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Kompetensi Gada</b></label>
                                        <input class="form-control" type="text" value="{{$profil->kompetensi_gada}}" name="kompetensi_gada">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>No Reg</b></label>
                                        <input class="form-control" type="text" value="{{$profil->no_reg}}" name="no_reg">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>No KTA</b></label>
                                        <input class="form-control" type="text" value="{{$profil->no_kta}}" name="no_kta">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>No Ijazah</b></label>
                                        <input class="form-control" type="text" value="{{$profil->no_ijazah}}" name="no_ijazah">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><b>Tanggal Jatuh Tempo Gada</b></label>
                                        <input class="datepicker-here form-control" type="text" name="tgl_jatuhtempo_gada"
                                            value="{{$profil->tgl_jatuhtempo_gada}}" data-language="en"
                                            data-original-title="" title=""> </div>
                                </div>
                            </div>

                            @else
                            <div class="row mb-3">
                                <div class="col-md-12 mb-6">
                                    <label class="col-form-label">Ganti Foto</label>
                                    <div class="col-md-12">
                                        <input type="file" class="custom-file-input" name="foto" id="inputGroupFile01">
                                        <input class="form-control" type="text" value="{{$profil->foto}}" name="foto_profil" hidden>
                                        <label class="custom-file-label" for="formFileMultiple">Pilih Foto</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>NIK</b></label>
                                        <input class="form-control" type="text" value="{{$profil->nik}}" name="nik" readonly>
                                        <input class="form-control" type="text" value="{{$profil->id_karyawan}}" name="id_karyawan" hidden>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-6 col-md-5">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Password</b></label>
                                        <input class="form-control" type="text" value="{{ $us->password}}" name="nama_lengkap">
                                    </div>
                                </div> --}}
                                <div class="col-md-5">
                                    <div class="form-group mb-3">
                                        <label><b>Level User</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="id_level_user" disabled="true">
                                            <option value="{{$us->id_level_user}}">{{$us->nama_level}}</option>
                                            @foreach ($level as $lev )
                                            <option value="{{$lev->id_level_user}}">{{$lev->nama_level}}</option>
                                            @endforeach
                                        </select>
                                        <input class="form-control" type="text" value="{{$us->id_level_user}}" name="id_level_user" hidden>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label><b>Departemen</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="id_departemen" disabled="true">
                                            <option value="{{$us->id_departemen}}">{{$us->nama_departemen}}</option>
                                            @foreach ($departemen as $dep )
                                            <option value="{{$dep->id_departemen}}">{{$dep->nama_departemen}}</option>
                                            @endforeach
                                        </select>
                                        <input class="form-control" type="text" value="{{$us->id_departemen}}" name="id_departemen" hidden>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-8">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Nama Lengkap</b></label>
                                        <input class="form-control" type="text" value="{{$profil->nama_lengkap}}" name="nama_lengkap">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Email</b></label>
                                        <input class="form-control" type="text" value="{{$us->email}}" name="email">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group mb-3">
                                        <label><b>Jabatan</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="id_jabatan" disabled="true">
                                            <option value="{{$profil->id_jabatan}}">{{$profil->nama_jabatan}}</option>
                                            @foreach ($jabatan as $jab )
                                            <option value="{{$jab->id_jabatan}}">{{$jab->nama_jabatan}}</option>
                                            @endforeach
                                        </select>
                                        <input class="form-control" type="text" value="{{$profil->id_jabatan}}" name="id_jabatan" hidden>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group mb-3">
                                        <label><b>Zona</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="id_zona" disabled="true">
                                            <option value="{{$profil->id_zona}}">{{$profil->nama_zona}}</option>
                                            @foreach ($zona as $zon )
                                            <option value="{{$zon->id_zona}}">{{$zon->nama_zona}}</option>
                                            @endforeach
                                        </select>
                                        <input class="form-control" type="text" value="{{$profil->id_zona}}" name="id_zona" hidden>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group mb-3">
                                        <label><b>Regu</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="id_regu" disabled="true">
                                            <option value="{{$profil->id_regu}}">{{$profil->nama_regu}}</option>
                                            @foreach ($regu as $reg )
                                            <option value="{{$reg->id_regu}}">{{$reg->nama_regu}}</option>
                                            @endforeach
                                        </select>
                                        <input class="form-control" type="text" value="{{$profil->id_regu}}" name="id_regu" hidden>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>PT</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="pt">
                                            <option>{{$profil->pt}}</option>
                                            <option value="PG">PG</option>
                                            <option value="FJM">FJM</option>
                                            <option value="AJG">AJG</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>No KIB</b></label>
                                        <input class="form-control" type="text" value="{{$profil->no_kib}}" name="no_kib">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label><b>Tanggal Lahir</b></label>
                                        <input class="datepicker-here form-control" type="text" name="tgl_lahir"
                                            value="{{$profil->tgl_lahir}}" data-language="en"
                                            data-original-title="" title=""> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Alamat</b></label>
                                        <input class="form-control" type="text" value="{{$profil->alamat}}" name="alamat">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>RT/RW</b></label>
                                        <input class="form-control" type="text" value="{{$profil->rtrw}}" name="rtrw">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Desa</b></label>
                                        <input class="form-control" type="text" value="{{$profil->desa}}" name="desa">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Kecamatan</b></label>
                                        <input class="form-control" type="text" value="{{$profil->kecamatan}}" name="kecamatan">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Kabupaten</b></label>
                                        <input class="form-control" type="text" value="{{$profil->kabupaten}}" name="kabupaten">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>No Hp</b></label>
                                        <input class="form-control" type="number" value="{{$profil->no_hp}}" name="no_hp">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>No KTP</b></label>
                                        <input class="form-control" type="number" value="{{$profil->no_ktp}}" name="no_ktp">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>Kompetensi Gada</b></label>
                                        <input class="form-control" type="text" value="{{$profil->kompetensi_gada}}" name="kompetensi_gada">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>No Reg</b></label>
                                        <input class="form-control" type="text" value="{{$profil->no_reg}}" name="no_reg">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>No KTA</b></label>
                                        <input class="form-control" type="text" value="{{$profil->no_kta}}" name="no_kta">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><b>No Ijazah</b></label>
                                        <input class="form-control" type="text" value="{{$profil->no_ijazah}}" name="no_ijazah">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><b>Tanggal Jatuh Tempo Gada</b></label>
                                        <input class="datepicker-here form-control" type="text" name="tgl_jatuhtempo_gada"
                                            value="{{$profil->tgl_jatuhtempo_gada}}" data-language="en"
                                            data-original-title="" title=""> </div>
                                </div>
                            </div>
                            @endif

                            {{-- <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0">
                                        <button class="btn btn-primary  mr-3" type="submit">Kirim</button>
                                        <a class="btn btn-danger" href="#">Batal</a>
                                    </div>
                                </div>
                            </div> --}}
                        <div class="form-footer">
                            <button class="btn btn-primary btn-block" type="submit" data-original-title="Edit">Edit Profil</button>
                        </div>
                        </form>


                        <!-- DELETE MODAL -->
                        <div id="edit" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="fill-danger-modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content modal-filled bg-info">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="fill-danger-modalLabel">Konfirmasi Edit Data</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Edit Data Master Profile</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                        <a href="{{route('profile_edit', $us->id_user)}}"
                                            class="btn btn-outline-light">Edit Profil
                                        </a>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
                        <!-- AKHIR DELETE MODAL -->
                </div>
            </div>
        </div>


        @endforeach

        @endforeach

    </div>
</div>
</div>



@endsection

@section('script')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
@endsection
