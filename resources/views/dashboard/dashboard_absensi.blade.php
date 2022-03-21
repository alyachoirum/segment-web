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
Dashboard
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Dashboard</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Dashboard Absensi </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xl-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="text-white" style="text-align: center">Cek Lokasi Kehadiran</h5>
                </div>

                <div class="card-body">

                    <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-toggle="tab"
                                href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"
                                data-original-title="" title=""><i class="icofont icofont-map-search"></i></i>Peta
                                Lokasi</a></li>
                        <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-toggle="tab"
                                href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false"
                                data-original-title="" title=""><i class="icofont icofont-document-search"></i>Data
                                Karyawan</a></li>
                    </ul>

                    <div class="tab-content" id="top-tabContent">
                        <div class="tab-pane fade show active" id="top-home" role="tabpanel"
                            aria-labelledby="top-home-tab">

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
                        </div>

                        <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                            <div class="card">
                                {{-- <div class="card-header">
                                    <div class="row">
                                        <form action="/dashboard_absensi_filter" method="post">
                                            {{ csrf_field() }}
                                            <div class="form-group row" style="padding-left:2.5%">
                                                    <div class="form-group col-md-5">
                                                        <label>Zona Kerja</label>
                                                        <br>
                                                        <select
                                                            class="form-control button btn btn-outline-primary js-example-basic-single" style="width: 500px;"
                                                            name="id_zona" id="id_zona">
                                                            <option>Pilih Zona</option>
                                                            @foreach ($data_zona as $zon)
                                                            <option value="{{ $zon->id_zona }}">{{ $zon->nama_zona }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-5">
                                                        <label>Regu</label>
                                                        <br>
                                                        <select
                                                            class="form-control button btn btn-outline-primary js-example-basic-single" style="width: 500px;"
                                                            name="id_regu" id="id_regu">
                                                            <option>Pilih Regu</option>
                                                            @foreach ($data_regu as $regu)
                                                            <option value="{{ $regu->id_regu }}">
                                                                {{ $regu->nama_regu }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                <div class="col-md-2">
                                                    <div class="form_group">
                                                        <label style="color: white">
                                                            Filter
                                                        </label>
                                                        <br>
                                                        <button class="btn btn-primary" type="submit">Go</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div> --}}
                                <div class="card-body">
                                    <div class="dt-ext table-responsive">
                                        <table class="display" id="tabel_absensi">
                                            <thead>
                                                <tr>
                                                    <th>Foto</th>
                                                    <th style="text-align: center">NIK</th>
                                                    <th style="text-align: center">Nama Karyawan</th>
                                                    <th style="text-align: center">Zona</th>
                                                    <th style="text-align: center">Regu</th>
                                                    <th style="text-align: center">Jabatan</th>
                                                    <th width="2px">Aksi</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <a href="{{ route('list_absen_tidakmasuk') }}">
                    <div class="card o-hidden">
                        <div class="bg-primary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="log-out"></i></div>
                                <div class="media-body"><span class="m-0">Absen Tidak Masuk</span>
                                    <h4 class="mb-0 counter">{{ $total_tidak_masuk }}</h4><i class="icon-bg" data-feather="log-out"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <a href="{{ route('list_tukar_shift') }}">
                    <div class="card o-hidden">
                        <div class="bg-primary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="refresh-cw"></i></div>
                                <div class="media-body"><span class="m-0">Perizinan Tukar Shift </span>
                                    <h4 class="mb-0 counter">{{ $total_tukar_shift }}</h4><i class="icon-bg" data-feather="refresh-cw"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <a href="{{ route('list_lembur') }}">
                    <div class="card o-hidden">
                        <div class="bg-primary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="file-plus"></i></div>
                                <div class="media-body"><span class="m-0">Perizinan SP Lembur</span>
                                    <h4 class="mb-0 counter">{{ $total_lembur }}</h4><i class="icon-bg" data-feather="file-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <a href="{{ route('list_lembur_khusus') }}">
                    <div class="card o-hidden">
                        <div class="bg-primary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="file-plus"></i></div>
                                <div class="media-body"><span class="m-0">Perizinan Lembur Khusus</span>
                                    <h4 class="mb-0 counter">{{ $total_lembur_khusus }}</h4><i class="icon-bg" data-feather="file-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{-- <div class="col-sm-6 col-xl-4 col-lg-6">
            <a href="{{ route('lokasi_kehadiran') }}">
            <div class="card o-hidden">
                <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="map"></i></div>
                        <div class="media-body"><span class="m-0">Detail Lokasi Kehadiran</span>
                            <h4 class="mb-0 counter">45</h4><i class="icon-bg" data-feather="map"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div> --}}

        @foreach ($absensitabel as $data)
        <div class="col-sm-12 col-xl-4">
            <div class="card card-absolute">
                <div class="card-header bg-primary">
                    <h5 class="text-white"><i class="icon-bg" data-feather="package"></i> Zona {{ $data['nama_zona'] }}
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="doughnutChart-{{$data['zona']}}" style="height:250px"></canvas>
                    <br> <br>
                    <table class="table table-condensed table-bordered table-xs">
                        <tbody>
                            <tr>
                                <td width="400px" style="text-align: center">Hadir</td>
                                <td width="100px" style="text-align: center">{{ $data['masuk'] }}</td>
                            </tr>
                            <tr>
                                <td width="400px" style="text-align: center">Absen</td>
                                <td width="100px" style="text-align: center">{{ $data['tidakmasuk'] }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="1" style="text-align: center">Total Pegawai</th>
                                <th colspan="1" style="text-align: center">
                                    <h5>{{ $data['countkaryawan'] }}</h5>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="col-md-12" style="text-align: center">
                        <a href="{{ route('detail_absen_zona',$data['zona'])}}" class="btn btn-pill btn-primary">Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


        {{-- <div class="col-xl-6 xl-100 box-col-12">
            <div class="widget-joins card">
                <div class="row">
                    <div class="col-sm-6 pr-0">
                        <div class="media border-after-xs">
                            <div class="align-self-center mr-3">68%<i class="fa fa-angle-up ml-2"></i></div>
                            <div class="media-body details pl-3"><span class="mb-1">New</span>
                                <h4 class="mb-0 counter">6982</h4>
                            </div>
                            <div class="media-body align-self-center"><i class="font-primary float-left ml-2"
                                    data-feather="shopping-bag"></i></div>
                        </div>
                    </div>
                    <div class="col-sm-6 pl-0">
                        <div class="media">
                            <div class="align-self-center mr-3">12%<i class="fa fa-angle-down ml-2"></i></div>
                            <div class="media-body details pl-3"><span class="mb-1">Pending</span>
                                <h4 class="mb-0 counter">783</h4>
                            </div>
                            <div class="media-body align-self-center"><i class="font-primary float-left ml-3"
                                    data-feather="layers"></i></div>
                        </div>
                    </div>
                    <div class="col-sm-6 pr-0">
                        <div class="media border-after-xs">
                            <div class="align-self-center mr-3">68%<i class="fa fa-angle-up ml-2"></i></div>
                            <div class="media-body details pl-3 pt-0"><span class="mb-1">Done</span>
                                <h4 class="mb-0 counter">3674</h4>
                            </div>
                            <div class="media-body align-self-center"><i class="font-primary float-left ml-2"
                                    data-feather="shopping-cart"></i></div>
                        </div>
                    </div>
                    <div class="col-sm-6 pl-0">
                        <div class="media">
                            <div class="align-self-center mr-3">68%<i class="fa fa-angle-up ml-2"></i></div>
                            <div class="media-body details pl-3 pt-0"><span class="mb-1">Cancel</span>
                                <h4 class="mb-0 counter">069</h4>
                            </div>
                            <div class="media-body align-self-center"><i class="font-primary float-left ml-2"
                                    data-feather="dollar-sign"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

</div>

{{-- <div class="row" style="z-index:-1">
        <div class="col-sm-12 col-xl-12">
            <div class="card">
                <div id="mapid">
                    <textarea class="form-control" rows="20"></textarea>
                </div>
            </div>
        </div>
    </div> --}}

<div class="row second-chart-list third-news-update">
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
</div>

{{-- <div class="row" style="z-index:-1">
        <div class="col-sm-12 col-xl-12">
            <div class="card">
                <div id="mapid">
                    <textarea class="form-control" rows="20"></textarea>
                </div>
            </div>
        </div>
    </div> --}}

</div>


@endsection

@section('script')

<script src="{{ asset('assets/js/dashboard/default.js')}}"></script>



<!-- JAVASCRIPT -->
<script>
    //CSRF TOKEN PADA HEADER
    //Script ini wajib krn kita butuh csrf token setiap kali mengirim request post, patch, put dan delete ke server
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    //MULAI DATATABLE
    //script untuk memanggil data json dari server dan menampilkannya berupa datatable
    $(document).ready(function () {
        $('#tabel_absensi').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side
            ajax: {
                url: "{{ route('dashboard_absensi')}}",
                type: 'GET'
            },
            columns: [{
                    data: 'foto',
                    name: 'foto',
                    render: function (data) {
                        return `<img class="b-r-8 img-70" src="{{ asset('assets/foto_profil') }}/${data}"
                                itemprop="thumbnail" alt="Foto Profil">`
                    },
                },
                {
                    data: 'nik',
                    name: 'nik'
                },
                {
                    data: 'nama_lengkap',
                    name: 'nama_lengkap'
                },
                {
                    data: 'nama_zona',
                    name: 'nama_zona'
                },
                {
                    data: 'nama_regu',
                    name: 'nama_regu'
                },
                {
                    data: 'nama_jabatan',
                    name: 'nama_jabatan'
                },
                {
                    data: 'action',
                    name: 'action'
                },

            ],
            order: [
                [0, 'asc']
            ]
        });
    });
</script>
<!-- JAVASCRIPT -->


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
        [-7.143791, 112.658808],
        [-7.144078, 112.658148],
        [-7.144158, 112.656909],
        [-7.144435, 112.656898],
        [-7.144403, 112.659162],
        [-7.146336, 112.659886],
        [-7.146166, 112.660251],
        [-7.139392, 112.657202],
        [-7.139552, 112.65688],
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

    var graha = L.circle([-7.156941, 112.640038], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.2,
        radius: 70
    }).addTo(mymap);

    var masjid = L.circle([-7.158817, 112.642303], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.2,
        radius: 60
    }).addTo(mymap);

    var kantor_depkam = L.circle([-7.15696, 112.638497], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.2,
        radius: 70
    }).addTo(mymap);

    @foreach($dt_absen as $d)

    var ikonKategori = L.icon({
        iconUrl: '/assets/foto_profil/{{$d->foto}}',
        iconSize: [25, 25], // size of the icon
        shadowSize: [20, 20], // size of the shadow
        iconAnchor: [17, 34], // point of the icon which will correspond to marker's location
        shadowAnchor: [20, 20], // the same for the shadow
        popupAnchor: [1, -30] // point from which the popup should open relative to the iconAnchor
    });
    L.marker([{{$d->lat}}, {{$d->lng}}], {
        icon: ikonKategori
    }).addTo(mymap).bindPopup(
        `<h5><b><center>{{$d->nama_lengkap}}</h5><img style="text-align: center" class="b-r-8 img-70" src="{{ asset('assets/foto_profil/'.$d->foto)}}"itemprop="thumbnail" alt="Foto Profil"></b></center><br><br><b>NIK:</b> {{$d->nik}} <br> <b>Zona:</b> {{$d->nama_zona}}  <br> <b>Regu:</b> {{$d->nama_regu}} <br><b> Jabatan:</b> {{$d->nama_jabatan}}<br><b>Hari:</b> {{ date('l F Y', strtotime($d->tanggal))}}  <br><b>Check In:</b> {{ date('H.i', strtotime($d->check_in))}}  <br> <b>No HP:</b> 0{{$d->no_hp}}`
    );
    @endforeach



