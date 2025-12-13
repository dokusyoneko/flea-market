<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExhibitionRequest;


class ItemController extends Controller
{
    public function index(Request $request)
{
    $user = Auth::user();
    $tab = $request->query('tab');
    $keyword = $request->input('keyword');

    if ($tab === 'mylist') {
        if (!$user) {
            $products = collect();
        } else {
            $products = $user->likes()
            ->with('product')
            ->get()
            ->pluck('product');
        }

        if ($keyword) {
            $products = $products->filter(function ($product) use ($keyword) {
                return str_contains($product->name, $keyword);
            });
        }
    } else {
        $query = Product::query();

        if ($user) {
            $query->where('user_id', '!=', $user->id);
        }

        if ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
        }

        $products = $query->get();
    }

    return view('item.index', compact('products', 'keyword', 'tab'));
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

    public function store(ExhibitionRequest $request)
    {
    $data = $request->validated();
    $data['user_id'] = auth()->id();
    $data['price']   = preg_replace('/[^0-9]/', '', $data['price']);
    $data['is_sold'] = false;

    if ($request->hasFile('image_path')) {
    $data['image_path'] = $request->file('image_path')->store('products', 'public');
}

    $product = Product::create($data);

    if ($request->has('categories')) {
        $product->categories()->attach($request->categories);
    }

    return redirect()->route('mypage.index');
    }

}

