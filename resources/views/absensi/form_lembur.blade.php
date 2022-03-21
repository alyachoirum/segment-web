@extends('main')

@section('judul')
Form Lembur
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-2">
                <h3>Form Lembur</h3>
            </div>
            <div class="col-10">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('data_karyawan')}}">Menu Karyawan</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('kehadiran')}}">Kehadiran</a>
                    </li>
                    <li class="breadcrumb-item">Form Lembur</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <h5>Form Lembur</h5>
                        </div>
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-6" style="text-align: right">
                            <p>Total SPL bulan ini yang sudah approve= <b>{{ $total_lembur }}</b></p>
                            <p><i> Maksimal SPL per Bulan adalah 20</i></p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('lembur_submit')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form theme-form">
                            <div class="row">
                                <div class="col">
                                    <label>{{ __('NIK') }}</label>
                                    <div class="form-group">
                                        <select class="js-example-basic-single col-sm-12" id="nik">
                                            <option value="">Pilih NIK Nama Karyawan</option>
                                            @foreach ($data_kar as $kar )
                                            <option value="{{ $kar->id_karyawan }}">{{ $kar->nik }} |
                                                {{ $kar->nama_lengkap }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                </div>
                                <div class="col-sm-2 mr-3">
                                    <div class="form-group">
                                        <img class="center" id="foto" style="height: 250px;" src="" alt=""
                                            data-original-title="" title="">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Tanggal Lembur</label>
                                        <input autocomplete="off" class="datepicker-here form-control" name="tgl_lembur"
                                            type="text" placeholder="Tanggal Lembur " data-language="en"
                                            data-original-title="" title="" required>
                                        {{-- <input type="text" value="Ijin" name="tipe_absen" hidden> --}}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Total Jam Lembur</label>
                                        <input class="form-control" min="1" max="8" type="number" placeholder="Total Jam" id="total_jam_lembur" name="total_jam_lembur"
                                            required>
                                        {{-- <input type="text" value="Ijin" name="tipe_absen" hidden> --}}
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>NIK</label>
                                        <input class="form-control" type="text" placeholder="NIK" id="niknik" name="niknik"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input class="form-control" type="text" placeholder="Nama Lengkap" id="nama"
                                            name="nama_lengkap" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Zona</label>
                                        <input class="form-control" type="text" placeholder="Zona Kerja" id="zona"
                                            name="nama_zona" readonly>
                                        <input class="form-control" type="text" id="id_zona" name="id_zona" hidden>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Regu</label>
                                        <input class="form-control" type="text" placeholder="Nama Regu" id="regu"
                                            name="nama_regu" readonly>
                                        <input class="form-control" type="text" id="id_regu" name="id_regu" hidden>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input class="form-control" type="text" placeholder="Jabatan" id="jabatan" readonly>
                                        <input class="form-control" type="text" id="id_jabatan" name="id_jabatan" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Validasi KARU / KAJAGA</label>
                                        <input class="form-control" type="text" placeholder="Validasi KARU / Kajaga"
                                            id="direct_jab_atasan" name="validasi" readonly>
                                        <input class="form-control" type="text" id="id_user_penerima" name="user_id_penerima" hidden>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Mengetahui KASI</label>
                                        <input class="form-control" type="text" placeholder="Mengetahui KASI"
                                            id="direct_jab_atasan_2" name="mengetahui" readonly>
                                        <input class="form-control" type="text" id="id_regu" name="id_regu" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea4" name="detail"
                                            rows="3" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0">
                                        <button class="btn btn-primary  mr-3" type="submit">Kirim</button>
                                        <a class="btn btn-danger" href="#">Batal</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')


<script type="text/javascript">
    $(document).ready(function () {
        $("#nik").change(function (e) {
            var id_karyawan = $(this).val();
            console.log(id_karyawan);
            $.ajax({
                url: '{{ url("data_autofield") }}/' + id_karyawan,
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    $('#niknik').val(data.karyawan.nik);
                    $('#nama').val(data.karyawan.nama_lengkap);
                    $('#regu').val(data.karyawan.regu.nama_regu);
                    $('#zona').val(data.karyawan.zona.nama_zona);
                    $('#id_zona').val(data.karyawan.id_zona);
                    $('#id_regu').val(data.karyawan.id_regu);
                    $('#id_jabatan').val(data.karyawan.id_jabatan);
                    $('#jadwal').val("| " + data.jadwal.action + " | " + data.jadwal
                        .jam_masuk + " - " + data.jadwal.jam_keluar);
                    $('#jabatan').val(data.karyawan.jabatan.nama_jabatan);
                    $('#alamat').val(data.karyawan.alamat);
                    $('#no_hp').val(data.karyawan.no_hp);
                    $('#no_ktp').val(data.karyawan.no_ktp);
                    $('#direct_jab_atasan').val(data.karyawan.jabatan.atasan_1.nama_lengkap);
                    $('#id_user_penerima').val(data.karyawan.jabatan.atasan_1.user.id_user);
                    $('#direct_jab_atasan_2').val(data.karyawan.jabatan.atasan_2.nama_lengkap);
                    $('#foto').attr('src', "{{asset('assets/foto_profil')}}/" + data.karyawan.user.foto);
                }
            });
        });
    });
</script>

<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>

@endsection
