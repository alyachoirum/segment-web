@extends('main')

@section('link')
<!-- leaflet css  -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />

<!-- leaflet js  -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
@endsection

@section('judul')
Form Keluar
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-2">
                <h3>Form Keluar</h3>
            </div>
            <div class="col-10">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('data_karyawan')}}">Menu Karyawan</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('kehadiran')}}">Kehadiran</a>
                    </li>
                    <li class="breadcrumb-item">Form Keluar</li>
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
                        @php
                            $datenow = date('d F Y');
                        @endphp
                        <div class="col-md-8">
                            <h5>Absensi {{ $datenow }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th width="100px" style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getinnow as $value)
                                @php
                                    $date = date_create($value->check_in);

                                    $currentDateTime = date('H:i:s');
                                    $datenows = date_format($date, 'd F Y H:i:s');
                                    $tgl_sekarang = date_format($date, 'd');
                                @endphp

                                <tr>
                                    <td>{{ $value->nik }}</td>
                                    <td>{{ $value->karyawans->nama_lengkap }}</td>
                                    <td>{{ $datenows }}</td>
                                    @if ($jadwal->action=="M")
                                        @if ($jadwal->tanggal == $tgl_sekarang)
                                            <td>{{$jadwal->tanggal+1}} {{ date("F", strtotime($datenows))}} {{$jadwal->tahun}} {{$jadwal->jam_keluar}}</td>
                                        @else
                                            <td>{{$jadwal->tanggal}} {{ date("F", strtotime($datenows))}} {{$jadwal->tahun}} {{$jadwal->jam_keluar}}</td>
                                        @endif
                                    @else
                                        <td>{{$jadwal->tanggal}} {{ date("F", strtotime($datenows))}} {{$jadwal->tahun}} {{$jadwal->jam_keluar}}</td>
                                    @endif

                                    @if ($currentDateTime >= $jadwal->jam_keluar)
                                        <td width="100px" style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('check_out', $value->id_presensi) }}" class="btn btn-danger">Check Out</a>
                                            </div>
                                        </td>
                                    @else
                                        <td width="100px" style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button class="btn btn-danger" disabled>Check Out</button>
                                            </div>
                                        </td>
                                    @endif

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Form Keluar</h5>
                </div>
                <div class="card-body">
                    <div class="form theme-form">
                        <div class="row">
                            <div class="col">
                                <label>{{ __('NIK') }}</label>
                                <div class="form-group">
                                    <select class="js-example-basic-single col-sm-12" id="nik">
                                        <option value="">Pilih NIK Nama Karyawan</option>
                                        @foreach ($data_kar as $kar )
                                            <option value="{{ $kar->id_karyawan }}">{{ $kar->nik }} | {{ $kar->nama_lengkap }}</option>
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
                                    <label>Nama</label>
                                    <input class="form-control" type="text" placeholder="Nama Lengkap" id="nama" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Regu</label>
                                    <input class="form-control" type="text" placeholder="Nama Regu" id="regu" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Zona</label>
                                    <input class="form-control" type="text" placeholder="Zona Kerja" id="zona" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label>Jadwal Kerja</label>
                                    <input class="form-control" type="text" placeholder="Jadwal Kerja" id="jadwal" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <input class="form-control" type="text" placeholder="Jabatan" id="jabatan" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input class="form-control" type="text" placeholder="Alamat" id="alamat" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>No Hp</label>
                                    <input class="form-control" type="text" placeholder="No HP" id="no_hp" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>No KTP</label>
                                    <input class="form-control" type="text" placeholder="No KTP" id="no_ktp" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-xl-12">
                                <div class="card">
                                    <div id="mapid" style="height: 520px; z-index: 0;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4" style="text-align: center">
                                <button onclick=fullScreenview() class="btn btn-pill btn-primary" type="button"
                                    title="">F U L L S C R E E N</button>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0">
                                    <a class="btn btn-primary  mr-3" href="#">Kirim</a>
                                    <a class="btn btn-danger" href="#">Batal</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>

@endsection

@section('script')

<script type="text/javascript">
        $(document).ready(function(){
            $( "#nik" ).change(function (e){
                console.log('TES')
                var id_karyawan = $(this).val();
                console.log(id_karyawan);

                $.ajax({
                    url: '{{ url("data_autofield") }}/'+id_karyawan,
                    type: 'GET',
                    dataType: 'json',
                    success: function( data ) {
                        console.log(data);
                        $('#nama').val(data.nama_lengkap);
                        $('#regu').val(data.regu.nama_regu);
                        $('#zona').val(data.zona.nama_zona);
                        $('#jadwal').val('S');
                        $('#jabatan').val(data.jabatan.nama_jabatan);
                    }
                });
            });
        });
</script>

