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
Tambah Laporan
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Tamnbah Laporan</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Tambah Laporan</li>
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
                    <h5>Form Tambah Laporan</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('tambah_laporan')}}" method="post" enctype="multipart/form-data"
                        class="needs-validation" novalidate="">
                        {{ csrf_field() }}
                        {{-- <div class="row mb-3">
                            <div class="col-md-12 mb-6">
                                <label>Tanggal</label>
                                <input class="datepicker-here form-control" placeholder="Tanggal Laporan" name="tanggal" type="text" data-language="en">
                            </div>
                        </div> --}}

                        <div class="row mb-3">
                            <div class="col-md-12 mb-6">
                                <label for="validationTooltip01">Judul Laporan</label>
                                <input class="form-control" name="judul_laporan" id="validationTooltip01" type="text"
                                    placeholder="Judul Laporan" required="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 mb-6">
                                <label>Kategori Laporan</label>
                                <select class="form-control" name="id_kategori" required>
                                    <option>Pilih Kategori</option>
                                    @foreach ($data_kategori as $kategori)
                                    <option value="{{$kategori->id_kategori}}">{{$kategori->nama_kategori}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-6">
                                <label for="exampleFormControlSelect23">Prioritas</label>
                                <select class="form-control" name="prioritas" required id="exampleFormControlSelect23">
                                    <option value="Normal">Normal</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                    <option value="Urgent">Urgent</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-6">
                                <label>Zona</label>
                                <select class="form-control" name="id_zona" required>
                                    <option>Pilih Zona</option>
                                    @foreach ($data_zona as $zona)
                                    <option value="{{$zona->id_zona}}">{{$zona->nama_zona}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- <div class="row mb-3">
                            <div class="col-md-12 mb-6">
                                <label for="validationTooltip04">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="validationTooltip04" rows="4"
                                    type="text" placeholder="Deskripsi Laporan" required=""></textarea>
                            </div>
                        </div> --}}

                        <div class="row mb-3">
                            <div class="col-md-4 mb-6">
                                <label>{{ __('Unit Kerja') }}</label>
                                    <select class="js-example-basic-single col-sm-12" id="unit_kerja" name="unit_kerja" required>
                                        <option value="">Pilih Unit Kerja</option>
                                        @foreach ($data_departemen as $departemen)
                                        <option value="{{$departemen->nama_departemen}}">{{$departemen->nama_departemen}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="col-md-4 mb-6">
                                <label>Tanggal Kejadian</label>
                                <input class="datepicker-here form-control" name="tgl_kejadian" type="text"
                                    placeholder="Tanggal Kejadian" data-language="en" data-original-title="" title="">
                            </div>
                            <div class="col-md-4 mb-6">
                                <label>Waktu Kejadian</label>
                                <div class="input-group clockpicker">
                                    <input class="form-control" type="text" placeholder="Jam Kejadian" name="jam_kejadian" ><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                </div>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 mb-6">
                                <label for="validationTooltip04">Kronologi Kejadian</label>
                                <textarea class="form-control" name="kronologi_kejadian" id="validationTooltip04" rows="5"
                                    type="text" placeholder="Kronologi Kejadian" required=""></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-8 mb-6">
                                <label for="validationTooltip04">Akibat Kejadian</label>
                                <textarea class="form-control" name="akibat_kejadian" id="validationTooltip04" rows="2"
                                    type="text" placeholder="Akibat Kejadian" required=""></textarea>
                            </div>
                            <div class="col-md-4 mb-6">
                                <label for="exampleFormControlSelect23">Bantuan Pengamanan</label>
                                <select class="form-control" name="bantuan_pengamanan" required id="exampleFormControlSelect23">
                                    <option value="Pengawalan">Pengawalan</option>
                                    <option value="Patroli">Patroli</option>
                                    <option value="Penyelidikan">Penyelidikan</option>
                                    <option value="Olah TKP">Olah TKP</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 mb-6">
                                <label class="col-form-label">Gambar</label>
                                <div class="col-md-12">
                                    <input type="file" class="custom-file-input" name="gambar[]" id="formFileMultiple"
                                        required="" multiple>
                                    <label class="custom-file-label" for="formFileMultiple">Pilih Foto</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-12 mb-6">
                                <label>Lokasi</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-xl-12">
                                <div class="card">
                                    <div id="mapid" style="height: 520px; z-index: 0;">
                                    </div>
                                    <input type="text" id="latlong" hidden>
                                </div>
                            </div>
                            {{-- <div class="col-md-12 mb-4" style="text-align: center">
                                <button onclick=fullScreenview() class="btn btn-pill btn-primary" type="button"
                                    title="">F U L L S C R E E N</button>
                            </div> --}}
                        </div>

                        <input type="text" id="lat" name="lat" hidden required>
                        <input type="text" id="lng" name="lng" hidden required>


                        <div class="row" style="text-align: center;">
                            <div class="col-sm-4">

                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-primary" type="submit">Tambah Laporan</button>
                            </div>
                            <div class="col-sm-4">

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
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
<script src="{{ asset('assets/js/time-picker/jquery-clockpicker.min.js')}}"></script>
<script src="{{ asset('assets/js/time-picker/highlight.min.js')}}"></script>
<script src="{{ asset('assets/js/time-picker/clockpicker.js')}}"></script>

<script>
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
</script>

@endsection
