<?php

namespace App\Http\Responses;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        if (! $user->hasVerifiedEmail()) {
            auth()->logout();
            return redirect()->route('verification.notice.custom');
        }

        return redirect()->intended(route('mypage.index'));
    }
}