</script>


{{-- <script>
    // set lokasi latitude dan longitude, lokasinya kota palembang
    var mymap = L.map('mapid').setView([-7.156819, 112.6402522], 16);
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

    @foreach($dt_laporan as $d)
    var ikonKategori = L.icon({
        iconUrl: '/assets/ikon_kategori/{{$d->ikon_kategori}}',
iconSize: [40, 40], // size of the icon
shadowSize: [20, 20], // size of the shadow
iconAnchor: [17, 34], // point of the icon which will correspond to marker's location
shadowAnchor: [20, 20], // the same for the shadow
popupAnchor: [1, -30] // point from which the popup should open relative to the iconAnchor
});
L.marker([{{$d->lat}}, {{$d->lng}}],{ icon: ikonKategori}).addTo(mymap).bindPopup("<h4><b>
        <center>{{$d->nama_kategori}}</h4></b></center> <b>Judul:</b> {{$d->judul_laporan}} <br> <b>Dilaporkan pada:</b>
{{$d->created_at}} <br><b> Pelapor:</b> {{$d->nama_user}} <br> <b>Deskripsi:</b> {{$d->deskripsi}} <br><b>Prioritas:</b>
{{$d->prioritas}}");
@endforeach
</script> --}}

<script>
    $(function () {
  /* ChartJS
   * -------
   * Data and config for chartjs
   */
  'use strict';
  var data = {
    labels: ["2013", "2014", "2014", "2015", "2016", "2017"],
    datasets: [{
      label: '# of Votes',
      data: [10, 19, 3, 5, 2, 3],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: false
    }]
  };
  var dataDark = {
    labels: ["2013", "2014", "2014", "2015", "2016", "2017"],
    datasets: [{
      label: '# of Votes',
      data: [10, 19, 3, 5, 2, 3],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: false
    }]
  };
  var multiLineData = {
    labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
    datasets: [{
      label: 'Dataset 1',
      data: [12, 19, 3, 5, 2, 3],
      borderColor: [
        '#587ce4'
      ],
      borderWidth: 2,
      fill: false
    },
    {
      label: 'Dataset 2',
      data: [5, 23, 7, 12, 42, 23],
      borderColor: [
        '#ede190'
      ],
      borderWidth: 2,
      fill: false
    },
    {
      label: 'Dataset 3',
      data: [15, 10, 21, 32, 12, 33],
      borderColor: [
        '#f44252'
      ],
      borderWidth: 2,
      fill: false
    }
    ]
  };
  var options = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    },
    legend: {
      display: false
    },
    elements: {
      point: {
        radius: 0
      }
    }

  };
  var optionsDark = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        },
        gridLines: {
          color: '#322f2f',
          zeroLineColor: '#322f2f'
        }
      }],
      xAxes: [{
        ticks: {
          beginAtZero: true
        },
        gridLines: {
          color: '#322f2f',
        }
      }],
    },
    legend: {
      display: false
    },
    elements: {
      point: {
        radius: 0
      }
    }

  };




  var areaData = {
    labels: ["2013", "2014", "2015", "2016", "2017"],
    datasets: [{
      label: '# of Votes',
      data: [12, 19, 3, 5, 2, 3],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: true, // 3: no fill
    }]
  };

  var areaDataDark = {
    labels: ["2013", "2014", "2015", "2016", "2017"],
    datasets: [{
      label: '# of Votes',
      data: [12, 19, 3, 5, 2, 3],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: true, // 3: no fill
    }]
  };

  var areaOptions = {
    plugins: {
      filler: {
        propagate: true
      }
    }
  }

  var areaOptionsDark = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        },
        gridLines: {
          color: '#322f2f',
          zeroLineColor: '#322f2f'
        }
      }],
      xAxes: [{
        ticks: {
          beginAtZero: true
        },
        gridLines: {
          color: '#322f2f',
        }
      }],
    },
    plugins: {
      filler: {
        propagate: true
      }
    }
  }

  var multiAreaData = {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
      label: 'Facebook',
      data: [8, 11, 13, 15, 12, 13, 16, 15, 13, 19, 11, 14],
      borderColor: ['rgba(255, 99, 132, 0.5)'],
      backgroundColor: ['rgba(255, 99, 132, 0.5)'],
      borderWidth: 1,
      fill: true
    },
    {
      label: 'Twitter',
      data: [7, 17, 12, 16, 14, 18, 16, 12, 15, 11, 13, 9],
      borderColor: ['rgba(54, 162, 235, 0.5)'],
      backgroundColor: ['rgba(54, 162, 235, 0.5)'],
      borderWidth: 1,
      fill: true
    },
    {
      label: 'Linkedin',
      data: [6, 14, 16, 20, 12, 18, 15, 12, 17, 19, 15, 11],
      borderColor: ['rgba(255, 206, 86, 0.5)'],
      backgroundColor: ['rgba(255, 206, 86, 0.5)'],
      borderWidth: 1,
      fill: true
    }
    ]
  };

  var multiAreaOptions = {
    plugins: {
      filler: {
        propagate: true
      }
    },
    elements: {
      point: {
        radius: 0
      }
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: false
        }
      }],
      yAxes: [{
        gridLines: {
          display: false
        }
      }]
    }
  }

  var scatterChartData = {
    datasets: [{
      label: 'First Dataset',
      data: [{
        x: -10,
        y: 0
      },
      {
        x: 0,
        y: 3
      },
      {
        x: -25,
        y: 5
      },
      {
        x: 40,
        y: 5
      }
      ],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)'
      ],
      borderWidth: 1
    },
    {
      label: 'Second Dataset',
      data: [{
        x: 10,
        y: 5
      },
      {
        x: 20,
        y: -30
      },
      {
        x: -25,
        y: 15
      },
      {
        x: -10,
        y: 5
      }
      ],
      backgroundColor: [
        'rgba(54, 162, 235, 0.2)',
      ],
      borderColor: [
        'rgba(54, 162, 235, 1)',
      ],
      borderWidth: 1
    }
    ]
  }

  var scatterChartDataDark = {
    datasets: [{
      label: 'First Dataset',
      data: [{
        x: -10,
        y: 0
      },
      {
        x: 0,
        y: 3
      },
      {
        x: -25,
        y: 5
      },
      {
        x: 40,
        y: 5
      }
      ],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)'
      ],
      borderWidth: 1
    },
    {
      label: 'Second Dataset',
      data: [{
        x: 10,
        y: 5
      },
      {
        x: 20,
        y: -30
      },
      {
        x: -25,
        y: 15
      },
      {
        x: -10,
        y: 5
      }
      ],
      backgroundColor: [
        'rgba(54, 162, 235, 0.2)',
      ],
      borderColor: [
        'rgba(54, 162, 235, 1)',
      ],
      borderWidth: 1
    }
    ]
  }

  var scatterChartOptions = {
    scales: {
      xAxes: [{
        type: 'linear',
        position: 'bottom'
      }]
    }
  }

  var scatterChartOptionsDark = {
    scales: {
      xAxes: [{
        type: 'linear',
        position: 'bottom',
        gridLines: {
          color: '#322f2f',
          zeroLineColor: '#322f2f'
        }
      }],
      yAxes: [{
        gridLines: {
          color: '#322f2f',
          zeroLineColor: '#322f2f'
        }
      }]
    }
  }
  // Get context with jQuery - using jQuery's .get() method.
  if ($("#barChart").length) {
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: data,
      options: options
    });
  }

  if ($("#barChartDark").length) {
    var barChartCanvasDark = $("#barChartDark").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var barChartDark = new Chart(barChartCanvasDark, {
      type: 'bar',
      data: dataDark,
      options: optionsDark
    });
  }

  if ($("#lineChart").length) {
    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: data,
      options: options
    });
  }

  if ($("#lineChartDark").length) {
    var lineChartCanvasDark = $("#lineChartDark").get(0).getContext("2d");
    var lineChartDark = new Chart(lineChartCanvasDark, {
      type: 'line',
      data: dataDark,
      options: optionsDark
    });
  }

  if ($("#linechart-multi").length) {
    var multiLineCanvas = $("#linechart-multi").get(0).getContext("2d");
    var lineChart = new Chart(multiLineCanvas, {
      type: 'line',
      data: multiLineData,
      options: options
    });
  }

  if ($("#areachart-multi").length) {
    var multiAreaCanvas = $("#areachart-multi").get(0).getContext("2d");
    var multiAreaChart = new Chart(multiAreaCanvas, {
      type: 'line',
      data: multiAreaData,
      options: multiAreaOptions
    });
  }



  if ($("#pieChart").length) {
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: doughnutPieData,
      options: doughnutPieOptions
    });
  }

  if ($("#areaChart").length) {
    var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
    var areaChart = new Chart(areaChartCanvas, {
      type: 'line',
      data: areaData,
      options: areaOptions
    });
  }

  if ($("#areaChartDark").length) {
    var areaChartCanvas = $("#areaChartDark").get(0).getContext("2d");
    var areaChart = new Chart(areaChartCanvas, {
      type: 'line',
      data: areaDataDark,
      options: areaOptionsDark
    });
  }

  if ($("#scatterChart").length) {
    var scatterChartCanvas = $("#scatterChart").get(0).getContext("2d");
    var scatterChart = new Chart(scatterChartCanvas, {
      type: 'scatter',
      data: scatterChartData,
      options: scatterChartOptions
    });
  }

  if ($("#scatterChartDark").length) {
    var scatterChartCanvas = $("#scatterChartDark").get(0).getContext("2d");
    var scatterChart = new Chart(scatterChartCanvas, {
      type: 'scatter',
      data: scatterChartDataDark,
      options: scatterChartOptionsDark
    });
  }

  if ($("#browserTrafficChart").length) {
    var doughnutChartCanvas = $("#browserTrafficChart").get(0).getContext("2d");
    var doughnutChart = new Chart(doughnutChartCanvas, {
      type: 'doughnut',
      data: browserTrafficData,
      options: doughnutPieOptions
    });
  }


  var doughnutPieData = {
    datasets: [{
      data: [{{ $data_masuk[0]}},{{ $data_tdk_masuk[0]}}],
      backgroundColor: [
        'rgba(54, 162, 235, 0.5)',
        'rgba(255, 99, 132, 0.5)',
        'rgba(255, 206, 86, 0.5)',
        'rgba(75, 192, 192, 0.5)',
        'rgba(153, 102, 255, 0.5)',
        'rgba(255, 159, 64, 0.5)'
      ],
      borderColor: [

        'rgba(54, 162, 235, 1)',
        'rgba(255,99,132,1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
      'Masuk',
      'Alpha',
    ]
  };

  var doughnutPieOptions = {
    responsive: true,
    animation: {
      animateScale: true,
      animateRotate: true
    }
  };

if ($("#doughnutChart").length) {
    var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
    var doughnutChart = new Chart(doughnutChartCanvas, {
      type: 'doughnut',
      data: doughnutPieData,
      options: doughnutPieOptions
    });
  }



});
</script>

<script>

@foreach ($absensitabel as $data)

var doughnutPieData_{{$data['zona']}} = {
    datasets: [{
        data: [{{ $data['masuk']}},{{ $data['tidakmasuk'] }}],
        backgroundColor: [
        'rgba(54, 162, 235, 0.5)',
        'rgba(255, 99, 132, 0.5)',
        'rgba(255, 206, 86, 0.5)',
        'rgba(75, 192, 192, 0.5)',
        'rgba(153, 102, 255, 0.5)',
        'rgba(255, 159, 64, 0.5)'
        ],
        borderColor: [
        'rgba(54, 162, 235, 1)',
        'rgba(255,99,132,1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
        ],
    }],

    labels: [
        'Masuk',
        'Alpha',
    ]
};

var doughnutPieOptions = {
    responsive: true,
    animation: {
        animateScale: true,
        animateRotate: true
    }
};


var doughnutChart_{{$data['zona']}} = new Chart(document.getElementById('doughnutChart-{{$data['zona']}}').getContext("2d"), {
        type: 'doughnut',
        data: doughnutPieData_{{$data['zona']}},
        options: doughnutPieOptions
    }
);


@endforeach
</script>

@endsection
