<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $product_id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'product_id' => $product_id,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'コメントを追加しました');
    }
}

