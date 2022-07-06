<link rel="icon" type="image/png" href="{{ asset('/images/equinox.png') }}">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Borrowed Books') }}
        </h2>
    </x-slot>


    <section class="mt-5 mb-5">
        <div class="container">

            @if(session()->has('message'))

            <div class="alert alert-success">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                {{session()->get('message')}}
            </div>

            @endif

            <div class="p-2 col-sm-3 float-end mb-2">
                <form action="{{route('borrowedbooks')}}" method="get">
                    @csrf
                    <input type="text" class="form-control shadow-none" name="search" placeholder="Search..." value="{{request()->query('search')}}">
                </form>
            </div>

            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Student Number</th>
                        <th scope="col">Book</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Return Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($borrowed_books as $item)
                    <tr>
                        <th scope="row">{{Crypt::decrypt($item->stud_num)}}</th>
                        <td>{{$item->book_title}}</td>
                        <td>{{$item->book_isbn}}</td>
                        <td>{{$item->returnDate}}</td>

                        @if($item->status === 'Pending')
                        <td class=""><span class="badge bg-warning fw-bold">{{$item->status}}</span></td>
                        @elseif($item->status === 'Returned')
                        <td class=""><span class="badge bg-success fw-bold">{{$item->status}}</span></td>
                        @endif
                        <td><a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}">View</a></td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade " id="exampleModal{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Student Information</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Student Number:</strong> {{Crypt::decrypt($item->stud_num)}}</p>
                                    <p><strong>Student Name:</strong> {{Crypt::decrypt($item->stud_name)}}</p>
                                    <p><strong>Email:</strong> {{Crypt::decrypt($item->stud_email)}}</p>
                                    <p><strong>Phone Number:</strong> {{Crypt::decrypt($item->stud_phone)}}</p>
                                    <br>
                                    <p class="lead">Book Information</p>
                                    <p><strong>Book ID:</strong> {{$item->book_id}}</p>
                                    <p><strong>Title:</strong> {{$item->book_title}}</p>
                                    <p><strong>ISBN:</strong> {{$item->book_isbn}}</p>
                                    <p><strong>Return Date:</strong> {{$item->returnDate}}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="{{route('returnBook', $item->id)}}" class="btn btn-success">Book Returned</a>
                                    
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>

            <span class="float-end">
                {{ $borrowed_books->links()}}
            </span>
        </div>
    </section>
</x-app-layout>