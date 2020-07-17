<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function create(Request $request) {
        $requestdata = $request::all();
        
        DB::transaction(function() use($requestdata) {
            $users = new User;
            $users->name = $requestdata['name'];
            $users->email = $requestdata['email'];
            $users->password = Hash::make($requestdata['pw']);
            $users->save();
        });
        return redirect('account'); 
    }

    public function delete(Request $request) {
        $requestdata = $request::all();
        
        DB::transaction(function() use($requestdata) {
            $id = $requestdata['id'];
            $users = User::find($id);
            $users->deleted_at = Carbon::now();
            $users->save();
        });
        return redirect('account');
    }
       
}
