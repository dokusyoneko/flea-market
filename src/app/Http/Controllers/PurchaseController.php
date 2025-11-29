<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function show($item_id)
    {
        session(['current_item_id' => $item_id]);
        $product = Product::findOrFail($item_id);
        $user_profile = Auth::user()->profile;
        return view('purchase.purchase', compact('product','user_profile'));
    }

    public function editAddress()
    {
        $user_profile = Auth::user()->profile;
        return view('purchase.address', compact('user_profile'));
    }

    public function updateAddress(Request $request)
    {
        $profile = Auth::user()->profile;

        if (!$profile) {
            $profile = new UserProfile();
            $profile->user_id = Auth::id();
        }

        $profile->fill($request->only([
            'username',
            'avatar',
            'postal_code',
            'address',
            'building_name',
        ]));

        $profile->save();

        return redirect()->route('purchase.show', ['item_id' => session('current_item_id')])
            ->with('success', '住所を更新しました');
    }
}

