<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class profileController extends Controller
{
    //
    public function profile(){
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }
}
