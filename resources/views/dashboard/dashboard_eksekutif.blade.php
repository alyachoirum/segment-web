@extends('main')

@section('judul')
Dashboard Eksekutif
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Dashboard Eksekutif</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Data Karyawan</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-3 col-lg-6">
            <div class="card o-hidden">
                <a href="#">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="user-check"></i></div>
                            <div class="media-body"><span class="m-0">
                                    <h5>Sudah Presensi</h5>
                                </span>
                                <h4 class="mb-0 counter">52</h4>
                                <i class="icon-bg" data-feather="user-check"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card o-hidden">
                <a href="#">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="user-x"></i></div>
                            <div class="media-body"><span class="m-0">
                                    <h5>Belum Presensi</h5>
                                </span>
                                <h4 class="mb-0 counter">52</h4>
                                <i class="icon-bg" data-feather="user-x"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card o-hidden">
                <a href="#">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="bell-off"></i></div>
                            <div class="media-body"><span class="m-0">
                                    <h5>Terlambat Masuk</h5>
                                </span>
                                <h4 class="mb-0 counter">52</h4>
                                <i class="icon-bg" data-feather="bell-off"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card o-hidden">
                <a href="#">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="map-pin"></i></div>
                            <div class="media-body"><span class="m-0">
                                    <h5>Sedang di Lokasi</h5>
                                </span>
                                <h4 class="mb-0 counter">52</h4>
                                <i class="icon-bg" data-feather="map-pin"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-md-12 box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Grafik Kehadiran Bulan ini</h5>
                </div>
                <div class="card-body chart-block">
                    <div class="row">
                        <div class="col-xl-8">
                            <canvas id="areaChart" style="height:350px" ></canvas>
                        </div>
                        <div class="col-xl-3">
                            <div class="progress-showcase row">
                                <div class="col">
                                    <h6>Rata-rata masuk</h6>
                                    <div><h5>421</h5></div>
                                    <div class="progress">
                                        <div class="progress-bar-animated bg-primary progress-bar-striped"
                                            role="progressbar" style="width: 73%" aria-valuenow="10" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                    <h6>Rata-rata tidak masuk</h6>
                                    <div><h5>11</h5></div>
                                    <div class="progress">
                                        <div class="progress-bar-animated progress-bar-striped bg-danger"
                                            role="progressbar" style="width: 12%" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                    <h6>Rata-rata terlambat</h6>
                                    <div><h5>14</h5></div>
                                    <div class="progress">
                                        <div class="progress-bar-animated progress-bar-striped bg-secondary"
                                            role="progressbar" style="width: 10%" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-1">
                            <br>
                            <br><br>
                            <div><h5>73%</h5></div>
                            <br><br>
                            <div><h5>12%</h5></div>
                            <br><br>
                            <div><h5>10%</h5></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-12 box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Performa Kehadiran</h5>
                </div>
                <div class="card-body chart-block chart-vertical-center">
                    <canvas id="pieChart" style="height:250px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-md-12 box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Total Tagihan</h5>
                </div>
                <div class="card-body chart-block">
                    <canvas id="barChart" style="height:250px"></canvas>


                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-12 box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Klasifikasi PT Karyawan</h5>
                </div>
                <div class="card-body chart-block">
                    <canvas id="doughnutChart" style="height:250px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-8 box-col-6 col-lg-12 col-md-6">
            <div class="card o-hidden">
                <div class="card-body">
                    <div class="ecommerce-widgets media">
                        <div class="media-body">
                        <p class="f-w-500 font-roboto">Total Pengeluaran Gaji<span class="badge pill-badge-primary ml-3">Bulan</span></p>
                        <h4 class="f-w-500 mb-0 f-26">@currency('4000000000')</h4>
                        </div>
                        {{-- <div class="ecommerce-box light-bg-primary">
                            <i class="fa fa-money"></i>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="col-xl-6 col-md-12 box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Grafik Kehadiran Bulan ini</h5>
                </div>
                <div class="card-body chart-block">
                    <canvas id="scatterChart" style="height:250px"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-12 box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Line Graph</h5>
                </div>
                <div class="card-body chart-block">
                    <canvas id="lineChart" style="height:250px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12 box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Radar Graph</h5>
                </div>
                <div class="card-body chart-block">
                    <canvas id="areaChart" style="height:250px"></canvas>
                </div>
            </div>
        </div> --}}

    </div>
</div>

<!-- Container-fluid Ends-->


@endsection

@section('script')

<script src="{{ asset('assets/js/chart/chart.js/Chart.min.js')}}"></script>

