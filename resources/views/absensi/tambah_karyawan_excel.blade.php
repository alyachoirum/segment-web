@extends('main')

@section('judul')
Tambah Karyawan Import Excel
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Tambah Data</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{route('data_karyawan')}}">Data Karyawan</a></li>
                    <li class="breadcrumb-item">Tambah Data Karyawan</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-14 col-xl-4">
            <div class="ribbon-wrapper card">
                <div class="card-body">
                    <div class="ribbon ribbon-clip ribbon-primary">1 | Download File Berikut</div>
                    <p>Download file dibawah ini sesuaikan dengan isian field tabel.</p>
                </div>
                <a style="text-align: center" href="{{ asset('assets/file_import/import_excel_karyawan.xlsx')}}"
                    download="file_import_excel.xlsx">
                    <button style="text-align: center" class="btn btn-pill btn-primary" type="button"
                        data-original-title="" title="">Download</button></a>
                <br>
            </div>
        </div>
        <div class="col-sm-14 col-xl-4">
            <div class="ribbon-wrapper card">
                <div class="card-body">
                    <div class="ribbon ribbon-clip ribbon-primary">2 | Edit Sesuai Field Tabel</div>
                    <p>Edit file excel tersebut dimulai dari baris ke 2.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-14 col-xl-4">
            <div class="ribbon-wrapper card">
                <div class="card-body">
                    <div class="ribbon ribbon-clip ribbon-primary">3 | Upload File</div>
                    <p>Sebelum upload file pastikan isian sudah tepat dan tidak ada yang tertinggal dan salah.</p>
                    <form action="">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="export_file" id="inputGroupFile01"
                                data-original-title="" title="">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>

                </div>
                <button style="text-align: center" type="submit" class="btn btn-pill btn-primary" data-original-title=""
                    title="">Upload</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Karyawan</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('tambah_data_karyawan')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form theme-form">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>NIK</b></label>
                                        <input class="form-control" type="text" placeholder="Nomor Induk Karyawan" name="nik" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>Email</b></label>
                                        <input class="form-control" type="text" placeholder="Email" name="email" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>Password</b></label>
                                        <input class="form-control" type="password" placeholder="Password" name="password" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>Level User</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="id_level_user" required>
                                            <option value="">Level User</option>
                                            @foreach ($level as $lev )
                                            <option value="{{$lev->id_level_user}}">{{$lev->nama_level}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>Departemen</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="id_departemen" required>
                                            <option value="">Departemen</option>
                                            @foreach ($departemen as $dep )
                                            <option value="{{$dep->id_departemen}}">{{$dep->nama_departemen}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>Nama Lengkap</b></label>
                                        <input class="form-control" type="text" placeholder="Nama Lengkap" name="nama_lengkap" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="custom-file-label" for="inputGroupFile01">Pilih Foto</label>
                                        <input type="file" class="custom-file-input" name="foto" id="inputGroupFile01" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>Zona</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="id_zona" required>
                                            <option value="">Zona</option>
                                            @foreach ($zona as $zon )
                                            <option value="{{$zon->id_zona}}">{{$zon->nama_zona}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>Regu</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="id_regu" required>
                                            <option value="">Regu</option>
                                            @foreach ($regu as $reg )
                                            <option value="{{$reg->id_regu}}">{{$reg->nama_regu}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>Jabatan</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="id_jabatan" required>
                                            <option value="">Jabatan</option>
                                            @foreach ($jabatan as $jab )
                                            <option value="{{$jab->id_jabatan}}">{{$jab->nama_jabatan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>PT</b></label>
                                        <select class="js-example-basic-single col-sm-12" name="pt" required>
                                            <option value="">PT</option>
                                            <option value="PG">PT. Petrokimia Gresik</option>
                                            <option value="FJM">PT. Fokus Jasa Mitra</option>
                                            <option value="AJG">PT. Aneka Jasa Grhadika</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>No KIB</b></label>
                                        <input class="form-control" type="text" placeholder="No KIB" name="no_kib">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>Tanggal Lahir</b></label>
                                        <input autocomplete="off" class="datepicker-here form-control" name="tgl_lahir" type="text"
                                        placeholder="Tanggal Lahir" data-language="en" data-original-title="" title="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label><b>Alamat</b></label>
                                        <input class="form-control" type="text" placeholder="Alamat Lengkap" name="alamat">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>RT/RW</b></label>
                                        <input class="form-control" type="text" placeholder="RT/RW" name="rtrw">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>Desa</b></label>
                                        <input class="form-control" type="text" placeholder="Desa" name="desa">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>Kecamatan</b></label>
                                        <input class="form-control" type="text" placeholder="Kecamatan" name="kecamatan">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>Kabupaten</b></label>
                                        <input class="form-control" type="text" placeholder="Kabupaten" name="kabupaten">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>No Hp</b></label>
                                        <input class="form-control" type="number" placeholder="No Hp" name="no_hp">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>No KTP</b></label>
                                        <input class="form-control" type="number" placeholder="No KTP" name="no_ktp">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>Kompetensi Gada</b></label>
                                        <input class="form-control" type="text" placeholder="Kompetensi Gada" name="kompetensi_gada">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>No Reg</b></label>
                                        <input class="form-control" type="text" placeholder="No Registrasi" name="no_reg">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>No KTA</b></label>
                                        <input class="form-control" type="text" placeholder="No KTA" name="no_kta">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>No Ijazah</b></label>
                                        <input class="form-control" type="text" placeholder="No Ijazah" name="no_ijazah">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><b>Tanggal Jatuh Tempo Gada</b></label>
                                        <input autocomplete="off" class="datepicker-here form-control" type="text" name="tgl_jatuhtempo_gada"
                                        placeholder="Tanggal Jatuh Tempo" data-language="en" data-original-title="" title="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-primary mr-3" href="">Tambah</button>
                                    {{-- <a class="btn btn-danger" href="">Batal</a> --}}
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

@endsection
