<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Like;

class LikeController extends Controller
{
    public function toggle($product_id)
    {
        $user = auth()->user();
        $product = Product::findOrFail($product_id);

        $like = Like::where('user_id', $user->id)
                    ->where('product_id', $product->id)
                    ->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            Like::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
            $liked = true;
        }

        return response()->json([
            'likes_count' => $product->likes()->count(),
            'liked' => $liked,
        ]);
    }
}

