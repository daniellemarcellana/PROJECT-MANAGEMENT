<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\BorrowedBookLivewire;
use App\Http\Livewire\ManageUsers;
use App\Http\Controllers\Auth\ForgotPasswordController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard')->middleware('2fa');

Route::get('2fa', [App\Http\Controllers\TwoFAController::class, 'index'])->name('2fa.index');
Route::post('2fa', [App\Http\Controllers\TwoFAController::class, 'store'])->name('2fa.post');
Route::get('2fa/reset', [App\Http\Controllers\TwoFAController::class, 'resend'])->name('2fa.resend');

// ADMIN CONTROLS
Route::get('books', [BookController::class, 'index'])->name('book.index');
Route::get('books/show/{id}', [BookController::class, 'show'])->name('book.show');
Route::get('books/create', [BookController::class, 'create'])->name('book.create');
Route::post('books/store', [BookController::class, 'store'])->name('book.store');
Route::post('books/update/{id}', [BookController::class, 'update'])->name('book.update');
Route::get('books/destroy/{id}', [BookController::class, 'destroy'])->name('book.destroy');
Route::get('books/export/pdf', [BookController::class, 'exportPdf'])->name('book.exportPdf');

//USER CONTROLS
Route::get('users/books', [UserController::class, 'index'])->name('user.index');
Route::get('users/borrowed-books', [UserController::class, 'borrowedBooks'])->name('user.borrowedBooks');
Route::get('users/books/show/{id}', [UserController::class, 'show'])->name('user.show');


//ASSIGN BORROWER VIEW 
Route::get('books/borrow/{id}', [BorrowedBookLivewire::class, 'render'])->name('book.borrow');
//ASSIGN BORROWER STORE
Route::post('books/borrow/store/{id}', [BorrowedBookLivewire::class, 'borrowStore'])->name('book.borrow.store');
//BORROWED BOOKS SHOW/VIEW
Route::get('borrowedbooks', [BorrowedBookLivewire::class, 'borrowedBooks'])->name('borrowedbooks');
//RETURN BOOK
Route::get('returnBook/{id}', [BorrowedBookLivewire::class, 'returnBook'])->name('returnBook');

//MANAGE USERS VIEW
Route::get('users', [ManageUsers::class, 'render'])->name('users');

//EDIT USERS
Route::post('edit-user/{id}', [ManageUsers::class, 'edit'])->name('editUser');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Forgot Password
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
