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
Form Masuk
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-2">
                <h3>Form Masuk</h3>
            </div>
            <div class="col-10">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('data_karyawan')}}">Menu Karyawan</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('kehadiran')}}">Kehadiran</a>
                    </li>
                    <li class="breadcrumb-item">Form Masuk</li>
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
                    <h5>Form Masuk</h5>
                </div>
                {{-- {{ $jadwal->jam_masuk }} --}}
                <div class="card-body">
                    <form action="{{route('check_in')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form theme-form">
                            <div class="row">
                                <div class="col">
                                    <label>{{ __('NIK') }}</label>
                                    <div class="form-group">
                                        <select class="js-example-basic-single col-sm-12" id="nik" name="nik" required>
                                            <option value="">Pilih NIK Nama Karyawan</option>
                                            @foreach ($data_kar as $kar )
                                                <option value="{{ $kar->id_karyawan }}">{{ $kar->nik }} | {{ $kar->nama_lengkap }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <input class="form-control" type="text" id="id_user_penerima" name="user_id_penerima" hidden>

                            <div class="row">
                                <div class="col-sm-4">
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <img class="center ml-5"id="foto" style="height: 250px; text-align:center;" src="" alt=""
                                            data-original-title="" title="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>NIK</label>
                                        <input class="form-control" type="text" placeholder="NIK" id="niknik" name="niknik" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input class="form-control" type="text" placeholder="Nama Lengkap" id="nama" name="nama_lengkap" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Jadwal Kerja</label>
                                        <input class="form-control" type="text" placeholder="Jadwal Kerja" id="jadwal" name="jadwal_kerja" readonly>
                                        <input class="form-control" type="text" id="jam_masuk" name="jam_masuk" hidden>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Zona</label>
                                        <input class="form-control" type="text" placeholder="Zona Kerja" id="zona" name="nama_zona" readonly>
                                        <input class="form-control" type="text" id="id_zona" name="id_zona" hidden>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Regu</label>
                                        <input class="form-control" type="text" placeholder="Nama Regu" id="regu" name="nama_regu" readonly>
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
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input class="form-control" type="text" placeholder="Alamat" id="alamat" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>No Hp</label>
                                        <input class="form-control" type="text" placeholder="No HP" id="no_hp" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>No KTP</label>
                                        <input class="form-control" type="text" placeholder="No KTP" id="no_ktp" readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                {{-- <div class="col-sm-12 col-xl-12">
                                    <div class="card">
                                        <div id="mapid" style="height: 520px; z-index: 0;">
                                        </div>
                                        <input type="text" id="latlong" hidden>
                                    </div>
                                </div>

                                <input type="text" id="lat" name="lat" hidden required>
                                <input type="text" id="lng" name="lng" hidden required>

                                <div class="col-md-12 mb-4" style="text-align: center">
                                    <button onclick=fullScreenview() class="btn btn-pill btn-primary" type="button"
                                        title="">F U L L S C R E E N</button>
                                </div> --}}
                                <div class="col-sm-4 mb-4" >
                                </div>
                                <div class="col-sm-4 mb-4" >
                                    <button class="btn btn-primary ml-5" style="text-align:center" onclick="getLocation()">Gunakan Lokasi Sekarang</button>
                                </div>
                                <div class="col-sm-4 mb-4" >
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-4">
                                    <input autocomplete="off" class="form-control" type="text" id="lt" name="lat" required>
                                </div>
                                <div class="col-sm-4">
                                    <input autocomplete="off" class="form-control" type="text" id="ln" name="lng" required>
                                </div>
                                <div class="col-sm-2">
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0">
                                        <button class="btn btn-primary  mr-3" type="submit">Kirim</button>
                                        <a class="btn btn-danger" href="{{ URL::previous() }}">Batal</a>
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

{{-- <script>
    $('#get_current_location').click(function(){
        if(navigator.geolocation)
            navigator.geolocation.getCurrentPosition(function(position){
                console.log(position);
                $.get( "http://maps.googleapis.com/maps/api/geocode/json?latlng="+ position.coords.latitude + "," + position.coords.longitude +"&sensor=false", function(data) {
                console.log(data);
                })

                var img = new Image();
                img.src = "https://maps.googleapis.com/maps/api/staticmap?center=" + position.coords.latitude + "," + position.coords.longitude + "&zoom=13&size=800x400&sensor=false";
                $('#output').html(img);
            });
        else
            console.log("Geolocation is Not Supported");
    });
</script> --}}

<script>
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    $('#lt').val(position.coords.latitude)
    $('#ln').val(position.coords.longitude)
}

var mymap = L.map('mymap').setView([position.coords.latitude, position.coords.longitude], 14);
    mymap.zoomControl.setPosition('topright');

var mapId = document.getElementById('mymap')

L.tileLayer(
        'https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: ''
        }).addTo(mymap);

L.control.scale({
            position: 'bottomright'
        }).addTo(mymap);

    map.touchZoom.disable();
    map.doubleClickZoom.disable();
    map.scrollWheelZoom.disable();
    map.boxZoom.disable();
    map.keyboard.disable();

var redIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

L.marker([position.coords.latitude, position.coords.longitude], {icon : redIcon}).addTo(map);

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

</script>
<script type="text/javascript">
    $(document).ready(function(){
        $( "#nik" ).change(function (e){
            var id_karyawan = $(this).val();
            console.log(id_karyawan);
            $.ajax({
                url: '{{ url("data_autofield") }}/'+id_karyawan,
                type: 'POST',
                dataType: 'json',
                success: function( data ) {
                    console.log(data);
                    $('#niknik').val(data.karyawan.nik);
                    $('#nama').val(data.karyawan.nama_lengkap);
                    $('#regu').val(data.karyawan.regu.nama_regu);
                    $('#zona').val(data.karyawan.zona.nama_zona);
                    $('#id_zona').val(data.karyawan.id_zona);
                    $('#id_regu').val(data.karyawan.id_regu);
                    $('#id_jabatan').val(data.karyawan.id_jabatan);
                    $('#jam_masuk').val(data.jadwal.jam_masuk);
                    $('#jadwal').val("| " + data.jadwal.action + " | " + data.jadwal.jam_masuk + " - " + data.jadwal.jam_keluar);
                    $('#jabatan').val(data.karyawan.jabatan.nama_jabatan);
                    $('#alamat').val(data.karyawan.alamat);
                    $('#no_hp').val(data.karyawan.no_hp);
                    $('#no_ktp').val(data.karyawan.no_ktp);
                    $('#foto').attr('src', "{{asset('assets/foto_profil')}}/"+data.karyawan.user.foto);
                    $('#id_user_penerima').val(data.karyawan.jabatan.atasan_1.user.id_user);
                }
            });
        });
    });
</script>
{{-- <script>
    // set lokasi latitude dan longitude, lokasinya kota palembang
    var mymap = L.map('mapid').setView([-7.156819, 112.6402522], 17);
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
