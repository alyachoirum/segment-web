@extends('dokumen')

@section('isi')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <!-- title row -->

                    <div class="row">
                        <div class="col-sm-12" style="text-align:center">
                            <h4>Rekap Absensi Tenaga Alih Daya</h4>
                            <h6>Bulan Ini</h6>
                        </div>
                    </div>
                    <hr>
                    <br>
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive-xs">
                            <table class="table table-striped table-xs">
                                <thead>
                                    <tr>
                                        <th width="15px" style="text-align: center; vertical-align : middle;text-align:center;" >NIK</th>
                                        <th width="15px"style="text-align: center; vertical-align : middle;text-align:center;">Nama</th>
                                        <th width="15px"style="text-align: center; vertical-align : middle;text-align:center;">Z</th>
                                        <th width="15px"style="text-align: center; vertical-align : middle;text-align:center;">R</th>
                                        <th style="text-align: center; vertical-align : middle;text-align:center;">H</th>
                                        <th style="text-align: center; vertical-align : middle;text-align:center;">A</th>
                                        <th style="text-align: center; vertical-align : middle;text-align:center;">I</th>
                                        <th style="text-align: center; vertical-align : middle;text-align:center;">S</th>
                                        <th style="text-align: center; vertical-align : middle;text-align:center;">C</th>
                                        <th style="text-align: center; vertical-align : middle;text-align:center;">LR</th>
                                        <th style="text-align: center; vertical-align : middle;text-align:center;">LK</th>
                                        <th width="15px"style="text-align: center; vertical-align : middle;text-align:center;">Tgl TH</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp

                                    @foreach ($data_karyawan as $karyawan)
                                    <tr>
                                        <td style="text-align: center">{{ $karyawan->nik }}</td>
                                        <td style="text-align: center">{{ $karyawan->nama_lengkap }}</td>
                                        <td style="text-align: center">{{ $karyawan->zona->nama_zona }}</td>
                                        <td style="text-align: center">{{ $karyawan->regu->nama_regu }}</td>
                                        <td style="text-align: center">22</td>
                                        <td style="text-align: center">3</td>
                                        <td style="text-align: center">1</td>
                                        <td style="text-align: center">1</td>
                                        <td style="text-align: center">2</td>
                                        <td style="text-align: center">2</td>
                                        <td style="text-align: center">3</td>
                                        <td style="text-align: center">14, 15</td>
                                    </tr>
                                    @endforeach
                                    @php
                                    $no++
                                    @endphp
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->

                    </div>
                    <!-- /.row -->


                    <br>

                    <div class="row">
                        <div class="col-md-9">
                            {{-- <p class="lead">Metode Pembayaran:</p>
                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                Billing Kita<br>
                                BRI 1234<br>
                                MANDIRI 1234 </p> --}}
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
                        <div class="col-md-3">
                            <h6>Catatan</h6>

                            <div class="table-responsive">
                                <table class="table table-striped table-xs">
                                    <tbody>
                                        <tr>
                                            <th>Z</th>
                                            <td>Zona</td>
                                        </tr>
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
                                            <th>LR</th>
                                            <td>Lembur Real</td>
                                        </tr>
                                        <tr>
                                            <th>LK</th>
                                            <td>Lembur Khusus</td>
                                        </tr>
                                        <tr>
                                            <th>Tgl TH</th>
                                            <td>Tanggal Tidak Hadir</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection

