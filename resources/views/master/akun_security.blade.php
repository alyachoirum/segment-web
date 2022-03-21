@extends('main')

@section('judul')
Akun Security
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Data Akun Security</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Data Akun Security</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    @if( $massage = Session::get('success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Tambah Akun Security Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @elseif( $massage = Session::get('edit_success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Edit Akun Security Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @elseif( $massage = Session::get('hapus_success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Hapus Akun Security Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h5>Akun Security</h5>
                        </div>

                        {{-- <div class="col-md-4" style="padding-left:13%">
                            <td>
                                <a href="#">
                                    <button class="btn btn-outline-primary" type="button" data-toggle="modal"
                                        data-target="#tambah_data" data-original-title="Isi secara lengkap" title="">+
                                        Akun Security</button>
                                </a>
                            </td>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="tabel_security">
                            <thead>
                                <tr>
                                    <th width="2px">Id</th>
                                    <th>Foto</th>
                                    <th>NIK</th>
                                    <th width="500px">Nama</th>
                                    <th>Departemen</th>
                                    <th width="150px" style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="tambah_data" tabindex="-1" role="dialog">
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

        //MULAI DATATABLE
        //script untuk memanggil data json dari server dan menampilkannya berupa datatable
        $(document).ready(function () {
            $('#tabel_security').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side
                ajax: {
                    url: "{{ route('data_security')}}",
                    type: 'GET'
                },
                columns: [
                    {
                        data: 'id_user',
                        name: 'id_user'
                    },
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
                        data: 'nama_departemen',
                        name: 'nama_departemen'
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
@endsection
