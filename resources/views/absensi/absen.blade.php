@extends('main')

@section('judul')
Absen Karyawan
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-3">
                <h3>Absen Karyawan</h3>
            </div>
            <div class="col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('data_karyawan')}}">Menu Karyawan</a>
                    </li>
                    <li class="breadcrumb-item">Absen</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    @if( $massage = Session::get('success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <strong>Form Absen Berhasil !</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title=""
            title=""><span aria-hidden="true">×</span></button>
    </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('form_ijin', $hash->encodeHex(auth()->user()->id_user))}}">
                <div class="card browser-widget">
                    <div class="media card-body align-self-center">
                        <div class="media-img">
                            <img style="height: 250px;" src="{{ asset('assets/images/dashboard/ijin.png')}}" alt=""
                                data-original-title="" title="">
                        </div>
                    </div>
                    <div class="align-self-center mb-3" style="text-align:center">
                        <h4>Ijin</h4>
                        <p>Form ijin</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="{{ route('form_dispensasi', $hash->encodeHex(auth()->user()->id_user))}}">
                <div class="card browser-widget">
                    <div class="media card-body align-self-center">
                        <div class="media-img">
                            <img style="height: 250px;" src="{{ asset('assets/images/dashboard/dispensasi.png')}}" alt=""
                                data-original-title="" title="">
                        </div>
                    </div>
                    <div class="align-self-center mb-3" style="text-align:center">
                        <h4>Dispensasi</h4>
                        <p>Form dispensasi</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="{{ route('form_cuti', $hash->encodeHex(auth()->user()->id_user))}}">
                <div class="card browser-widget">
                    <div class="media card-body align-self-center">
                        <div class="media-img">
                            <img style="height: 250px;" src="{{ asset('assets/images/dashboard/cuti.png')}}" alt=""
                                data-original-title="" title="">
                        </div>
                    </div>
                    <div class="align-self-center mb-3" style="text-align:center">
                        <h4>Cuti</h4>
                        <p>Form cuti</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="{{ route('form_sakit', $hash->encodeHex(auth()->user()->id_user))}}">
                <div class="card browser-widget">
                    <div class="media card-body align-self-center">
                        <div class="media-img">
                            <img style="height: 250px;" src="{{ asset('assets/images/dashboard/sakit.png')}}" alt=""
                                data-original-title="" title="">
                        </div>
                    </div>
                    <div class="align-self-center mb-3" style="text-align:center">
                        <h4>Sakit</h4>
                        <p>Form sakit</p>
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
