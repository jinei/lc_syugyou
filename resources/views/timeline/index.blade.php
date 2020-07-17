<!DOCTYPE html>
<html lang="ja">

<head>
    <title>勤務表アプリ</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
</head>

<body>

<!-- ナビバー START -->
<header>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">

            <div class="navbar-header">
                <a class="navbar-brand">ホルトガーデン</a>
            </div>

            <ul class="nav navbar-nav">
                <li class="active"><a>勤務表</a></li>
            </ul>

            <ul class="nav navbar-nav">
                <li><a href="/account">従業員管理</a></li>
            </ul>

            <form method="post" name="logoutform" action="../../../../logout">
                @csrf
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="javascript:logoutform.submit()"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
            </form>
        </div>
    </nav>
</header>
<!-- ナビバー END -->

<main>

    <div class="selectctrl">
    
        <form action="{{ route('timeline') }}" method="post" style="display:inline;">
            @csrf

            <!-- 日付選択 -->
            <label for="sel1">年月:</label>
            <select class="form-control" onChange="submit(this.form)" name="date">
            
                <!-- 選択中の日付より前の日付 -->
                @for ($i = 10;$i > 0;$i--)
                    <option value="{{$checkdt -> copy() -> subMonth($i) -> year}}/{{$checkdt -> copy() -> subMonth($i) -> month}}">
                    {{$checkdt -> copy() -> subMonth($i) -> year}}/{{$checkdt -> copy() -> subMonth($i) -> month}}
                    </option>
                @endfor

                <!-- 選択中の日付-->
                <option selected>{{$checkdt -> year}}/{{$checkdt -> month}}

                <!-- 選択中の日付より後の日付 -->
                @for ($i = 1;$i <= 10;$i++)
                <option value="{{$checkdt -> copy() -> addMonth($i) -> year}}/{{$checkdt -> copy() -> addMonth($i) -> month}}">
                {{$checkdt -> copy() -> addMonth($i) -> year}}/{{$checkdt -> copy() -> addMonth($i) -> month}}
                </option>
                @endfor

            </select>

            
            <!-- ユーザー選択 -->
            <label for="sel1">ユーザー:</label>
            <select class="form-control" onChange="submit(this.form)" name="user">

                @if($checkuserid == 0)
                    <option selected>全て</option>
                @else
                    <option value="0">全て</option>
                @endif

                @foreach ($data as $item)
                    @if ($checkuserid == $item['userid'])
                        <option selected>{{$item['name']}}</option>
                    @else
                        <option value="{{$item['userid']}}">{{$item['name']}}</option>
                    @endif
                @endforeach

            </select>
        </form>

    </div>

    <!-- 勤怠表 START -->
    <div class="table">
        <table class="table table-striped" border-collapse="collapse">
            <thead>
                
                <!-- 曜日 -->
                <tr class="active">
                    <th>Hallstaff</th>
                    @foreach ($date as $day)
                        <th>{{$weekday[$day->dayOfWeek]}}</th>
                    @endforeach
                    <th>Hallstaff</th>
                </tr>
                
                <!-- 日付 -->
                <tr>
                    <th>{{$date[0]->month}}月</th>
                    @foreach ($date as $day)
                        <th>{{$day->day}}</th>
                    @endforeach
                    <th>{{$date[0]->month}}月</th>
                </tr>

            </thead>

            <tbody>
            
                @foreach ($data as $empitem)
                    <!-- 表示中のユーザーかどうかの判定 -->
                    @if ($checkuserid == $empitem['userid'] || $checkuserid == 0)
                        <tr>
                            <td>{{$empitem['name']}}</td>
                            
                            <!-- 一ヶ月分繰り返す -->
                            @foreach ($date as $dateitem)
                                
                                <!-- その日付に出勤情報があれば出勤時間と退勤時間を出力 -->
                                @if ( in_array($dateitem -> day, $empitem['day']))
                                    <td data-toggle="modal" data-target="#addModal" data-user="{{$empitem['userid']}}" data-day="{{$dateitem}}" data-start="{{$empitem['starttime'][array_search($dateitem -> day, $empitem['day'])]}}" data-end="{{$empitem['endtime'][array_search($dateitem -> day, $empitem['day'])]}}" data-id="{{$empitem['workingid'][array_search($dateitem -> day, $empitem['day'])]}}">
                                    {{$empitem['starttime'][array_search($dateitem -> day, $empitem['day'])]}}<br>{{$empitem['endtime'][array_search($dateitem -> day, $empitem['day'])]}}</td>
                                @else
            
                                <td data-toggle="modal" data-target="#addModal" data-user="{{$empitem['userid']}}" data-day="{{$dateitem}}" data-start="" data-end=""> -</td>
                                @endif            
                            @endforeach

                            <td>{{$empitem['name']}}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- 勤怠表 END -->

</main>

    <!-- MODAL START -->
    <form name="form" action="" method="post" onsubmit="return check();">
    @csrf 
        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="modal_name"></h4>
                        <h4 class="modal-subtitle" id="modal_day"></h4>
                    </div>

                    <!-- body -->
                    <div class="modal-body">
                        <input type="hidden" id="userid" name="userid">
                        <input type="hidden" id="year" name="year">
                        <input type="hidden" id="month" name="month">
                        <input type="hidden" id="day" name="day">
                        <input type="hidden" id="workingid" name="workingid">
                        <input name="key" type="hidden" value="" />
                        <p>出勤時間：<input type="time" class=" form-control" id="start" name="start"></p>
                        <p>退勤時間：<input type="time" class=" form-control" id="end" name="end"></p>
                        <input type="submit" class="btn btn-default btn-danger" value="削除" name="delete" onclick="form.key.value='delete'">       
                    </div>

                    <!-- footer -->
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-default btn-success" value="作成" name="add" onclick="form.key.value='add'">
                    </div>

                </div>
            </div>
        </div>
    </form>
    <!-- MODAL END -->

<script>
window.Laravel = {};
window.Laravel.date = @json($date);
</script>

<script src="{{ asset('js/script.js') }}"></script>

</body>

</html>