<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\UserProfile;
use App\Models\Purchase;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\AddressRequest;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PurchaseController extends Controller
{
    public function show($item_id)
    {
        session(['current_item_id' => $item_id]);
        $product = Product::findOrFail($item_id);
        $user_profile = Auth::user()->profile;
        return view('purchase.purchase', compact('product','user_profile'));
    }

    public function editAddress($item_id)
    {
        $product = Product::findOrFail($item_id);
        $user_profile = Auth::user()->profile;
        return view('purchase.address', compact('product', 'user_profile'));
    }

    public function updateAddress(AddressRequest  $request, $item_id)
    {
        $profile = Auth::user()->profile;

        if (!$profile) {
            $profile = new UserProfile();
            $profile->user_id = Auth::id();
        }

        $profile->fill($request->validated());
        $profile->save();

        return redirect()->route('purchase.show', ['item_id' => $item_id]);

    }

    public function store(PurchaseRequest $request, $item_id)
    {
        $user = Auth::user();
        $profile = $user->profile;

        Purchase::create([
            'user_id'       => $user->id,
            'product_id'    => $item_id,
            'postal_code'   => $profile->postal_code,
            'address'       => $profile->address,
            'building_name' => $profile->building_name,
            'payment_method'=> $request->payment_method,
        ]);

        $product = Product::findOrFail($item_id);
        $product->is_sold = true;
        $product->save();

        return redirect()->route('item.index');
    }

    public function checkout(PurchaseRequest $request, $item_id)
    {
        $request->validate([
        'payment_method' => 'required|in:konbini,card',
        ]);

        $product = Product::findOrFail($item_id);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' =>  [$request->payment_method],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => $product->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('purchase.success', ['item_id' => $product->id]),
            'cancel_url'  => route('item.index'),
        ]);

        return redirect($session->url);
    }

    public function success($item_id)
    {
        $user = Auth::user();
        $profile = $user->profile;

        Purchase::create([
            'user_id'       => $user->id,
            'product_id'    => $item_id,
            'postal_code'   => $profile->postal_code,
            'address'       => $profile->address,
            'building_name' => $profile->building_name,
            'payment_method'=> 'stripe',
        ]);

        $product = Product::findOrFail($item_id);
        $product->is_sold = true;
        $product->save();

        return redirect()->route('item.index');
    }

}

