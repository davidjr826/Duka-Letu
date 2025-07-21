<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class changesController extends Controller
{
    //
    public function changes(){
        $user = auth()->user();
        return view('admin.loans.changes', compact('user'));
    }
}
