<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('item.index', compact('products'));
    }

    public function show($item_id)
    {
        $product = Product::with(['categories', 'comments', 'likes'])->findOrFail($item_id);
        return view('item.detail', compact('product'));
    }

    public function create()
    {
        return view('item.sell');
    }

    public function showSellForm()
    {
        $categories = Category::all();
        return view('item.sell', compact('categories'));
    }
}

