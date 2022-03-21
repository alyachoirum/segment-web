@extends('main')

@section('judul')
Data Tukar Shift
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Data Tukar Shift</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Data Tukar Shift</li>
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
                    <h5 class="text-white" style="text-align: center">Data Tukar Shift</h5>
                </div>

                <div class="card-body">

                    <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-toggle="tab"
                                href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"
                                data-original-title="" title=""><i class="icofont icofont-map-search"></i></i>Belum Validasi <span class="badge badge-pill badge-warning">{{ $total_belum_valid }}</span>
                                </a></li>
                        <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-toggle="tab"
                                href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false"
                                data-original-title="" title=""><i class="icofont icofont-document-search"></i>Sudah Validasi <span class="badge badge-pill badge-info">{{ $total_sudah_valid }}</span>
                                </a></li>
                        <li class="nav-item"><a class="nav-link" id="reject-top-tab" data-toggle="tab"
                                href="#top-reject" role="tab" aria-controls="top-reject" aria-selected="false"
                                data-original-title="" title=""><i class="icofont icofont-document-search"></i>Ditolak <span class="badge badge-pill badge-danger">{{ $total_reject }}</span>
                                </a></li>
                    </ul>

                    <div class="tab-content" id="top-tabContent">
                        <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display" id="tabel_tukar_shift">
                                        <thead>
                                            <tr>
                                                <th width="100px"style="text-align: center">Tgl Tukar</th>
                                                <th style="text-align: center">Pihak 1</th>
                                                <th style="text-align: center">Pihak 2</th>
                                                <th style="text-align: center">Awal</th>
                                                <th style="text-align: center">Tukar</th>
                                                <th style="text-align: center">P 2</th>
                                                <th style="text-align: center">KJG 1</th>
                                                <th style="text-align: center">KJG 2</th>
                                                <th width="120px" style="text-align: center">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display" id="sudah_validasi">
                                        <thead>
                                            <tr>
                                                <th width="100px"style="text-align: center">Tgl Tukar</th>
                                                <th style="text-align: center">Pihak 1</th>
                                                <th style="text-align: center">Pihak 2</th>
                                                <th style="text-align: center">Awal</th>
                                                <th style="text-align: center">Tukar</th>
                                                <th style="text-align: center">P 2</th>
                                                <th style="text-align: center">KJG 1</th>
                                                <th style="text-align: center">KJG 2</th>
                                                <th width="120px" style="text-align: center">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="top-reject" role="tabpanel" aria-labelledby="profile-top-tab">
                            <div class="card-body">
                                <div class="dt-ext table-responsive">
                                    <table class="display" id="tabel_tukar_shift_reject">
                                        <thead>
                                            <tr>
                                                <th width="100px"style="text-align: center">Tgl Tukar</th>
                                                <th style="text-align: center">Pihak 1</th>
                                                <th style="text-align: center">Pihak 2</th>
                                                <th style="text-align: center">Awal</th>
                                                <th style="text-align: center">Tukar</th>
                                                <th style="text-align: center">P 2</th>
                                                <th style="text-align: center">KJG 1</th>
                                                <th style="text-align: center">KJG 2</th>
                                                <th width="120px" style="text-align: center">Aksi</th>
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


@endsection

@section('script')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>

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
        $('#tabel_tukar_shift').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side
            ajax: {
                url: "{{ route('list_tukar_shift')}}",
                type: 'GET'
            },
            columns: [
                {
                    data: 'tgl_tukar',
                    name: 'tgl_tukar',
                    orderable: false,
                },
                {
                    data: 'pihak_1.nama_lengkap',
                    name: 'nama_lengkap'
                },
                {
                    data: 'pihak_2.nama_lengkap',
                    name: 'nama_lengkap'
                },
                {
                    data: 'awal_jam_kerja',
                    name: 'awal_jam_kerja'
                },
                {
                    data: 'ubah_jam_kerja',
                    name: 'ubah_jam_kerja'
                },
                {
                    data: 'apv_pihak2',
                    name: 'apv_pihak2'
                },
                {
                    data: 'apv_kajaga_p1',
                    name: 'apv_kajaga_p1'
                },
                {
                    data: 'apv_kajaga_p2',
                    name: 'apv_kajaga_p2'
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

        //jika klik class delete (yang ada pada tombol delete) maka tampilkan modal konfirmasi hapus maka
        $(document).on('click', '.delete', function () {
            dataId = $(this).attr('id');
            $('#konfirmasi-modal').modal('show');
        });

        //jika tombol hapus pada modal konfirmasi di klik maka
        $('#tombol-hapus').click(function () {
            $.ajax({

                url: "delete_user/" + dataId, //eksekusi ajax ke url ini
                type: 'delete',
                beforeSend: function () {
                    $('#tombol-hapus').text('Hapus Data'); //set text untuk tombol hapus
                },
                success: function (data) { //jika sukses
                    setTimeout(function () {
                        $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
                        var oTable = $('#table_partner').dataTable();
                        oTable.fnDraw(false); //reset datatable
                    });
                    iziToast.warning({ //tampilkan izitoast warning
                        title: 'Data Berhasil Dihapus',
                        message: '{{ Session('
                        delete ')}}',
                        position: 'bottomRight'
                    });
                }
            })
        });
    });
