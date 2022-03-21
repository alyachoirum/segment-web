@extends('main')

@section('judul')
Notifikasi
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-2">
                <h3>Notifikasi</h3>
            </div>
            <div class="col-sm-8">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Notifikasi</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 box-col-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{route('find_notif')}}" method="get" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-10">
                                    <input autocomplete="off" class="form-control" type="text" name="q" id="q" value="" placeholder="Search...">
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" class="btn btn-primary" value="Search"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">

                    @foreach ($notifikasi as $notif )
                    @if ($notif->kategori_notifikasi == "Presensi")
                        <a href="#">
                            <div class="alert alert-primary inverse mb-3" role="alert">
                                <i class="icofont icofont-runner-alt-2"></i>
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5>{{ $notif->judul_notifikasi }}</h5>
                                    </div>
                                    <div class="col-md-4" style="text-align: right">
                                        <th>{{ Carbon\Carbon::parse($notif->created_at)->diffForHumans()}} </th>
                                    </div>
                                </div>
                                <p>{{ $notif->isi_notifikasi }}</p>
                            </div>
                        </a>
                    @elseif ($notif->kategori_notifikasi == "Pengajuan")
                        <a href="#">
                            <div class="alert alert-warning inverse mb-3" role="alert">
                                <i class="icofont icofont-list"></i>
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5>{{ $notif->judul_notifikasi }}</h5>
                                    </div>
                                    <div class="col-md-4" style="text-align: right">
                                        <th>{{ Carbon\Carbon::parse($notif->created_at)->diffForHumans()}} </th>
                                    </div>
                                </div>
                                <p>{{ $notif->isi_notifikasi }}</p>
                            </div>
                        </a>
                    @elseif ($notif->kategori_notifikasi == "Approve")
                        <a href="#">
                            <div class="alert alert-approve inverse mb-3" role="alert">
                                <i class="icofont icofont-checked"></i>
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5>{{ $notif->judul_notifikasi }}</h5>
                                    </div>
                                    <div class="col-md-4" style="text-align: right">
                                        <th>{{ Carbon\Carbon::parse($notif->created_at)->diffForHumans()}} </th>
                                    </div>
                                </div>
                                <p>{{ $notif->isi_notifikasi }}</p>
                            </div>
                        </a>
                    @elseif ($notif->kategori_notifikasi == "Reject")
                        <a href="#">
                            <div class="alert alert-danger inverse mb-3" role="alert">
                                <i class="icofont icofont-close-squared-alt"></i>
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5>{{ $notif->judul_notifikasi }}</h5>
                                    </div>
                                    <div class="col-md-4" style="text-align: right">
                                        <th>{{ Carbon\Carbon::parse($notif->created_at)->diffForHumans()}} </th>
                                    </div>
                                </div>
                                <p>{{ $notif->isi_notifikasi }}</p>
                            </div>
                        </a>
                    @endif

                    @endforeach

                    {{-- {{ $notifikasi->total() }} total data notifikasi --}}
                    {{-- Current Page: {{ $notifikasi->currentPage() }}<br>
                    Jumlah Data: {{ $notifikasi->total() }}<br>
                    Data perhalaman: {{ $notifikasi->perPage() }}<br> --}}


                    <br>

                    {{ $notifikasi->render("pagination::bootstrap-4") }}

                    {{-- {{ $notifikasi->links() }} --}}

                    {{-- <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end pagination-primary">
                            <li class="page-item"><a class="page-link" href="#" data-original-title="" title="">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#" data-original-title="" title="">1</a></li>
                            <li class="page-item"><a class="page-link" href="#" data-original-title="" title="">2</a></li>
                            <li class="page-item"><a class="page-link" href="#" data-original-title="" title="">3</a></li>
                            <li class="page-item"><a class="page-link" href="#" data-original-title="" title="">Next</a></li>
                        </ul>
                    </nav> --}}

                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display yajra-datatable" id="notif" width="100%">
                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Notifikasi</th>
                                    <th>Dibuat</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($notifikasi as $notif )
                                <tr>
                                    <td></td>
                                    <td>{{ $notif->created_at }}</td>
                                    <td>{{ $notif->judul_notifikasi }}</td>
                                    <td>{{ $notif->isi_notifikasi }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> --}}



@endsection

@section('script')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>

<!-- JAVASCRIPT -->
    {{-- <script>
        //CSRF TOKEN PADA HEADER
        //Script ini wajib krn kita butuh csrf token setiap kali mengirim request post, patch, put dan delete ke server
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        //MULAI DATATABLE
        //script untuk memanggil data json dari server dan menampilkannya berupa datatable
        $(document).ready(function () {
            $('#notif').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side
                ajax: {
                    url: "{{ route('notifikasi')}}",
                    type: 'GET'
                },
                columns: [
                    {
                        data: '',
                        name: ''
                    },
                    {
                        data: '',
                        name: ''
                    },
                    {
                        data: '',
                        name: ''
                    },
                    {
                        data: '',
                        name: ''
                    },
                ],
                order: [
                    [0, 'asc']
                ]
            });
        });
    </script> --}}
    <!-- JAVASCRIPT -->
@endsection
