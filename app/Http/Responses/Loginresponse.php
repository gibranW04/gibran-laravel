<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect('/admin/dashboard');
        }

        if ($user->hasRole('member')) {
            return redirect('/dashboard');
        }

        // Fallback jika user tidak punya role
        return redirect('/');
    }
}
