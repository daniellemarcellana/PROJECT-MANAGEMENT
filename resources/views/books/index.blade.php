<link rel="icon" type="image/png" href="{{ asset('/images/equinox.png') }}">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Catalogue') }}
        </h2>
    </x-slot>
    <section class="mt-5 mb-5">
        <div class="container">

            @if(session()->has('deleted'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Book deleted',
                })
            </script>
            @else
            @endif
            <!-- search and create -->
            <div class="d-flex mb-3">
                <div class="p-2">
                    <form action="{{route('book.index')}}" method="get">
                        @csrf
                        <input type="text" class="form-control shadow-none" name="search" placeholder="Search by title, isbn, author..." value="{{request()->query('search')}}">
                    </form>
                </div>
                <div class="p-2">
                    <form action="{{route('book.exportPdf')}}" method="get">
                        @csrf
                        <input type="date" class="form-control shadow-none" name="from">
                </div>
                <div class="p-2">
                    <input type="date" class="form-control shadow-none" name="to">
                </div>
                <div class="p-2">
                    <button type="submit" class="btn btn-dark">Export</button>
                    </form>
                </div>
                <div class="ms-auto p-2"><a href="{{route('book.create')}}" class="btn btn-primary">Create a new book </a></div>

            </div>
            <!-- search and create -->

            <!-- card -->
            <div class="row">
                @foreach($books as $book)
                <div class="col-sm-3 mb-2 d-flex justify-content-center">
                    <div class="card rounded-0" style="width: 15rem; height:28rem;">
                        <div class="overflow-hidden">
                            <a href="{{route('book.show', $book->id)}}" title="Click to show or update"><img class="img-thumbnail" src="{{asset('images')}}/{{$book->image}}" style="width:14.5rem; height:16rem; margin:2px 2px 2px 2px;" alt=""></a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center mb-3" style="font-size:16px;"><u>{{$book->bookTitle}}</u></h5>
                            <p class="text-center" style="font-size:13px;">({{$book->isbn}})</p>
                            <p class="text-center text-muted"> By: {{$book->author}}</p>
                            <span class="badge rounded-pill text-bg-primary float-end">{{$book->genre}}</span>
                            <br>
                            <small class="float-end text-muted">{{$book->quantity}} remaining</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- card -->
            <div class="mx-auto d-flex justify-content-center p-5">{{ $books->appends(['search'=>request()->query('search')])->links() }}</div>

        </div>
    </section>
</x-app-layout>