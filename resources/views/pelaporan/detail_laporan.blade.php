@extends('main')

@section('judul')
Akun Admin
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Detail Laporan</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Detail Laporan</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="user-profile">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="profile-img-style">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="media">
                                    {{-- <img class="img-thumbnail rounded-circle mr-3"
                                        src="{{ asset('assets/foto_profil/'.$detail->foto)}}"
                                        alt="Generic placeholder image"> --}}
                                    <div class="media-body align-self-center">
                                        {{-- <h5 class="mt-0 user-name">{{$detail->nama_lengkap}}</h5> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 align-self-center">
                                <div class="float-sm-right">
                                    <small>{{ date('d-m-Y', strtotime($detail->created_at))}}</small></div>
                            </div>
                        </div>
                        <hr>

                        <div class="owl-carousel owl-theme my-gallery" id="owl-carousel-13">

                            @foreach ($foto as $ft)
                            <figure class="item" itemprop="associatedMedia" itemscope=""><a
                                    href="{{ asset('foto/laporan'.$ft->foto)}}" itemprop="contentUrl"
                                    data-size="1600x950">
                                    <img class="img-thumbnail" src="{{ asset('foto/laporan'.$ft->foto)}}"
                                        itemprop="thumbnail" alt="Image description"></a>
                                <figcaption itemprop="caption description">{{$detail->judul_laporan}}</figcaption>
                            </figure>
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
            <!-- user profile fourth-style end-->

            <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="pswp__bg"></div>
                <div class="pswp__scroll-wrap">
                    <div class="pswp__container">
                        <div class="pswp__item"></div>
                        <div class="pswp__item"></div>
                        <div class="pswp__item"></div>
                    </div>
                    <div class="pswp__ui pswp__ui--hidden">
                        <div class="pswp__top-bar">
                            <div class="pswp__counter"></div>
                            <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                            <button class="pswp__button pswp__button--share" title="Share"></button>
                            <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                            <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                            <div class="pswp__preloader">
                                <div class="pswp__preloader__icn">
                                    <div class="pswp__preloader__cut">
                                        <div class="pswp__preloader__donut"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                            <div class="pswp__share-tooltip"></div>
                        </div>
                        <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                        <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                        <div class="pswp__caption">
                            <div class="pswp__caption__center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="media">
                        {{-- <img class="img-40 img-fluid m-r-20" src="../assets/images/job-search/1.jpg" alt="" data-original-title="" title=""> --}}
                        <div class="media-body">
                            @if($detail->prioritas=='Normal')
                            <h5 class="f-w-600"><a>{{$detail->judul_laporan}}</a>
                                <span class="badge badge-success pull-right">{{$detail->prioritas}}</span></h5>
                            <p></p>
                            @elseif($detail->prioritas=='Medium')
                            <h5 class="f-w-600"><a>{{$detail->judul_laporan}}</a>
                                <span class="badge badge-info pull-right">{{$detail->prioritas}}</span></h5>
                            <p></p>
                            @elseif($detail->prioritas=='High')
                            <h5 class="f-w-600"><a>{{$detail->judul_laporan}}</a>
                                <span class="badge badge-warning pull-right">{{$detail->prioritas}}</span></h5>
                            <p></p>
                            @elseif($detail->prioritas=='Urgent')
                            <h5 class="f-w-600"><a>{{$detail->judul_laporan}}</a>
                                <span class="badge badge-danger pull-right">{{$detail->prioritas}}</span></h5>
                            <p></p>
                            @endif
                        </div>
                    </div>
                    <h5></h5>
                </div>
                <div class="card-body">
                    <p class="mb-4">{{$detail->kronologi_kejadian}}</p>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('script')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
<script src="{{ asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
<script src="{{ asset('assets/js/owlcarousel/owl-custom.js')}}"></script>
@endsection
