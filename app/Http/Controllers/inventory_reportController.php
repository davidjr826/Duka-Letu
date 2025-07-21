<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class inventory_reportController extends Controller
{
    //
    public function inventory_report(){
        $inStock = 80;
        $lowStock = 10;
        $outOfStock = 32;
        $user = auth()->user();
        return view('admin.inventory_report', compact('user', 'inStock', 'lowStock', 'outOfStock' ));
    }
}
