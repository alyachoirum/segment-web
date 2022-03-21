@extends('main')

@section('judul')
Ganti Password
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Ganti Password</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href=""><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Profile</li>
                    <li class="breadcrumb-item">Ganti Password</li>
                </ol>
            </div>

        </div>
    </div>
</div>
@error('current_password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h4>Ganti Password</h4>
                </div> --}}
                <form action="{{route('profile.change.password')}}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                    <form class="theme-form">
                        <div class="form-group">
                            <label class="col-form-label">Password Lama</label>
                            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required
                                        placeholder="Masukkan password lama">
                            @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            {{-- <input class="form-control" type="password" name="login[password]" required=""
                                placeholder="*********"> --}}
                            {{-- <div class="show-hide"><span class="show"></span></div> --}}
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Password Baru</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required
                                        placeholder="Masukkan password baru">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            {{-- <input class="form-control" type="password" name="login[password]" required=""
                                placeholder="*********"> --}}
                            {{-- <div class="show-hide"><span class="show"></span></div> --}}
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Ulangi Password Baru</label>
                            <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror"required
                                        placeholder="Ulangi password baru">
                            @error('confirm_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            {{-- <input class="form-control" type="password" name="login[password]" required=""
                                placeholder="*********"> --}}
                            {{-- <div class="show-hide"><span class="show"></span></div> --}}
                        </div>
                        <br>
                        <div class="form-group mb-0">
                            {{-- <div class="checkbox p-0">
                                    <input id="checkbox1" type="checkbox">
                                    <label class="text-muted" for="checkbox1">Remember password</label>
                                </div> --}}
                            <button class="btn btn-primary btn-block" type="submit" id="formSubmit">Ganti Password</button>
                        </div>
                        <p class="mt-4 mb-0">Lupa password anda?<a class="ml-2" href="#">Reset Password</a></p>
                    </form>
                </div>

                <div class="form-footer">
                    <a href="{{ URL::previous() }}" class="btn btn-primary" data-original-title="" title="">Kembali</a>
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
@endsection
