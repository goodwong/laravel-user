<?php

namespace Goodwong\LaravelUser\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    /**
     * show
     * 
     * @param  Request  $request
     * @return Response
     */
    public function show(Request $request)
    {
        $user = $request->user();
        // 开发环境下可以模拟登录
        if (!$user && config('app.debug') && $request->has('fake')) {
            $user = \Goodwong\LaravelUser\Entities\User::firstOrCreate(
                ['id' => 1],
                ['name' => 'william', 'email' => 'w.illi.am@qq.com', 'password' => sha1(uniqid())]
            );
            app('Goodwong\LaravelUser\Handlers\AuthHandler')->login($user);
        }
        return response()->json($user);
    }

    /**
     * logout
     * 
     * @return Response
     */
    public function logout()
    {
        Auth::logout();
        return response(null, 204);
    }
}
