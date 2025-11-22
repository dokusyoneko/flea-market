<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;

class MypageController extends Controller
{
    public function index()
    {
        $products = Product::where('user_id', Auth::id())->get();
        return view('mypage.mypage', compact('products'));
    }

    public function edit()
{
    $profile = Auth::user()->profile;
    return view('mypage.profile', compact('profile'));
}

    public function update(Request $request)
    {
        $validated = $request->validate([
        'username'      => 'required|string|max:255',
        'postal_code'   => 'required|string|max:8',
        'address'       => 'required|string|max:255',
        'building_name' => 'nullable|string|max:255',
]);

        $profile = Auth::user()->profile;

        if (!$profile) {
            $profile = new UserProfile();
            $profile->user_id = Auth::id();
        }

        $profile->fill($validated)->save();

        return redirect()->route('mypage.edit')->with('success', 'プロフィールを更新しました');
    }
}
