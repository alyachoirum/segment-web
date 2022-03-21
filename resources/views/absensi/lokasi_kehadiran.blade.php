@extends('main')

@section('link')
<!-- leaflet css  -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />


<!-- leaflet js  -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

<style>
    /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
    #map {
        height: 100%;
        width: 100%;
        margin: 30, 30, 30, 30;
        padding: 30, 30, 30, 30;
    }

    /* Optional: Makes the sample page fill the window. */
    html,
    body {
        height: 100%;
        width: 100%;
        margin: 30, 30, 30, 30;
        padding: 30, 30, 30, 30;
    }
</style>
@endsection

@section('judul')
Lokasi Kehadiran
@endsection

@section('isi')

<br>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xl-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="text-white" style="text-align: center">Cek Lokasi Kehadiran</h5>
                </div>

                <div class="card-body">

                    <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-toggle="tab"
                                href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"
                                data-original-title="" title=""><i class="icofont icofont-map-search"></i></i>Peta
                                Lokasi</a></li>
                        <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-toggle="tab"
                                href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false"
                                data-original-title="" title=""><i class="icofont icofont-document-search"></i>Data
                                Karyawan</a></li>
                        {{-- <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-toggle="tab" href="#top-distributor"
                                role="tab" aria-controls="top-profile" aria-selected="false" data-original-title=""
                                title=""><i class="icofont icofont-document-search"></i>Berdasarkan Distributor</a></li> --}}
                        {{-- <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-toggle="tab" href="#top-daerah"
                                role="tab" aria-controls="top-profile" aria-selected="false" data-original-title=""
                                title=""><i class="icofont icofont-document-search"></i>Berdasarkan Daerah</a></li> --}}
                    </ul>

                    <div class="tab-content" id="top-tabContent">
                        <div class="tab-pane fade show active" id="top-home" role="tabpanel"
                            aria-labelledby="top-home-tab">

                            <div class="col-lg-12">
                                <div class="card-body">
                                    <div class="row" style="z-index:-1">
                                        <div class="col-sm-12 col-xl-12">
                                            <div class="card">
                                                <div id="mapid">
                                                    <textarea class="form-control" rows="21"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">

                            <div class="card">
                                    <div class="card-body">
                                    <form action="{{route('lokasi_kehadiran_filter')}}" method="POST">
                                    {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <input class="form-control" name="filter" type="hidden" value="1" readonly>
                                                    <label>Zona</label>
                                                    <select class="form-control button btn btn-outline-primary" name="zona"
                                                        id="exampleFormControlSelect7">
                                                        <option>Zona</option>
                                                        <option value="I">I</option>
                                                        <option value="II">II</option>
                                                        <option value="III">III</option>
                                                        <option value="IV">IV</option>
                                                        <option value="V">V</option>
                                                        <option value="KAWASAN">KAWASAN</option>
                                                        <option value="TUKS">TUKS</option>
                                                        <option value="PA BABAT">PA BABAT</option>
                                                        <option value="PA GNGSARI">PA GNGSARI</option>
                                                        <option value="GRAHA">GRAHA</option>
                                                        <option value="MASJID">MASJID</option>
                                                        <option value="KANTOR DEPKAM">KANTOR DEPKAM</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <input class="form-control" name="filter" type="hidden" value="1" readonly>
                                                    <label>Regu</label>
                                                    <select class="form-control button btn btn-outline-primary" name="regu"
                                                        id="exampleFormControlSelect7">
                                                        <option>Regu</option>
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="C">C</option>
                                                        <option value="D">D</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-3 pt-1">
                                                <button class="btn btn-primary btn-block mt-4" type="submit">Filter</button>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            <div class="card-body">
                                <div class="dt-ext table-responsive">
                                    <table class="display" id="export-button">
                                        <thead>
                                            <tr>
                                                <th width="2px" style="text-align: center">No</th>
                                                <th style="text-align: center">NIK</th>
                                                <th style="text-align: center">Nama Karyawan</th>
                                                <th style="text-align: center">Zona</th>
                                                <th style="text-align: center">Regu</th>
                                                <th style="text-align: center">Bagian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $no = 1;
                                            @endphp
                                            {{-- @foreach ($data_tagihan as $tagihan) --}}
                                            <tr>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>3</td>
                                                <td>4</td>
                                                <td>2</td>
                                                <td>3</td>
                                            </tr>
                                            @php
                                            $no++
                                            @endphp
                                            {{-- @endforeach --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('script')

<script>
    // set lokasi latitude dan longitude, lokasinya kota palembang
    var mymap = L.map('mapid').setView([-7.156819, 112.6402522], 16);
    //setting maps menggunakan api mapbox bukan google maps, daftar dan dapatkan token
    L.tileLayer(
        'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibmFiaWxjaGVuIiwiYSI6ImNrOWZzeXh5bzA1eTQzZGxpZTQ0cjIxZ2UifQ.1YMI-9pZhxALpQ_7x2MxHw', {
            attribution: '',
            maxZoom: 20,
            id: 'mapbox/streets-v11', //menggunakan peta model streets-v11 kalian bisa melihat jenis-jenis peta lainnnya di web resmi mapbox
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'your.mapbox.access.token'
        }).addTo(mymap);


</script>

<script>
    $(document).ready(function () {
        $('select[name="id_provinsi"]').on('change', function () {
            let provinceId = $(this).val();
            if (provinceId) {
                jQuery.ajax({
                    url: '/province/' + provinceId + '/cities',
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="id_kab_kota"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="id_kab_kota"]')
                                .append('<option value="' + key + '">' + value +
                                    '</option>');
                        });
                    },
                });
            } else {
                $('select[name="id_kab_kota"]').empty();
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#provinsi').select2();
    });
</script>

<script>
    $(document).ready(function () {
        $('#kab_kota').select2();
    });
</script>

<script>
    var lpr = document.getElementById("laporan").getContext('2d');

    var chartlpr;

    charts1();

    function charts1() {
        chartlpr = new Chart(lpr, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Des"],
                datasets: [{
                        label: 'Data Aktual',
                        data: [10, 3, 19, 63, 35, 22, 13, 53, 45, 82, 83, 45],
                        backgroundColor: 'transparent',
                        borderColor: "rgba(69, 182, 73)",
                        borderWidth: 4,
                        fill: true
                    },
                    {
                        label: 'Least Square',
                        data: [60, 43, 12, 33, 75, 62, 33, 23, 85, 42, 63, 25],
                        backgroundColor: 'transparent',
                        borderColor: "rgba(58, 73, 172)",
                        borderWidth: 2,
                        fill: true
                    },
                    {
                        label: 'Exponential Smoothing',
                        data: [16, 36, 14, 12, 42, 48, 53, 41, 33, 62, 31, 75],
                        backgroundColor: 'transparent',
                        borderColor: "rgba(71, 84, 168)",
                        borderWidth: 2,
                        fill: true

                    },
                    {
                        label: 'Moving Average',
                        data: [52, 25, 73, 24, 63, 42, 38, 43, 35, 92, 23, 45],
                        backgroundColor: 'transparent',
                        borderColor: "rgba(91, 101, 171)",
                        borderWidth: 2,
                        fill: true
                    },
                ]
            },
            options: {
                barValueSpacing: 20,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: "rgba(0, 0, 0, 0)",
                        }
                    }]
                }
            }
        });
    };
