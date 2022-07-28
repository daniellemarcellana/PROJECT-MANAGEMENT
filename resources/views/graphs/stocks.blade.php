<?php
foreach ($total_books as $total) {
    if ($total->genre == "Arts") {
        $arr = array(
            'name' => $total->bookTitle,
            'value' => (float)$total->quantity
        );
        $series_array[] = $arr;
    }

    if ($total->genre == "Entertainment") {
        $arrEnt = array(
            'name' => $total->bookTitle,
            'value' => (float)$total->quantity
        );
        $series_array2[] = $arrEnt;
    }

    if ($total->genre == "Mathematics") {
        $arrMath = array(
            'name' => $total->bookTitle,
            'value' => (float)$total->quantity
        );
        $series_array3[] = $arrMath;
    }

    if ($total->genre == "Politics") {
        $arrPol = array(
            'name' => $total->bookTitle,
            'value' => (float)$total->quantity
        );
        $series_array4[] = $arrPol;
    }

    if ($total->genre == "Psychology") {
        $arrPsych = array(
            'name' => $total->bookTitle,
            'value' => (float)$total->quantity
        );
        $series_array5[] = $arrPsych;
    }

    if ($total->genre == "Science") {
        $arrSci = array(
            'name' => $total->bookTitle,
            'value' => (float)$total->quantity
        );
        $series_array6[] = $arrSci;
    }
}

$josn_data = json_encode($series_array);
$josn_data2 = json_encode($series_array2);
$josn_data3 = json_encode($series_array3);
$josn_data4 = json_encode($series_array4);
$josn_data5 = json_encode($series_array5);
$josn_data6 = json_encode($series_array6);
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
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
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
                    <a href="" class="list-group-item list-group-item-action bg-light active text-dark">Book Availability</a>
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
                        <div class=" text-2xl">
                            BOOK AVAILABILITY - STOCKS
                        </div>
                        <div class="mt-6 text-gray-500">
                            In this page, you can see the stocks of each book in the library.
                            <br><br>
                            
                            @foreach($total_books as $total)


                            
                                 <span class="badge badge-primary">{{$total->bookTitle}} : {{$total->quantity}}pcs.</span> 
                            
                            @endforeach
                        </div>
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
            // Create the chart
            Highcharts.chart('container1', {
                chart: {
                    type: 'packedbubble',
                    height: '100%'
                },
                title: {
                    text: 'Book Stocks (2022)'

                },
                subtitle: {
                    text: 'Source: Bibliotech - Virtual Library'
                },
                tooltip: {
                    useHTML: true,
                    pointFormat: '<b>{point.name}:</b> Quantity: {point.value} pcs.'
                },
                plotOptions: {
                    packedbubble: {
                        minSize: '20%',
                        maxSize: '100%',
                        zMin: 0,
                        zMax: 1000,
                        layoutAlgorithm: {
                            gravitationalConstant: 0.05,
                            splitSeries: true,
                            seriesInteraction: false,
                            dragBetweenSeries: true,
                            parentNodeLimit: true
                        },
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}',
                            filter: {
                                property: 'y',
                                operator: '>',
                                value: 250
                            },
                            style: {
                                color: 'black',
                                textOutline: 'none',
                                fontWeight: 'normal'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Arts',
                    data: <?= $josn_data ?>
                }, {
                    name: 'Entertainment',
                    data: <?= $josn_data2 ?>
                }, {
                    name: 'Mathematics',
                    data: <?= $josn_data3 ?>
                }, {
                    name: 'Politics',
                    data: <?= $josn_data4 ?>
                }, {
                    name: 'Psychology',
                    data: <?= $josn_data5 ?>
                }, {
                    name: 'Science',
                    data: <?= $josn_data6 ?>
                }]
            });
        </script>
    </body>
</x-app-layout>