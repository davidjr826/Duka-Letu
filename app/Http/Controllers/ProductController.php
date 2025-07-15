<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{


public function index()
{

    $user = auth()->user();
    
    $products = Product::select([
        'id',
        'name as product_name',
        'description',
        'cost_price as buying_price',
        'price as selling_price',
        'quantity as quantity_in_stock'
    ])->get();

    return view('admin.products', compact('products')  );
}
}




