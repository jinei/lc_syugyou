<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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

        // $test = DB::select('select * from employee');

        // ユーザーIDとユーザー名の追加
        $usercollection = collect(['userid','name','starttime','endtime','day','workingid']);
        $employee = DB::select('select * from employee');//従業員のデータ

        for($i = 0;$i < count($employee);$i++) {
            // 勤務時間をユーザーごとに取得
            $working = DB::select('select * from working where year='.$checkdt->year.' and month='.$checkdt->month.' and userid='.$employee[$i]->userid);
            $starttime = array_column($working, 'starttime'); //勤務開始時間
            $endtime = array_column($working, 'endtime'); //勤務終了時間
            $workingid = array_column($working, 'id');
            $day = array_column($working, 'day'); //勤務日

            // データをユーザーごとにコレクションに格納
            $data[$employee[$i]->userid] = $usercollection->combine([$employee[$i]->userid,$employee[$i]->name,$starttime,$endtime,$day,$workingid]);
        }
        
        $weekday = ['日', '月', '火', '水', '木', '金', '土']; //曜日変換用
  
        return view('timeline.index',compact('data','lastday','date','weekday','checkdt','checkuserid','working'));
    }
    public function add(Request $request)
	{   
        $requestdata = $request::all();

        // INSERT
        if($requestdata['workingid'] == "") {
        DB::insert('insert into working(userid,starttime,endtime,year,month,day) values("'.$requestdata['userid'].'","'.$requestdata['start'].'","'.$requestdata['end'].'",'.$requestdata['year'].','.$requestdata['month'].','.$requestdata['day'].')');

        // UPDATE
        } else {
        DB::update('update working set starttime = "'.$requestdata['start'].'",endtime = "'.$requestdata['end'].'" where id = '.$requestdata['workingid']);
        }
	    return redirect($_SERVER['REQUEST_URI']);
	}
}
