<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function index()
    {
        $param = ['message' => ''];
        return view('timeline.login',$param);
    }
    
    public function login(Request $request)
    {
        $requestdata = $request::all();
        $email = $requestdata['email'];
        $password = $requestdata['password'];
        if(Auth::attempt(['email' => $email,
            'password' => $password])) {
            $now = Carbon::now();
            return redirect('timeline/'.$now->year.'/'.$now->month.'/0'); 
            } else {
                $msg = 'ログインに失敗しました。';
                return view('timeline.login',['message' => $msg]); 
            }
    }
}
