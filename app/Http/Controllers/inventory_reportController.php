<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class inventory_reportController extends Controller
{
    //
    public function inventory_report(){
        return view('admin.inventory_report');
    }
}
