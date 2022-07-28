<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PDF;


class BookController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
                $search = request()->query('search');
                if ($search) {
                    $books = Book::where('bookTitle', 'LIKE', "%{$search}%")
                        ->orWhere('author', 'LIKE', "%{$search}%")
                        ->orWhere('genre', 'LIKE', "%{$search}%")
                        ->orWhere('isbn', 'LIKE', "%{$search}%")
                        ->paginate(16);
                } else {
                    $books = DB::table('books')->orderBy('created_at', 'asc')->paginate('16');
                }
                return view('books.index', compact('books'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }

    public function show($id)
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
                $book = Book::find($id);
                return view('books.show', compact('book'));
            } else {
                return back()->with('', '');
            }
        } else {
            return redirect('login');
        }
    }

    public function create()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
                return view('books.create');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }
    public function store(Request $request)
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {

                // validation
                $request->validate([
                    'bookTitle' => 'required|unique:books|max:255',
                    'isbn' => 'required|unique:books|digits:13',
                    'genre' => 'required|in:Science,Mathematics,Politics,Psychology,Arts,Entertainment',
                    'author' => 'required|max:255|regex:/^[\pL\s\-]+$/u', //regex for letters, hyphens and spaces only
                    'publisher' => 'required|unique:books|max:255',
                    'publishingDate' => 'required',
                    'illustrator' => 'required|max:255',
                    'totalPages' => 'required|numeric|min:1|max:99999',
                    'quantity' => 'required|numeric|min:1|max:9999',
                    // niremove ko validation sa image hahaha pag nilagyan ko ayaw masaveeeeeee
                ], [
                    // custom error message here if ever meron
                ]);
                // if ever may foreign keys / relationships nang nakaset up, uncomment $book = Auth::user(); and $book->books()->save($book); and delete $book->save();
                // $book = Auth::user();
                $book = new Book();
                $book->bookTitle = $request->bookTitle;
                $book->isbn = $request->isbn;
                $book->genre = $request->genre;
                $book->author = $request->author;
                $book->publisher = $request->publisher;
                $book->publishingDate = $request->publishingDate;
                $book->illustrator = $request->illustrator;
                $book->totalPages = $request->totalPages;
                $book->quantity = $request->quantity;
                //saving image
                $image = $request->file('file');
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('images'), $imageName);

                $book->image = $imageName;
                $book->save();
                // $book->books()->save($book);
                return back()->with('success', '');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {

                $request->validate([
                    'bookTitle' => "required|max:255|unique:books,bookTitle,$id",
                    'isbn' => "required|digits:13|unique:books,isbn,$id",
                    'genre' => 'required|in:Science,Mathematics,Politics,Psychology,Arts,Entertainment',
                    'author' => 'required|max:255|regex:/^[\pL\s\-]+$/u', //regex for letters, hyphens and spaces only
                    'publisher' => 'required|max:255',
                    'publishingDate' => 'required',
                    'illustrator' => 'required|max:255',
                    'totalPages' => 'required|numeric|min:1|max:99999',
                    'quantity' => 'required|numeric|min:1|max:9999',
                    // niremove ko validation sa image hahaha pag nilagyan ko ayaw masaveeeeeee
                ], [
                    // custom error message here if ever meron
                ]);
                $book = Book::find($id);
                $book->bookTitle = $request->bookTitle;
                $book->isbn = $request->isbn;
                $book->genre = $request->genre;
                $book->author = $request->author;
                $book->publisher = $request->publisher;
                $book->publishingDate = $request->publishingDate;
                $book->illustrator = $request->illustrator;
                $book->totalPages = $request->totalPages;
                $book->quantity = $request->quantity;
                //saving image
                $image = $request->file('file');
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('images'), $imageName);

                $book->image = $imageName;
                $book->save();
                return back()->with('updated', '');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }

    public function destroy($id)
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {

                $book = Book::find($id);
                // delete associated image with this book
                $directory = 'images/' . $book->image;
                if (File::exists($directory)) {
                    File::delete($directory);
                }
                $book->delete();
                return redirect()->to('/books')->with('deleted', '');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }
    public function exportPdf(Request $request)
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
                $from = $request->from;
                $to = $request->to;

                $books = Book::select('bookTitle', 'isbn', 'genre', 'quantity', 'updated_at')
                    ->whereDate('updated_at', '>=', $from)
                    ->whereDate('updated_at', '<=', $to)
                    ->get();
                $pdf = PDF::loadView('books.pdf', compact('books'));
                $pdf->setPaper('A4', 'landscape');
                return $pdf->download('books.pdf');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }
