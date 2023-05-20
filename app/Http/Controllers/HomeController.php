<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('pages.home', compact('products'));
    }
    public function show($id)
    {
        $product = Product::find($id);
        return view('pages.detail', compact('product'));
    }
}
