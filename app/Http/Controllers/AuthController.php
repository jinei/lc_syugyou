<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
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

    public function logout() 
    {
        Auth::logout();
        return redirect('login'); 
    }

    public function create(Request $request) {
        $requestdata = $request::all();
        $name = $requestdata['name'];
        $email = $requestdata['email'];
        $pw = $requestdata['pw'];

        DB::insert('insert into users(name,email,password) values("'.$name.'","'.$email.'","'.Hash::make($pw).'")');
        return redirect('account'); 
    }
}
