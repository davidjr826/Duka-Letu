<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class student_loanController extends Controller
{
    //
    public function student_loan(){
        return view('admin.student_loan');
    }
}
