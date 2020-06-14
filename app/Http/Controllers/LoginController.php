<?php

namespace App\Http\Controllers;

use Request;

class LoginController extends Controller
{
    public function index()
    {
        $param = ['message' => 'ログインしてください'];
        return view('timeline.login',$param);
    }
    
    public function login(Request $request)
    {
        $email = $request->lg_username;
        $password = $request->lg_password;
        if(Auth::attempt(['email' => $email,
            'password' => $password])) {
                $msg = 'ログインしました';
            } else {
                $msg = 'ログインに失敗しました。';
            }
        return view('timeline.login',['message' => $msg]); 
    }
}
