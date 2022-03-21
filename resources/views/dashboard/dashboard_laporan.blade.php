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

<style>
    /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
    #map {
        height: 100%;
        width: 100%;
        margin: 30, 30, 30, 30;
        padding: 30, 30, 30, 30;
    }

    /* Optional: Makes the sample page fill the window. */
    html,
    body {
        height: 100%;
        width: 100%;
        margin: 30, 30, 30, 30;
        padding: 30, 30, 30, 30;
    }
</style>
@endsection

@section('judul')
Dashboard Laporan
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Dashboard Laporan</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Dashboard Laporan</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <a href="{{ route("data_semua_laporan") }}">
                <div class="card o-hidden">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                            <div class="media-body"><span class="m-0">Laporan Masuk </span>
                                <h4 class="mb-0 counter">52</h4><i class="icon-bg" data-feather="shopping-bag"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <a href="{{ route("data_laporan_proses1") }}">
                <div class="card o-hidden">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="refresh-cw"></i></div>
                            <div class="media-body"><span class="m-0">Laporan Proses</span>
                                <h4 class="mb-0 counter">86</h4><i class="icon-bg" data-feather="refresh-cw"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <a href="{{ route("data_laporan_selesai") }}">
                <div class="card o-hidden">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="check-square"></i></div>
                            <div class="media-body"><span class="m-0">Laporan Selesai</span>
                                <h4 class="mb-0 counter">45</h4><i class="icon-bg" data-feather="check-square"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- <div class="row second-chart-list third-news-update">
        <div class="col-xl-4 col-lg-12 xl-50 morning-sec box-col-12">
            <div class="card o-hidden profile-greeting">
                <div class="card-body">
                    <div class="media">
                        <div class="badge-groups w-100">
                            <div class="badge f-12"><i class="mr-1" data-feather="clock"></i><span id="txt"></span>
                            </div>
                            <div class="badge f-12"><i class="fa fa-spin fa-cog f-14"></i></div>
                        </div>
                    </div>
                    <div class="greeting-user text-center">
                        <div class="profile-vector"><img class="img-fluid"
                                src="{{asset('assets/images/dashboard/profile.png')}}" alt=""></div>
                        <h4 class="f-w-600"><span id="greeting">Selamat Pagi</span> <span class="right-circle"><i
                                    class="fa fa-check-circle f-14 middle"></i></span></h4>
                        <p><span>Semoga harimu menyenangkan.</span></p>
                        <div class="left-icon"><i class="fa fa-bell"> </i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-12 xl-50 calendar-sec box-col-6">
            <div class="card gradient-primary o-hidden">
                <div class="card-body">
                    <div class="setting-dot">
                        <div class="setting-bg-primary date-picker-setting position-set pull-right"><i
                                class="fa fa-spin fa-cog"></i></div>
                    </div>
                    <div class="default-datepicker">
                        <div class="datepicker-here" data-language="en"></div>
                    </div><span class="default-dots-stay overview-dots full-width-dots"><span class="dots-group"><span
                                class="dots dots1"></span><span class="dots dots2 dot-small"></span><span
                                class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span
                                class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span
                                class="dots dots7 dot-small-semi"></span><span
                                class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">
                            </span></span></span>
                </div>
            </div>
        </div>

    </div> --}}
    <div class="row">
        <div class="col-sm-12 col-xl-12">
            <div class="card">
                <div id="mapid" style="height: 520px; z-index: 0;">
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4" style="text-align: center">
            <button onclick=fullScreenview() class="btn btn-pill btn-primary" type="button" title="">F U L L S C R E E
                N</button>
        </div>
    </div>

</div>


@endsection

@section('script')

<script src="{{ asset('assets/js/dashboard/default.js')}}"></script>


<script>
    // set lokasi latitude dan longitude, lokasinya kota palembang
    var mymap = L.map('mapid').setView([-7.145191, 112.643103], 15);
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

    @foreach($dt_laporan as $d)
    var ikonKategori = L.icon({
        iconUrl: '/assets/ikon_kategori/{{$d->ikon_kategori}}',
        iconSize: [40, 40], // size of the icon
        shadowSize: [20, 20], // size of the shadow
        iconAnchor: [17, 34], // point of the icon which will correspond to marker's location
        shadowAnchor: [20, 20], // the same for the shadow
        popupAnchor: [1, -30] // point from which the popup should open relative to the iconAnchor
    });
    L.marker([{{$d->lat}}, {{$d->lng}}], {icon: ikonKategori
    }).addTo(mymap).bindPopup(
        `<h4><b><center>{{$d->nama_kategori}}</h4><img style="text-align: center" class="b-r-8 img-70" src="{{ asset('foto/'.$d->foto)}}"itemprop="thumbnail"></b></center> <b>Judul:</b> {{$d->judul_laporan}} <br> <b>Dilaporkan pada:</b> {{$d->created_at}} <br><b> Pelapor:</b> {{$d->nama_lengkap}} <br> <b>Kronologi Kejadian:</b> {{$d->kronologi_kejadian}} <br><b>Prioritas:</b> {{$d->prioritas}}`
        );
    @endforeach
</script>

@endsection
