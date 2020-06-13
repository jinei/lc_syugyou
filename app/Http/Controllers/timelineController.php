<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class timelineController extends Controller
{
    public function index($checkyear,$checkmonth,$checkuser)
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

        $weekday = ['日', '月', '火', '水', '木', '金', '土']; //曜日変換用
        $employee = ["長野","金谷","益田"]; //従業員のデータ
        
        // $employee[0]['name'] = '長野';
        // $employee[1]['name'] = '金谷';
        // $employee[2]['name'] = '益田';

        // $dept_name = $company['departments'][0]['name'];

        return view('timeline.index',compact('employee','lastday','date','weekday','checkdt','checkuser'));
    }
}