</script>

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
        $('#sudah_validasi').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side
            ajax: {
                url: "{{ route('data_tukar_shift_sudah_valid')}}",
                type: 'GET'
            },
            columns: [
                {
                    data: 'tgl_tukar',
                    name: 'tgl_tukar',
                    orderable: false,

                },
                {
                    data: 'pihak_1.nama_lengkap',
                    name: 'nama_lengkap'
                },
                {
                    data: 'pihak_2.nama_lengkap',
                    name: 'nama_lengkap'
                },
                {
                    data: 'awal_jam_kerja',
                    name: 'awal_jam_kerja'
                },
                {
                    data: 'ubah_jam_kerja',
                    name: 'ubah_jam_kerja'
                },
                {
                    data: 'apv_pihak2',
                    name: 'apv_pihak2'
                },
                {
                    data: 'apv_kajaga_p1',
                    name: 'apv_kajaga_p1'
                },
                {
                    data: 'apv_kajaga_p2',
                    name: 'apv_kajaga_p2'
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

        //jika klik class delete (yang ada pada tombol delete) maka tampilkan modal konfirmasi hapus maka
        $(document).on('click', '.delete', function () {
            dataId = $(this).attr('id');
            $('#konfirmasi-modal').modal('show');
        });

        //jika tombol hapus pada modal konfirmasi di klik maka
        $('#tombol-hapus').click(function () {
            $.ajax({

                url: "delete_user/" + dataId, //eksekusi ajax ke url ini
                type: 'delete',
                beforeSend: function () {
                    $('#tombol-hapus').text('Hapus Data'); //set text untuk tombol hapus
                },
                success: function (data) { //jika sukses
                    setTimeout(function () {
                        $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
                        var oTable = $('#table_partner').dataTable();
                        oTable.fnDraw(false); //reset datatable
                    });
                    iziToast.warning({ //tampilkan izitoast warning
                        title: 'Data Berhasil Dihapus',
                        message: '{{ Session('
                        delete ')}}',
                        position: 'bottomRight'
                    });
                }
            })
        });
    });
</script>

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
        $('#tabel_tukar_shift_reject').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side
            ajax: {
                url: "{{ route('data_tukar_shift_reject')}}",
                type: 'GET'
            },
            columns: [
                {
                    data: 'tgl_tukar',
                    name: 'tgl_tukar',
                    orderable: false,
                },
                {
                    data: 'pihak_1.nama_lengkap',
                    name: 'nama_lengkap'
                },
                {
                    data: 'pihak_2.nama_lengkap',
                    name: 'nama_lengkap'
                },
                {
                    data: 'awal_jam_kerja',
                    name: 'awal_jam_kerja'
                },
                {
                    data: 'ubah_jam_kerja',
                    name: 'ubah_jam_kerja'
                },
                {
                    data: 'apv_pihak2',
                    name: 'apv_pihak2'
                },
                {
                    data: 'apv_kajaga_p1',
                    name: 'apv_kajaga_p1'
                },
                {
                    data: 'apv_kajaga_p2',
                    name: 'apv_kajaga_p2'
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

        //jika klik class delete (yang ada pada tombol delete) maka tampilkan modal konfirmasi hapus maka
        $(document).on('click', '.delete', function () {
            dataId = $(this).attr('id');
            $('#konfirmasi-modal').modal('show');
        });

        //jika tombol hapus pada modal konfirmasi di klik maka
        $('#tombol-hapus').click(function () {
            $.ajax({

                url: "delete_user/" + dataId, //eksekusi ajax ke url ini
                type: 'delete',
                beforeSend: function () {
                    $('#tombol-hapus').text('Hapus Data'); //set text untuk tombol hapus
                },
                success: function (data) { //jika sukses
                    setTimeout(function () {
                        $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
                        var oTable = $('#table_partner').dataTable();
                        oTable.fnDraw(false); //reset datatable
                    });
                    iziToast.warning({ //tampilkan izitoast warning
                        title: 'Data Berhasil Dihapus',
                        message: '{{ Session('
                        delete ')}}',
                        position: 'bottomRight'
                    });
                }
            })
        });
    });
</script>

<!-- JAVASCRIPT -->
@endsection
