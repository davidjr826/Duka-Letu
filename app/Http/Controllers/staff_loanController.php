<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class staff_loanController extends Controller
{
    //
    public function staff_loan(){
        $user = auth()->user();
        return view('admin.staff_loan', compact('user'));
    }
}
