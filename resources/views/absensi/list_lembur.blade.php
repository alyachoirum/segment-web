@extends('main')

@section('judul')
Data Surat Perintah Lembur
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Data Surat Perintah Lembur</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Data Lembur</li>
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
                    <h5 class="text-white" style="text-align: center">Data Surat Perintah Lembur</h5>
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
                        {{-- <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-toggle="tab" href="#top-distributor"
                                role="tab" aria-controls="top-profile" aria-selected="false" data-original-title=""
                                title=""><i class="icofont icofont-document-search"></i>Berdasarkan Distributor</a></li> --}}
                        {{-- <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-toggle="tab" href="#top-daerah"
                                role="tab" aria-controls="top-profile" aria-selected="false" data-original-title=""
                                title=""><i class="icofont icofont-document-search"></i>Berdasarkan Daerah</a></li> --}}
                    </ul>

                    <div class="tab-content" id="top-tabContent">
                        <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display" id="tabel_lembur">
                                        <thead>
                                            <tr>
                                                <th width="50px">Tgl Lembur</th>
                                                <th width="1px">NIK</th>
                                                <th width="180px">Nama</th>
                                                <th width="20px">Total Jam</th>
                                                <th width="200px">Keterangan</th>
                                                <th width="50px">Kajaga</th>
                                                <th width="50px">Kasi</th>
                                                <th width="250px">Aksi</th>
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
                                                <th width="50px">Tgl Lembur</th>
                                                <th width="1px">NIK</th>
                                                <th width="180px">Nama</th>
                                                <th width="20px">Total Jam</th>
                                                <th width="200px">Keterangan</th>
                                                <th width="50px">Kajaga</th>
                                                <th width="50px">Kasi</th>
                                                <th width="250px">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="top-reject" role="tabpanel" aria-labelledby="profile-top-tab">
                            <div class="card-body">
                                <div class="dt-ext table-responsive">
                                    <table class="display" id="tabel_lembur_reject">
                                        <thead>
                                            <tr>
                                                <th width="50px">Tgl Lembur</th>
                                                <th width="1px">NIK</th>
                                                <th width="180px">Nama</th>
                                                <th width="20px">Total Jam</th>
                                                <th width="200px">Keterangan</th>
                                                <th width="50px">Kajaga</th>
                                                <th width="50px">Kasi</th>
                                                <th width="250px">Aksi</th>
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
        $('#tabel_lembur').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side
            ajax: {
                url: "{{ route('list_lembur')}}",
                type: 'GET'
            },
            columns: [
                {
                    data: 'tgl_lembur',
                    name: 'tgl_lembur',
                    orderable: false,
                },
                {
                    data: 'nik',
                    name: 'nik'
                },
                {
                    data: 'karyawan.nama_lengkap',
                    name: 'nama_lengkap'
                },
                {
                    data: 'total_jam_lembur',
                    name: 'total_jam_lembur'
                },
                {
                    data: 'detail_lembur',
                    name: 'detail_lembur'
                },
                {
                    data: 'validasi',
                    name: 'validasi'
                },
                {
                    data: 'mengetahui',
                    name: 'mengetahui'
                },
                // {
                //     data: 'bukti',
                //     name: 'bukti',
                //     render: function (data) {
                //         return `<img class="b-r-8 img-70" src="{{ asset('assets/foto_bukti_sakit') }}/${data}"
                //                 itemprop="thumbnail" alt="Foto Bukti Sakit">`
                //     },
                // },
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
                url: "{{ route('data_lembur_sudah_valid')}}",
                type: 'GET'
            },
            columns: [
                {
                    data: 'tgl_lembur',
                    name: 'tgl_lembur',
                    orderable: false,
                },
                {
                    data: 'nik',
                    name: 'nik'
                },
                {
                    data: 'karyawan.nama_lengkap',
                    name: 'nama_lengkap'
                },
                {
                    data: 'total_jam_lembur',
                    name: 'total_jam_lembur'
                },
                {
                    data: 'detail_lembur',
                    name: 'detail_lembur'
                },
                {
                    data: 'validasi',
                    name: 'validasi'
                },
                {
                    data: 'mengetahui',
                    name: 'mengetahui'
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
        $('#tabel_lembur_reject').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side
            ajax: {
                url: "{{ route('data_lembur_reject')}}",
                type: 'GET'
            },
            columns: [
                {
                    data: 'tgl_lembur',
                    name: 'tgl_lembur',
                    orderable: false,
                },
                {
                    data: 'nik',
                    name: 'nik'
                },
                {
                    data: 'karyawan.nama_lengkap',
                    name: 'nama_lengkap'
                },
                {
                    data: 'total_jam_lembur',
                    name: 'total_jam_lembur'
                },
                {
                    data: 'detail_lembur',
                    name: 'detail_lembur'
                },
                {
                    data: 'validasi',
                    name: 'validasi'
                },
                {
                    data: 'mengetahui',
                    name: 'mengetahui'
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
