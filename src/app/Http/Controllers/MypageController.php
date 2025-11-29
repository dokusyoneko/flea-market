<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;
use App\Models\Purchase;

class MypageController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $view = $request->query('view');

        if ($view === 'buy') {
            $productIds = Purchase::where('user_id', $user->id)->pluck('product_id');
            $products = Product::whereIn('id', $productIds)->get();
        } else {
            $products = Product::where('user_id', $user->id)->get();
        }
        return view('mypage.mypage', compact('products', 'view'));
    }

    public function edit()
    {
        $profile = Auth::user()->profile;
        return view('mypage.profile', compact('profile'));
    }

    public function update(Request $request)
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

        return redirect('/mypage');
    }


}
