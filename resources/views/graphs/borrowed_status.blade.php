<?php

foreach ($borrowed_status as $borrowed) {
    $arr = array(
        'name' => $borrowed->status,
        'y' => (float)$borrowed->count
    );
    $series_array[] = $arr;
}

$josn_data = json_encode($series_array);
$josn_decode = json_decode($josn_data, true);



?>

<x-app-layout>



    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/highcharts-3d.js"></script>
        <script src="https://code.highcharts.com/modules/cylinder.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <script>
            jQuery(document).ready(function($) {
                $("#menu-toggle").click(function(e) {
                    e.preventDefault();
                    $("#wrapper").toggleClass("toggled");
                });
            })
        </script>
        <style>
            body {
                overflow-x: hidden;
            }

            #sidebar-wrapper {
                min-height: 100vh;
                margin-left: -15rem;
                -webkit-transition: margin .25s ease-out;
                -moz-transition: margin .25s ease-out;
                -o-transition: margin .25s ease-out;
                transition: margin .25s ease-out;
            }

            #sidebar-wrapper .sidebar-heading {
                padding: 0.875rem 1.25rem;
                font-size: 1.2rem;
            }

            #sidebar-wrapper .list-group {
                width: 15rem;
            }

            #page-content-wrapper {
                min-width: 100vw;
            }

            #wrapper.toggled #sidebar-wrapper {
                margin-left: 0;
            }

            @media (min-width: 768px) {
                #sidebar-wrapper {
                    margin-left: 0;
                }

                #page-content-wrapper {
                    min-width: 0;
                    width: 100%;
                }

                #wrapper.toggled #sidebar-wrapper {
                    margin-left: -15rem;
                }
            }
        </style>
    </head>

    <body>


        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class="bg-light border-right" id="sidebar-wrapper">
                <div class="sidebar-heading">NAVIGATION</div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action bg-light">Home</a>
                    <a href="{{ route('book_monthly') }}" class="list-group-item list-group-item-action bg-light">Books per Month</a>
                    <a href="{{ route('stocks') }}" class="list-group-item list-group-item-action bg-light">Book Availability</a>
                    <a href="{{ route('due_dates') }}" class="list-group-item list-group-item-action bg-light">Due Dates</a>
                    <a href="{{ route('borrowed_chart') }}" class="list-group-item list-group-item-action bg-light">Borrowed Dates</a>
                    <a href="" class="list-group-item list-group-item-action bg-light  active text-dark">Borrowed Status</a>
                    <a href="{{ route('students_penalty') }}" class="list-group-item list-group-item-action bg-light">Student's Penalty</a>
                    <a href="{{ route('about') }}" class="list-group-item list-group-item-action bg-light">About</a>
                    <a href="/admin/user-activity" class="list-group-item list-group-item-action bg-light">Activity Logs</a>
                </div>
            </div>
            <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <button class="btn btn-dark" id="menu-toggle">Toggle Menu</button>
                </nav>
                <div class="container-fluid">

                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div class="mt-8 text-2xl">
                            Borrowed Books Status
                        </div>

                        <div class="mt-6 text-gray-500">
                            A Library Management System is a software built to handle the primary housekeeping functions of a library. Libraries rely on library management systems to manage asset collections as well as relationships with their members. Library management systems help libraries keep track of the books and their checkouts, as well as members’ subscriptions and profiles.

                            Library management systems also involve maintaining the database for entering new books and recording books that have been borrowed with their respective due dates.
                        </div>
                        @foreach($borrowed_status as $borrowed)

                        <br>
                        @if ($borrowed->status == 'Pending')
                        {{$borrowed->status}} <span class="badge bg-danger fw-bold">{{$borrowed->count}}</span>

                        @elseif ($borrowed->status == 'Returned')
                        {{$borrowed->status}} <span class="badge bg-success fw-bold">{{$borrowed->count}}</span>

                        @endif
                        @endforeach

                        @foreach($borrowed_total as $total)
                        <br><br>
                        <button type="button" class="btn btn-info">
                            Total:  <span class="badge badge-light">{{$total->total}}</span>
                            <span class="sr-only">unread messages</span>
                        </button>
                        @endforeach
                    </div>

                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div id="container1"></div>

                            </div>
                        </div>
                    </div>



                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>
        <!-- /#wrapper -->


        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>




        <script>
            Highcharts.chart('container1', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: 0,
                    plotShadow: false
                },
                title: {
                    text: 'Status<br><br>',
                    align: 'center',
                    verticalAlign: 'middle',
                    y: 60
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        dataLabels: {
                            enabled: true,
                            distance: -50,
                            style: {
                                fontWeight: 'bold',
                                color: 'white'
                            }
                        },
                        startAngle: -90,
                        endAngle: 90,
                        center: ['50%', '75%'],
                        size: '110%'
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Status',
                    innerSize: '50%',
                    data: <?= $josn_data ?>,
                    


                }]
            });
        </script>

    </body>
</x-app-layout>