@extends('layouts.detached', ['title' => 'Dasboard'])

@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/selectize/selectize.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/chartist/chartist.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                <i class="fe-eye font-22 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="mt-1"><span data-plugin="counterup">{{ $stats['pageviews'] ?? 10.067 }}</span>
                                </h3>
                                <p class="text-muted mb-1 text-truncate">Total Views</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                <i class="fe-users font-22 avatar-title text-info"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span
                                        data-plugin="counterup">{{ $stats['visitors'] ?? 4.296 }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Total Visitors</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-blue border-blue border">
                                <i class="fe-percent font-22 avatar-title text-blue"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span
                                        data-plugin="counterup">{{ $stats['bounce'] ?? 100 }}</span>%</h3>
                                <p class="text-muted mb-1 text-truncate">Bounce Rate</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-pink border-pink border">
                                <i class="fe-watch font-22 avatar-title text-pink"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="">{{ $stats['avg_visit'] ?? '3m 16' }}</span>s
                                </h3>
                                <p class="text-muted mb-1 text-truncate">Avg. Visit Time</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
        </div>

        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                <i class="mdi mdi-book-open-page-variant text-primary font-22 avatar-title"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="mt-1"><span data-plugin="counterup">{{ $totalperda }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Total Perda</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                <i class="mdi mdi-book-open-page-variant text-success font-22 avatar-title"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $totalperwal }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Total Perwal</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-danger border-danger border">
                                <i class="mdi mdi-book-open-variant text-danger font-22 avatar-title"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $totalpropemperda }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Total Propemperda</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-blue border-blue border">
                                <i class="mdi mdi-bookshelf text-blue font-22 avatar-title"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $totalbuku }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Books</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->
        <div class="row">
            <div class="col-lg-4">
                <div class="card-box">
                    <h4 class="header-title mb-3">PERSENTASE PRODUK HUKUM</h4>

                    <div class="widget-chart text-center" dir="ltr">

                        <div id="simple-pie" class="ct-chart ct-golden-section simple-pie-chart-chartist mb-3 mt-4"></div>
                        <div class="text-center">
                            <p class="text-muted font-15 font-family-secondary mb-3 mt-3">
                                <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle" style="color:#4a81d4"></i>
                                    Perda</span>
                                <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle" style="color:#1abc9c"></i>
                                    Perwal</span>
                                <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle" style="color:#f1556c"></i>
                                    Propemperda</span>
                            </p>
                        </div>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col-->

            <div class="col-lg-8">
                <div class="card-box pb-2">
                    <h4 class="header-title mb-3">STATISTIK PRODUK HUKUM</h4>

                    <div dir="ltr">
                        <div class="text-center">
                            <p class="text-muted font-15 font-family-secondary mb-0">
                                <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-blue"></i> Perda</span>
                                <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-info"></i> Perwal</span>
                                <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-muted"></i>
                                    Propemperda</span>
                            </p>
                        </div>
                        <div id="morris-bar-stacked" style="height: 350px;" class="morris-chart"
                            data-colors="#4a81d4,#4fc6e1,#e3eaef"></div>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col-->
        </div>
        <!-- end row -->
    </div> <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/libs/morris.js06/morris.js06.min.js') }}"></script>
    <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chartist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chartist-plugin-tooltips/chartist-plugin-tooltips.min.js') }}"></script>

    <!-- Dashboar 1 init js-->
    <script src="{{ asset('assets/js/pages/dashboard-1-standalone.js') }}"></script>
    {{-- <script src="{{asset('assets/js/pages/chartist.init.js')}}"></script> --}}
    <script>
        //Simple pie chart

        var data = {
            series: [{{ $totalperda }}, {{ $totalperwal }}, {{ $totalpropemperda }}]
        };

        var sum = function(a, b) {
            return a + b
        };

        new Chartist.Pie('#simple-pie', data, {
            labelInterpolationFnc: function(value) {
                return Math.round(value / data.series.reduce(sum) * 100) + '%';
            }
        });

        ! function($) {
            "use strict";
            // Morris
            var MorrisCharts = function() {};

            //creates Stacked chart
            MorrisCharts.prototype.createStackedChart = function(element, data, xkey, ykeys, labels, lineColors) {
                    Morris.Bar({
                        element: element,
                        data: data,
                        xkey: xkey,
                        ykeys: ykeys,
                        stacked: true,
                        labels: labels,
                        hideHover: 'auto',
                        dataLabels: false,
                        resize: true, //defaulted to true
                        gridLineColor: 'rgba(65, 80, 95, 0.07)',
                        barColors: lineColors
                    });
                },
                MorrisCharts.prototype.init = function() {

                    //creating Stacked chart
                    var $stckedData = [
                        @for ($i = $mintahun; $i <= $maxtahun; $i++)
                            {
                                y: '{{ $i }}',
                                a: {{ isset($tahunanperda[$i]) ? $tahunanperda[$i] : 0 }},
                                b: {{ isset($tahunanperwal[$i]) ? $tahunanperwal[$i] : 0 }},
                                c: {{ isset($tahunanpropemperda[$i]) ? $tahunanpropemperda[$i] : 0 }}
                            },
                        @endfor
                    ];
                    var colors = ['#4a81d4', '#4fc6e1', '#e3eaef'];
                    var dataColors = $("#morris-bar-stacked").data('colors');
                    if (dataColors) {
                        colors = dataColors.split(",");
                    }
                    this.createStackedChart('morris-bar-stacked', $stckedData, 'y', ['a', 'b', 'c'], ["Perda", "Perwal",
                        "Propemperda"
                    ], colors);

                },
                //init
                $.MorrisCharts = new MorrisCharts, $.MorrisCharts.Constructor = MorrisCharts
        }(window.jQuery),
        //initializing
        function($) {
            "use strict";
            $.MorrisCharts.init();
        }(window.jQuery);
    </script>
@endsection
