@extends('main')

@section('judul')
Detail Lembur
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Detail Lembur</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href=""><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Data Lembur</li>
                    <li class="breadcrumb-item">Detail Lembur</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="edit-profile">

        <div class="row">

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Detail Lembur</h4>
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
                                        <img class="center" style="height: 250px;" src="{{ asset('assets/foto_profil/'.$data_lembur->foto)}}" alt=""
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
                                    <input class="form-control" type="text" value="{{$data_lembur->nik}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group mb-3">
                                    <label class="form-label"><b>Nama Lengkap</b></label>
                                    <input class="form-control" type="text" value="{{$data_lembur->nama_lengkap}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><b>Tanggal Lembur</b></label>
                                    <input class="datepicker-here form-control" type="text"
                                        value="{{$data_lembur->tgl_lembur}}" data-language="en" data-original-title="" title=""
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label"><b>Total Jam Lembur</b></label>
                                    <input class="form-control" type="text" value="{{$data_lembur->total_jam_lembur}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label class="form-label"><b>Keterangan</b></label>
                                    <input class="form-control" type="text" value="{{$data_lembur->detail_lembur}}" readonly>
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
                                    @if ($data_lembur->reject == 1)
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
                                                <td>{{$rej->reject}}<br>{{$data_lembur->reject_by}}</td>
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
                                                @if($data_lembur->validasi == null && $data_lembur->mengetahui == null)
                                                    <td>
                                                        <br><br><br><br>
                                                    </td>
                                                    <td>
                                                        <br><br><br><br>
                                                    </td>
                                                @elseif($data_lembur->mengetahui == null)
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
                                            @if($data_lembur->validasi == null && $data_lembur->mengetahui == null)
                                            <td><br>{{$data_lembur->validasi}}</td>
                                            <td><br>{{$data_lembur->mengetahui}}</td>

                                            @elseif($data_lembur->mengetahui == null)
                                            <td>{{$nama_validasi->nama_lengkap}}<br>{{$data_lembur->validasi}}</td>
                                            <td><br>{{$data_lembur->mengetahui}}</td>

                                            @else
                                            <td>{{$nama_validasi->nama_lengkap}}<br>{{$data_lembur->validasi}}</td>
                                            <td>{{$nama_mengetahui->nama_lengkap}}<br>{{$data_lembur->mengetahui}}</td>
                                            @endif

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
