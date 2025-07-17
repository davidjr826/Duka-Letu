<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class inventory_reportController extends Controller
{
    //
    public function inventory_report(){
        $user = auth()->user();
        return view('admin.inventory_report', compact('user'));
    }
}
