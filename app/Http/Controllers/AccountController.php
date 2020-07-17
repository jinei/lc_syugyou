<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\User;

class AccountController extends Controller
{

    public function index() {

        $usercollection = collect(['id','name','email']); //コレクションの定義
        $employee = User::get();
        for($i = 0;$i < count($employee);$i++) {
            $data[$i] = $usercollection->combine([$employee[$i]->id,$employee[$i]->name,$employee[$i]->email]);
        }
        return view('timeline.account',compact('data'));
    }
    
}
