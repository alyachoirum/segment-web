@extends('main')

@section('judul')
Berita - Pengumuman
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Data Berita</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Data Berita</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    @if( $massage = Session::get('success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Tambah Berita Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @elseif( $massage = Session::get('edit_success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Edit Berita Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @elseif( $massage = Session::get('hapus_success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Hapus Berita Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h5>Berita</h5>
                        </div>

                        <div class="col-md-3" style="padding-left:13%">
                            <td>
                                <a href="#">
                                    <button class="btn btn-outline-primary" type="button" data-toggle="modal"
                                        data-target="#tambah_data" data-original-title="Isi secara lengkap"
                                        title="">+ Berita</button>
                                </a>
                            </td>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center">Gambar</th>
                                    <th style="text-align: center">Judul</th>
                                    <th style="text-align: center">Deskripsi</th>
                                    <th style="text-align: center">Dibuat Oleh</th>
                                    <th width="2px" style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($data_berita as $berita)
                                <tr>
                                    <td width="2px" style="text-align: center"><?=$no?></td>
                                    <td>
                                        <div class="my-gallery" id="aniimated-thumbnials-3" itemscope="">
                                            <figure itemprop="associatedMedia" itemscope=""><a
                                                    href="{{ asset('assets/gambar_berita/'.$berita->gambar)}}" itemprop="contentUrl"
                                                    data-size="1600x950"><img class="img-fluid rounded"
                                                        src="{{ asset('assets/gambar_berita/'.$berita->gambar)}}" itemprop="thumbnail"
                                                        alt="gallery"></a>
                                                <figcaption itemprop="caption description">Image caption 1</figcaption>
                                            </figure>
                                        </div>
                                    </td>
                                    <td>{{$berita->judul}}</td>
                                    <td>{{$berita->deskripsi}}</td>
                                    <td>{{$berita->nama_lengkap}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-original-title="Detail" data-target="#view{{$berita->id_berita}}"><i
                                                    class="fa fa-eye"></i></button>
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-original-title="Edit" data-target="#edit{{$berita->id_berita}}"><i
                                                    class="fa fa-edit"></i></button>
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-original-title="Hapus" data-target="#delete{{$berita->id_berita}}"><i
                                                    class="fa fa-eraser"></i></button>
                                        </div>
                                    </td>

                                    {{-- MODAL VIEW --}}
                                    <div class="modal fade" id="view{{$berita->id_berita}}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detail Data Admin</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post">
                                                        {{ csrf_field() }}

                                                        <img class="img-fluid" src="{{ asset('assets/gambar_berita/'.$berita->gambar)}}">

                                                        <div class="form-group">
                                                            <label class="col-form-label" for="nama_pengguna">Judul</label>
                                                            <input class="form-control" name="fullname" type="text" value="{{$berita->judul}}" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label" for="nama_pengguna">Deskripsi</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea25" readonly name="deskripsi" rows="3">{{$berita->deskripsi}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label" for="nama_pengguna">Dibuat Oleh</label>
                                                            <input class="form-control" name="fullname" type="text" value="{{$berita->nama_lengkap}}" readonly>
                                                        </div>


                                                </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- AKHIR MODAL VIEW --}}


                                    {{-- MODAL EDIT --}}
                                    <div class="modal fade" id="edit{{$berita->id_berita}}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Data Berita</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="edit_berita/{{$berita->id_berita}}" method="post" enctype="multipart/form-data">
                                                        {{ csrf_field() }}

                                                        <div class="form-group">
                                                            <br>
                                                            <img class="img-100 img-fluid m-r-20 update_img_0 mx-auto d-block" src="assets/gambar_berita/{{$berita->gambar}}" alt="">
                                                            <br>
                                                            <br>
                                                            <div class="col-md-12">
                                                                <input type="file" class="custom-file-input" name="gambar" id="inputGroupFile01" required="">
                                                                <label class="custom-file-label" for="inputGroupFile01">Ganti Gambar Berita</label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-form-label" for="judul">Judul Berita</label>
                                                            <input class="form-control" name="judul" type="text" placeholder="Judul Berita" value="{{$berita->judul}}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Deskripsi</label>
                                                            <textarea class="form-control" name="deskripsi" rows="3">{{$berita->deskripsi}}</textarea>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button class="btn btn-primary" type="submit">Edit</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- AKHIR MODAL EDIT --}}

                                    <!-- DELETE MODAL -->
                                    <div id="delete{{$berita->id_berita}}" class="modal fade" tabindex="-1"
                                        role="dialog" aria-labelledby="fill-danger-modalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content modal-filled bg-danger">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="fill-danger-modalLabel">Konfirmasi Hapus
                                                        Data</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Data akan hilang selamanya</p>
                                                    <p>Apakah anda yakin menghapusnya?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-dismiss="modal">Close</button>
                                                    <a href="{{route('delete_berita',$berita->id_berita)}}"
                                                        class="btn btn-outline-light">Hapus
                                                    </a>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
                                    <!-- AKHIR DELETE MODAL -->


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

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="tambah_data" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Berita</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('tambah_berita')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-form-label">Gambar</label>
                        <div class="col-md-12">
                            <input type="file" class="custom-file-input" name="gambar" id="inputGroupFile01"
                                required="">
                            <label class="custom-file-label" for="inputGroupFile01">Pilih Gambar</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="judul">Judul Berita</label>
                        <input class="form-control" name="judul" type="text" placeholder="Judul Berita" required>
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3"> </textarea>
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
@endsection
