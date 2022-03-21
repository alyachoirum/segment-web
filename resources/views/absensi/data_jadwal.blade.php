@extends('main')

@section('judul')
Jadwal Karyawan
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Jadwal Karyawan</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Jadwal Karyawan</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Container-fluid starts-->
<div class="container-fluid">
    @if( $massage = Session::get('success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Tambah Jadwal Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @elseif( $massage = Session::get('edit_success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Edit Jadwal Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @elseif( $massage = Session::get('hapus_success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Hapus Jadwal Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @endif
    <h4 style="text-align: center" class="mb-4">Jadwal Hari Ini</h4>
    <div class="row">

        @foreach ($getdata as $data)

        <div class="col-sm-6 col-xl-3 col-lg-6">
            <a href="{{route('data_jadwal_karyawan', $data['id_regu'])}}">
                <div class="card o-hidden">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="calendar"></i></div>
                            <div class="media-body"><span class="m-0">REGU {{ $data['regu'] }}</span>
                                <h5>{{ $data['action']}}</h5>
                                <h6 class="mb-0">{{ $data['jam_masuk']}} - {{ $data['jam_keluar'] }} </h6><i
                                    class="icon-bg" data-feather="calendar"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        @endforeach

        {{-- <div class="col-xl-12 col-lg-12 col-md-6">
            <div class="table-responsive-xs">
                <table class="table">
                    <tbody>
                        <tr height="1px">
                            <th class="bg-primary" scope="row">A</th>
                            @foreach ($A as $aa)
                            <td style="text-align: center">{{ $aa }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th class="bg-primary" scope="row">B</th>
                            @foreach ($B as $bb)
                            <td style="text-align: center">{{ $bb }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th class="bg-primary" scope="row">C</th>
                            @foreach ($C as $cc)
                            <td style="text-align: center">{{ $cc }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th class="bg-primary" scope="row">D</th>
                            @foreach ($D as $dd)
                            <td style="text-align: center">{{ $dd }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>

            <br>

            <div class="table-responsive-sm">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>

                            <th scope="col">Min</th>
                            <th scope="col">Sen</th>
                            <th scope="col">Sel</th>
                            <th scope="col">Rab</th>
                            <th scope="col">Kam</th>
                            <th scope="col">Jum</th>
                            <th scope="col">Sab</th>

                            <th scope="col">Min</th>
                            <th scope="col">Sen</th>
                            <th scope="col">Sel</th>
                            <th scope="col">Rab</th>
                            <th scope="col">Kam</th>
                            <th scope="col">Jum</th>
                            <th scope="col">Sab</th>

                            <th scope="col">Min</th>
                            <th scope="col">Sen</th>
                            <th scope="col">Sel</th>
                            <th scope="col">Rab</th>
                            <th scope="col">Kam</th>
                            <th scope="col">Jum</th>
                            <th scope="col">Sab</th>

                            <th scope="col">Min</th>
                            <th scope="col">Sen</th>
                            <th scope="col">Sel</th>
                            <th scope="col">Rab</th>
                            <th scope="col">Kam</th>
                            <th scope="col">Jum</th>
                            <th scope="col">Sab</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bulan as $bul )
                        <tr>
                            <th scope="row">{{ $bul }}</th>
                            <td style="text-align: center">1</td>
                            <td style="text-align: center">2</td>
                            <td style="text-align: center">3</td>
                            <td style="text-align: center">4</td>
                            <td style="text-align: center">5</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> --}}

        {{-- <div class="col-sm-12">
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
                        <table class="display" id="tabel_jadwal" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="2px">No</th>
                                    <th width="1px">Tanggal</th>
                                    <th width="2px">Bulan</th>
                                    <th width="2px">Tahun</th>
                                    <th width="2px">Regu</th>
                                    <th width="2px">Jam Masuk</th>
                                    <th width="2px">Jam Keluar</th>
                                    <th width="2px">Detail</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="product-box">
                    <div class="product-img">
                        <img class="img-fluid" src="{{ asset('assets/images/blog/jadwal_kerja.jpg')}}"  alt="" data-original-title=""title="">
                        <div class="product-hover">
                            <ul>
                                <li>
                                    <button class="btn" type="button" data-toggle="modal"
                                        data-target="#exampleModalCenter" data-original-title="" title=""><i
                                            class="icon-eye"></i></button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen">
                            <img class="img-fluid" src="{{ asset('assets/images/blog/jadwal_kerja.jpg')}}" alt="" data-original-title="" title="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>

                            </tr>
                        </thead>
                        <tbody>
                            <tr height="1px">
                            <th style="width:10%" class="bg-primary" scope="row">A</th>
                            @foreach ($A as $aa)
                            <td style="text-align: center">{{ $aa }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th class="bg-primary" scope="row">B</th>
                            @foreach ($B as $bb)
                            <td style="text-align: center">{{ $bb }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th class="bg-primary" scope="row">C</th>
                            @foreach ($C as $cc)
                            <td style="text-align: center">{{ $cc }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th class="bg-primary" scope="row">D</th>
                            @foreach ($D as $dd)
                            <td style="text-align: center">{{ $dd }}</td>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>

                    <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>

                            <th scope="col">Min</th>
                            <th scope="col">Sen</th>
                            <th scope="col">Sel</th>
                            <th scope="col">Rab</th>
                            <th scope="col">Kam</th>
                            <th scope="col">Jum</th>
                            <th scope="col">Sab</th>

                            <th scope="col">Min</th>
                            <th scope="col">Sen</th>
                            <th scope="col">Sel</th>
                            <th scope="col">Rab</th>
                            <th scope="col">Kam</th>
                            <th scope="col">Jum</th>
                            <th scope="col">Sab</th>

                            <th scope="col">Min</th>
                            <th scope="col">Sen</th>
                            <th scope="col">Sel</th>
                            <th scope="col">Rab</th>
                            <th scope="col">Kam</th>
                            <th scope="col">Jum</th>
                            <th scope="col">Sab</th>

                            <th scope="col">Min</th>
                            <th scope="col">Sen</th>
                            <th scope="col">Sel</th>
                            <th scope="col">Rab</th>
                            <th scope="col">Kam</th>
                            <th scope="col">Jum</th>
                            <th scope="col">Sab</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bulan as $bul )
                        <tr>
                            <th style="text-align: center" scope="row">{{ $bul }}</th>
                            <td style="text-align: center">1</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div> --}}


{{-- MODAL TAMBAH --}}
<div class="modal fade" id="tambah_data" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Karyawan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    {{ csrf_field()}}
                    <div class="form-group">
                        <label class="col-form-label" for="departemen">Nama Departemen</label>
                        <input class="form-control" name="nama_departemen" type="text" placeholder="Departemen"
                            required>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary" type="submit">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- AKHIR MODAL TAMBAH --}}







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

    //TOMBOL TAMBAH DATA
    //jika tombol-tambah diklik maka
    // $('#tombol-tambah').click(function () {
    //     $('#button-simpan').val("create-post"); //valuenya menjadi create-post
    //     $('#customer_id').val(''); //valuenya menjadi kosong
    //     $('#form-tambah-edit').trigger("reset"); //mereset semua input dll didalamnya
    //     $('#modal-judul').html("Add Project"); //valuenya tambah pegawai baru
    //     $('#tambah-edit-modal').modal('show'); //modal tampil
    // });


    var nama_bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
        'November', 'Desember'
    ];

    //MULAI DATATABLE
    //script untuk memanggil data json dari server dan menampilkannya berupa datatable
    $(document).ready(function () {
        $('#tabel_jadwal').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side
            ajax: {
                url: "{{ route('data_jadwal') }}",
                type: 'GET'
            },
            columns: [{
                    data: 'id_jadwal',
                    name: 'id_jadwal'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal',
                },
                {
                    data: 'bulan',
                    name: 'bulan',
                    render: function (data) {
                        return nama_bulan[data - 1]
                    },
                },
                {
                    data: 'tahun',
                    name: 'tahun'
                },
                {
                    data: 'id_regu',
                    name: 'id_regu'
                },
                {
                    data: 'jam_masuk',
                    name: 'jam_masuk'
                },
                {
                    data: 'jam_keluar',
                    name: 'jam_keluar'
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

    //SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
    //jika id = form-tambah-edit panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
    //jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
    // if ($("#form-tambah-edit").length > 0) {
    //     $("#form-tambah-edit").validate({
    //         submitHandler: function (form) {
    //             var actionType = $('#tombol-simpan').val();
    //             $('#tombol-simpan').html('Sending..');
    //             var idnya = $('#id').val();

    //             $.ajax({
    //                 data: $('#form-tambah-edit')
    //                     .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
    //                 url: "{{ route('data_jadwal') }}", //url simpan data
    //                 type: "POST", //karena simpan kita pakai method POST
    //                 dataType: 'json', //data tipe kita kirim berupa JSON
    //                 success: function (data) { //jika berhasil
    //                     $('#form-tambah-edit').trigger("reset"); //form reset
    //                     $('#tambah-edit-modal').modal('hide'); //modal hide
    //                     $('#tombol-simpan').html('Simpan'); //tombol simpan
    //                     var oTable = $('#table_project').dataTable(); //inialisasi datatable
    //                     oTable.fnDraw(false); //reset datatable
    //                     iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
    //                         title: 'Data Berhasil Disimpan',
    //                         message: '{{ Session('
    //                         success ')}}',
    //                         position: 'bottomRight'
    //                     });
    //                 },
    //                 error: function (data) { //jika error tampilkan error pada console
    //                     console.log('Error:', data);
    //                     $('#tombol-simpan').html('Simpan');
    //                 }
    //             });
    //         }
    //     })
    // }

    //TOMBOL EDIT DATA PER PEGAWAI DAN TAMPIKAN DATA BERDASARKAN ID PEGAWAI KE MODAL
    //ketika class edit-post yang ada pada tag body di klik maka
    // $('body').on('click', '.edit-post', function () {
    //     var data_id = $(this).data('id');
    //     $.get('data-project/' + data_id + '/edit', function (data) {
    //         $('#modal-judul').html("Edit Data Project");
    //         $('#tombol-simpan').val("edit-post");
    //         $('#tambah-edit-modal').modal('show');

    //         //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas
    //         $('#id').val(data.id);
    //         $('#project_name').val(data.project_name);
    //         $('#status').val(data.status);
    //         $('#start_date').val(data.start_date);
    //         $('#end_date').val(data.end_date);
    //         $('#employee_name').val(data.employee_name);
    //         $('#workpartner_name').val(data.workpartner_name);
    //         $('#customer_name').val(data.customer_name);
    //     })
    // });

    //jika klik class delete (yang ada pada tombol delete) maka tampilkan modal konfirmasi hapus maka
    // $(document).on('click', '.delete', function () {
    //     dataId = $(this).attr('id');
    //     $('#konfirmasi-modal').modal('show');
    // });

    //jika tombol hapus pada modal konfirmasi di klik maka
    // $('#tombol-hapus').click(function () {
    //     $.ajax({

    //         url: "data-project/" + dataId, //eksekusi ajax ke url ini
    //         type: 'delete',
    //         beforeSend: function () {
    //             $('#tombol-hapus').text('Hapus Data'); //set text untuk tombol hapus
    //         },
    //         success: function (data) { //jika sukses
    //             setTimeout(function () {
    //                 $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
    //                 var oTable = $('#table_project').dataTable();
    //                 oTable.fnDraw(false); //reset datatable
    //             });
    //             iziToast.warning({ //tampilkan izitoast warning
    //                 title: 'Data Berhasil Dihapus',
    //                 message: '{{ Session('
    //                 delete ')}}',
    //                 position: 'bottomRight'
    //             });
    //         }
    //     })
    // });
</script>
<!-- JAVASCRIPT -->

@endsection
