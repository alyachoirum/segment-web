@extends('main')

@section('judul')
Data Karyawan
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Data Karyawan Filter Zona</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Data Karyawan Filter Zona</li>
                </ol>
            </div>
        </div>
    </div>
</div>



<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden">
                <a href="{{route('kehadiran')}}">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="user-check"></i></div>
                            <div class="media-body"><span class="m-0">
                                    <h4>Kehadiran</h4>
                                    <p>form hadir dan keluar</p>
                                </span>
                                <i class="icon-bg" data-feather="user-check"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden">
                <a href="{{route('absen')}}">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="user-x"></i></div>
                            <div class="media-body"><span class="m-0">
                                    <h4>Absen</h4>
                                    <p>form ijin, dispen, sakit, cuti</p>
                                </span>
                                <i class="icon-bg" data-feather="user-x"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden">
                <a href="{{route('pengajuan')}}">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="clipboard"></i></div>
                            <div class="media-body"><span class="m-0">
                                    <h4>Pengajuan</h4>
                                    <p>form tukar shift, lembur</p>
                                </span>
                                <i class="icon-bg" data-feather="clipboard"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h5>Data Karyawan</h5>
                        </div>
                        <div class="col-md-4" style="padding-left:19%">
                            <td>
                                <a href="{{route('tambah_karyawan_excel')}}">
                                    <button class="btn btn-outline-primary" type="button" data-toggle="modal"
                                        data-target="#tambah_data" data-original-title="Isi secara lengkap" title="">+
                                        Karyawan</button>
                                </a>
                            </td>
                        </div>

                    </div>

                    <br>

                    <div class="row">
                        <form action="" method="post">
                            {{ csrf_field() }}
                            <div class="form-group row" style="padding-left:4%">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Zona Kerja</label>
                                        <select class="form-control button btn btn-outline-primary js-example-basic-single col-sm-12" name="id_zona"
                                            id="id_zona">
                                            <option>Pilih Zona</option>
                                            @foreach ($zona as $zon)
                                            <option value="{{ $zon->id_zona }}">{{ $zon->nama_zona }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form_group">
                                        <label style="color: white">
                                            Filter
                                        </label>
                                        <button class="btn btn-primary" type="submit">Go</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- <div class="row">
                        <form action="" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <select class="form-control button btn btn-outline-primary js-example-basic-single col-sm-12" name="id_zona"
                                            id="id_zona">
                                            <option>Pilih Zona</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <select class="form-control button btn btn-outline-primary" name="month"
                                        id="exampleFormControlSelect7">
                                        <option>Bulan</option>
                                        <option value=12>Desember</option>
                                        <option value=11>November</option>
                                        <option value=10>Oktober</option>
                                        <option value=9>September</option>
                                        <option value=8>Agustus</option>
                                        <option value=7>Juli</option>
                                        <option value=6>Juni</option>
                                        <option value=5>Mei</option>
                                        <option value=4>April</option>
                                        <option value=3>Maret</option>
                                        <option value=2>Februari</option>
                                        <option value=1>Januari</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <select class="form-control button btn btn-outline-primary" name="status"
                                        id="exampleFormControlSelect7">
                                        <option>Status</option>
                                        <option value=unpaid>Unpaid</option>
                                        <option value=paid>Paid</option>
                                    </select>
                                </div>

                                <div class="col-md-1">
                                    <button class="btn btn-primary" type="submit">Go</button>
                                </div>
                            </div>
                        </form>
                    </div> --}}
                </div>

                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display yajra-datatable" id="tabel_karyawan" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama Karyawan</th>
                                    <th>Zona</th>
                                    <th>Regu</th>
                                    <th>Jabatan</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection

@section('script')

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
            $('#tabel_karyawan').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side
                ajax: {
                    url: "{{ route('data_karyawan_filter')}}",
                    type: 'POST'
                },
                columns: [
                    {
                        data: 'id_karyawan',
                        name: 'id_karyawan'
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
                ],
                order: [
                    [0, 'asc']
                ]
            });
        });
    </script>
    <!-- JAVASCRIPT -->


{{-- <script type="text/javascript">

$(function () {

    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('list_data_karyawan') }}",
        columns: [
            {data: 'nik', name: 'nik'},
            {data: 'nama_lengkap', name: 'nama_lengkap'},
            {data: 'nama_zona', name: 'nama_zona'},
            {data: 'nama_regu', name: 'nama_regu'},
            {data: 'nama_jabatan', name: 'nama_jabatan'},

            {
                data: 'id_karyawan',
                render:function(data){
                    return `
                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-original-title="Detail" data-target="#view${data}"><i
                                                    class="fa fa-eye"></i></button>
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-original-title="Approve" data-target="#approve${data}"><i
                                                    class="fa fa-check-square-o"></i></button>
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-original-title="Edit" data-target="#edit${data}"><i
                                                    class="fa fa-edit"></i></button>
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-original-title="Hapus" data-target="#delete${data}"><i
                                                    class="fa fa-eraser"></i></button>
                                        </div>
                    `
                }
            },
        ]
    });

    });

</script> --}}

@endsection
