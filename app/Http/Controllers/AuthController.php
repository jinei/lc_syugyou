<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function logout() 
    {
        Auth::logout();
        return redirect(''); 
    }

    public function create(Request $request) {
        $requestdata = $request::all();
        $name = $requestdata['name'];
        $email = $requestdata['email'];
        $pw = $requestdata['pw'];

        DB::insert('insert into users(name,email,password) values("'.$name.'","'.$email.'","'.Hash::make($pw).'")');
        return redirect('account'); 
    }

    public function delete(Request $request) {
        $requestdata = $request::all();
        $id = $requestdata['id'];
        DB::delete('delete from users where id = '.$id);
        return redirect('account');
    }
       
}
