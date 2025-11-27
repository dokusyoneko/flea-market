<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ItemController extends Controller
{
    public function index(Request $request)
    {
        if ($request->query('data') === 'mypage') {
            $user = Auth::user();

            if (!$user) {
                return redirect()->route('login');
            }

            $likedProductIds = Like::where('user_id', $user->id)->pluck('product_id');
            $products = Product::whereIn('id', $likedProductIds)->get();
        } else {
            $products = Product::all();
        }
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

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'brand' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:2000',
        'price' => 'required|regex:/^[0-9]+$/',
        'condition' => 'required|string|max:50',
        'categories' => 'required|array|min:1',
        'categories.*' => 'exists:categories,id',
        'image_path' => 'nullable|image|max:2048',
    ]);

    $price = preg_replace('/[^0-9]/', '', $request->price);

    $imagePath = null;
    if ($request->hasFile('image_path')) {
        $imagePath = $request->file('image_path')->store('products', 'public');
    }

    $product = Product::create([
        'user_id' => auth()->id(),
        'name' => $validated['name'],
        'brand' => $validated['brand'] ?? '',
        'description' => $validated['description'] ?? '',
        'price' => $price,
        'condition' => $validated['condition'],
        'is_sold' => false,
        'image_path' => $imagePath ?? '',
    ]);

    $product->categories()->attach($validated['categories']);

    return redirect()->route('mypage.index')->with('success', '商品を出品しました');
}
}