<script type="text/javascript">
        $(document).ready(function(){
            $( "#nik" ).change(function (e){
                console.log('TES')
                var id_karyawan = $(this).val();
                console.log(id_karyawan);

                $.ajax({
                    url: '{{ url("data_autofield") }}/'+id_karyawan,
                    type: 'GET',
                    dataType: 'json',
                    success: function( data ) {
                        console.log(data);
                        $('#nama').val(data.nama_lengkap);
                        $('#regu').val(data.regu.nama_regu);
                        $('#zona').val(data.zona.nama_zona);
                        $('#jadwal').val('S');
                        $('#jabatan').val(data.jabatan.nama_jabatan);
                        $('#alamat').val(data.alamat);
                        $('#no_hp').val(data.no_hp);
                        $('#no_ktp').val(data.no_ktp);
                        $('#foto').attr('src', "{{ asset('assets/foto_profil') }}/"+data.user.foto);
                    }
                });
            });
        });
</script>

<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
<script>
    // set lokasi latitude dan longitude, lokasinya kota palembang
    var mymap = L.map('mapid').setView([-7.145191, 112.643103], 14);
    mymap.zoomControl.setPosition('topright');

    var mapId = document.getElementById('mapid')

    function fullScreenview() {
        mapId.requestFullscreen();
    }


    //setting maps menggunakan api mapbox bukan google maps, daftar dan dapatkan token
    L.tileLayer(
        'https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: ''
        }).addTo(mymap);

    L.control.scale({
        position: 'bottomright'
    }).addTo(mymap);

    var kawasan = L.polygon([
        [-7.157055, 112.638956],
        [-7.157385, 112.639545],
        [-7.157557, 112.640709],
        [-7.157587, 112.641007],
        [-7.152356, 112.642082],
        [-7.152584, 112.643284],
        [-7.15326, 112.643139],
        [-7.153736, 112.644655],
        [-7.154291, 112.644558],
        [-7.154397, 112.645164],
        [-7.152611, 112.645567],
        [-7.153067, 112.647855],
        [-7.152796, 112.64793],
        [-7.152913, 112.648461],
        [-7.153179, 112.648258],
        [-7.153894, 112.648201],
        [-7.156337, 112.647564],
        [-7.157013, 112.647956],
        [-7.160324, 112.645972],
        [-7.159075, 112.643907],
        [-7.160935, 112.642851],
        [-7.159434, 112.641685],
        [-7.163402, 112.639488],
        [-7.162564, 112.638986],
        [-7.162633, 112.638019],
        [-7.161829, 112.63715],
        [-7.161505, 112.636405],
        [-7.161659, 112.635759],
        [-7.161781, 112.635008],
        [-7.160717, 112.634257],
        [-7.157351, 112.638764]
    ], {
        color: 'yellow',
        fillColor: 'yellow',
        fillOpacity: 0.4,
    }).addTo(mymap);

    var kawasan2 = L.polygon([
        [-7.151081, 112.636195],
        [-7.149264, 112.636527],
        [-7.149072, 112.63479],
        [-7.150692, 112.63444],
        [-7.151918, 112.634547],
        [-7.15277, 112.634365],
        [-7.152589, 112.633507],
        [-7.154523, 112.634097],
        [-7.154746, 112.635449]
    ], {
        color: 'yellow',
        fillColor: 'yellow',
        fillOpacity: 0.1,
    }).addTo(mymap);

    var kawasan3 = L.polygon([
        [-7.143503, 112.625983],
        [-7.142518, 112.625285],
        [-7.141957, 112.624009],
        [-7.143509, 112.624143],
        [-7.144243, 112.625694]
    ], {
        color: 'yellow',
        fillColor: 'yellow',
        fillOpacity: 0.1,
    }).addTo(mymap);

    var zona1 = L.polygon([
        [-7.157055, 112.638956],
        [-7.157385, 112.639545],
        [-7.157557, 112.640709],
        [-7.15629, 112.641021],
        [-7.155942, 112.640133],
        [-7.151499, 112.641025],
        [-7.151605, 112.64162],
        [-7.150322, 112.641878],
        [-7.149714, 112.641245],
        [-7.148532, 112.636803],
        [-7.155795, 112.635199]
    ], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.1,
    }).addTo(mymap);

    var zona2 = L.polygon([
        [-7.148821, 112.639376],
        [-7.149928, 112.642337],
        [-7.149385, 112.642526],
        [-7.147969, 112.644586],
        [-7.146902, 112.646837],
        [-7.146615, 112.648007],
        [-7.146087, 112.649301],
        [-7.145679, 112.651022],
        [-7.144604, 112.650937],
        [-7.144456, 112.657113],
        [-7.144062, 112.657167],
        [-7.144062, 112.652596],
        [-7.14221, 112.650122],
        [-7.143083, 112.647633],
        [-7.142301, 112.647223],
        [-7.142215, 112.64683],
        [-7.144601, 112.641786],
        [-7.145484, 112.64214],
        [-7.146336, 112.640326],
        [-7.147735, 112.641229],

    ], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.1,
    }).addTo(mymap);

    var zona3 = L.polygon([
        [-7.142301, 112.647223],
        [-7.142215, 112.64683],
        [-7.144601, 112.641786],
        [-7.145484, 112.64214],
        [-7.146336, 112.640326],
        [-7.147735, 112.641229],
        [-7.14621, 112.638139],
        [-7.145076, 112.637743],
        [-7.141584, 112.639009],
        [-7.140334, 112.642032],


    ], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.1,
    }).addTo(mymap);

    var zona4 = L.polygon([
        [-7.138191, 112.640413],
        [-7.138489, 112.641572],
        [-7.140334, 112.642032],
        [-7.142301, 112.647223],
        [-7.143083, 112.647633],
        [-7.14221, 112.650122],
        [-7.139979, 112.654661],
        [-7.132831, 112.654817],
        [-7.137985, 112.640283]




    ], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.1,
    }).addTo(mymap);

    var tuks = L.polygon([
        [-7.144158, 112.656909],
        [-7.144435, 112.656898],
        [-7.144403, 112.659162],
        [-7.146336, 112.659886],
        [-7.146166, 112.660251],
        [-7.139392, 112.657202],
        [-7.139552, 112.65688],
        [-7.144123, 112.659003]
    ], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.1,
    }).addTo(mymap);

    var zona5 = L.polygon([
        [-7.143094, 112.632051],
        [-7.137525, 112.635374],
        [-7.138164, 112.639089],
        [-7.132392, 112.655264],
        [-7.126431, 112.652475],
        [-7.133287, 112.634493],
        [-7.135074, 112.631213],
        [-7.136384, 112.630194],
        [-7.137139, 112.630751],
        [-7.137865, 112.630025],
        [-7.138259, 112.62929],
        [-7.140304, 112.628285],
        [-7.140994, 112.629413],
        [-7.141981, 112.628989],
        [-7.142901, 112.630887],
        [-7.142625, 112.631202]
    ], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.1,
    }).addTo(mymap);

    var pagsari = L.circle([-7.307213, 112.708989], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.2,
        radius: 100
    }).addTo(mymap);

    var kandangan = L.circle([-7.253174, 112.655651], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.2,
        radius: 100
    }).addTo(mymap);

    var ews = L.circle([-7.219081, 112.655771], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.2,
        radius: 100
    }).addTo(mymap);

    var pababat = L.circle([-7.088484, 112.196959], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.2,
        radius: 100
    }).addTo(mymap);

    var bplamongan = L.circle([-7.109364, 112.410687], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.2,
        radius: 100
    }).addTo(mymap);

    var masjid = L.circle([-7.158817, 112.642303], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.2,
        radius: 100
    }).addTo(mymap);

    L.control.scale({
        position: 'bottomright'
    }).addTo(mymap);

    var popup = L.popup();

    // buat fungsi popup saat map diklik
    function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent("Koordinatnya : " + e.latlng
                .toString()
            ) //set isi konten yang ingin ditampilkan, kali ini kita akan menampilkan latitude dan longitude
            .openOn(mymap);
        var latlng = document.getElementById('latlong').value = e
            .latlng;
        document.getElementById('lat').value = latlng.lat;
        document.getElementById('lng').value = latlng.lng;
        console.log(latlng);
        //value pada form latitde, longitude akan berganti secara otomatis
    }
    mymap.on('click', onMapClick); //jalankan fungsi
