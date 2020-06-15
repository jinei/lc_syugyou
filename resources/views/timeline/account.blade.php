<!DOCTYPE html>
<html lang="ja">

<head>
  <title>勤務表アプリ</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="{{ asset('account.css') }}" rel="stylesheet">
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
        <li><a href="/timeline/{{\Carbon\Carbon::now()->year}}/{{\Carbon\Carbon::now()->month}}/0">勤務表</a></li>
      </ul>
      <ul class="nav navbar-nav">
        <li class="active"><a>従業員管理</a></li>
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
   
</main>
<table class="table table">
  <thead>
    <tr>
      <th>名前</th>
      <th>Email</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data as $dataitem)
    <tr>
      <td>{{$dataitem['name']}}</td>
      <td>{{$dataitem['email']}}</td>
      <td><button type="submit" class="btn btn-danger">削除</button></td>
    </tr>
    @endforeach
  </tbody>
</table>

  <!--------------------------------------------------->
  <!--              TABLE 各従業員の勤務 END         -->
  <!--------------------------------------------------->
<button type="button" class="btn btn-success center-block" style="width:20vw;margin-top:10vh;" data-toggle="modal" data-target="#myModal">追加</button>

  <!--------------------------------------------------->
  <!--                  MODAL START                  -->
  <!--------------------------------------------------->
  <form name="form" action="create" method="post" onsubmit="return check();">
  @csrf 
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
          <div class="modal-content">

          <!-- header -->
          <div class="modal-header">
            <h4>従業員追加</h4>
          </div>

          <!-- body -->
          <div class="modal-body">
            <p>Email：<input type="text" class=" form-control" id="email" name="email"></p>
            <p>Password：<input type="text" class=" form-control" id="pw" name="pw"></p>
            <p>名前：<input type="text" class=" form-control" id="name" name="name"></p>
            
          <!-- footer -->
          <div class="modal-footer">
            <input type="submit" class="btn btn-default btn-primary" value="決定" name="add">
          </div>

      </div>
    </div>
  </div>
  </form>

  <!--------------------------------------------------->
  <!--                  MODAL END                    -->
  <!--------------------------------------------------->

</body>

</html>