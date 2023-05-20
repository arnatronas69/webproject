<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;

class DetailController extends Controller
{
    public function show($id)
    {
        $product = Product::find($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->take(4)
        ->get();
        $category = Category::find($product->category_id);
        $tags = $product->tags;

        return view('pages.detail', [
            'product' => $product,
            'category' => $category,
            'tags' => $tags,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
