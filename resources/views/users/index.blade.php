<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Catalogue') }}
        </h2>
    </x-slot>
    <section class="mt-5 mb-5">
        <div class="container">
            <!-- search and create -->
            <div class="d-flex mb-3">
                <div class="me-auto p-2">{{ $books->appends(['search'=>request()->query('search')])->links() }}</div>
                <div class="p-2">
                    <form action="{{route('user.index')}}" method="get">
                        @csrf
                        <input type="text" class="form-control shadow-none" name="search" placeholder="Search by title, isbn, author..." value="{{request()->query('search')}}">
                    </form>
                </div>
            </div>
            <!-- search and create -->

            <!-- card -->
            <div class="row">
                @foreach($books as $book)
                <div class="col-sm-3 mb-2 d-flex justify-content-center">
                    <div class="card rounded-0" style="width: 15rem; height:28rem;">
                        <div class="overflow-hidden">
                            <a href="{{route('user.show', $book->id)}}" title="Click to show or update"><img class="img-thumbnail" src="{{asset('images')}}/{{$book->image}}" style="width:14.5rem; height:16rem; margin:2px 2px 2px 2px;" alt=""></a>
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
        </div>
    </section>
</x-app-layout>