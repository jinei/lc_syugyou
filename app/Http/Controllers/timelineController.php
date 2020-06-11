<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class timelineController extends Controller
{
    public function index()
    {
        $data = [
            'msg'=>'これはテストメッセージです'
        ];
        return view('timeline.index',$data);
    }
}
