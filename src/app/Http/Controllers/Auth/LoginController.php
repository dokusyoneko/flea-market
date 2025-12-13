<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if (is_null($user->email_verified_at)) {
                return redirect()->route('verification.notice.custom');
            }
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'ログイン情報が登録されていません',
        ]);
    }
}

