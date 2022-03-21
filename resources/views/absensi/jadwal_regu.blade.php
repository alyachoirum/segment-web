@extends('main')

@section('judul')
Data Jadwal Hari Ini
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Jadwal Kerja Karyawan</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Jadwal Kerja Karyawan</li>
                </ol>
            </div>
        </div>
    </div>
</div>



<!-- Container-fluid starts-->
<div class="container-fluid">
    <h4 style="text-align: center" class="mb-4">Jadwal Hari Ini</h4>
    <div class="row">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h5>Master Jadwal Karyawan</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
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
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($data_karyawan as $karyawan)
                                <tr>
                                    <td width="2px" style="text-align: center"><?=$no?></td>
                                    <td>{{ $karyawan->nik }}</td>
                                    <td>{{ $karyawan->nama_lengkap }}</td>
                                    <td>{{ $karyawan->nama_zona }}</td>
                                    <td>{{ $karyawan->nama_regu }}</td>
                                    <td>{{ $karyawan->nama_jabatan }}</td>
                                </tr>
                                @php
                                $no++
                                @endphp
                                @endforeach
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
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>

{{--
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
            $('#tabel_jadwal_karyawan').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side
                ajax: {
                    url: "{{ route('tabel_data_jadwal_karyawan')}}",
                    type: 'GET'
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
    <!-- JAVASCRIPT --> --}}

@endsection
