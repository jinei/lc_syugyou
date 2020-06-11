<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class timelineController extends Controller
{
    public function index()
    {   
        $lastday = Carbon::now()->endOfMonth()->day;
        $date = array();
        for($i = 1; $i <= $lastday; $i++){
            $dt = Carbon::now();
            $dt = Carbon::create($dt->year,$dt->month,$i);
            array_push($date,$dt);
        }
        $weekday = ['日', '月', '火', '水', '木', '金', '土'];
        $employee = ["長野","金谷","益田"];
        return view('timeline.index',compact('employee','lastday','date','weekday'));
    }
}
