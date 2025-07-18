<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class salesController extends Controller
{
    //
    public function sales(){
        $user = auth()->user();
        return view('admin.sales', compact('user'));
    }
    public function new_sales(){
        $user = auth()->user();
        return view('admin.new_sales', compact('user'));
    }
}
