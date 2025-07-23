<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // admin用ルートへのアクセス
        if($request->is('admin/*')){
            if(Auth::guard('web')->check()){
                abort(403);
            }

            // 未ログインならadminログインへリダイレクト
            return route('admin.login');
        }

        // 通常ルートへのみログイン時
        return $request->expectsJson() ? null : route('login');
    }
}
