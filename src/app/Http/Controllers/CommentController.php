<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(CommentRequest $request, $product_id)
    {
        $data = $request->validated();

        Comment::create([
            'user_id'    => Auth::id(),
            'product_id' => $product_id,
            'content'    => $data['comment'],
        ]);

        return redirect()->back();
    }
}

