<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class inventoryController extends Controller
{
    //
    public function inventory(){
        return view('admin.inventory');
    }
}
