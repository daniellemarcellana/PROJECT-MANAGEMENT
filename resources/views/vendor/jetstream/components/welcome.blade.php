<div class="p-6 sm:px-20 bg-white border-b border-gray-200">


    <div class="mt-8 text-2xl">
        Welcome to Bibliotech Dashboard!
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