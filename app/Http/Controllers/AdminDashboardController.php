<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $categoryData = $this->getCategoryData();

        return view('admin.dashboard', compact('totalProducts', 'categoryData'));
    }

    private function getCategoryData()
    {
        $categories = Category::all();
        $categoryData = [
            'labels' => [],
            'values' => [],
            'colors' => [],
        ];

        foreach ($categories as $category) {
            $categoryData['labels'][] = $category->name;
            $categoryData['values'][] = $category->products->count();
            $categoryData['colors'][] = $this->generateRandomColor();
        }

        return $categoryData;
    }

    private function generateRandomColor()
    {
        $letters = '0123456789ABCDEF';
        $color = '#';

        for ($i = 0; $i < 6; $i++) {
            $color .= $letters[rand(0, 15)];
        }

        return $color;
    }
}
