@extends('main')

@section('judul')
List Pengajuan
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-2">
                <h3>List Pengajuan</h3>
            </div>
            <div class="col-10">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('data_karyawan')}}">Menu Karyawan</a>
                    </li>
                    <li class="breadcrumb-item">List Pengajuan</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    @if( $massage = Session::get('success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Form Tambah Lembur Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @elseif( $massage = Session::get('success_lk'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Form Tambah Lembur Khusus Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @elseif( $massage = Session::get('success_ts'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Form Tukar Shift Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('list_tukar_shift') }}">
                <div class="card browser-widget">
                    <div class="media card-body align-self-center">
                        <div class="media-img">
                            <img style="height: 250px;" src="{{ asset('assets/images/dashboard/tukarshift.png')}}" alt=""
                                data-original-title="" title="">
                        </div>
                    </div>
                    <div class="align-self-center mb-3" style="text-align:center">
                        <h4>Tukar Shift</h4>
                        <p>Data tukar shift</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('list_lembur') }}">
                <div class="card browser-widget">
                    <div class="media card-body align-self-center">
                        <div class="media-img">
                            <img style="height: 250px;" src="{{ asset('assets/images/dashboard/lembur.png')}}" alt=""
                                data-original-title="" title="">
                        </div>
                    </div>
                    <div class="align-self-center mb-3" style="text-align:center">
                        <h4>Surat Perintah Lembur(SPL) </h4>
                        <p>Data SPL</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="{{ route('list_lembur_khusus') }}">
                <div class="card browser-widget">
                    <div class="media card-body align-self-center">
                        <div class="media-img">
                            <img style="height: 250px;" src="{{ asset('assets/images/dashboard/lembur.png')}}" alt=""
                                data-original-title="" title="">
                        </div>
                    </div>
                    <div class="align-self-center mb-3" style="text-align:center">
                        <h4>Lembur Khusus</h4>
                        <p>Data lembur khusus</p>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>

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
@endsection
