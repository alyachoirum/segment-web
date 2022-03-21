@extends('main')

@section('link')

@endsection

@section('judul')
Detail Absen Zona
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Detail Absen Zona</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Detail Absen Zona</li>
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
                    <h5 class="text-white" style="text-align: center">Absensi Per Zona</h5>
                </div>

                <div class="card-body">

                    <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="top-home-tab" data-toggle="tab"
                                href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"
                                data-original-title="" title=""><i class="icofont icofont-user-search"></i>Masuk</a></li>
                        <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-toggle="tab"
                                href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false"
                                data-original-title="" title=""><i class="icofont icofont-job-search"></i>Tidak Masuk</a></li>
                    </ul>

                    <div class="tab-content" id="top-tabContent">

                        <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                            <div class="card-body">
                                <div class="dt-ext table-responsive">
                                    <table class="display" id="export-button">
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
                                        <tbody>
                                            @foreach ($dt_absen_masuk as $masuk)
                                            <tr>
                                                <td>Tes</td>
                                                <td>{{ $masuk->nik }}</td>
                                                <td>{{ $masuk->nama_lengkap }}</td>
                                                <td>{{ $masuk->nama_zona }}</td>
                                                <td>{{ $masuk->nama_regu }}</td>
                                                <td>{{ $masuk->nama_jabatan }}</td>
                                                <td>
                                                    <a href="{{ route('profile_detail',auth()->user()->id_user)}}">
                                                        <button class="btn btn-primary" data-original-title="View"><i
                                                        class="fa fa-eye"></i></button>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                            <div class="card-body">
                                <div class="dt-ext table-responsive">
                                    <table class="display" id="basic-1">
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
                                        <tbody>
                                            @foreach ($dt_absen_tidak_masuk as $tidak_masuk)
                                            <tr>
                                                <td>Tes</td>
                                                <td>{{ $tidak_masuk->nik }}</td>
                                                <td>{{ $tidak_masuk->nama_lengkap }}</td>
                                                <td>{{ $tidak_masuk->nama_zona }}</td>
                                                <td>{{ $tidak_masuk->nama_regu }}</td>
                                                <td>{{ $tidak_masuk->nama_jabatan }}</td>
                                                <td>
                                                    <a href="{{ route('profile_detail',auth()->user()->id_user)}}">
                                                        <button class="btn btn-primary" data-original-title="View"><i
                                                        class="fa fa-eye"></i></button>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
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


@endsection

@section('script')

<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>

<!-- JAVASCRIPT -->
    {{-- <script>
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
            $('#tabel_absensi_masuk').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side
                ajax: {
                    url: "{{ route('dashboard_absensi')}}",
                    type: 'GET'
                },
                columns: [
                    {
                        data: 'foto',
                        name: 'foto',
                        render: function(data){
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
    </script> --}}
<!-- JAVASCRIPT -->


<!-- JAVASCRIPT -->
    {{-- <script>
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
            $('#tabel_absensi_tidak_masuk').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side
                ajax: {
                    url: "{{ route('dashboard_absensi')}}",
                    type: 'GET'
                },
                columns: [
                    {
                        data: 'foto',
                        name: 'foto',
                        render: function(data){
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
    </script> --}}
<!-- JAVASCRIPT -->



@endsection