<<<<<<< HEAD

    public function dashboard()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
                $total_books = DB::select('SELECT genre, COUNT(*) as count FROM books GROUP BY genre');

                return view('graphs.dashboard', compact('total_books'));
=======
    public function dashboard()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {      
                $total_books = DB::select('SELECT genre, COUNT(*) as count FROM books GROUP BY genre');
                
                return view('graphs.dashboard', compact('total_books'));

>>>>>>> bea6db1d838e443f72650735931067ae40e2e6ef
            } else {
                return view('users.dashboard');
            }
        } else {
            return redirect('login');
        }
    }

    public function stocks()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
<<<<<<< HEAD
                $total_books = DB::select('SELECT bookTitle, quantity, genre FROM books');

=======
                $total_books = DB::select('SELECT bookTitle, quantity FROM books');
            
>>>>>>> bea6db1d838e443f72650735931067ae40e2e6ef
                return view('graphs.stocks', compact('total_books'));
            } else {
                return view('users.dashboard');
            }
        } else {
            return redirect('login');
        }
    }

    public function due_dates()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
<<<<<<< HEAD
                $duedates = DB::select('SELECT stud_num, stud_name, book_title, returnDate FROM borrowed_books  WHERE returnDate>curdate() ORDER BY returnDate');

=======
                $duedates = DB::select('SELECT stud_num, stud_name, book_title, returnDate FROM borrowed_books ');
            
>>>>>>> bea6db1d838e443f72650735931067ae40e2e6ef
                return view('graphs.duedates', compact('duedates'));
            } else {
                return view('users.dashboard');
            }
        } else {
            return redirect('login');
        }
    }

    public function about()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
                return view('graphs.about');
            } else {
                return view('users.dashboard');
            }
        } else {
            return redirect('login');
        }
    }
<<<<<<< HEAD

    public function borrowed_chart()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
                $borrowed_dates = DB::select('SELECT ROW_NUMBER() OVER (ORDER BY DATE(created_at)) row_num, DATE(created_at) as date_borrowed, COUNT(*) as count FROM borrowed_books GROUP BY DATE(created_at)');

                return view('graphs.borrowed_dates', compact('borrowed_dates'));
            } else {
                return view('users.dashboard');
            }
        } else {
            return redirect('login');
        }
    }

    public function borrowed_status()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
                $borrowed_status = DB::select('SELECT status, COUNT(*) as count FROM `borrowed_books` GROUP BY status');
                $borrowed_total = DB::select('SELECT COUNT(*) as total FROM `borrowed_books`');
                return view('graphs.borrowed_status', compact('borrowed_status', 'borrowed_total'));
            } else {
                return view('users.dashboard');
            }
        } else {
            return redirect('login');
        }
    }

    public function students_penalty()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
                $users = DB::select('SELECT * FROM users WHERE penalty != "0" ORDER BY (0 + penalty)');

                return view('graphs.students_penalty', compact('users'));
            } else {
                return view('users.dashboard');
            }
        } else {
            return redirect('login');
        }
    }

    public function book_monthly()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
                $monthly_books = DB::select('SELECT
                t.month,
                t.monthname,
                t.book_count,
                @running_total := @running_total + t.book_count AS cumulative_sum
            FROM
                (SELECT
                    MONTH(created_at) AS month,
                    MONTHNAME(created_at) AS monthname,
                    COUNT(created_at) AS book_count
                FROM
                    books
                GROUP BY
                    MONTH(created_at)) t
            JOIN(SELECT
                @running_total := 0) r
            ORDER BY
                t.month');

                return view('graphs.book_monthly', compact('monthly_books'));
            } else {
                return view('users.dashboard');
            }
        } else {
            return redirect('login');
        }
    }
=======
>>>>>>> bea6db1d838e443f72650735931067ae40e2e6ef
}
