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

  <!--------------------------------------------------->
  <!--               ナビバー START                  -->
  <!--------------------------------------------------->
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
        <li><a href="#">従業員管理</a></li>
      </ul>
      <form method="post" name="logoutform" action="../../../../logout">
        <ul class="nav navbar-nav navbar-right">
          @csrf
          <li><a href="javascript:logoutform.submit()"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </form>
      </ul>
    </div>
  </nav>
</header>
  <!--------------------------------------------------->
  <!--               ナビバー END                    -->
  <!--------------------------------------------------->

  <main>
    <div class="selectctrl">
  <!--------------------------------------------------->
  <!--               SELECT*日時* START              -->
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

      <!-- ユーザーを全選択 -->
      @if($checkuserid == 0)
      <option selected>全て</option>
      @else
      <option value="./0">全て</option>
      @endif

      <!-- ユーザー選択 -->
      @foreach ($data as $item)
      @if ($checkuserid == $item['userid'])
      <option selected>{{$item['name']}}</option>
      @else
      <option value="./{{$item['userid']}}">{{$item['name']}}</option>
      @endif
      @endforeach

      </select>
    </div>
  <!--------------------------------------------------->
  <!--                SELECT*ユーザー* END           -->
  <!--------------------------------------------------->    


  <!--------------------------------------------------->
  <!--                   TABLE 曜日 START            -->
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
  <!--                   TABLE 曜日 END              -->
  <!--------------------------------------------------->


  <!--------------------------------------------------->
  <!--                   TABLE 日付 START            -->
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
  <!--                   TABLE 日付 END              -->
  <!--------------------------------------------------->  

  <!--------------------------------------------------->
  <!--              TABLE 各従業員の勤務 START       -->
  <!--------------------------------------------------->
        <tbody>
        <!-- 従業員の数だけ繰り返す -->
        @foreach ($data as $empitem)
          <!-- 表示中のユーザーかどうかの判定 -->
          @if ($checkuserid == $empitem['userid'] || $checkuserid == 0)
          <tr>
            <td>{{$empitem['name']}}</td>
            <!-- 一ヶ月分繰り返す -->
            @foreach ($date as $dateitem)
            <!-- その日付に出勤情報があれば出勤時間と退勤時間を出力 -->
            @if ( in_array($dateitem -> day, $empitem['day']))
            <td data-toggle="modal" data-target="#myModal" data-user="{{$empitem['userid']}}" data-day="{{$dateitem}}" data-start="{{$empitem['starttime'][array_search($dateitem -> day, $empitem['day'])]}}" data-end="{{$empitem['endtime'][array_search($dateitem -> day, $empitem['day'])]}}" data-id="{{$empitem['workingid'][array_search($dateitem -> day, $empitem['day'])]}}">
            {{$empitem['starttime'][array_search($dateitem -> day, $empitem['day'])]}}<br>{{$empitem['endtime'][array_search($dateitem -> day, $empitem['day'])]}}</td>
            @else
            <td data-toggle="modal" data-target="#myModal" data-user="{{$empitem['userid']}}" data-day="{{$dateitem}}" data-start="" data-end=""> -</td>
            @endif
            @endforeach
            <td>{{$empitem['name']}}</td>
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
   </div>
</main>
  <!--------------------------------------------------->
  <!--              TABLE 各従業員の勤務 END         -->
  <!--------------------------------------------------->


  <!--------------------------------------------------->
  <!--                  MODAL START                  -->
  <!--------------------------------------------------->
  <form name="form" action="" method="post" onsubmit="return check();">
  @csrf 
        <div id="myModal" class="modal fade" role="dialog">
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
            <input type="submit" class="btn btn-default btn-success" value="決定" name="add" onclick="form.key.value='add'">
          </div>

      </div>
    </div>
  </div>
  </form>

  <!--------------------------------------------------->
  <!--                  MODAL END                    -->
  <!--------------------------------------------------->

<script>

function check() {

  // **********決定ボタン押下時************
  if(form.key.value == 'add') {
    let startTime = document.getElementById("start").value;
    let endTime = document.getElementById("end").value;

    // nullチェック
    if(startTime == "" || endTime == "") {
      Swal.fire({
      icon: 'error',
      title: '未入力の箇所があります',
    })
    return false;

    // 時間チェック（時間の上下がないか)
    } else {
      startTime = startTime.split(":")[0] + startTime.split(":")[1];
      endTime = endTime.split(":")[0] + endTime.split(":")[1];
      if(startTime <= endTime) {
        return true;
      } else {
        Swal.fire({
        icon: 'error',
        title: '時間の入力が不適切です',
      })
      return false;
    }
  }
  // **********決定ボタン押下時************

  // **********削除ボタン押下時************
  } else {
    const workingid = document.getElementById("workingid").value;
    if(workingid != "") {
      return true;
    } else {
      return false;
    }
  }
    // **********削除ボタン押下時************

}

// モーダル表示時
$('#myModal').on('show.bs.modal', function (event) {

    // クリックした箇所の情報を取得
    let data =@json($data);
    const button = $(event.relatedTarget);
    const edituserid = button.data('user');
    const editdate = button.data('day').split("-");
    const edityear = parseInt(editdate[0],10);
    const editmonth = parseInt(editdate[1],10);
    const editday = parseInt(editdate[2].split(" ")[0],10);
    const editusername = data[edituserid].name;
    const editstarttime = button.data('start');
    const editendtime = button.data('end');
    const editworkindid = button.data('id');

    // ダイアログに情報出力
    var modal = $(this)
    modal.find('.modal-title').text(editusername) 
    modal.find('.modal-subtitle').text(edityear + "年" + editmonth + "月" + editday + "日") 
    modal.find('.modal-body input#userid').val(edituserid);
    modal.find('.modal-body input#workingid').val(editworkindid);
    modal.find('.modal-body input#year').val(edityear);
    modal.find('.modal-body input#month').val(editmonth);
    modal.find('.modal-body input#day').val(editday);
	  modal.find('.modal-body input#start').val(editstarttime);
	  modal.find('.modal-body input#end').val(editendtime);
});

</script>
</body>

</html>