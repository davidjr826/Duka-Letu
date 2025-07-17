<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class inventoryController extends Controller
{
    //
    public function inventory(){
        $user = auth()->user();
        return view('admin.inventory', compact('user'));
    }
}
