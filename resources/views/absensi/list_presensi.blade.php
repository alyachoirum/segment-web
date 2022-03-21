@extends('main')

@section('judul')
Data Presensi
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Data Presensi</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Data Presensi</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->

<div class="container-fluid">
    <h4>Tahun 2022</h4>
    <div class="row">
        @foreach ($data_bulan as $bulan )
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden">
                <a href="{{ route('detail_presensi',$bulan->id_bulan)}}">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="calendar"></i></div>
                            <div class="media-body"><span class="m-0">
                                    <h4>{{ $bulan->nama_bulan }}</h4>
                                </span>
                                <i class="icon-bg" data-feather="calendar"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection

@section('script')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
@endsection
