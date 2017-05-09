<?php

namespace Goodwong\LaravelUser\Controllers;

use Illuminate\Http\Request;

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
        if (!$user && config('app.debug')) {
            $user = \Goodwong\LaravelUser\Entities\User::firstOrCreate(
                ['id' => 1],
                ['name' => 'william', 'email' => 'w.illi.am@qq.com', 'password' => sha1(uniqid())]
            );
            app('Goodwong\LaravelUser\Handlers\LoginHandler')->login($user);
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
