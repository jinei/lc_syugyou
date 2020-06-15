<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

class timelineController extends Controller
{

    //------------------------------------------------------/
    // ------------------- ページ起動時 --------------------
    //------------------------------------------------------/
    public function index($checkyear,$checkmonth,$checkuserid)
    {   
        // ログイン済
        if (Auth::check()) {
        return $this->getData($checkyear,$checkmonth,$checkuserid);
        } else {
        return redirect('');
        }
    }
    //------------------------------------------------------/
    // ------------------- ページ起動時 --------------------
    //------------------------------------------------------/


    //------------------------------------------------------/
    // ------------- 勤務情報・日付情報の取得 -------------
    //------------------------------------------------------/
    public function getData($checkyear,$checkmonth,$checkuserid)
    {
        Carbon::useMonthsOverflow(false); //日付の加算方法を変更

        // 日付データ取得
        $checkdt = Carbon::create($checkyear,$checkmonth);
        $lastday = $checkdt->endOfMonth()->day; //末日の取得
        $date = array(); //日付データを入れる配列

        // 1日分ずつ配列に該当月の日付データを入れる
        for($i = 1; $i <= $lastday; $i++){
            $dt = Carbon::create($checkdt->year,$checkdt->month,$i);
            array_push($date,$dt);
        }

        // 従業員IDと従業員名の取得
        $usercollection = collect(['userid','name','starttime','endtime','day','workingid']); //コレクションの定義
        $employee = DB::select('select * from users');//従業員のデータ
        
        for($i = 0;$i < count($employee);$i++) {
            // 勤務時間をユーザーごとに取得
            $working = DB::select('select * from working where year='.$checkdt->year.' and month='.$checkdt->month.' and userid='.$employee[$i]->id);
            $starttime = array_column($working, 'starttime'); //勤務開始時間
            $endtime = array_column($working, 'endtime'); //勤務終了時間
            $workingid = array_column($working, 'id');
            $day = array_column($working, 'day'); //勤務日

            // 勤務時間をユーザーごとにコレクションに格納
            $data[$employee[$i]->id] = $usercollection->combine([$employee[$i]->id,$employee[$i]->name,$starttime,$endtime,$day,$workingid]);
        }
        
        $weekday = ['日', '月', '火', '水', '木', '金', '土']; //曜日変換用
  
        return view('timeline.index',compact('data','lastday','date','weekday','checkdt','checkuserid','working'));
    }
    //------------------------------------------------------/
    // ------------- 勤務情報・日付情報の取得 -------------
    //------------------------------------------------------/


    //------------------------------------------------------/
    // ------ データベース操作(INSERT UPDATE DELETE) ------
    //------------------------------------------------------/
    public function database(Request $request)
	{   
        $requestdata = $request::all();
        $userid = $requestdata['userid'];
        $start = $requestdata['start'];
        $end = $requestdata['end'];
        $year = $requestdata['year'];
        $month = $requestdata['month'];
        $day = $requestdata['day'];
        $workingid = $requestdata['workingid'];

        if (Request::get('add')){
            // INSERT
            if($requestdata['workingid'] == "") {
            DB::insert('insert into working(userid,starttime,endtime,year,month,day) values("'.$userid.'","'.$start.'","'.$end.'",'.$year.','.$month.','.$day.')');
            // UPDATE
            } else {
            DB::update('update working set starttime = "'.$start.'",endtime = "'.$end.'" where id = '.$workingid);
            }
        } elseif (Request::get('delete')){
            DB::delete('delete from working where id = '.$workingid);
        }
	    return redirect($_SERVER['REQUEST_URI']);
    }
    //------------------------------------------------------/
    // ------ データベース操作(INSERT UPDATE DELETE) ------
    //------------------------------------------------------/
}
