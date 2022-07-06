<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Details') }}
        </h2>
    </x-slot>
    <section class="mt-5 mb-5">
        <div class="container">
            <a href="{{route('user.index')}}" class="btn btn-light mb-5">Return to book list</a>
            <!-- book details -->
            <div class="row justify-content-center">
                <div class="col-sm-3 mb-2">
                    <img class="img-thumbnail" src="{{asset('images')}}/{{$book->image}}" style="width:18.5rem; height:25rem;">
                </div>
                <div class="col-9 mb-2">
                    <h5 class="fw-bold">{{$book->bookTitle}} <span class="fw-normal"><small>({{$book->isbn}})</small></span></h5>
                    <p>by <u>{{$book->author}}</u></p>
                    <div class="d-flex mb-3">
                        <div class="me-auto p-2"> <span class="badge rounded-pill text-bg-primary float-start">{{$book->genre}}</span></div>
                        <div class="p-2"><span class="fw-bold">Last updated:</span> {{$book->created_at}}</div>
                    </div>
                    <hr>
                    <p class="fw-bold">Synopsis</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde illum ipsa dolore ullam dignissimos, laudantium expedita exercitationem sint rerum optio quasi cum animi qui nisi voluptas quis molestiae praesentium repudiandae porro accusamus aliquid excepturi quibusdam? Eaque dolore non quam soluta hic! Ipsa doloremque quidem nihil unde consectetur totam modi delectus, aperiam a? Qui illum similique alias expedita fugiat facilis laborum quaerat magnam? Quisquam numquam eos nobis omnis in ea et impedit, unde, fugit excepturi magnam sunt ratione voluptatem neque delectus nemo perferendis fugiat voluptatum dignissimos incidunt magni? Mollitia praesentium animi vero in, consequuntur eum minima perferendis temporibus facere voluptate vitae hic delectus quam assumenda magni suscipit, sunt modi sapiente excepturi iste perspiciatis exercitationem? Repellat earum mollitia eum quisquam? Quis, illum, expedita debitis, nesciunt blanditiis voluptatem similique voluptatibus voluptate dolores aperiam consectetur minus minima dolor repellat voluptates. Consequuntur quod praesentium excepturi in repudiandae! Rerum voluptatum iste porro fugiat, laboriosam, aspernatur modi veniam at ex necessitatibus adipisci molestias, tenetur minima obcaecati a libero debitis molestiae! Atque saepe fuga sequi facere sapiente nam reiciendis rerum officiis, molestias, ipsum, illo perferendis incidunt molestiae! Neque rem, doloribus, labore quae voluptatum eveniet voluptas omnis earum eos laudantium officia facilis accusamus ut iusto magni non iste aspernatur.</p>
                </div>
                <div class="col-sm-9 offset-sm-3 mb-2">
                    <hr>
                    <p class="fw-bold">About this book</p>
                    <div class="card-group">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">Published by</p>
                                <p class="card-text"><small class="text-muted">{{$book->publisher}}</small></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">Illustrated by</p>
                                <p class="card-text"><small class="text-muted">{{$book->illustrator}}</small></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">Total pages</p>
                                <p class="card-text"><small class="text-muted">{{$book->totalPages}}</small></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">Stocks</p>
                                <p class="card-text"><small class="text-muted">{{$book->quantity}}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <!-- book details -->
    </section>
</x-app-layout>