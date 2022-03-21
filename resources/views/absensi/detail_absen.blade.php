@extends('main')

@section('judul')
Detail Absen
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Detail Absen</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href=""><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Data Absen</li>
                    <li class="breadcrumb-item">Detail Absen</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="edit-profile">

        <div class="row">
            <div class="col-xl-3">
                <div class="card">
                    <div class="product-box">
                        <div class="product-img"><img class="img-fluid"
                                src="{{ asset('assets/foto_bukti_sakit/'.$data_absen->bukti)}}" alt="" data-original-title=""
                                title="">
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
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenter" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="product-box row">
                                            <div class="product-img col-md-8"><img class="img-fluid"
                                                    src="{{ asset('assets/foto_bukti_sakit/'.$data_absen->bukti)}}" alt=""
                                                    data-original-title="" title=""></div>

                                        </div>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"
                                            data-original-title="" title=""><span aria-hidden="true">×</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-xl-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Detail Absen</h4>
                        <div class="card-options"><a class="card-options-collapse" href="#"
                                data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                class="card-options-remove" href="#" data-toggle="card-remove"><i
                                    class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <img class="center" style="height: 250px;" src="{{ asset('assets/foto_profil/'.$data_absen->foto)}}" alt=""
                                            data-original-title="" title="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group mb-3">
                                    <label class="form-label"><b>NIK</b></label>
                                    <input class="form-control" type="text" value="{{$data_absen->nik}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label"><b>Nama Lengkap</b></label>
                                    <input class="form-control" type="text" value="{{$data_absen->nama_lengkap}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Tanggal Absen</b></label>
                                    <input class="form-control" type="text" value="{{ date("d F Y", strtotime($data_absen->tgl_absen)) }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label"><b>Tipe Absen</b></label>
                                    <input class="form-control" type="text" value="{{$data_absen->tipe_absen}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label class="form-label"><b>Keterangan</b></label>
                                    <input class="form-control" type="text" value="{{$data_absen->detail}}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                {{-- <p class="lead">Metode Pembayaran:</p>
                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                    Billing Kita<br>
                                    BRI 1234<br>
                                    MANDIRI 1234 </p> --}}
                                {{-- <h6>Mengetahui</h6> --}}
                                <p></p>
                                <div class="table-responsive">
                                    @if ($data_absen->reject == 1)
                                    <table class="table table-condensed table-bordered table-xs">
                                        <thead>
                                            <tr>
                                                <th>DITOLAK</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <img class="center" style="height: 100px;" src="{{ asset('assets/images/rejected.png')}}" alt="" data-original-title="" title="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$rej->reject}}<br>{{$data_absen->reject_by}}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    @else
                                    <table class="table table-condensed table-bordered table-xs">
                                        <thead>
                                            <tr>
                                                <th>KARU / KAJAGA</th>
                                                <th>KASI / SPV</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                @if($data_absen->validasi == null && $data_absen->mengetahui == null)
                                                    <td>
                                                        <br><br><br><br>
                                                    </td>
                                                    <td>
                                                        <br><br><br><br>
                                                    </td>

                                                @elseif($data_absen->mengetahui == null)
                                                    <td>
                                                        <img class="center" style="height: 100px;" src="{{ asset('assets/images/approved.png')}}" alt="" data-original-title="" title="">
                                                    </td>
                                                    <td>
                                                        <br><br><br><br>
                                                    </td>
                                                @else
                                                    <td>
                                                        <img class="center" style="height: 100px;" src="{{ asset('assets/images/approved.png')}}" alt="" data-original-title="" title="">
                                                    </td>
                                                    <td>
                                                        <img class="center" style="height: 100px;" src="{{ asset('assets/images/approved.png')}}" alt="" data-original-title="" title="">
                                                    </td>
                                                @endif

                                            </tr>
                                            <tr>
                                                <td>{{$jab->jabatan->atasan_1->nama_lengkap}}<br>{{$data_absen->validasi}}</td>
                                                <td>{{$jab->jabatan->atasan_2->nama_lengkap}}<br>{{$data_absen->mengetahui}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-footer">
                            <a href="{{ URL::previous() }}" class="btn btn-primary btn-block" >Kembali</a>
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
@endsection
