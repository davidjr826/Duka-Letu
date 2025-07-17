<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class sales_reportController extends Controller
{
    //
    public function sales_report(){
        $user = auth()->user();
        return view('admin.sales_report', compact('user'));
    }
}
