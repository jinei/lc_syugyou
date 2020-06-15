<?php

namespace App\Http\Controllers;
use Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function index()
    {
        $param = ['message' => '','test' => Auth::check()];
        // ログイン済
        if (Auth::check()) {
            $now = Carbon::now();
            return redirect('timeline/'.$now->year.'/'.$now->month.'/0');
        // 未ログイン    
        } else {
            return view('timeline.login',$param);
        }
    }

}
