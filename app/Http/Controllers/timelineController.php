<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use App\Models\User;
use App\Models\Working;


class timelineController extends Controller
{

    // ページ起動時
    public function index()
    {   
        $dt = Carbon::now();
        $checkyear = $dt->year;
        $checkmonth = $dt->month;
        $checkuserid = 0;
        return $this->getData($checkyear,$checkmonth,$checkuserid);
    }
    
    // 日付・選択ユーザーの切り替え
    public function timeline_update(Request $request)
    {
        $param = $request::all();
        $param_date = $param['date'];
        $param_date = explode("/", $param_date);
        $param_user = $param['user'];
        return $this->getData($param_date[0],$param_date[1],$param_user);
    }


    // 出勤情報・日付情報の取得
    public function getData($checkyear,$checkmonth,$checkuserid)
    {
        Carbon::useMonthsOverflow(false); //日付の加算方法を変更

        $checkdt = Carbon::create($checkyear,$checkmonth);
        $lastday = $checkdt->endOfMonth()->day; //末日の取得
        $date = array(); //日付データを入れる配列

        for($i = 1; $i <= $lastday; $i++){
            $dt = Carbon::create($checkdt->year,$checkdt->month,$i);
            array_push($date,$dt);
        }

        $usercollection = collect(['userid','name','starttime','endtime','day','workingid']);
        $employee = User::where('deleted_at',null)->get();

        for($i = 0;$i < count($employee);$i++) {

            // 勤務時間をユーザーごとに取得
            $working = Working::where('userid',$employee[$i]->id)->where('year',$checkdt->year)->where('month',$checkdt->month)->get()->toArray();

            $starttime = array_column($working, 'starttime');
            $endtime = array_column($working, 'endtime');
            $workingid = array_column($working, 'id');
            $day = array_column($working, 'day');

            // 勤務時間をユーザーごとにコレクションに格納
            $data[$employee[$i]->id] = $usercollection->combine([$employee[$i]->id,$employee[$i]->name,$starttime,$endtime,$day,$workingid]);
        }
        
        $weekday = ['日', '月', '火', '水', '木', '金', '土']; //曜日変換用
  
        return view('timeline.index',compact('data','lastday','date','weekday','checkdt','checkuserid','working'));
    }
    

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

            if($requestdata['workingid'] == "") {  // INSERT
                $data = new Working;
            } else {  // UPDATE
                $data = Working::find($workingid);
            }
            $data->userid = $userid;
            $data->starttime = $start;
            $data->endtime = $end;
            $data->year = $year;
            $data->month = $month;
            $data->day = $day;
            $data->save();

        } elseif (Request::get('delete')){
            Working::find($workingid)->delete();
        }
	    return redirect()->back();
    }

}
