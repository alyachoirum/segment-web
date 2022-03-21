@extends('main')

@section('judul')
Rekap Zona Filter
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-md-9">
                <h3>List Rekap Zona Bulanan</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">List Rekap Zona Bulanan</li>
                </ol>
            </div>

            <div class="col-md-3" style="padding-left:11%">
                <div class="btn-group" role="group" aria-label="Basic example">
                    {{-- <input class="btn btn-secondary" type="button" onclick="printDiv('printableArea')" value="print a div!"/> --}}
                    <button class="btn btn-secondary" data-toggle="modal" data-original-title="" data-target="#print"
                        onclick="printDiv('printableArea')">
                        <i class="fa fa-print"></i> | PRINT
                    </button>
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
            <div class="row">
                <div class="col-sm-12" style="text-align:center">
                    <h2>Rekap Absensi Tenaga Alih Daya</h2>
                </div>
                <div class="col-sm-12" style="text-align:center">
                    <h3><b>Bulan {{ $bulan->nama_bulan }}</b> </h3>
                </div>
                <div class="col-sm-12" style="text-align:center">
                    <h4>({{ date('d-F-Y',strtotime($dateFirst)) }} - {{ date('d-F-Y',strtotime($dateEnd)) }})</h4>
                </div>
            </div>
            <hr>
            <br>
            <div class="row">
                <div class="table-responsive-xs mb-3">
                    <table class="table table-striped table-xs" border="1">
                        <thead>
                            <th width="20px"style="text-align: center; vertical-align : middle;text-align:center;">
                                <b>NIK</b>
                            </th>
                            <th width="1000px" style="text-align: center; vertical-align : middle;text-align:center;">
                                <b>NAMA</b>
                            </th>
                            <th width="1px" style="text-align: center; vertical-align : middle;text-align:center;">
                                <b>R</b>
                            </th>
                            <th width="1px" style="text-align: center; vertical-align : middle;text-align:center;">
                                <b>H</b>
                            </th>
                            <th width="1px" style="text-align: center; vertical-align : middle;text-align:center;">
                                <b>A</b>
                            </th>
                            <th width="1px" style="text-align: center; vertical-align : middle;text-align:center;">
                                <b>I</b>
                            </th>
                            <th width="1px" style="text-align: center; vertical-align : middle;text-align:center;">
                                <b>S</b>
                            </th>
                            <th width="1px" style="text-align: center; vertical-align : middle;text-align:center;">
                                <b>C</b>
                            </th>
                            <th width="1px" style="text-align: center; vertical-align : middle;text-align:center;">
                                <b>D</b>
                            </th>
                            <th width="1px" style="text-align: center; vertical-align : middle;text-align:center;">
                                <b>SPL</b>
                            </th>
                            <th width="1px" style="text-align: center; vertical-align : middle;text-align:center;">
                                <b>LK</b>
                            </th>
                            {{-- <th width="50px"style="text-align: center; vertical-align : middle;text-align:center;"><h6><b>TGL TH</b></h6></th> --}}
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp

                            @foreach ($data_karyawan as $karyawan)
                            <tr page-break-inside:avoid; page-break-after:auto>
                                <td style="text-align: center">{{ $karyawan->nik }}</td>
                                <td style="text-align: center">{{ $karyawan->nama_lengkap }}</td>
                                <td style="text-align: center">{{ $karyawan->regu->nama_regu }}</td>
                                <td style="text-align: center">{{ $karyawan->h }}</td>
                                <td style="text-align: center">{{ $karyawan->a }}</td>
                                <td style="text-align: center">{{ $karyawan->i }}</td>
                                <td style="text-align: center">{{ $karyawan->s }}</td>
                                <td style="text-align: center">{{ $karyawan->c }}</td>
                                <td style="text-align: center">{{ $karyawan->d }}</td>
                                <td style="text-align: center">{{ $karyawan->spl }}</td>
                                <td style="text-align: center">{{ $karyawan->lk }}</td>
                                {{-- <td style="text-align: center">
                                    <p>@foreach ($karyawan->tgl_th as $th){{ str_replace(' ', '', $th) }},@endforeach
                                </p>
                                </td> --}}
                            </tr>
                            @endforeach
                            @php
                            $no++
                            @endphp
                        </tbody>
                        {{-- <tfoot>
                            <th style="text-align: center"> Total</th>
                            <th style="text-align: center">41</th>
                            <th></th>
                            <th style="text-align: center">51</th>
                            <th style="text-align: center">32</th>
                            <th style="text-align: center">53</th>
                            <th style="text-align: center">23</th>
                            <th style="text-align: center">32</th>
                            <th style="text-align: center">13</th>
                            <th style="text-align: center">52</th>
                            <th style="text-align: center">13</th>
                        </tfoot> --}}
                    </table>
                </div>

                <br>
                <br>

                <div class="col-sm-8 invoice-col">
                    <h6>Mengetahui</h6>
                    <p>Gresik, </p>
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered table-xs">
                            <thead>
                                <tr>
                                    <th>PT. Fokus jasa Mitra</th>
                                    <th></th>
                                    <th>PT. Petrokimia Gresik</th>
                                </tr>
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
                <div class="col-sm-4 invoice-col">
                    <h6>Catatan</h6>
                    <div class="table-responsive">
                        <table class="table table-striped table-xs">
                            <tbody>
                                <tr>
                                    <th>R</th>
                                    <td>Regu</td>
                                </tr>
                                <tr>
                                    <th>H</th>
                                    <td>Hadir</td>
                                </tr>
                                <tr>
                                    <th>A</th>
                                    <td>Absen</td>
                                </tr>
                                <tr>
                                    <th>I</th>
                                    <td>Ijin</td>
                                </tr>
                                <tr>
                                    <th>S</th>
                                    <td>Sakit</td>
                                </tr>
                                <tr>
                                    <th>C</th>
                                    <td>Cuti</td>
                                </tr>
                                <tr>
                                    <th>D</th>
                                    <td>Dispensasi</td>
                                </tr>
                                <tr>
                                    <th>SPL</th>
                                    <td>Surat Perintah Lembur</td>
                                </tr>
                                <tr>
                                    <th>LK</th>
                                    <td>Lembur Khusus</td>
                                </tr>
                                {{-- <tr>
                                <th>Tgl TH</th>
                                <td>Tanggal Tidak Hadir</td>
                            </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="form-footer">
    <a href="{{ URL::previous() }}" class="btn btn-primary btn-block">Kembali</a>
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
