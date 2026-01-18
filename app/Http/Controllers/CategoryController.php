<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // All Categories
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'message' => 'Data Retrieve Successfully!',
            // 'data' => $categories,
            'data' => new CategoryCollection($categories),
        ]);
    }

    // Category with Products
    public function categoryWithProduct()
    {
        $categories = Category::with('products')->get();
        return response()->json([
            'message' => "Data Retrieve Success!",
            'data' => new CategoryCollection($categories),
        ]);
    }
}
