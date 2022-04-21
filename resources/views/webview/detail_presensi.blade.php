@extends('main_webview')

@section('judul')
Detail Data Presensi
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-md-3" style="padding-left:11%">
                <div class="btn-group" role="group" aria-label="Basic example">
                    {{-- <input class="btn btn-secondary" type="button" onclick="printDiv('printableArea')" value="print a div!"/> --}}
                    {{-- <button class="btn btn-secondary" data-toggle="modal" data-original-title="" data-target="#print" onclick="printDiv('printableArea')">
                        <i class="fa fa-print"></i> | PRINT
                    </button> --}}
                    {{-- <button class="btn btn-secondary" data-toggle="modal" data-original-title=""
                        data-target="#print" onclick="window.open('{{route('absensi_karyawan_print', auth()->user()->karyawan->nik)}}');">
                        <i class="fa fa-print"></i> | PRINT
                    </button> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->

<div class="container-fluid" id="printableArea">
    <div class="card">
        <div class="card-body">

            @foreach ($data_karyawan as $kar )
            <div class="row">
                <div class="col-sm-4" style="text-align:center">
                    <div class="media-img">
                        @if ($kar->pt == 'AJG')
                        <img style="height: 90px;" src="{{ asset('assets/images/other-images/ajg.png')}}" alt=""
                        data-original-title="" title="">
                        @elseif ($kar->pt == 'FJM')
                        <img style="height: 90px;" src="{{ asset('assets/images/other-images/fjm.png')}}" alt=""
                        data-original-title="" title="">
                        @endif
                    </div>
                </div>
                <div class="col-sm-3 invoice-col">
                    <i class="fa fa-calendar"></i> Masa :
                    <br>
                    {{ date("d-m-Y", strtotime($date_first)) }} - {{ date("d-m-Y", strtotime($date_end)) }}
                </div>
                <!-- /.col -->
                <div class="col-sm-2 invoice-col">
                    <b>Nama</b><br>
                    <b>NIK</b><br>
                    <b>Klasifikasi</b><br>
                    <b>Unit Kerja</b>
                </div>
                <div class="col-sm-3 invoice-col">
                    : {{ $kar->nama_lengkap }}<br>
                    : {{ $kar->nik }} <br>
                    : {{ $kar->nama_jabatan }}<br>
                    : <span class="label label-success">{{ $kar->nama_zona }}</span>
                </div>

            </div>
            @endforeach

            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <h5 style="text-align: center">Detail Data Presensi Bulan {{ $bulan->nama_bulan }}</h5>
                </div>
                {{-- <div class="col-md-3" style="padding-left:11%">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <input class="btn btn-secondary" type="button" onclick="printDiv('printableArea')" value="print a div!" />
                        <button class="btn btn-secondary" data-toggle="modal" data-original-title=""
                            data-target="#print" onclick="window.open('{{route('absensi_karyawan_print', auth()->user()->karyawan->nik)}}');">
                            <i class="fa fa-print"></i> | PRINT
                        </button>
                    </div>
                </div> --}}
            </div>

            <div class="table-responsive">
                <table class="table table-border-horizontal">
                    <thead>
                        <tr>
                            <th rowspan="2" width="2px" style="text-align: center; vertical-align : middle;text-align:center;">Tgl</th>
                            <th colspan="2" width="2px" style="text-align: center; vertical-align : middle;text-align:center;" >Jam Kerja</th>
                            <th rowspan="2" width="2px"style="text-align: center; vertical-align : middle;text-align:center;">Total (SPL)</th>
                            <th rowspan="2" width="2px"style="text-align: center; vertical-align : middle;text-align:center;">Total (LK)</th>
                            <th rowspan="2" width="900px"style="text-align: center; vertical-align : middle;text-align:center;">Ket. SPL</th>
                            <th rowspan="2" width="900px"style="text-align: center; vertical-align : middle;text-align:center;">Ket. LK</th>
                            <th rowspan="2" width="500px"style="text-align: center; vertical-align : middle;text-align:center;">Ket. Absen</th>
                        </tr>
                        <tr>
                            <th width="50px" style="text-align: center">Datang</th>
                            <th width="50px"style="text-align: center">Pulang</th>
                        </tr>
                    </thead>
                    @foreach ($data_absen as $abs)

                        <tbody>
                            <tr>
                                <td height="30px" style="text-align: center">{{ date('d', strtotime($abs->tanggal))}}</td>

                                @if ($abs->jadwal_kerja == "OFF")
                                <td style="text-align: center">OFF</td>
                                <td style="text-align: center">OFF</td>
                                @elseif (!is_null($abs->id_absensi))
                                <td style="text-align: center">ABSEN</td>
                                <td style="text-align: center">ABSEN</td>
                                @else
                                <td style="text-align: center">{{ date('H.i', strtotime($abs->check_in))}}</td>
                                <td style="text-align: center">{{ date('H.i', strtotime($abs->check_out))}}</td>
                                @endif

                                @if (!is_null($abs->id_lembur))
                                <td style="text-align: center">
                                    <a href="/detail_lembur/{{ $abs->id_lembur }}">
                                        <button class="btn btn-primary btn-xs" type="button" data-original-title="Detail Lembur" title="">
                                            {{ $abs->total_jam_lembur }}
                                        </button>
                                    </a>
                                </td>
                                @else
                                <td style="text-align: center"></td>
                                @endif

                                @if (!is_null($abs->id_lembur_khusus))
                                <td style="text-align: center">
                                    <a href="/detail_lembur_khusus/{{ $abs->id_lembur_khusus }}">
                                        <button class="btn btn-primary btn-xs" type="button" data-original-title="Detail Lembur Khusus" title="">
                                            {{ $abs->total_jam_lembur_khusus }}
                                        </button>
                                    </a>
                                </td>
                                @else
                                <td style="text-align: center"></td>
                                @endif

                                <td style="text-align: center">{{ $abs->detail_lembur}}</td>
                                <td style="text-align: center">{{ $abs->detail_lembur_khusus}}</td>
                                <td style="text-align: center">
                                    <a href="/detail_absen/{{ $abs->id_absensi }}">
                                        {{ $abs->detail}}
                                    </a>
                                </td>
                            </tr>
                        </tbody>

                    @endforeach
                        <tfoot>
                            <th colspan="3" width="2px" style="text-align: center; vertical-align : middle;text-align:center;">Jumlah</th>
                            <th width="2px" style="text-align: center; vertical-align : middle;text-align:center;">SPL : {{$spl}}</th>
                            <th width="2px" style="text-align: center; vertical-align : middle;text-align:center;">LK : {{$lk}}</th>
                            <th width="2px" style="text-align: center; vertical-align : middle;text-align:center;"></th>
                            <th width="2px" style="text-align: center; vertical-align : middle;text-align:center;"></th>
                            <th width="2px" style="text-align: center; vertical-align : middle;text-align:center;"></th>
                        </tfoot>
                </table>
            </div>


            <div class="row">
                <div class="col-sm-9 invoice-col">
                    <h6>Mengetahui</h6>
                    <p>Gresik, </p>
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered table-xs">
                            <thead>
                                @if ($pt->pt == 'AJG')
                                <tr>
                                    <th>PT. Aneka Jasa Gradika</th>
                                    <th></th>
                                    <th>PT. Petrokimia Gresik</th>
                                </tr>
                                @elseif ($pt->pt == 'FJM')
                                <tr>
                                    <th>PT. Fokus jasa Mitra</th>
                                    <th></th>
                                    <th>PT. Petrokimia Gresik</th>
                                </tr>
                                @endif
                            </thead>
                            <tbody>
                                <tr>
                                    <td><br><br><br><br></td>
                                    <td><br><br><br><br></td>
                                    <td><br><br><br><br></td>
                                </tr>
                            <tr>
                                <td>Badge</td>
                                <td></td>
                                <td>Badge</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-3 invoice-col">
                    <h6>Catatan</h6>
                    <div class="table-responsive">
                        <table class="table table-striped table-xs">
                            <tbody>
                                <tr>
                                    <th>Hadir</th>
                                    <td>{{$hadir}}</td>
                                </tr>
                                <tr>
                                    <th>Absen</th>
                                    <td>{{$mangkir}}</td>
                                </tr>
                                <tr>
                                    <th>Ijin</th>
                                    <td>{{$ijin}}</td>
                                </tr>
                                <tr>
                                    <th>Sakit</th>
                                    <td>{{$sakit}}</td>
                                </tr>
                                <tr>
                                    <th>Cuti</th>
                                    <td>{{$cuti}}</td>
                                </tr>
                                <tr>
                                    <th>Dispensasi</th>
                                    <td>{{$dispensasi}}</td>
                                </tr>
                                <tr>
                                    <th>SPL</th>
                                    <td>{{$spl}}</td>
                                </tr>
                                <tr>
                                    <th>Lembur Khusus</th>
                                    <td>{{$lk}}</td>
                                </tr>
                            </tbody>
                        </table>
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


<script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
@endsection
