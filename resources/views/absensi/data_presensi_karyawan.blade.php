@extends('main')

@section('judul')
Data Presensi Karyawan
@endsection

@section('isi')

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Data Presensi Karyawan</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Data Presensi Karyawan</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Data Presensi Karyawan | {{ date('d-F-Y',strtotime($tanggal_awal)) }} - {{ date('d-F-Y',strtotime($tanggal_akhir)) }}  </h5>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display yajra-datatable" id="tabel_karyawan" width="100%">
                            <thead>
                                <tr>
                                    <th>Zona</th>
                                    <th>NIK</th>
                                    <th>Nama Karyawan</th>
                                    <th>Regu</th>
                                    <th>Jabatan</th>
                                    <th>Presensi</th>
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

        var tanggal_awal = "{{ $tanggal_awal }}"
        var tanggal_akhir = "{{ $tanggal_akhir }}"
        var id_bulan    = "{{ $id_bulan }}"
        //MULAI DATATABLE
        //script untuk memanggil data json dari server dan menampilkannya berupa datatable
        $(document).ready(function () {
            $('#tabel_karyawan').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side
                ajax: {
                    url: "{{ route('data_presensi_karyawan')}}",
                    type: 'POST',
                    data: { id_bulan: id_bulan, tanggal_awal: tanggal_awal, tanggal_akhir: tanggal_akhir }
                },
                columns: [

                    {
                        data: 'nama_zona',
                        name: 'nama_zona'
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
