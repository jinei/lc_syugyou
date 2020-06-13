<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class timelineController extends Controller
{
    public function index($checkyear,$checkmonth,$checkuserid)
    {   
        Carbon::useMonthsOverflow(false); //日付の加算方法を変更

        // 日付データ取得
        $checkdt = Carbon::create($checkyear,$checkmonth);
        $lastday = $checkdt->endOfMonth()->day; //末日の取得
        $date = array(); //日付データを入れる配列

        // 1日分ずつ配列に日付データを入れる
        for($i = 1; $i <= $lastday; $i++){
            $dt = Carbon::create($checkdt->year,$checkdt->month,$i);
            array_push($date,$dt);
        }
        
        // ユーザーIDとユーザー名の追加
        $usercollection = collect(['userid', 'name','starttime','endtime','day']);
        $data = ["全て","長野","金谷","益田"]; //従業員のデータ
        $starttime = ["17:00","18:00"];
        $endtime = ["21:00","23:00"];
        $day = [3,8];
        for($i = 0;$i < 4;$i++) {
            $employee[$i] = $usercollection->combine([$i,$data[$i],$starttime,$endtime,$day]);
        }
        
        $weekday = ['日', '月', '火', '水', '木', '金', '土']; //曜日変換用
  
        return view('timeline.index',compact('employee','lastday','date','weekday','checkdt','checkuserid','employee'));
    }
}
