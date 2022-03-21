@extends('main')

@section('judul')
Data Absen Tidak Masuk
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Data Absen Tidak Masuk</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Data Absen Tidak Masuk</li>
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
                    <h5 class="text-white" style="text-align: center">Data Absen Tidak Masuk</h5>
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
                                    <table class="display" id="tabel_absen">
                                        <thead>
                                            <tr>
                                                <th width="200px">Tgl Absen</th>
                                                <th width="1px">NIK</th>
                                                <th width="180px">Nama</th>
                                                <th width="20px">Tipe Absen</th>
                                                <th width="50px">Kajaga</th>
                                                <th width="50px">Kasi</th>
                                                <th width="140px">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                            <div class="card-body">
                                <div class="dt-ext table-responsive">
                                    <table class="display" id="tabel_absen_sudah_validasi">
                                        <thead>
                                            <tr>
                                                <th width="1000px">Tgl Absen</th>
                                                <th width="1px">NIK</th>
                                                <th width="180px">Nama</th>
                                                <th width="5px">Tipe Absen</th>
                                                <th width="200px">Keterangan</th>
                                                <th width="50px">Kajaga</th>
                                                <th width="50px">Kasi</th>
                                                <th width="140px">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="top-reject" role="tabpanel" aria-labelledby="profile-top-tab">
                            <div class="card-body">
                                <div class="dt-ext table-responsive">
                                    <table class="display" id="tabel_absen_reject">
                                        <thead>
                                            <tr>
                                                <th width="1000px">Tgl Absen</th>
                                                <th width="1px">NIK</th>
                                                <th width="180px">Nama</th>
                                                <th width="5px">Tipe Absen</th>
                                                <th width="200px">Keterangan</th>
                                                <th width="50px">Kajaga</th>
                                                <th width="50px">Kasi</th>
                                                <th width="140px">Aksi</th>
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


{{-- <div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h5>Data Absen Tidak Masuk</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="tabel_absen">
                            <thead>
                                <tr>
                                    <th width="1px">NIK</th>
                                    <th width="180px">Nama</th>
                                    <th width="50px">Tgl Absen</th>
                                    <th width="20px">Tipe Absen</th>
                                    <th width="200px">Keterangan</th>
                                    <th width="50px">Kajaga</th>
                                    <th width="50px">Kasi</th>
                                    <th width="100px">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

{{-- MODAL TAMBAH --}}
{{-- <div class="modal fade" id="tambah_data" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Admin</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('tambah_user')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input class="form-control" name="level_user" type="hidden" placeholder="" value="Admin">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"><b>Foto Profil</b></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input input-rounded" name="gambar">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"><b>NIK</b></label>
                        <input class="form-control" name="nik" type="text" placeholder="nomor induk karyawan" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"><b>Nama Lengkap</b></label>
                        <input class="form-control" name="nama_user" type="text" placeholder="nama lengkap" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"><b>Username</b></label>
                        <input class="form-control" name="username" type="text" placeholder="username" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"><b>Password</b></label>
                        <input class="form-control" type="password" name="password" placeholder="password" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"><b>Departemen</b></label>
                        <select class="form-control" name="id_departemen">
                            <option>Pilih Departemen</option>
                            @foreach ($data_departemen as $departemen)
                            <option value="{{$departemen->id_departemen}}">{{$departemen->nama_departemen}}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary" type="submit">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div> --}}
{{-- AKHIR MODAL TAMBAH --}}

<!-- DELETE MODAL -->
<div id="konfirmasi-modal" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="fill-danger-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-filled bg-danger">
            <div class="modal-header">
                <h4 class="modal-title" id="fill-danger-modalLabel">Konfirmasi Hapus
                    Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p>Data akan hilang selamanya</p>
                <p>Apakah anda yakin menghapusnya?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <a id="tombol-hapus" name="tombol-hapus"  class="btn btn-outline-light">Hapus
                </a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- AKHIR DELETE MODAL -->


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
        $('#tabel_absen').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side
            ajax: {
                url: "{{ route('list_absen_tidakmasuk')}}",
                type: 'GET'
            },
            columns: [
                {
                    data: 'tgl_absen',
                    name: 'tgl_absen',
                    orderable: false
                },{
                    data: 'nik',
                    name: 'nik'
                },
                {
                    data: 'karyawan.nama_lengkap',
                    name: 'nama_lengkap'
                },
                {
                    data: 'tipe_absen',
                    name: 'tipe_absen'
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
        $('#tabel_absen_sudah_validasi').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side
            ajax: {
                url: "{{ route('data_absen_sudah_valid')}}",
                type: 'GET'
            },
            columns: [
                {
                    data: 'tgl_absen',
                    name: 'tgl_absen',
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
                    data: 'tipe_absen',
                    name: 'tipe_absen'
                },
                {
                    data: 'detail',
                    name: 'detail'
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
        $('#tabel_absen_reject').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side
            ajax: {
                url: "{{ route('data_absen_reject')}}",
                type: 'GET'
            },
            columns: [
                {
                    data: 'tgl_absen',
                    name: 'tgl_absen',
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
                    data: 'tipe_absen',
                    name: 'tipe_absen'
                },
                {
                    data: 'detail',
                    name: 'detail'
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
