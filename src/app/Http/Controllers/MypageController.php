<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;
use App\Models\Purchase;
use App\Http\Requests\ProfileRequest;

class MypageController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $page = $request->query('page');

        if ($page === 'buy') {
            $productIds = Purchase::where('user_id', $user->id)->pluck('product_id');
            $products = Product::whereIn('id', $productIds)->get();
        } else {
            $products = Product::where('user_id', $user->id)->get();
            $page = 'sell';
        }

        return view('mypage.mypage', compact('products', 'page'));
    }

    public function edit()
    {
        $profile = Auth::user()->profile;
        return view('mypage.profile', compact('profile'));
    }

    public function update(ProfileRequest $request)
    {
        $user = auth()->user();

        $profile = $user->profile ?? new UserProfile(['user_id' => $user->id]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $profile->avatar = $path;
        }

        $profile->username = $request->username;
        $profile->postal_code = $request->postal_code;
        $profile->address = $request->address;
        $profile->building_name = $request->building_name;

        $profile->save();

        return redirect()->route('item.index', ['tab' => 'mylist']);
    }


}
