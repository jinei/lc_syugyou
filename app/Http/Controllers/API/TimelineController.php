<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TimelineController extends Controller
{
    public function getDate(Request $request)
    {
        // ページ起動時
        if($request->flag == 0) {
            $checkdt = Carbon::now();

        // 月の変更時
        } else {
            $checkdt = Carbon::create($request->now['year'],$request->now['month']+$request->flag);
        }

        Carbon::useMonthsOverflow(false); //日付の加算方法を変更
        $checkyear = $checkdt->year;
        $checkmonth = $checkdt->month;
        $lastday = $checkdt->endOfMonth()->day; //末日の取得
        $date = array();
        $datecollection = collect(['year','month','day','week']);
        $weekday = ['日', '月', '火', '水', '木', '金', '土'];
        
        for($i = 1; $i <= $lastday; $i++){
            $dt = Carbon::create($checkdt->year,$checkdt->month,$i);
            array_push($date,$datecollection->combine([
                $checkyear,
                $checkmonth,
                $i,
                $weekday[$dt->dayOfWeek]
            ]));
        }
        return ['date'=>$date];
    }
    
}