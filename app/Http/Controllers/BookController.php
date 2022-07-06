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
}
