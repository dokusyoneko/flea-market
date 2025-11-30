<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExhibitionRequest;


class ItemController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $view = $request->query('data');
        $keyword = $request->input('keyword');

        if ($view === 'mypage') {
            if (!$user) {
                return redirect()->route('login');
            }

            $likedProductIds = Like::where('user_id', $user->id)->pluck('product_id');
            $products = Product::search($keyword)
                ->whereIn('id', $likedProductIds)
                ->get();
        } else {
            $products = Product::search($keyword)
                ->where('user_id', '!=', $user?->id)
                ->get();
        }

        return view('item.index', compact('products', 'keyword', 'view'));
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

