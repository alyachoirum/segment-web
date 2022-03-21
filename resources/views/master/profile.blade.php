@extends('main')

@section('judul')
Profile
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>User Profile</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Profile</li>
                </ol>
            </div>
        </div>
    </div>
</div>



<div class="container-fluid">
    <div class="user-profile">
        <div class="row">
            <!-- user profile first-style start-->
            <div class="col-xl-12">
                <div class="card hovercard text-center">
                    <div class="cardheader"></div>
                    @foreach ($user as $us)
                    @foreach ($profile as $profil)
                    <div class="user-image mb-5">
                        <div class="avatar"><img alt="" src="{{ asset('assets/foto_profil/'.$us->foto)}}"></div>
                        <div class="icon-wrapper">

                            @if (auth()->user()->id_level_user == 1)
                            <a href="{{ route('profile_detail', $hash->encodeHex($us->id_user))}}">
                                <i class="icofont icofont-pencil-alt-5"></i>
                            </a>

                            @elseif (auth()->user()->id_level_user == 12)
                            <a href="{{ route('profile_detail', $hash->encodeHex($us->id_user))}}">
                                <i class="icofont icofont-pencil-alt-5"></i>
                            </a>

                            @elseif ($us->id_user == auth()->user()->id_user)
                            <a href="{{ route('profile_detail', $hash->encodeHex(auth()->user()->id_user))}}">
                                <i class="icofont icofont-pencil-alt-5"></i>
                            </a>

                            @else
                            <a href="#">
                                <i class="icofont icofont-pencil-alt-5"></i>
                            </a>
                            @endif
                        </div>

                    </div>

                    @if ($us->id_user == auth()->user()->id_user)
                        <a href="{{ route('change_password', $hash_change_password->encodeHex($us->id_user))}}">
                            <button class="btn btn-primary" data-original-title="" title="">Ganti Password</button>
                        </a>
                    @else

                    @endif


                    <div class="info">

                        <div class="row mb-4">
                            <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>NIK</b></h6>
                                            <span>{{$profil->nik}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>Nama Lengkap</b></h6>
                                            <span>{{$profil->nama_lengkap}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                                <div class="user-designation">
                                    <div class="title">
                                        <h6>Level User</h6><a target="_blank"
                                            href="{{ route('profile_detail',$us->id_user)}}"></a>
                                    </div>
                                    <div class="desc mt-2">{{$us->nama_level}}</div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>Departemen</b></h6>
                                            <span>{{$us->nama_departemen}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>Email</b></h6>
                                            <span>{{$us->email}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-4">
                            <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>Zona</b></h6>
                                            <span>{{$profil->nama_zona}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>Regu</b></h6>
                                            <span>{{$profil->nama_regu}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>Jabatan</b></h6>
                                            <span>{{$profil->nama_jabatan}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>PT</b></h6>
                                            <span>{{$profil->pt}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>No KIB</b></h6>
                                            <span>{{$profil->no_kib}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>Tanggal Lahir</b></h6>
                                            <span>{{$profil->tgl_lahir}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-4">
                            <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>Alamat</b></h6>
                                            <span>{{$profil->alamat}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>RT/RW</b></h6>
                                            <span>{{$profil->rtrw}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>Desa</b></h6>
                                            <span>{{$profil->desa}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>Kecamatan</b></h6>
                                            <span>{{$profil->kecamatan}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>Kabupaten</b></h6>
                                            <span>{{$profil->kabupaten}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>No Hp</b></h6>
                                            <span>{{$profil->no_hp}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-4">
                            <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>No KTP</b></h6>
                                            <span>{{$profil->no_ktp}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>Kompetensi Gada</b></h6>
                                            <span>{{$profil->kompetensi_gada}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>No Reg</b></h6>
                                            <span>{{$profil->no_reg}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>No KTA</b></h6>
                                            <span>{{$profil->no_kta}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>No Ijazah</b></h6>
                                            <span>{{$profil->no_ijazah}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ttl-info text-left">
                                            <h6><b>Jatuh Tempo Gada</b></h6>
                                            <span>{{$profil->tgl_jatuhtempo_gada}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Struktur Atasan</h4>
                                    <div class="card-options"><a class="card-options-collapse" href="#"
                                            data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                            class="card-options-remove" href="#" data-toggle="card-remove"><i
                                                class="fe fe-x"></i></a></div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <input style="text-align: center" class="form-control" type="text" value="{{$jab->jabatan->atasan_2->nama_lengkap}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                {{-- <label class="form-label"><b>Nama Lengkap</b></label> --}}
                                                <input style="text-align: center" class="form-control" type="text" value="{{$jab->jabatan->atasan_1->nama_lengkap}}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                {{-- <label class="form-label"><b></b></label> --}}
                                                <input style="text-align: center" class="form-control" type="text" value="{{$profil->nama_lengkap}}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>

                                    </div>
                                </div>
                            </div>
                        </div>



                        @endforeach
                        @endforeach

                        {{-- <div class="social-media">
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fa fa-rss"></i></a></li>
                            </ul>
                        </div> --}}
                        {{-- <div class="follow">
                            <div class="row">
                                <div class="col-6 text-md-right border-right">
                                    <div class="follow-num counter">25869</div><span>Follower</span>
                                </div>
                                <div class="col-6 text-md-left">
                                    <div class="follow-num counter">659887</div><span>Following</span>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <!-- user profile first-style end-->
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
@endsection
