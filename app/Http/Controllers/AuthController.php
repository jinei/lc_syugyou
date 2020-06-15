<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    //------------------------------------------------------/
    // ------------------- ログイン処理 --------------------
    //------------------------------------------------------/
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
    //------------------------------------------------------/
    // ------------------- ログイン処理 --------------------
    //------------------------------------------------------/



    //------------------------------------------------------/
    // ------------------- ログアウト処理--------------------
    //------------------------------------------------------/
    public function logout() 
    {
        Auth::logout();
        return redirect('login'); 
    }
    //------------------------------------------------------/
    // ------------------- ログアウト処理--------------------
    //------------------------------------------------------/


    //------------------------------------------------------/
    // ------------------- アカウント作成--------------------
    //------------------------------------------------------/
    public function create(Request $request) {
        $requestdata = $request::all();
        $name = $requestdata['name'];
        $email = $requestdata['email'];
        $pw = $requestdata['pw'];

        DB::insert('insert into users(name,email,password) values("'.$name.'","'.$email.'","'.Hash::make($pw).'")');
        return redirect('account'); 
    }
    //------------------------------------------------------/
    // ------------------- アカウント作成--------------------
    //------------------------------------------------------/


    //------------------------------------------------------/
    // ------------------- アカウント削除--------------------
    //------------------------------------------------------/
    public function delete(Request $request) {
        $requestdata = $request::all();
        $id = $requestdata['id'];
        DB::delete('delete from users where id = '.$id);
        return redirect('account');
    }
     //------------------------------------------------------/
    // ------------------- アカウント削除--------------------
    //------------------------------------------------------/
       
}
