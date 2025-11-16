<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return view('item.index');
    }

    public function show($item_id)
    {
        $product = Product::with(['categories', 'comments', 'likes'])->findOrFail($item_id);
        return view('item.detail', compact('product'));
    }
}

