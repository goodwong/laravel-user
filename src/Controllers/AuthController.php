<?php

namespace Goodwong\User\Controllers;

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
        $fake = $request->input('fake');
        if (!$user && config('app.debug') && $fake) {
            $user = \Goodwong\User\Entities\User::firstOrCreate(
                ['id' => $fake],
                ['name' => 'william', 'email' => 'w.illi.am@qq.com', 'password' => sha1(uniqid())]
            );
            app('Goodwong\User\Handlers\AuthHandler')->login($user, true);
        }
        return $user;
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
