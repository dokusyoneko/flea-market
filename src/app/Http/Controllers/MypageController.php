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
        $user = auth()->user();

        $profile = $user->profile ?? new UserProfile(['user_id' => $user->id]);

        if ($request->hasFile('avatar')) {
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->profile->avatar = $path;
        }

        $user->profile->username = $request->username;
        $user->profile->postal_code = $request->postal_code;
        $user->profile->address = $request->address;
        $user->profile->building_name = $request->building_name;

        $user->profile->save();

    return redirect('/')->with('success', 'プロフィールを更新しました');
}

}
