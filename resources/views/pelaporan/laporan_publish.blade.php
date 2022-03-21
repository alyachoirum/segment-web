@extends('main')

@section('judul')
Laporan Publish
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Laporan Publish</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Laporan Publish</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid product-wrapper">
    <div class="product-grid">
        <div class="feature-products">
            <div class="row">
                <div class="col-md-6 mb-3 products-total">
                    <div class="square-product-setting d-inline-block"><a class="icon-grid grid-layout-view" href="#"
                            data-original-title="" title=""><i data-feather="grid"></i></a></div>
                    <div class="square-product-setting d-inline-block"><a class="icon-grid m-0 list-layout-view"
                            href="#" data-original-title="" title=""><i data-feather="list"></i></a></div><span
                        class="d-none-productlist filter-toggle">
                        Filters<span class="ml-2"><i class="toggle-data" data-feather="chevron-down"></i></span></span>
                    <div class="grid-options d-inline-block">
                        <ul>
                            <li><a class="product-2-layout-view" href="#" data-original-title="" title=""><span
                                        class="line-grid line-grid-1 bg-primary"></span><span
                                        class="line-grid line-grid-2 bg-primary"></span></a></li>
                            <li><a class="product-3-layout-view" href="#" data-original-title="" title=""><span
                                        class="line-grid line-grid-3 bg-primary"></span><span
                                        class="line-grid line-grid-4 bg-primary"></span><span
                                        class="line-grid line-grid-5 bg-primary"></span></a></li>
                            <li><a class="product-4-layout-view" href="#" data-original-title="" title=""><span
                                        class="line-grid line-grid-6 bg-primary"></span><span
                                        class="line-grid line-grid-7 bg-primary"></span><span
                                        class="line-grid line-grid-8 bg-primary"></span><span
                                        class="line-grid line-grid-9 bg-primary"></span></a></li>
                            <li><a class="product-6-layout-view" href="#" data-original-title="" title=""><span
                                        class="line-grid line-grid-10 bg-primary"></span><span
                                        class="line-grid line-grid-11 bg-primary"></span><span
                                        class="line-grid line-grid-12 bg-primary"></span><span
                                        class="line-grid line-grid-13 bg-primary"></span><span
                                        class="line-grid line-grid-14 bg-primary"></span><span
                                        class="line-grid line-grid-15 bg-primary"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <span class="f-w-600 m-r-5"></span>
                    <div class="select2-drpdwn-product select-options d-inline-block">
                        <select class="form-control btn-square" name="select">
                            <option value="">Filter</option>
                            <option value="1">Normal</option>
                            <option value="2">Medium</option>
                            <option value="3">High</option>
                            <option value="4">Urgent</option>
                        </select>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-sm-3">
                    <div class="product-sidebar">
                        <div class="filter-section">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0 f-w-600">Filters<span class="pull-right"><i
                                                class="fa fa-chevron-down toggle-data"></i></span></h6>
                                </div>
                                <div class="left-filter">
                                    <div class="card-body filter-cards-view animate-chk">
                                        <div class="product-filter">
                                            <h6 class="f-w-600">Category</h6>
                                            <div class="checkbox-animated mt-0">
                                                <label class="d-block" for="edo-ani5">
                                                    <input class="radio_animated" id="edo-ani5" type="radio"
                                                        data-original-title="" title="">Man Shirt
                                                </label>
                                                <label class="d-block" for="edo-ani6">
                                                    <input class="radio_animated" id="edo-ani6" type="radio"
                                                        data-original-title="" title="">Man Jeans
                                                </label>
                                                <label class="d-block" for="edo-ani7">
                                                    <input class="radio_animated" id="edo-ani7" type="radio"
                                                        data-original-title="" title="">Woman Top
                                                </label>
                                                <label class="d-block" for="edo-ani8">
                                                    <input class="radio_animated" id="edo-ani8" type="radio"
                                                        data-original-title="" title="">Woman Jeans
                                                </label>
                                                <label class="d-block" for="edo-ani9">
                                                    <input class="radio_animated" id="edo-ani9" type="radio"
                                                        data-original-title="" title="">Man T-shirt
                                                </label>
                                            </div>
                                        </div>
                                        <div class="product-filter">
                                            <h6 class="f-w-600">Brand</h6>
                                            <div class="checkbox-animated mt-0">
                                                <label class="d-block" for="chk-ani">
                                                    <input class="checkbox_animated" id="chk-ani" type="checkbox"
                                                        data-original-title="" title=""> Levi's
                                                </label>
                                                <label class="d-block" for="chk-ani1">
                                                    <input class="checkbox_animated" id="chk-ani1" type="checkbox"
                                                        data-original-title="" title="">Diesel
                                                </label>
                                                <label class="d-block" for="chk-ani2">
                                                    <input class="checkbox_animated" id="chk-ani2" type="checkbox"
                                                        data-original-title="" title="">Lee
                                                </label>
                                                <label class="d-block" for="chk-ani3">
                                                    <input class="checkbox_animated" id="chk-ani3" type="checkbox"
                                                        data-original-title="" title="">Hudson
                                                </label>
                                                <label class="d-block" for="chk-ani4">
                                                    <input class="checkbox_animated" id="chk-ani4" type="checkbox"
                                                        data-original-title="" title="">Denizen
                                                </label>
                                                <label class="d-block" for="chk-ani5">
                                                    <input class="checkbox_animated" id="chk-ani5" type="checkbox"
                                                        data-original-title="" title="">Spykar
                                                </label>
                                            </div>
                                        </div>
                                        <div class="product-filter slider-product">
                                            <h6 class="f-w-600">Colors</h6>
                                            <div class="color-selector">
                                                <ul>
                                                    <li class="white"></li>
                                                    <li class="gray"></li>
                                                    <li class="black"></li>
                                                    <li class="orange"></li>
                                                    <li class="green"></li>
                                                    <li class="pink"></li>
                                                    <li class="yellow"></li>
                                                    <li class="blue"></li>
                                                    <li class="red"></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-filter pb-0">
                                            <h6 class="f-w-600">Price</h6>
                                            <input id="u-range-03" type="text">
                                            <h6 class="f-w-600">New Products</h6>
                                        </div>
                                        <div class="product-filter pb-0 new-products">
                                            <div class="owl-carousel owl-theme" id="testimonial">
                                                <div class="item">
                                                    <div class="product-box row">
                                                        <div class="product-img col-md-5"><img class="img-fluid img-100"
                                                                src="../assets/images/ecommerce/01.jpg" alt=""
                                                                data-original-title="" title=""></div>
                                                        <div class="product-details col-md-7 text-left"><span><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning"></i></span>
                                                            <p class="mb-0">Fancy Shirt</p>
                                                            <div class="product-price">$100.00</div>
                                                        </div>
                                                    </div>
                                                    <div class="product-box row">
                                                        <div class="product-img col-md-5"><img class="img-fluid img-100"
                                                                src="../assets/images/ecommerce/02.jpg" alt=""
                                                                data-original-title="" title=""></div>
                                                        <div class="product-details col-md-7 text-left"><span><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning"></i></span>
                                                            <p class="mb-0">Fancy Shirt</p>
                                                            <div class="product-price">$100.00</div>
                                                        </div>
                                                    </div>
                                                    <div class="product-box row">
                                                        <div class="product-img col-md-5"><img class="img-fluid img-100"
                                                                src="../assets/images/ecommerce/03.jpg" alt=""
                                                                data-original-title="" title=""></div>
                                                        <div class="product-details col-md-7 text-left"><span><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning"></i></span>
                                                            <p class="mb-0">Fancy Shirt</p>
                                                            <div class="product-price">$100.00</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <div class="product-box row">
                                                        <div class="product-img col-md-5"><img class="img-fluid img-100"
                                                                src="../assets/images/ecommerce/01.jpg" alt=""
                                                                data-original-title="" title=""></div>
                                                        <div class="product-details col-md-7 text-left"><span><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning"></i></span>
                                                            <p class="mb-0">Fancy Shirt</p>
                                                            <div class="product-price">$100.00</div>
                                                        </div>
                                                    </div>
                                                    <div class="product-box row">
                                                        <div class="product-img col-md-5"><img class="img-fluid img-100"
                                                                src="../assets/images/ecommerce/02.jpg" alt=""
                                                                data-original-title="" title=""></div>
                                                        <div class="product-details col-md-7 text-left"><span><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning"></i></span>
                                                            <p class="mb-0">Fancy Shirt</p>
                                                            <div class="product-price">$100.00</div>
                                                        </div>
                                                    </div>
                                                    <div class="product-box row">
                                                        <div class="product-img col-md-5"><img class="img-fluid img-100"
                                                                src="../assets/images/ecommerce/03.jpg" alt=""
                                                                data-original-title="" title=""></div>
                                                        <div class="product-details col-md-7 text-left"><span><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning mr-1"></i><i
                                                                    class="fa fa-star font-warning"></i></span>
                                                            <p class="mb-0">Fancy Shirt</p>
                                                            <div class="product-price">$100.00 </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-filter text-center"><img class="img-fluid banner-product"
                                                src="../assets/images/ecommerce/banner.jpg" alt=""
                                                data-original-title="" title=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <form>
                        <div class="form-group m-0">
                            <input class="form-control" type="search" placeholder="Search.." data-original-title=""
                                title=""><i class="fa fa-search"></i>
                        </div>
                    </form>
                </div>
            </div> --}}
        </div>


        <div class="product-wrapper-grid">
            <div class="row">

                @foreach ($data_laporan as $laporan)
                <div class="col-xl-3 col-sm-6 xl-4">
                    <div class="card">
                        <div class="product-box">
                            <div class="product-img">
                                @if($laporan->prioritas=='Normal')
                                <div class="ribbon ribbon-success ribbon-right">{{$laporan->prioritas}}</div>
                                @elseif($laporan->prioritas=='Medium')
                                <div class="ribbon ribbon-info ribbon-right">{{$laporan->prioritas}}</div>
                                @elseif($laporan->prioritas=='High')
                                <div class="ribbon ribbon-warning ribbon-right">{{$laporan->prioritas}}</div>
                                @elseif($laporan->prioritas=='Urgent')
                                <div class="ribbon ribbon-danger ribbon-right">{{$laporan->prioritas}}</div>
                                @endif
                                @foreach ($foto->where('id_laporan', $laporan->id_laporan) as $ft)
                                    @if ($loop->first)
                                        <img class="img-fluid" src="{{ asset('foto/laporan'.$ft->foto)}}" style="" alt="">
                                    @endif
                                @endforeach
                                <div class="product-hover">
                                    <ul>
                                        {{-- <li>
                                            <button class="btn" type="button"><i
                                                    class="icon-shopping-cart"></i></button>
                                        </li> --}}
                                        <li>
                                            <a href="{{ route('detail_laporan', $laporan->id_laporan)}}">
                                                <button class="btn" type="button"><i class="icon-eye"></i></button>
                                            </a>
                                        </li>
                                        {{-- <li>
                                            <button class="btn" type="button"><i
                                                    class="icofont icofont-law-alt-2"></i></button>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>

                            {{-- <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenter3" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            Detail Laporan
                                            <button class="close" type="button" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">× </span></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="product-box row">
                                                <div class="card">
                                                    <div class="row product-page-main">
                                                        <div class="col-xl-1"> </div>
                                                        <div class="col-xl-10">
                                                            <div class="product-slider owl-carousel owl-theme"
                                                                id="sync1">
                                                                <div class="item"><img
                                                                        src="../assets/images/ecommerce/01.jpg" alt="">
                                                                </div>
                                                                <div class="item"><img
                                                                        src="../assets/images/ecommerce/02.jpg" alt="">
                                                                </div>
                                                                <div class="item"><img
                                                                        src="../assets/images/ecommerce/03.jpg" alt="">
                                                                </div>
                                                                <div class="item"><img
                                                                        src="../assets/images/ecommerce/04.jpg" alt="">
                                                                </div>
                                                                <div class="item"><img
                                                                        src="../assets/images/ecommerce/05.jpg" alt="">
                                                                </div>
                                                                <div class="item"><img
                                                                        src="../assets/images/ecommerce/06.jpg" alt="">
                                                                </div>
                                                                <div class="item"><img
                                                                        src="../assets/images/ecommerce/07.jpg" alt="">
                                                                </div>
                                                                <div class="item"><img
                                                                        src="../assets/images/ecommerce/08.jpg" alt="">
                                                                </div>
                                                            </div>
                                                            <div class="owl-carousel owl-theme" id="sync2">
                                                                <div class="item"><img
                                                                        src="../assets/images/ecommerce/01.jpg" alt="">
                                                                </div>
                                                                <div class="item"><img
                                                                        src="../assets/images/ecommerce/02.jpg" alt="">
                                                                </div>
                                                                <div class="item"><img
                                                                        src="../assets/images/ecommerce/03.jpg" alt="">
                                                                </div>
                                                                <div class="item"><img
                                                                        src="../assets/images/ecommerce/04.jpg" alt="">
                                                                </div>
                                                                <div class="item"><img
                                                                        src="../assets/images/ecommerce/05.jpg" alt="">
                                                                </div>
                                                                <div class="item"><img
                                                                        src="../assets/images/ecommerce/06.jpg" alt="">
                                                                </div>
                                                                <div class="item"><img
                                                                        src="../assets/images/ecommerce/07.jpg" alt="">
                                                                </div>
                                                                <div class="item"><img
                                                                        src="../assets/images/ecommerce/08.jpg" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-1"> </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="product-page-details">
                                                <h3>{{$laporan->judul_laporan}}</h3>
                                            </div>
                                            <hr>
                                            <p>{{$laporan->deskripsi}}</p>
                                            <hr>

                                            <div class="row">
                                                <div class="col-xl-2">
                                                    <img class="img-thumbnail rounded-circle mr-3" src="{{ asset('assets/foto_profil/'.$laporan->foto_profil)}}"
                                                    style="width: 50px; height: 50px;" alt="profil">
                                                </div>
                                                <div class="col-xl-10">
                                                    <div class="product-price">
                                                {{$laporan->nama_user}}
                                            </div>
                                            <small>{{ date('d-m-Y', strtotime($laporan->created_at))}}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="product-details">
                                <h4>{{$laporan->judul_laporan}}</h4>
                                <hr>
                                <p class="mb-4">{{Str::limit($laporan->kronologi_kejadian, 150, '...')}}</p>

                                <div class="row">
                                    <div class="col-md-3">
                                        <li class="d-inline-block">
                                            {{-- <img class="img-thumbnail rounded-circle"
                                            src="{{ asset('assets/foto_profil/'.$laporan->foto)}}"
                                            style="width: 50px; height: 50px;" alt="profil"> --}}
                                        </li>

                                    </div>
                                    <div class="col-md-9">
                                        <div class="product-price">
                                            {{-- {{$laporan->nama_lengkap}} --}}
                                        </div>
                                        <small>{{ date('d-m-Y', strtotime($laporan->created_at))}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

@endsection

@section('script')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>

<script src="{{ asset('assets/js/range-slider/ion.rangeSlider.min.js')}}"></script>
<script src="{{ asset('assets/js/range-slider/rangeslider-script.js')}}"></script>
<script src="{{ asset('assets/js/touchspin/vendors.min.js')}}"></script>
<script src="{{ asset('assets/js/touchspin/touchspin.js')}}"></script>
<script src="{{ asset('assets/js/touchspin/input-groups.min.js')}}"></script>
<script src="{{ asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
<script src="{{ asset('assets/js/product-tab.js')}}"></script>
<script src="{{ asset('assets/js/ecommerce.js')}}"></script>

@endsection
