<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class AccountController extends Controller
{

    //------------------------------------------------------/
    // ------------------- ページ起動時 --------------------
    //------------------------------------------------------/
    public function index() {
        // ログイン済
        if (Auth::check()) {
        // アカウント情報の取得
        $usercollection = collect(['id','name','email']); //コレクションの定義
        $employee = DB::select('select * from users');//従業員のデータ
        for($i = 0;$i < count($employee);$i++) {
            $data[$i] = $usercollection->combine([$employee[$i]->id,$employee[$i]->name,$employee[$i]->email]);
        }
        return view('timeline.account',compact('data'));

        // 未ログイン
        } else {
        return redirect('login');
        }
    }
    //------------------------------------------------------/
    // ------------------- ページ起動時 --------------------
    //------------------------------------------------------/
    
}
