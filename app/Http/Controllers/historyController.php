<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class historyController extends Controller
{
    //
    public function history(){
        $user = auth()->user();
        return view('admin.history', compact('user'));
    }
}
