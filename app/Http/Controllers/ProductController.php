<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{


public function index()
{
    
    $products = Product::with('category') // Eager load the category relationship
        ->select([
            'id',
            'name',
            'cost_price as buying',
            'price as selling',
            'quantity',
            'category_id'
        ])->get();

    $categories = \App\Models\Category::all(); // Get all categories for the select dropdown

    return view('admin.products', [
        'products' => $products,
        'categories' => $categories
    ]);
}

public function show($id)
{
    $product = Product::findOrFail($id);
    return view('admin.product_details', compact('product'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'cost_price' => 'required|numeric',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
    ]);

    Product::create([
        'name' => $validated['name'],
        'category_id' => $validated['category_id'],
        'price' => $validated['price'],   // Adjust if your DB column is named differently
        'cost_price' => $validated['cost_price'],       // Adjust if your DB column is named differently
        'quantity' => $validated['quantity'],
    ]);

    return redirect()->back()->with('success', 'Product added successfully!');
}




}




