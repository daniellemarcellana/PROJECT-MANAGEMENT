<link rel="icon" type="image/png" href="{{ asset('/images/equinox.png') }}">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create book') }}
        </h2>
    </x-slot>
    <section class="mt-5 mb-5">
        <div class="container">
            @if(session()->has('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Book created successfully',
                    footer: '<a href="/books">Return to book catalogue</a>'
                })
            </script>
            @else
            @endif
            <div class="row d-flex justify-content-center">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('book.index')}}" class="btn btn-light mb-3">Return to Book List</a>
                            <p class="card-text mb-3">Please fill out all the fields below and click on the "Submit" button to save the book to the database.</p>
                            <hr>

                            <!-- form -->
                            <form method="post" action="{{route('book.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="bookTitle" class="form-label">Book Title</label>
                                    <input type="text" class="form-control shadow-none  @error('bookTitle') is-invalid @enderror" value="{{old('bookTitle')}}" name="bookTitle" id="bookTitle">
                                    @error('bookTitle')
                                    <small id="helpId" class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="isbn" class="form-label">ISBN</label>
                                    <input type="text" class="form-control shadow-none  @error('isbn') is-invalid @enderror" value="{{old('isbn')}}" name="isbn" id="isbn">
                                    @error('isbn')
                                    <small id="helpId" class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="genre" class="form-label">Genre</label>
                                    <select class="form-select shadow-none  @error('genre') is-invalid @enderror" name="genre" id="genre">
                                        <option selected>Select a genre</option>
                                        <option value="Arts">Arts</option>
                                        <option value="Entertainment">Entertainment</option>
                                        <option value="Mathematics">Mathematics</option>
                                        <option value="Politics">Politics</option>
                                        <option value="Psychology">Psychology</option>
                                        <option value="Science">Science</option>
                                    </select>
                                </div>

                                <hr>

                                <div class="mb-3">
                                    <label for="author" class="form-label">Author</label>
                                    <input type="text" class="form-control shadow-none  @error('author') is-invalid @enderror" value="{{old('author')}}" name="author" id="author">
                                    @error('author')
                                    <small id="helpId" class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="publisher" class="form-label">Publisher</label>
                                    <input type="text" class="form-control shadow-none  @error('publisher') is-invalid @enderror" value="{{old('publisher')}}" name="publisher" id="publisher">
                                    @error('publisher')
                                    <small id="helpId" class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="publishingDate" class="form-label">Publishing Date</label>
                                    <input type="date" class="form-control shadow-none  @error('publishingDate') is-invalid @enderror" value="{{old('publishingDate')}}" name="publishingDate" id="publishingDate">
                                    @error('publishingDate')
                                    <small id="helpId" class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="illustrator" class="form-label">Illustrator</label>
                                    <input type="text" class="form-control shadow-none  @error('illustrator') is-invalid @enderror" value="{{old('illustrator')}}" name="illustrator" id="illustrator">
                                    @error('illustrator')
                                    <small id="helpId" class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="totalPages" class="form-label">Total Pages</label>
                                    <input type="number" class="form-control shadow-none  @error('totalPages') is-invalid @enderror" value="{{old('totalPages')}}" name="totalPages" id="totalPages">
                                    @error('totalPages')
                                    <small id="helpId" class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control shadow-none  @error('quantity') is-invalid @enderror" value="{{old('quantity')}}" name="quantity" id="quantity">
                                    @error('quantity')
                                    <small id="helpId" class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="file" class="form-label">Image</label>
                                    <input type="file" class="form-control shadow-none  @error('file') is-invalid @enderror" onchange="previewFile(this)" name="file">
                                    <img id="previewImg" alt="book image" style="max-width:15rem; margin-top:2rem;">
                                    @error('file')
                                    <small id="helpId" class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-dark float-end">Submit</button>

                            </form>
                            <!-- form -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- card -->
        </div>
    </section>
</x-app-layout>