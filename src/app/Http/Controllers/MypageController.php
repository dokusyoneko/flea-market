<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function index()
    {
        return view('mypage.mypage');
    }

    public function edit()
    {
        return view('mypage.profile');
    }
}
