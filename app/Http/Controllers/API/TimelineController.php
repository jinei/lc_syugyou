<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TimelineController extends Controller
{
    public function getDate()
    {
        Carbon::useMonthsOverflow(false); //日付の加算方法を変更
        $checkyear = Carbon::now()->year;
        $checkmonth = Carbon::now()->month;
        $checkdt = Carbon::create($checkyear,$checkmonth);
        $lastday = $checkdt->endOfMonth()->day; //末日の取得
        $date = array(); //日付データを入れる配列
        $datecollection = collect(['month','day','week']);
        $weekday = ['日', '月', '火', '水', '木', '金', '土']; //曜日変換用

        for($i = 1; $i <= $lastday; $i++){
            $dt = Carbon::create($checkdt->year,$checkdt->month,$i);
            array_push($date,$datecollection->combine([
                $checkmonth,
                $i,
                $weekday[$dt->dayOfWeek]
            ]));
        }
        return ['date'=>$date];
    }
}
