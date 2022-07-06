<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Borrowed Books') }}
        </h2>
    </x-slot>
    <section class="mb-5 mt-5">
        <div class="container">
            <div class="row">
                @foreach($books as $book)
                <div class="col-sm-3 mb-2 d-flex justify-content-center">
                    <div class="card rounded-0" style="width: 15rem; height:28rem;">
                        <div class="overflow-hidden">
                            <a href="#" title="Click to show or update"><img class="img-thumbnail" src="{{asset('/images')}}/bookplaceholder.png" style="width:14.5rem; height:16rem; margin:2px 2px 2px 2px;" alt=""></a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center mb-3" style="font-size:16px;"><u>{{$book->book_title}}</u></h5>
                            <p class="text-center" style="font-size:13px;">({{$book->book_isbn}})</p>

                            <p class="text-center text-muted"> By: {{$book->returnDate}}</p>
                            @if($book->status === 'Pending')
                            <span class="badge rounded-pill text-bg-warning float-end">{{$book->status}}</span>
                            @else
                            <span class="badge rounded-pill text-bg-success float-end">{{$book->status}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>