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
                            <h4>ABSENSI KEHADIRAN TENAGA</h4>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-4" style="text-align:center">
                            <div class="media-img">
                                <img style="height: 90px;" src="{{ asset('assets/images/other-images/fjm.png')}}" alt=""
                                data-original-title="" title="">
                            </div>
                        </div>
                        <div class="col-sm-3 invoice-col">
                            <i class="fa fa-calendar"></i> Masa :
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-2 invoice-col">
                            <b>Nama</b><br>
                            <b>NIK</b><br>
                            <b>Klasifikasi</b><br>
                            <b>Unit Kerja</b>
                        </div>
                        <div class="col-sm-3 invoice-col">
                            : Abdul Khamid<br>
                            : K.1215373 <br>
                            : KAJAGA<br>
                            : <span class="label label-success">KAWASAN</span>
                        </div>

                    </div>

                    <br>
                    {{-- <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            Dari :
                            <address>
                                <strong>Menak Sopal Link Nusantara</strong><br>
                                Perum. Griya Taman Agung Permai Blok E-2, Ds. Buluagung Kec. Karangan, Kabupaten Trenggalek<br>
                                Telf: 0355-7982333<br>
                                Email: marketing@menaksopal.net.id </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            Untuk :
                            <address>
                                <strong>Tes</strong><br>
                                Tes<br>
                                Telf: Tes<br>
                                Jns Cust: Tes </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>Tagihan ID # tes</b><br>
                            <br>
                            <b>Produk Layanan: tes</b> <br>
                            <b>Jatuh Tempo:</b> tes<br>
                            <b>Status:</b> <span class="label label-success">sukses</span>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row --> --}}

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-8 table-responsive-xs">
                            <table class="table table-striped table-xs">
                                <thead>
                                    <tr>
                                        <th rowspan="2" width="2px" style="text-align: center; vertical-align : middle;text-align:center;">Tgl</th>
                                        <th colspan="2" style="text-align: center; vertical-align : middle;text-align:center;" >Jam Kerja</th>
                                        <th rowspan="2" width="15px"style="text-align: center; vertical-align : middle;text-align:center;">Jumlah Lembur</th>
                                        <th rowspan="2" width="15px"style="text-align: center; vertical-align : middle;text-align:center;">Paraf</th>
                                        <th rowspan="2" width="200px"style="text-align: center; vertical-align : middle;text-align:center;">Lembur Khusus</th>
                                        <th rowspan="2" width="200px"style="text-align: center; vertical-align : middle;text-align:center;">Keterangan</th>
                                    </tr>
                                    <tr>
                                        <th width="100px" style="text-align: center">Datang</th>
                                        <th width="100px"style="text-align: center">Pulang</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 26; $i <= 31; $i++)
                                    <tr>
                                        <td height="30px" style="text-align: center">{{ $i }}</td>
                                        <td style="text-align: center">07.00</td>
                                        <td style="text-align: center">14.00</td>
                                        <td style="text-align: center">15</td>
                                        <td style="text-align: center">kajaga</td>
                                        <td style="text-align: center">Detail lemburan</td>
                                        <td style="text-align: center">Detail keseluruhan</td>
                                    </tr>
                                    @endfor



                                    @for ($i = 1; $i <= 25; $i++)
                                    <tr>
                                        <td height="30px" style="text-align: center">{{ $i }}</td>
                                        <td style="text-align: center">07.00</td>
                                        <td style="text-align: center">14.00</td>
                                        <td style="text-align: center">15</td>
                                        <td style="text-align: center">kajaga</td>
                                        <td style="text-align: center">Detail lemburan</td>
                                        <td style="text-align: center">Detail keseluruhan</td>
                                    </tr>
                                    @endfor

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
                                            <th>Cuti</th>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <th>Dispensasi</th>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <th>Sakit</th>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <th>Izin</th>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <th>Mangkir</th>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <th>Hadir</th>
                                            <td>23</td>
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

