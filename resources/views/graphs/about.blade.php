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
                    <a href="{{ route('borrowed_status') }}" class="list-group-item list-group-item-action bg-light">Borrowed Status</a>
                    <a href="{{ route('students_penalty') }}" class="list-group-item list-group-item-action bg-light">Student's Penalty</a>
                    <a href="" class="list-group-item list-group-item-action bg-light  active text-dark">About</a>
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
                            Bibliotech - Virtual Library!
                        </div>

                        <div class="mt-6 text-gray-500">
                            A Library Management System is a software built to handle the primary housekeeping functions of a library. Libraries rely on library management systems to manage asset collections as well as relationships with their members. Library management systems help libraries keep track of the books and their checkouts, as well as members’ subscriptions and profiles.

                            Library management systems also involve maintaining the database for entering new books and recording books that have been borrowed with their respective due dates.
                        </div>
                    </div>

                    <div class="bg-white bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <i class="fa-solid fa-book fa-2xl"></i>
                                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="{{route('book.index')}}">Book Catalogue</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-500">
                                    Navigate to the books section. In this part, you as the server can add, edit, and delete books. You can also assign a book to the borrower as well as its return date.
                                </div>


                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
                            <div class="flex items-center">
                                <i class="fa-solid fa-book-bookmark fa-2xl"></i>
                                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="{{route('borrowedbooks')}}">Borrowed Books</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-500">
                                    Explore the borrowed books table. In this section, you can see the overview of the borrowed books. You can also mark the book as returned here when the borrower has given it back.
                                </div>

                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200">
                            <div class="flex items-center">
                                <i class="fa-solid fa-users fa-2xl"></i>
                                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="{{route('users')}}">Users Database</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-500">
                                    Manage the users, view their user insensitive data, and impose penalties. You can also change their user type.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 md:border-l">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
                                    <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Authentication</div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-sm text-gray-500">
                                    Authentication and registration views are included with Laravel Jetstream, as well as support for user email verification and resetting forgotten passwords. So, you're free to get started what matters most: building your application.
                                </div>
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

    </body>
</x-app-layout>