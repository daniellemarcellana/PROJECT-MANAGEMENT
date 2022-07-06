<link rel="icon" type="image/png" href="{{ asset('/images/equinox.png') }}">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>


    <section class="mt-5 mb-5">
        <div class="container">

            @if(session()->has('message'))

            <div class="alert alert-success col-sm-12">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                {{session()->get('message')}}
            </div>

            @endif

            <div class="p-2 col-sm-3 float-end mb-2">
                <form action="{{route('users')}}" method="get">
                    @csrf
                    <input type="text" class="form-control shadow-none" name="search" placeholder="Search..." value="{{request()->query('search')}}">
                </form>
            </div>

            <div class="table-responsive-sm">

                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Student Number</th>
                            <th scope="col">Year Level</th>
                            <th scope="col">Penalty</th>
                            <th scope="col">Usertype</th>
                            <th scope="col" colspan="2" style="text-align: center; width:20%;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->fName}} {{$user->midInit}} {{$user->lName}} </td>
                            <td>{{$user->stud_num}}</td>
                            <td>{{$user->yrLvl}}</td>

                            @if($user->penalty == null || $user->penalty == '0')
                            <td><span class="badge bg-success fw-bold">Php: 0</span></td>
                            @else
                            <td><span class="badge bg-danger fw-bold">Php: {{$user->penalty}}</span></td>
                            @endif

                            @if($user->usertype === '0')
                            <td>Student</td>
                            @elseif($user->usertype === '1')
                            <td>Admin</td>
                            @endif

                            <td><a class="btn btn-block btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal{{$user->id}}">View</a></td>
                            <td><a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{$user->id}}">Update Student</a></td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade " id="viewModal{{$user->id}}"  aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Student Information</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Student Number:</strong> {{$user->stud_num}}</p>
                                        <p><strong>Full Name:</strong> {{$user->fName}} {{$user->midInit}} {{$user->lName}} </p>
                                        <p><strong>Year Level:</strong> {{$user->yrLvl}} </p>
                                        <p><strong>Email:</strong> {{$user->email}}</p>
                                        <p><strong>Phone Number:</strong> {{$user->phone}}</p>
                                        <p><strong>Address:</strong> {{$user->address}}</p>
                                        <p><strong>Penalty:</strong> {{$user->penalty}}</p>
                                        <p><strong>User Type:</strong> {{$user->usertype}}</p>
                                        <br>

                                        <hr>
                                        <p class="lead">Books Handled</p>
                                        @foreach($borrowed_books as $borrowed_book)
                                        @if($borrowed_book->user_id == $user->id && $borrowed_book->status === 'Pending')
                                        <p><strong>Title:</strong> {{$borrowed_book->book_title}} </p>
                                        <p><strong>ISBN:</strong> {{$borrowed_book->book_isbn}} </p>
                                        <p><strong>Return Date:</strong> {{$borrowed_book->returnDate}} </p>
                                        <hr>
                                        @endif
                                        @endforeach

                                        

                                    
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade " id="editModal{{$user->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Student Information</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{route('editUser', $user->id)}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group mb-2">
                                                <label for="fName">First Name</label>
                                                <input type="text" class="form-control" name="fName" id="fName" value="{{$user->fName}}" required>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label for="midInit">Middle Name</label>
                                                <input type="text" class="form-control" name="midInit" id="midInit" value="{{$user->midInit}}" required>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label for="lName">Last Name</label>
                                                <input type="text" class="form-control" name="lName" id="lName" value="{{$user->lName}}" required>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label for="stud_num">Student Number</label>
                                                <input type="number" class="form-control" name="stud_num" id="stud_num" value="{{$user->stud_num}}" required>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label for="yrLvl">Year Level</label>
                                                <select class="form-control" aria-label="Default select example" required  name="yrLvl" id="yrLvl" required>
                                                    <option selected disabled value="">Current: {{$user->yrLvl}}</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="3">4</option>
                                                    <option value="3">5</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}" required>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label for="phone">Phone</label>
                                                <input type="text" class="form-control" name="phone" id="phone" value="{{$user->phone}}" required>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" name="address" id="address" value="{{$user->address}}" required>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label for="penalty">Penalty</label>
                                                <input type="text" class="form-control" name="penalty" id="penalty" value="{{$user->penalty}}" required>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label for="usertype">User Type</label>
                                                <select class="form-control" aria-label="Default select example" required  name="usertype" id="usertype" required>
                                                    <option selected disabled value="">Current: {{$user->usertype}}</option>
                                                    <option value="0">0 - Student</option>
                                                    <option value="1">1 - Librarian/Admin</option>
                                                </select>
                                            </div>

                                            
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary float-end mt-2">Save</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </tbody>
                </table>
            </div>

            <span class="float-end">
                {{ $users->links()}}
            </span>

        </div>
    </section>

</x-app-layout>