<?php
foreach ($total_books as $total) {
    $arr = array(
        'name' => $total->genre,
        'y' => (float)$total->count
    );
    $series_array[] = $arr;
}

$josn_data = json_encode($series_array);
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
        <script src="https://code.highcharts.com/modules/data.js"></script>
        <script src="https://code.highcharts.com/modules/drilldown.js"></script>
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
            @import "https://code.highcharts.com/css/highcharts.css";

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
                    <a href="" class="list-group-item list-group-item-action bg-light active text-dark">Home</a>
                    <a href="{{ route('book_monthly') }}" class="list-group-item list-group-item-action bg-light">Books per Month</a>
                    <a href="{{ route('stocks') }}" class="list-group-item list-group-item-action bg-light">Book Availability</a>
                    <a href="{{ route('due_dates') }}" class="list-group-item list-group-item-action bg-light">Due Dates</a>
                    <a href="{{ route('borrowed_chart') }}" class="list-group-item list-group-item-action bg-light">Borrowed Dates</a>
                    <a href="{{ route('borrowed_status') }}" class="list-group-item list-group-item-action bg-light">Borrowed Status</a>
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
                            Welcome to Bibliotech Dashboard!
                        </div>

                        <div class="mt-6 text-gray-500">
                            A Library Management System is a software built to handle the primary housekeeping functions of a library. Libraries rely on library management systems to manage asset collections as well as relationships with their members. Library management systems help libraries keep track of the books and their checkouts, as well as members’ subscriptions and profiles.

                            Library management systems also involve maintaining the database for entering new books and recording books that have been borrowed with their respective due dates.
                        </div>
                    </div>

                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div id="container1"></div>
                            </div>
                        </div>
                    </div>

                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div id="container2"></div>
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
            // Create the chart
            Highcharts.chart('container1', {
                chart: {
                    type: 'column',
                    styledMode: true
                },
                title: {
                    align: 'left',
                    text: 'Total Number of Books by Genre'
                },
                subtitle: {
                    align: 'left',
                    text: 'Click the columns to view books on each genre'
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Number of Books'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                        }
                    },
                    column: {
                        borderRadius: 20
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
                },

                series: [{
                    name: "Count",
                    colorByPoint: true,
                    data: <?= $josn_data ?>
                }]
            });

            // Create the chart
            Highcharts.chart('container2', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Book Category shares. July, 2022'
                },
                subtitle: {
                    text: 'Click the slices to view versions. '
                },

                accessibility: {
                    announceNewData: {
                        enabled: true
                    },
                    point: {
                        valueSuffix: ''
                    }
                },

                plotOptions: {
                    series: {
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}: {point.y}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
                },

                series: [{
                    name: "Genre",
                    colorByPoint: true,
                    data: <?= $josn_data ?>
                }]
            });
        </script>

    </body>
</x-app-layout>