</script>

{{-- <script>
    // set lokasi latitude dan longitude, lokasinya kota palembang
    var mymap = L.map('mapid').setView([-7.156819, 112.6402522], 17);
    //setting maps menggunakan api mapbox bukan google maps, daftar dan dapatkan token
    L.tileLayer(
        'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibmFiaWxjaGVuIiwiYSI6ImNrOWZzeXh5bzA1eTQzZGxpZTQ0cjIxZ2UifQ.1YMI-9pZhxALpQ_7x2MxHw', {
            attribution: '',
            maxZoom: 20,
            id: 'mapbox/streets-v11', //menggunakan peta model streets-v11 kalian bisa melihat jenis-jenis peta lainnnya di web resmi mapbox
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'your.mapbox.access.token'
        }).addTo(mymap);

    var popup = L.popup();

    // buat fungsi popup saat map diklik
    function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent("Koordinatnya : " + e.latlng
                .toString()
            ) //set isi konten yang ingin ditampilkan, kali ini kita akan menampilkan latitude dan longitude
            .openOn(mymap);
        var latlng = document.getElementById('latlong').value = e
            .latlng;
        document.getElementById('lat').value = latlng.lat;
        document.getElementById('lng').value = latlng.lng;
        console.log(latlng);
        //value pada form latitde, longitude akan berganti secara otomatis
    }
    mymap.on('click', onMapClick); //jalankan fungsi
</script> --}}
@endsection
