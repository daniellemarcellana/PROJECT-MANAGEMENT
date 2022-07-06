<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;

use Livewire\Component;
use App\Models\Book;
use App\Models\BorrowedBook;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Livewire\WithPagination;
use Laravel\Jetstream\ConfirmsPasswords;

class BorrowedBookLivewire extends Component
{
    public $search;
    public $studentNumber, $stud_num, $stud_name, $stud_email, $stud_phone, $returnDate;
    use WithPagination;
    use ConfirmsPasswords;

    public function render($id)
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
                $book = Book::find($id);
                $users = User::orderBy('stud_num')->get();
                return view('livewire.borrowed-book-index', compact('book', 'users'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
        $book = Book::find($id);
        $users = User::orderBy('stud_num')->get();
        return view('livewire.borrowed-book-index', compact('book', 'users'));
    }
    public function borrowStore($id, Request $request)
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
                //find the book
                $book = Book::find($id);

                if ($book->quantity > 0) {
                    //find the book
                    $book = Book::find($id);

                    //find the student
                    $studentNumber = $request->stud_num;
                    $user = DB::table('users')->where('stud_num', $studentNumber)->first();

                    //create instance of borrowedbook and fill its column
                    $BorrowedBook = new BorrowedBook();
                    $BorrowedBook->user_id = $user->id;
                    $BorrowedBook->stud_num = Crypt::encrypt($request->stud_num);
                    $BorrowedBook->stud_name = Crypt::encrypt($user->fName . ' ' . $user->lName . ' ' . $user->midInit);
                    $BorrowedBook->stud_email = Crypt::encrypt($user->email);
                    $BorrowedBook->stud_phone = Crypt::encrypt($user->phone);

                    $BorrowedBook->book_id = $book->id;
                    $BorrowedBook->book_title = $book->bookTitle;
                    $BorrowedBook->book_isbn = $book->isbn;
                    $BorrowedBook->returnDate = $request->returnDate;
                    $BorrowedBook->status = 'Pending';

                    $BorrowedBook->save();

                    //minus 1 
                    DB::table('books')->where('id', $id)->decrement('quantity');

                    return redirect()->back()->with('message', 'Borrower Assigned Successfully');
                } else {
                    return redirect()->back()->with('failed_message', 'No stock available');
                }
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }
    public function borrowedBooks()
    {
       
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
                
                $search = request()->query('search');
                if ($search) {
                    $borrowed_books = BorrowedBook::where('stud_num', 'LIKE', "%{$search}%")
                        ->orWhere('book_title', 'LIKE', "%{$search}%")
                        ->orWhere('book_isbn', 'LIKE', "%{$search}%")
                        ->orWhere('returnDate', 'LIKE', "%{$search}%")
                        ->orWhere('status', 'LIKE', "%{$search}%")
                        ->orderBy('status')->paginate(5);
                } else {
                    $borrowed_books = BorrowedBook::orderBy('status')->orderBy('returnDate')->paginate(5);
                }

                return view('livewire.borrowed-book-show', ['borrowed_books' => $borrowed_books]);
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }
    public function returnBook($id)
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
                $borrowed_books = BorrowedBook::find($id);
                $borrowed_books->status = 'Returned';

                //plus 1 
                DB::table('books')->where('id', $borrowed_books->book_id)->increment('quantity');
                $borrowed_books->save();

                return redirect()->back()->with('message', 'Status Updated');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }

}
