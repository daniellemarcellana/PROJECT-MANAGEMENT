<link rel="icon" type="image/png" href="{{ asset('/images/equinox.png') }}">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assign Borrower') }}
        </h2>
    </x-slot>

    <section class="mt-5 mb-5">
        <div class="container">
            <a href="{{route('book.show', $book->id)}}" class="btn btn-dark mb-4">Return to book</a>

            <div class="row justify-content-center">
                @if(session()->has('message'))

                <div class="alert alert-success col-sm-9">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    {{session()->get('message')}}
                </div>

                @endif

                @if(session()->has('failed_message'))

                <div class="alert alert-danger col-sm-9">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    {{session()->get('failed_message')}}
                </div>

                @endif

            </div>

            <div class="row justify-content-center">
                <div class="col-sm-3 mb-2">
                    <div class="card">
                        <img class="card-img-top" src="{{asset('images')}}/{{$book->image}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$book->bookTitle}}</h5>
                            <p class="card-text">({{$book->isbn}})</p>
                        </div>
                    </div>

                    <form class="mt-4" method="post" action="{{route('book.borrow.store', $book->id)}}">
                        @csrf
                        <div class="form-group">
                            <h5>Select a student</h5>
                            <label for="stud_num">Student Number</label>
                            <select class="form-control mt-2" id="stud_num" name="stud_num" wire:model="stud_num" required>
                                <option value="">---</option>
                                @foreach($users as $user)
                                <option>{{$user->stud_num}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <label for="returnDate">Return Date</label>
                            <input type="date" class="form-control shadow-none " name="returnDate" id="returnDate" wire:model="returnDate" required>
                        </div>
                        
                        <!-- Pang disable ng past dates -->
                        <script language="javascript">
                            var today = new Date();
                            var dd = String(today.getDate()).padStart(2, '0');
                            var mm = String(today.getMonth() + 1).padStart(2, '0');
                            var yyyy = today.getFullYear();

                            today = yyyy + '-' + mm + '-' + dd;
                            $('#returnDate').attr('min', today);
                        </script>

                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-dark">Submit</button>
                        </div>
                    </form>


                </div>
                <div class="col-sm-6 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Synopsis</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde illum ipsa dolore ullam dignissimos, laudantium expedita exercitationem sint rerum optio quasi cum animi qui nisi voluptas quis molestiae praesentium repudiandae porro accusamus aliquid excepturi quibusdam? Eaque dolore non quam soluta hic! Ipsa doloremque quidem nihil unde consectetur totam modi delectus, aperiam a? Qui illum similique alias expedita fugiat facilis laborum quaerat magnam? Quisquam numquam eos nobis omnis in ea et impedit, unde, fugit excepturi magnam sunt ratione voluptatem neque delectus nemo perferendis fugiat voluptatum dignissimos incidunt magni? Mollitia praesentium animi vero in, consequuntur eum minima perferendis temporibus facere voluptate vitae hic delectus quam assumenda magni suscipit, sunt modi sapiente excepturi iste perspiciatis exercitationem? Repellat earum mollitia eum quisquam? Quis, illum, expedita debitis, nesciunt blanditiis voluptatem similique voluptatibus voluptate dolores aperiam consectetur minus minima dolor repellat voluptates. Consequuntur quod praesentium excepturi in repudiandae! Rerum voluptatum iste porro fugiat, laboriosam, aspernatur modi veniam at ex necessitatibus adipisci molestias, tenetur minima obcaecati a libero debitis molestiae! Atque saepe fuga sequi facere sapiente nam reiciendis rerum officiis, molestias, ipsum, illo perferendis incidunt molestiae! Neque rem, doloribus, labore quae voluptatum eveniet voluptas omnis earum eos laudantium officia facilis accusamus ut iusto magni non iste aspernatur.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>