<?php

namespace App\Http\Livewire;

use App\Models\BorrowedBook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Laravel\Jetstream\ConfirmsPasswords;
use Livewire\WithPagination;


class ManageUsers extends Component
{
    use ConfirmsPasswords;
    use WithPagination;


    //WALA PANG REDIRECTIONS
    public function render()
    {
        
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {

                $search = request()->query('search');
                if ($search) {
                    $users = User::where('id', 'LIKE', "%{$search}%")
                        ->orWhere('fName', 'LIKE', "%{$search}%")
                        ->orWhere('midInit', 'LIKE', "%{$search}%")
                        ->orWhere('lName', 'LIKE', "%{$search}%")
                        ->orWhere('stud_num', 'LIKE', "%{$search}%")
                        ->orWhere('yrLvl', 'LIKE', "%{$search}%")
                        ->orWhere('penalty', 'LIKE', "%{$search}%")
                        ->orWhere('usertype', 'LIKE', "%{$search}%")
                        ->orderBy('id')->paginate(5);
                } else {
                    $users = User::paginate(5);
                }

                $borrowed_books = BorrowedBook::all();
                return view('livewire.manage-users.index', compact('users', 'borrowed_books'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }

    public function edit($id, Request $request)
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {

                $users = User::findOrFail($id);

                $users->fName = $request->fName;
                $users->midInit = $request->midInit;
                $users->lName = $request->lName;
                $users->stud_num = $request->stud_num;
                $users->yrLvl = $request->yrLvl;
                $users->email = $request->email;
                $users->phone = $request->phone;
                $users->address = $request->address;
                $users->penalty = $request->penalty;
                $users->usertype = $request->usertype;

                $users->save();

                return redirect()->back()->with('message', 'User Updated');

            } else {
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }
}