</script>


<script>
    $(function () {
        /* ChartJS
         * -------
         * Data and config for chartjs
         */
        'use strict';

        var data = {
            labels: ["2013", "2014", "2014", "2015", "2016", "2017"],
            datasets: [{
                label: '# of Votes',
                data: [10, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1,
                fill: false
            }]
        };

        var options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: false
            },
            elements: {
                point: {
                    radius: 0
                }
            }

        };


        if ($("#barChart").length) {
            var barChartCanvas = $("#barChart").get(0).getContext("2d");
            // This will get the first returned node in the jQuery collection.
            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: data,
                options: options
            });
        }



        var data2 = {
            labels: ["2013", "2014", "2014", "2015", "2016", "2017"],
            datasets: [{
                label: '# of Votes',
                data: [61, 14, 73, 32, 97, 36],
                backgroundColor: [
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1,
                fill: false
            }]
        };

        var options2 = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: false
            },
            elements: {
                point: {
                    radius: 0
                }
            }

        };

        if ($("#barChart2").length) {
            var barChartCanvas = $("#barChart2").get(0).getContext("2d");
            // This will get the first returned node in the jQuery collection.
            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: data2,
                options: options2
            });
        }

        var doughnutPieData = {
            datasets: [{
                data: [61, 14, 73, 32, 97, 36],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                'Unpaid',
                'Paid',
            ]
        };
        var doughnutPieOptions = {
            responsive: true,
            animation: {
                animateScale: true,
                animateRotate: true
            }
        };

        if ($("#doughnutChart").length) {
            var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
            var doughnutChart = new Chart(doughnutChartCanvas, {
                type: 'doughnut',
                data: doughnutPieData,
                options: doughnutPieOptions
            });
        }


        var areaData = {
            labels: ["2013", "2014", "2015", "2016", "2017"],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                fill: true, // 3: no fill
            }]
        };

        var areaDataDark = {
            labels: ["2013", "2014", "2015", "2016", "2017"],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                fill: true, // 3: no fill
            }]
        };

        var areaOptions = {
            plugins: {
                filler: {
                    propagate: true
                }
            }
        }

        var areaOptionsDark = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    gridLines: {
                        color: '#322f2f',
                        zeroLineColor: '#322f2f'
                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    gridLines: {
                        color: '#322f2f',
                    }
                }],
            },
            plugins: {
                filler: {
                    propagate: true
                }
            }
        }

        var multiAreaData = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                    label: 'Facebook',
                    data: [8, 11, 13, 15, 12, 13, 16, 15, 13, 19, 11, 14],
                    borderColor: ['rgba(255, 99, 132, 0.5)'],
                    backgroundColor: ['rgba(255, 99, 132, 0.5)'],
                    borderWidth: 1,
                    fill: true
                },
                {
                    label: 'Twitter',
                    data: [7, 17, 12, 16, 14, 18, 16, 12, 15, 11, 13, 9],
                    borderColor: ['rgba(54, 162, 235, 0.5)'],
                    backgroundColor: ['rgba(54, 162, 235, 0.5)'],
                    borderWidth: 1,
                    fill: true
                },
                {
                    label: 'Linkedin',
                    data: [6, 14, 16, 20, 12, 18, 15, 12, 17, 19, 15, 11],
                    borderColor: ['rgba(255, 206, 86, 0.5)'],
                    backgroundColor: ['rgba(255, 206, 86, 0.5)'],
                    borderWidth: 1,
                    fill: true
                }
            ]
        };

        var multiAreaOptions = {
            plugins: {
                filler: {
                    propagate: true
                }
            },
            elements: {
                point: {
                    radius: 0
                }
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            }
        }

        var scatterChartData = {
            datasets: [{
                    label: 'First Dataset',
                    data: [{
                            x: -10,
                            y: 0
                        },
                        {
                            x: 0,
                            y: 3
                        },
                        {
                            x: -25,
                            y: 5
                        },
                        {
                            x: 40,
                            y: 5
                        }
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)'
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Second Dataset',
                    data: [{
                            x: 10,
                            y: 5
                        },
                        {
                            x: 20,
                            y: -30
                        },
                        {
                            x: -25,
                            y: 15
                        },
                        {
                            x: -10,
                            y: 5
                        }
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }
            ]
        }

        var scatterChartDataDark = {
            datasets: [{
                    label: 'First Dataset',
                    data: [{
                            x: -10,
                            y: 0
                        },
                        {
                            x: 0,
                            y: 3
                        },
                        {
                            x: -25,
                            y: 5
                        },
                        {
                            x: 40,
                            y: 5
                        }
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)'
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Second Dataset',
                    data: [{
                            x: 10,
                            y: 5
                        },
                        {
                            x: 20,
                            y: -30
                        },
                        {
                            x: -25,
                            y: 15
                        },
                        {
                            x: -10,
                            y: 5
                        }
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }
            ]
        }

        var scatterChartOptions = {
            scales: {
                xAxes: [{
                    type: 'linear',
                    position: 'bottom'
                }]
            }
        }

        var scatterChartOptionsDark = {
            scales: {
                xAxes: [{
                    type: 'linear',
                    position: 'bottom',
                    gridLines: {
                        color: '#322f2f',
                        zeroLineColor: '#322f2f'
                    }
                }],
                yAxes: [{
                    gridLines: {
                        color: '#322f2f',
                        zeroLineColor: '#322f2f'
                    }
                }]
            }
        }
        // Get context with jQuery - using jQuery's .get() method.


        if ($("#barChartDark").length) {
            var barChartCanvasDark = $("#barChartDark").get(0).getContext("2d");
            // This will get the first returned node in the jQuery collection.
            var barChartDark = new Chart(barChartCanvasDark, {
                type: 'bar',
                data: dataDark,
                options: optionsDark
            });
        }

        if ($("#lineChart").length) {
            var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
            var lineChart = new Chart(lineChartCanvas, {
                type: 'line',
                data: data,
                options: options
            });
        }

        if ($("#lineChart2").length) {
            var lineChartCanvas = $("#lineChart2").get(0).getContext("2d");
            var lineChart = new Chart(lineChartCanvas, {
                type: 'line',
                data: data,
                options: options
            });
        }

        if ($("#lineChartDark").length) {
            var lineChartCanvasDark = $("#lineChartDark").get(0).getContext("2d");
            var lineChartDark = new Chart(lineChartCanvasDark, {
                type: 'line',
                data: dataDark,
                options: optionsDark
            });
        }

        if ($("#linechart-multi").length) {
            var multiLineCanvas = $("#linechart-multi").get(0).getContext("2d");
            var lineChart = new Chart(multiLineCanvas, {
                type: 'line',
                data: multiLineData,
                options: options
            });
        }

        if ($("#areachart-multi").length) {
            var multiAreaCanvas = $("#areachart-multi").get(0).getContext("2d");
            var multiAreaChart = new Chart(multiAreaCanvas, {
                type: 'line',
                data: multiAreaData,
                options: multiAreaOptions
            });
        }



        if ($("#pieChart").length) {
            var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
            var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: doughnutPieData,
                options: doughnutPieOptions
            });
        }

        if ($("#areaChart").length) {
            var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
            var areaChart = new Chart(areaChartCanvas, {
                type: 'line',
                data: areaData,
                options: areaOptions
            });
        }

        if ($("#areaChartDark").length) {
            var areaChartCanvas = $("#areaChartDark").get(0).getContext("2d");
            var areaChart = new Chart(areaChartCanvas, {
                type: 'line',
                data: areaDataDark,
                options: areaOptionsDark
            });
        }

        if ($("#scatterChart").length) {
            var scatterChartCanvas = $("#scatterChart").get(0).getContext("2d");
            var scatterChart = new Chart(scatterChartCanvas, {
                type: 'scatter',
                data: scatterChartData,
                options: scatterChartOptions
            });
        }

        if ($("#scatterChartDark").length) {
            var scatterChartCanvas = $("#scatterChartDark").get(0).getContext("2d");
            var scatterChart = new Chart(scatterChartCanvas, {
                type: 'scatter',
                data: scatterChartDataDark,
                options: scatterChartOptionsDark
            });
        }

        if ($("#browserTrafficChart").length) {
            var doughnutChartCanvas = $("#browserTrafficChart").get(0).getContext("2d");
            var doughnutChart = new Chart(doughnutChartCanvas, {
                type: 'doughnut',
                data: browserTrafficData,
                options: doughnutPieOptions
            });
        }
    });
</script>



@endsection
