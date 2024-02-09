<?php

namespace App\Http\Controllers;

use App\Models\Products;

class LProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::all();
        $cart = auth()->user()->cart ?? null;
        return view('lproducts.index', compact('products'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
        return view('lproducts.show', compact('product'));
    }

}
