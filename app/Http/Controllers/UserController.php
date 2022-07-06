<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\BorrowedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 0 && Auth::user()->email_verified_at != NULL) {
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
                return view('users.index', compact('books'));
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
            if (Auth::user()->usertype == 0 && Auth::user()->email_verified_at != NULL) {
                $book = Book::find($id);
                return view('users.show', compact('book'));
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
            if (Auth::user()->usertype == 0 && Auth::user()->email_verified_at != NULL) {
                $user_id = Auth::user()->id;
                $books = BorrowedBook::where('user_id', $user_id)->get();
                return view('users.borrowed-books', compact('books'));
                
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }
}
