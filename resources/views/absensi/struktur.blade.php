@extends('main')

@section('judul')
Struktur
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-3">
                <h3>Struktur Depkam</h3>
            </div>
            <div class="col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Struktur Depkam</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->

<div class="container-fluid">
    <h4 style="text-align: center" class="mb-5">Struktur Departemen Keamanan PT Petrokimia Gresik</h4>

    <div class="row">
        <div class="col-md-4">
            <div class="card">

            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div style="text-align:center" class="mt-3">
                    <h5>{{ $vp->nama_lengkap }}</h5>
                    <p>{{ $vp->nama_jabatan }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">

            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div style="text-align:center" class="mt-3">
                    <h5>{{ $avp_opsmin->nama_lengkap }}</h5>
                    <p>{{ $avp_opsmin->nama_jabatan }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div style="text-align:center" class="mt-3">
                    <h5>{{ $avp_kawasan->nama_lengkap }}</h5>
                    <p>{{ $avp_kawasan->nama_jabatan }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div style="text-align:center" class="mt-3">
                    <h5>{{ $avp_pabrik->nama_lengkap }}</h5>
                    <p>{{ $avp_pabrik->nama_jabatan }}</p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div style="text-align:center" class="mt-3">
                    <h6>{{ $spv_security->nama_lengkap }}</h6>
                    <p>{{ $spv_security->nama_jabatan }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div style="text-align:center" class="mt-3">
                    <h6>{{ $spv_tuks->nama_lengkap }}</h6>
                    <p>{{ $spv_tuks->nama_jabatan }}</p>
                </div>
                <div style="text-align:center" class="mt-3">
                    <h6>{{ $spv_kawasan->nama_lengkap }}</h6>
                    <p>{{ $spv_kawasan->nama_jabatan }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div style="text-align:center" class="mt-3">
                    <h6>{{ $spv_zona_1->nama_lengkap }}</h6>
                    <p>{{ $spv_zona_1->nama_jabatan }}</p>
                </div>
                <div style="text-align:center" class="mt-3">
                    <h6>{{ $spv_zona_2->nama_lengkap }}</h6>
                    <p>{{ $spv_zona_2->nama_jabatan }}</p>
                </div>
                <div style="text-align:center" class="mt-3">
                    <h6>{{ $spv_zona_3->nama_lengkap }}</h6>
                    <p>{{ $spv_zona_3->nama_jabatan }}</p>
                </div>
                <div style="text-align:center" class="mt-3">
                    <h6>{{ $spv_zona_4->nama_lengkap }}</h6>
                    <p>{{ $spv_zona_4->nama_jabatan }}</p>
                </div>
                <div style="text-align:center" class="mt-3">
                    <h6>{{ $spv_zona_5->nama_lengkap }}</h6>
                    <p>{{ $spv_zona_5->nama_jabatan }}</p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div style="text-align:center" class="mt-3">
                    <h6>{{ $foreman_security_a->nama_lengkap }}</h6>
                    <p>{{ $foreman_security_a->nama_jabatan }}</p>
                </div>
                <div style="text-align:center" class="mt-3">
                    <h6>{{ $foreman_security_b->nama_lengkap }}</h6>
                    <p>{{ $foreman_security_b->nama_jabatan }}</p>
                </div>
                <div style="text-align:center" class="mt-3">
                    <h6>{{ $foreman_security_c->nama_lengkap }}</h6>
                    <p>{{ $foreman_security_c->nama_jabatan }}</p>
                </div>
                <div style="text-align:center" class="mt-3">
                    <h6>{{ $foreman_security_d->nama_lengkap }}</h6>
                    <p>{{ $foreman_security_d->nama_jabatan }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div style="text-align:center" class="mt-3">
                    <h6>{{ $foreman_tuks->nama_lengkap }}</h6>
                    <p>{{ $foreman_tuks->nama_jabatan }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                {{-- <div style="text-align:center" class="mt-3">
                    <h6>{{ $avp_pabrik->nama_lengkap }}</h6>
                    <p>{{ $avp_pabrik->nama_jabatan }}</p>
                </div> --}}
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div style="text-align:center" class="mt-3">
                    <h6>{{ $staff_opsmin->nama_lengkap }}</h6>
                    <p>{{ $staff_opsmin->nama_jabatan }}</p>
                </div>
                <div style="text-align:center" class="mt-3">
                    <h6>{{ $staff_kib->nama_lengkap }}</h6>
                    <p>{{ $staff_kib->nama_jabatan }}</p>
                </div>
                @foreach ($staff_penyelidik as $penyelidik)
                <div style="text-align:center" class="mt-3">
                    <h6>{{ $penyelidik->nama_lengkap }}</h6>
                    <p>{{ $penyelidik->nama_jabatan }}</p>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                {{-- <div style="text-align:center" class="mt-3">
                    <h5>{{ $vp->nama_lengkap }}</h5>
                    <p>{{ $vp->nama_jabatan }}</p>
                </div> --}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                {{-- <div style="text-align:center" class="mt-3">
                    <h5>{{ $staff_zona_1->nama_lengkap }}</h5>
                    <p>{{ $staff_zona_1->nama_jabatan }}</p>
                </div>
                <div style="text-align:center" class="mt-3">
                    <h5>{{ $staff_zona_2->nama_lengkap }}</h5>
                    <p>{{ $staff_zona_2->nama_jabatan }}</p>
                </div>
                <div style="text-align:center" class="mt-3">
                    <h5>{{ $staff_zona_3->nama_lengkap }}</h5>
                    <p>{{ $staff_zona_3->nama_jabatan }}</p>
                </div>
                <div style="text-align:center" class="mt-3">
                    <h5>{{ $staff_zona_4->nama_lengkap }}</h5>
                    <p>{{ $staff_zona_4->nama_jabatan }}</p>
                </div>
                <div style="text-align:center" class="mt-3">
                    <h5>{{ $staff_zona_5->nama_lengkap }}</h5>
                    <p>{{ $staff_zona_5->nama_jabatan }}</p>
                </div> --}}

            </div>
        </div>
    </div>

</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h6>Catatan</h6>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered table-xs">
                            <thead>
                                <tr style="text-align: center">
                                    <th>Karyawan Organik</th>
                                    <th>Karyawan Non Organik</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="text-align: center">
                                    <td><br><br><h2>{{ $jumlah_kar_organik }}</h2><br><br></td>
                                    <td><br><br><h2>{{ $jumlah_kar_non_organik }}</h2><br><br></td>
                                </tr>
                                {{-- <tr>
                                    <td>Total</td>
                                    <td>Total</td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="form-footer">
            <a href="{{ URL::previous() }}" class="btn btn-primary btn-block" >Kembali</a>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
@endsection