<script>
    $(function () {
        /* ChartJS
         * -------
         * Data and config for chartjs
         */
        'use strict';
        var data = {
            labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli","Agustus","September","Oktober","November","Desember"],
            datasets: [{
                label: 'Jumlah Pengeluaran',
                data: [10, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                ],
                borderColor: [
                    'rgba(28,74,38 ,1)',
                    'rgba(28,74,38 ,1)',
                    'rgba(28,74,38 ,1)',
                    'rgba(28,74,38 ,1)',
                    'rgba(28,74,38 ,1)',
                    'rgba(28,74,38 ,1)',
                    'rgba(28,74,38 ,1)',
                    'rgba(28,74,38 ,1)',
                    'rgba(28,74,38 ,1)',
                    'rgba(28,74,38 ,1)',
                    'rgba(28,74,38 ,1)',
                    'rgba(28,74,38 ,1)',

                ],
                borderWidth: 1,
                fill: false
            }]
        };
        var dataDark = {
            labels: ["2013", "2014", "2014", "2015", "2016", "2017"],
            datasets: [{
                label: '# of Votes',
                data: [10, 19, 3, 5, 2, 3],
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
                fill: false
            }]
        };
        var multiLineData = {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
                    label: 'Dataset 1',
                    data: [12, 19, 3, 5, 2, 3],
                    borderColor: [
                        '#587ce4'
                    ],
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Dataset 2',
                    data: [5, 23, 7, 12, 42, 23],
                    borderColor: [
                        '#ede190'
                    ],
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Dataset 3',
                    data: [15, 10, 21, 32, 12, 33],
                    borderColor: [
                        '#f44252'
                    ],
                    borderWidth: 2,
                    fill: false
                }
            ]
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
        var optionsDark = {
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
            legend: {
                display: false
            },
            elements: {
                point: {
                    radius: 0
                }
            }

        };
        var doughnutPieData = {
            datasets: [{
                data: [89, 18, 21],
                backgroundColor: [
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(240, 194, 91, 0.8)'

                ],
                borderColor: [
                    'rgba(28,74,38 ,1)',
                    'rgba(138, 20, 31, 1)',
                    'rgba(130, 99, 31, 1)',
                ],
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                'Masuk Tepat Waktu',
                'Tidak Masuk',
                'Terlambat',
            ]
        };
        var doughnutPieOptions = {
            responsive: true,
            animation: {
                animateScale: true,
                animateRotate: true
            }
        };
        var doughnutData = {
            datasets: [{
                data: [12, 233, 273],
                backgroundColor: [
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',


                ],
                borderColor: [
                    'rgba(130, 99, 31, 1)',
                    'rgba(28,74,38 ,1)',
                    'rgba(138, 20, 31, 1)',

                ],
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                'PT Petrokimia Gresik',
                'PT. Aneka Jasa Gradika',
                'PT. Fokus Jasa Mitra',
            ]
        };
        var doughnutOptions = {
            responsive: true,
            animation: {
                animateScale: true,
                animateRotate: true
            }
        };
        var areaData = {
            labels: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31],
            datasets: [{
                label: 'Masuk',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                    'rgba(53, 118, 68, 0.8)',
                ],
                borderColor: [
                    'rgba(28,74,38 ,1)',
                ],
                borderWidth: 1,
                fill: true, // 3: no fill
            },
            {
                label: 'Tidak Masuk',
                data: [15, 21, 7, 9, 9, 6],
                backgroundColor: [
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                    'rgba(220, 52, 68, 0.8)',
                ],
                borderColor: [
                    'rgba(138, 20, 31, 1)'
                ],
                borderWidth: 1,
                fill: true, // 3: no fill
            },
            {
                label: 'Terlambat',
                data: [23, 10, 18,25, 17, 13],
                backgroundColor: [
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                    'rgba(240, 194, 91, 0.8)',
                ],
                borderColor: [
                    'rgba(130, 99, 31, 1)',
                ],
                borderWidth: 1,
                fill: true, // 3: no fill
            },
            ]
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
                    propagate: false
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
        if ($("#barChart").length) {
            var barChartCanvas = $("#barChart").get(0).getContext("2d");
            // This will get the first returned node in the jQuery collection.
            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: data,
                options: options
            });
        }

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

        if ($("#doughnutChart").length) {
            var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
            var doughnutChart = new Chart(doughnutChartCanvas, {
                type: 'doughnut',
                data: doughnutData,
                options: doughnutOptions
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
