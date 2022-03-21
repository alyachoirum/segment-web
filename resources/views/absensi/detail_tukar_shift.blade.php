@extends('main')

@section('judul')
Detail Tukar Shift
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Detail Tukar Shift</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href=""><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Data Tukar Shift</li>
                    <li class="breadcrumb-item">Detail Tukar Shift</li>
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
                        <h4 class="card-title mb-0">Detail Tukar Shift</h4>
                        <div class="card-options"><a class="card-options-collapse" href="#"
                                data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                class="card-options-remove" href="#" data-toggle="card-remove"><i
                                    class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group" style="text-align: center">
                                    <h6>Yang Mengajukan</h6>
                                    <img class="center" style="height: 250px;" src="{{ asset('assets/foto_profil/'.$data_tukar_shift->foto)}}" alt=""
                                            data-original-title="" title="">
                                </div>
                            </div>
                            <div class="col-sm-2" style="text-align: center">
                                <i data-feather="repeat"></i>
                            </div>
                            <div class="col-sm-5">

                                <div class="form-group" style="text-align: center">
                                    <h6>Yang Menerima </h6>
                                    <img class="center" style="height: 250px;" src="{{ asset('assets/foto_profil/'.$data_penerima->foto)}}" alt=""
                                            data-original-title="" title="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group mb-3">
                                    <label class="form-label"><b>NIK</b></label>
                                    <input class="form-control" type="text" value="{{$data_tukar_shift->nik}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group mb-3">
                                    <label class="form-label"><b>Nama Lengkap</b></label>
                                    <input class="form-control" type="text" value="{{$data_tukar_shift->nama_lengkap}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><b>Tanggal Tukar</b></label>
                                    <input class="datepicker-here form-control" type="text"
                                        value="{{$data_tukar_shift->tgl_tukar}}" data-language="en" data-original-title="" title=""
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label"><b>Jam Kerja Awal</b></label>
                                    <input class="form-control" type="text" value="{{$data_tukar_shift->awal_jam_kerja}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label"><b>Jam Kerja Tukar</b></label>
                                    <input class="form-control" type="text" value="{{$data_tukar_shift->ubah_jam_kerja}}" readonly>
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
                                    @if ($data_tukar_shift->reject == 1)
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
                                                <td>{{$rej->reject}}<br>{{$data_tukar_shift->reject_by}}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    @else
                                    <table class="table table-condensed table-bordered table-xs">
                                        <thead>
                                            <tr>
                                                <th>Pihak Penerima</th>
                                                <th>Kajaga Pihak 1</th>
                                                <th>Kajaga Pihak 2</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @if($data_tukar_shift->apv_pihak2 == null && $data_tukar_shift->apv_kajaga_p1 == null && $data_tukar_shift->apv_kajaga_p2 == null )
                                                    <td>
                                                        <br><br><br><br>
                                                    </td>
                                                    <td>
                                                        <br><br><br><br>
                                                    </td>
                                                    <td>
                                                        <br><br><br><br>
                                                    </td>
                                                @elseif($data_tukar_shift->apv_kajaga_p1 == null && $data_tukar_shift->apv_kajaga_p2 == null)
                                                    <td>
                                                        <img class="center" style="height: 100px;" src="{{ asset('assets/images/approved.png')}}" alt="" data-original-title="" title="">
                                                    </td>
                                                    <td>
                                                        <br><br><br><br>
                                                    </td>
                                                    <td>
                                                        <br><br><br><br>
                                                    </td>
                                                @elseif($data_tukar_shift->apv_kajaga_p2 == null)
                                                    <td>
                                                        <img class="center" style="height: 100px;" src="{{ asset('assets/images/approved.png')}}" alt="" data-original-title="" title="">
                                                    </td>
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
                                                    <td>
                                                        <img class="center" style="height: 100px;" src="{{ asset('assets/images/approved.png')}}" alt="" data-original-title="" title="">
                                                    </td>
                                                @endif
                                            </tr>
                                        <tr>
                                            <td>{{$nama_apv_pihak2->nama_lengkap}}<br>{{$data_tukar_shift->nik_pihak2}}</td>
                                            <td>{{$nama_apv_kajaga_p1->nama_lengkap}}<br>{{$data_tukar_shift->nik_kajaga_pihak1}}</td>
                                            <td>{{$nama_apv_kajaga_p2->nama_lengkap}}<br>{{$data_tukar_shift->nik_kajaga_pihak2}}</td>
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
