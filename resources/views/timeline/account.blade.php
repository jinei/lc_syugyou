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
  <!--------------------------------------------------->
  <!--              TABLE 各従業員の勤務 END         -->
  <!--------------------------------------------------->

</body>

</html>