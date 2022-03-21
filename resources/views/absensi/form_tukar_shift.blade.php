@extends('main')

@section('judul')
Form Tukar Shift
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-3">
                <h3>Form Tukar Shift</h3>
            </div>
            <div class="col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('data_karyawan')}}">Menu Karyawan</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('kehadiran')}}">Kehadiran</a>
                    </li>
                    <li class="breadcrumb-item">Form Tukar Shift</li>
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
                    <h5>Form Tukar Shift</h5>
                </div>

                <div class="card-body">
                    <form action="{{route('tukar_shift_submit')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form theme-form">
                            <div class="row">
                                <div class="col">
                                    <h5><b>Pihak 1</b> <i>[yang mengajukan]</i></h5>
                                </div>
                            </div>
                            <br>
                            <br>

                            <div class="row">
                                <div class="col mb-3">
                                    <label>{{ __('NIK') }}</label>
                                    <div class="form-group">
                                        <select class="js-example-basic-single col-sm-12" id="nik1">
                                            <option value="">Pilih NIK Nama Karyawan</option>
                                            @foreach ($data_karyawan_p1 as $kar )
                                            <option value="{{ $kar->id_karyawan }}">{{ $kar->nik }} |
                                                {{ $kar->nama_lengkap }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Tanggal Tukar</label>
                                        <input autocomplete="off" class="datepicker-here form-control" id="tanggal_tukar" name="tgl_tukar"
                                            type="text" placeholder="Tanggal Tukar" data-language="en" data-original-title=""
                                                title="" required>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-5">

                                </div>
                                <div class="col-sm-2 mr-3">
                                    <div class="form-group">
                                        <img class="center" id="foto1" style="height: 250px;" src="" alt=""
                                            data-original-title="" title="">
                                    </div>
                                </div>
                                <div class="col-sm-5">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>NIK</label>
                                        <input class="form-control" type="text" placeholder="NIK" id="niknik1" name="nik_pihak1"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input class="form-control" type="text" placeholder="Nama Lengkap" id="nama1"
                                            name="nama_lengkap_pembuat" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Jadwal Kerja</label>
                                        <input class="form-control" type="text" placeholder="Jadwal Kerja" id="jadwal1"
                                            name="awal_jam_kerja" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Zona</label>
                                        <input class="form-control" type="text" placeholder="Zona Kerja" id="zona1"
                                            name="nama_zona" readonly>
                                        <input class="form-control" type="text" id="id_zona" name="id_zona" hidden>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Regu</label>
                                        <input class="form-control" type="text" placeholder="Nama Regu" id="regu1"
                                            name="nama_regu" readonly>
                                        <input class="form-control" type="text" id="id_regu" name="id_regu" hidden>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input class="form-control" type="text" placeholder="Jabatan" id="jabatan1"
                                            readonly>
                                        <input class="form-control" type="text" id="id_jabatan" name="id_jabatan" hidden>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Validasi KARU / KAJAGA</label>
                                        <input class="form-control" type="text" placeholder="Validasi KARU / Kajaga" id="direct_jab_atasan1" name="apv_kajaga_p1" readonly>
                                        <input class="form-control" type="text" placeholder="Validasi KARU / Kajaga" id="nik_kajaga_pihak1" name="nik_kajaga_pihak1" hidden>
                                        <input class="form-control" type="text" id="id_user_penerima_2" name="id_user_penerima_2" hidden>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <br>

                            <hr>

                            <div class="row">
                                <div class="col">
                                    <h5><b>Pihak 2</b> <i>[yang menerima]</i></h5>
                                </div>
                            </div>
                            <br>
                            <br>

                            <div class="row">
                                <div class="col">
                                    <label>{{ __('NIK') }}</label>
                                    <div class="form-group">
                                        <select class="js-example-basic-single col-sm-12" id="nik2">
                                            <option value="">Pilih NIK Nama Karyawan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-5">
                                </div>
                                <div class="col-sm-2 mr-3">
                                    <div class="form-group">
                                        <img class="center" id="foto2" style="height: 250px;" src="" alt=""
                                            data-original-title="" title="">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Tanggal Shift yang dapat Ditukar</label>
                                            <input autocomplete="off" class="datepicker-here form-control" id="tgl_can_tukar" name="tgl_can_tukar" type="text"
                                                placeholder="Tanggal Tukar" data-language="en" data-original-title=""
                                                title="" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>NIK</label>
                                        <input class="form-control" type="text" placeholder="NIK" id="niknik2" name="nik_pihak2" readonly>
                                        <input class="form-control" type="text" id="id_user_penerima_1" name="id_user_penerima_1" hidden>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input class="form-control" type="text" placeholder="Nama Lengkap" id="nama2"
                                            name="nama_lengkap" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Jadwal Kerja</label>
                                        <input class="form-control" type="text" placeholder="Jadwal Kerja" id="jadwal2"
                                            name="ubah_jam_kerja" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Zona</label>
                                        <input class="form-control" type="text" placeholder="Zona Kerja" id="zona2"
                                            name="nama_zona" readonly>
                                        <input class="form-control" type="text" id="id_zona" name="id_zona" hidden>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Regu</label>
                                        <input class="form-control" type="text" placeholder="Nama Regu" id="regu2"
                                            name="nama_regu" readonly>
                                        <input class="form-control" type="text" id="id_regu" name="id_regu" hidden>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input class="form-control" type="text" placeholder="Jabatan" id="jabatan2"
                                            readonly>
                                        <input class="form-control" type="text" id="id_jabatan" name="id_jabatan" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Validasi KARU / KAJAGA</label>
                                        <input class="form-control" type="text" placeholder="Validasi KARU / Kajaga" id="direct_jab_atasan2" name="apv_kajaga_p2" readonly>
                                        <input class="form-control" type="text" placeholder="Validasi KARU / Kajaga" id="nik_kajaga_pihak2" name="nik_kajaga_pihak2" hidden>
                                        <input class="form-control" type="text" id="id_user_penerima_3" name="id_user_penerima_3" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0">
                                        <button class="btn btn-primary  mr-3" type="submit">Ajukan</button>
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
    $(document).ready(function(){
        $( "#nik1" ).change(function (e){
            var id_karyawan = $(this).val();
                $.ajax({
                url: '{{ url("data_autofield") }}/'+id_karyawan,
                type: 'POST',
                dataType: 'json',
                success: function( data ) {
                    $('#niknik1').val(data.karyawan.nik);
                    $('#nama1').val(data.karyawan.nama_lengkap);
                    $('#regu1').val(data.karyawan.regu.nama_regu);
                    $('#zona1').val(data.karyawan.zona.nama_zona);
                    $('#id_zona1').val(data.karyawan.id_zona);
                    $('#id_regu1').val(data.karyawan.id_regu);
                    $('#id_jabatan1').val(data.karyawan.id_jabatan);
                    $('#jabatan1').val(data.karyawan.jabatan.nama_jabatan);
                    $('#alamat1').val(data.karyawan.alamat);
                    $('#no_hp1').val(data.karyawan.no_hp);
                    $('#no_ktp1').val(data.karyawan.no_ktp);
                    $('#foto1').attr('src', "{{asset('assets/foto_profil')}}/"+data.karyawan.user.foto);
                    $('#direct_jab_atasan1').val(data.karyawan.jabatan.atasan_1.nama_lengkap);
                    $('#nik_kajaga_pihak1').val(data.karyawan.jabatan.atasan_1.user.nik);
                    $('#id_user_penerima_2').val(data.karyawan.jabatan.atasan_1.user.id_user);
                    $('#id_jab1').val(data.karyawan.jabatan.atasan_1.nik);

                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#tanggal_tukar').datepicker({
            dateFormat: 'dd/mm/yyyy',
            onSelect: function(dateText, inst){
                $.ajax({
                url: '{{ url("get_jadwal_tukar") }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    tanggal_tukar: dateText
                },
                success: function( data ) {
                    var source_shift = data.source;

                    var destination_shift = data.destination;

                    $('#jadwal1').val(`| ${source_shift.action} | ${source_shift.jam_masuk} - ${source_shift.jam_keluar}`)

                    var karyawan_can_swap = data.karyawan_can_swap;
                    $('#nik2').empty().trigger('change');
                    var karyawan_can_swap_for_select2 = karyawan_can_swap.map(function(karyawan){

                        var shift_pick = destination_shift.filter(function(shift){
                            return shift.id_regu == karyawan.id_regu
                        })

                        return {
                            'id' : karyawan.id_karyawan,
                            'text' : karyawan.nik+'|'+karyawan.nama_lengkap,
                            'actionShift' : shift_pick[0].action,
                            'tglShift' : shift_pick[0].tanggal,
                            'blnShift' : shift_pick[0].bulan,
                            'thnShift' : shift_pick[0].tahun,
                            'masukShift' : shift_pick[0].jam_masuk,
                            'pulangShift' : shift_pick[0].jam_keluar,
                        }
                    })

                    console.log(karyawan_can_swap_for_select2)
                    $('#nik2').prepend('<option selected=""></option>').select2({
                        placeholder: 'Pilih NIK atau Karyawan',
                        data: karyawan_can_swap_for_select2
                    }).on('select2:select',function(e){
                        var data = e.params.data;
                        $(this).children('[value="'+data['id']+'"]')
                                .data('actionShift',data['actionShift'])
                                .data('tglShift',data['tglShift'])
                                .data('blnShift',data['blnShift'])
                                .data('thnShift',data['thnShift'])
                                .data('masukShift',data['masukShift'])
                                .data('pulangShift',data['pulangShift'])
                    })

                }
            });
            }
        })

    });
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $( "#nik2" ).change(function (e){
            var id_karyawan = $('#nik2').find(':selected');

            if(typeof id_karyawan.val() !== 'undefined'){
                $.ajax({
                url: '{{ url("data_autofield") }}/'+id_karyawan.val(),
                type: 'POST',
                dataType: 'json',
                success: function( data ) {
                    if(data.karyawan != null){
                    $('#tgl_can_tukar').val(`${id_karyawan.data('tglShift')}/${id_karyawan.data('blnShift')}/${id_karyawan.data('thnShift')}`)
                    $('#niknik2').val(data.karyawan.nik);
                    $('#id_user_penerima_1').val(data.karyawan.user.id_user);
                    $('#nama2').val(data.karyawan.nama_lengkap);
                    $('#regu2').val(data.karyawan.regu.nama_regu);
                    $('#zona2').val(data.karyawan.zona.nama_zona);
                    $('#id_zona2').val(data.karyawan.id_zona);
                    $('#id_regu2').val(data.karyawan.id_regu);
                    $('#id_jabatan2').val(data.karyawan.id_jabatan);
                    $('#jadwal2').val("| " + id_karyawan.data('actionShift') + " | " + id_karyawan.data('masukShift') + " - " + id_karyawan.data('pulangShift'));
                    $('#jabatan2').val(data.karyawan.jabatan.nama_jabatan);
                    $('#alamat2').val(data.karyawan.alamat);
                    $('#no_hp2').val(data.karyawan.no_hp);
                    $('#no_ktp2').val(data.karyawan.no_ktp);
                    $('#foto2').attr('src', "{{asset('assets/foto_profil')}}/"+data.karyawan.user.foto);
                    $('#direct_jab_atasan2').val(data.karyawan.jabatan.atasan_1.nama_lengkap);
                    $('#nik_kajaga_pihak2').val(data.karyawan.jabatan.atasan_1.user.nik);
                    $('#id_user_penerima_3').val(data.karyawan.jabatan.atasan_1.user.id_user);
                    $('#id_jab2').val(data.karyawan.jabatan.atasan_1.nik);
                    }
                }
            });
            }

        });
    });
</script>


<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
@endsection
