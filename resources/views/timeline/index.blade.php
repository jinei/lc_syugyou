<!DOCTYPE html>
<html lang="ja">

<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="{{ asset('style.css') }}" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script src="script.js"></script>
</head>

<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">ホルトガーデン</a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">勤務表</a></li>
        <li><a href="#">アカウント管理</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </nav>

  <main>

    <div class="selectctrl">

  <!--------------------------------------------------->
  <!--               SELECT*日時* START            -->
  <!--------------------------------------------------->

      <label for="sel1">年月:</label>
      <select class="form-control" onChange="location.href=value;">

        <!-- 選択中の日付より前の日付 -->
        @for ($i = 10;$i > 0;$i--)
        <option value="../../{{$checkdt -> copy() -> subMonth($i) -> year}}/{{$checkdt -> copy() -> subMonth($i) -> month}}/{{$checkuserid}}">
        {{$checkdt -> copy() -> subMonth($i) -> year}}/{{$checkdt -> copy() -> subMonth($i) -> month}}
        </option>
        @endfor

        <!-- 選択中の日付-->
        <option selected>{{$checkdt -> year}}/{{$checkdt -> month}}

        <!-- 選択中の日付より後の日付 -->
        @for ($i = 1;$i <= 10;$i++)
        <option value="../../{{$checkdt -> copy() -> addMonth($i) -> year}}/{{$checkdt -> copy() -> addMonth($i) -> month}}/{{$checkuserid}}">
        {{$checkdt -> copy() -> addMonth($i) -> year}}/{{$checkdt -> copy() -> addMonth($i) -> month}}
        </option>
        @endfor

      </select>
  <!--------------------------------------------------->
  <!--                 SELECT*日時* END              -->
  <!--------------------------------------------------->    

  <!--------------------------------------------------->
  <!--                SELECT*ユーザー* START         -->
  <!--------------------------------------------------->    
      <label for="sel1">ユーザー:</label>
      <select class="form-control" onChange="location.href=value;">
        <option selected>{{$combined[$checkuserid]['name']}}</option>
        @for ($i = 0;$i < count($combined);$i++)
        @if ($combined[$i]['id'] != $checkuserid)
        <option value="./{{$combined[$i]['id']}}">{{$combined[$i]["name"]}}</option>
        @endif
        @endfor
      </select>
    </div>
  <!--------------------------------------------------->
  <!--                SELECT*ユーザー* END           -->
  <!--------------------------------------------------->    


  <!--------------------------------------------------->
  <!--                   曜日 START                  -->
  <!--------------------------------------------------->
      <div class="table">
      <table class="table table-striped" border-collapse="collapse">
        <thead>
          <tr class="active">
            <th>Hallstaff</th>
            @foreach ($date as $day)
            <th>{{$weekday[$day->dayOfWeek]}}</th>
            @endforeach
            <th>Hallstaff</th>
          </tr>
  <!--------------------------------------------------->
  <!--                   曜日 END                    -->
  <!--------------------------------------------------->


  <!--------------------------------------------------->
  <!--                   日付 START                  -->
  <!--------------------------------------------------->
          <tr>
            <th>{{$date[0]->month}}月</th>
            @foreach ($date as $day)
            <th>{{$day->day}}</th>
            @endforeach
            <th>{{$date[0]->month}}月</th>
          </tr>
      </thead>
  <!--------------------------------------------------->
  <!--                   日付 END                    -->
  <!--------------------------------------------------->  

  <!--------------------------------------------------->
  <!--              各従業員の勤務 START             -->
  <!--------------------------------------------------->
        <tbody>
        @for ($i = 1;$i < count($combined);$i++)
          @if ($checkuserid == $combined[$i]['id'] || $checkuserid == 0)
          <tr>
            <td>{{$combined[$i]['name']}}</td>
            @foreach ($date as $day)
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            @endforeach
            <td>{{$combined[$i]['name']}}</td>
          </tr>
          @endif
          @endfor
        </tbody>
      </table>
   </div>
</main>
  <!--------------------------------------------------->
  <!--              各従業員の勤務 END               -->
  <!--------------------------------------------------->


  <!--------------------------------------------------->
  <!--                  MODAL START                  -->
  <!--------------------------------------------------->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- header -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">長野</h4>
          <h4 class="modal-title">2020年6月21日</h4>
        </div>

        <!-- body -->
        <div class="modal-body">
          <p>出勤時間：<input type="time" class=" form-control" id="usr"></p>
          <p>退勤時間：<input type="time" class=" form-control" name="" id=""></p>
          <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">休暇</button>
        </div>

        <!-- footer -->
        <div class=" modal-footer">
          <button type="button" class="btn btn-default btn-success" data-dismiss="modal">決定</button>
        </div>

      </div>
    </div>
  </div>
  <!--------------------------------------------------->
  <!--                  MODAL END                    -->
  <!--------------------------------------------------->

</body>

</html>