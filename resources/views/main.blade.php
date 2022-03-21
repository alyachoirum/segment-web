<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="pixelstrap">
    <meta name="theme-color" content="#357644"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" href="/pwa/manifest/icon-192x192.png">

    <link rel="icon" href="{{ asset('assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png')}}" type="image/x-icon">
    <title>@yield('judul')</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css')}}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/timepicker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dropzone.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/sweetalert2.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/owlcarousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/range-slider.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/photoswipe.css')}}">

    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script> --}}

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script> --}}

    <!-- Manifest -->
    <link rel="manifest" href="{{ asset('pwa/manifest/manifest.json')}}">
    <!-- PWA -->
    <link rel="stylesheet" href="{{ asset('pwa/css/addtohomescreen.css')}}">


    @yield('link')

    {{-- <script src="{{ asset('assets/js/jquery-3.5.1.min.js')}}"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    @include('sweetalert::alert')

    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">

        <!-- Page Header Start-->
        @include('layouts.header')
        <!-- Page Header Ends-->

        <!-- Page Body Start-->
        <div class="page-body-wrapper sidebar-icon">

            <!-- Page Sidebar Start-->
            @include('layouts.sidebar')
            <!-- Page Sidebar Ends-->

            <div class="page-body">
                <!-- Container-fluid Starts-->
                @yield('isi')
                <!-- Container-fluid Ends-->
            </div>

            <!-- footer start-->
            @include('layouts.footer')
            <!-- footer ends-->

        </div>
    </div>
    <!-- latest jquery-->
    {{-- <script src="{{ asset('assets/js/jquery-3.5.1.min.js')}}"></script> --}}
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/popper.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.js')}}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets/js/config.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('assets/js/sidebar-menu.js')}}"></script>


    <script>
        var base_url = '<?php echo url('/');?>';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>


    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{ asset('assets/js/chart/chart.js/chart.min.js')}}"></script>
    <script src="{{ asset('assets/js/select2/select2.full.min.js')}}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js')}}"></script>
    {{-- <script src="{{ asset('assets/js/notify/index.js')}}"></script> --}}
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>

    {{-- <script src="{{ asset('assets/js/typeahead/handlebars.js')}}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.bundle.js')}}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.custom.js')}}"></script>
    <script src="{{ asset('assets/js/typeahead-search/handlebars.js')}}"></script>
    <script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js')}}"></script> --}}

    <script src="{{ asset('assets/js/prism/prism.min.js')}}"></script>
    <script src="{{ asset('assets/js/clipboard/clipboard.min.js')}}"></script>
    <script src="{{ asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
    <script src="{{ asset('assets/js/counter/jquery.counterup.min.js')}}"></script>

    <script src="{{ asset('assets/js/photoswipe/photoswipe.min.js')}}"></script>
    <script src="{{ asset('assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script src="{{ asset('assets/js/photoswipe/photoswipe.js')}}"></script>

    <script src="{{ asset('assets/js/counter/counter-custom.js')}}"></script>
    <script src="{{ asset('assets/js/custom-card/custom-card.js')}}"></script>
    <script src="{{ asset('assets/js/tooltip-init.js')}}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/jszip.min.js')}}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js')}}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/pdfmake.min.js')}}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/vfs_fonts.js')}}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')}}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.select.min.js')}}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.print.min.js')}}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')}}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js')}}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')}}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js')}}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/custom.js')}}"></script>

    <script src="{{ asset('pwa/js/upup.min.js')}}"></script>
    <script src="{{ asset('pwa/js/addtohomescreen.min.js')}}"></script>

    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets/js/script.js')}}"></script>
    <script src="{{ asset('assets/js/theme-customizer/customizer.js')}}"></script>
    <!-- login js-->
    <!-- Plugin used-->

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.8.0/firebase-app.js"></script>

    <script src="https://www.gstatic.com/firebasejs/8.8.0/firebase-messaging.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.8.0/firebase-analytics.js"></script>

    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('fcm/firebase.js') }}"></script>


    @yield('script')

    <script>
        UpUp.start({
        'cache-version': 'v2',
        'content-url': '/offline',
        'assets': ['../pwa/js/addtohomescreen.min.js', '../pwa/js/upup.min.js', '../pwa/css/addtohomescreen.css',
        '../pwa/manifest/manifest.json', '../pwa/manifest/icon-192x192.png','/pwa/manifest/icon-256x256.png',
        '../pwa/manifest/icon-384x384.png', '../pwa/manifest/icon-512x512.png'],
        'service-worker-url': '../upup.sw.min.js'
        });

        addToHomescreen();
    </script>

    {{-- <script type="text/javascript">
        $(document).ready(function(){
            $('.onhover-dropdown').hover(function() {
                const id = $(this).attr('data-id');
                console.log(id)
                $.ajax({
                    url: '{{ url("get_notifikasi") }}',
                    type: 'GET',

                    success: function(data) {
                        console.log(data);
                        $('#jml_notif').html(data.jumlah_notif);
                        $('#jml').html(data.jumlah_notif);
                        $("judul").append(data.notifikasi.judul_notifikasi);
                        $('#sa').html(data.notifikasi.judul_notifikasi);
                        $('#waktu').html(data.notifikasi.created_at)
                    }
                });
            });
        });
    </script> --}}

    <script type="text/javascript">

        $(document).ready(function(){
            var id_user = {!! json_encode((array)auth()->user()->id_user) !!};

            console.log(id_user);


            $('.notification-dropdown').ready(function() {

                $.ajax({
                    url: '{{ url("get_notifikasi") }}',
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('#jml_notif').html(data.jumlah_notif);
                        $('#jml').html(data.jumlah_notif);

                        $.each(data, function(i, notif){
                            $('#judul').append(data.notifikasi.judul_notifikasi);
                            $('#waktu').append(data.notifikasi.created_at)
                        });
                    },

                    // success: function(data) {
                    //     console.log(data);
                    //     $('#jml_notif').html(data.jumlah_notif);
                    //     $('#jml').html(data.jumlah_notif);
                    //     $.each(data, function(i, dt) {
                    //         var $a = $('waktu').html(data.notifikasi.created_at);;
                    //         var $p = $('judul').html(data.notifikasi.judul_notifikasi);
                    //         var $li = $('notif').append($a).append($p);
                    //     });
                    // },
                });
            });
        });
    </script>


</body>

</html>
