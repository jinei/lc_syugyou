<!DOCTYPE html>
<html lang="ja">

<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="{{ asset('styles.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
</head>

<body>

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">{{$timelines[0]->userid}}</a>
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
      <label for="sel1">年月:</label>
      <select class="form-control">
        <option>2020/6</option>
        <option>2020/7</option>
        <option>2020/8</option>
        <option>2020/9</option>
      </select>
      <label for="sel1">ユーザー:</label>
      <select class="form-control">
        <option>全て</option>
        <option>長野</option>
        <option>金谷</option>
        <option>益田</option>
      </select>
    </div>

    <div class="table">
      <table class="table table-striped" border-collapse="collapse">
        <thead>

          <!-- ********曜日********* -->
          <tr class="active">
            <th>Hallstaff</th>
            <th>月</th>
            <th>火</th>
            <th>水</th>
            <th>木</th>
            <th>金</th>
            <th>土</th>
            <th>日</th>
            <th>月</th>
            <th>火</th>
            <th>水</th>
            <th>木</th>
            <th>金</th>
            <th>土</th>
            <th>日</th>
            <th>月</th>
            <th>火</th>
            <th>水</th>
            <th>木</th>
            <th>金</th>
            <th>土</th>
            <th>日</th>
            <th>月</th>
            <th>火</th>
            <th>水</th>
            <th>木</th>
            <th>金</th>
            <th>土</th>
            <th>日</th>
            <th>月</th>
            <th>火</th>
            <th>Hallstaff</th>
          </tr>
          <!-- ********曜日********* -->

          <!-- ********日付********* -->
          <tr>
            <th>6月</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
            <th>9</th>
            <th>10</th>
            <th>11</th>
            <th>12</th>
            <th>13</th>
            <th>14</th>
            <th>15</th>
            <th>16</th>
            <th>17</th>
            <th>18</th>
            <th>19</th>
            <th>20</th>
            <th>21</th>
            <th>22</th>
            <th>23</th>
            <th>24</th>
            <th>25</th>
            <th>26</th>
            <th>27</th>
            <th>28</th>
            <th>29</th>
            <th>30</th>
            <th>6月</th>
          </tr>
          <!-- ********日付********* -->
        </thead>

        <tbody>

          <tr>
            <td>長野</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">-</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td>長野</td>
          </tr>

          <td>金谷</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">-</td>
          <td data-toggle="modal" data-target="#myModal">-</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">-</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">-</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">-</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">-</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">-</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">-</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
          <td>金谷</td>
          </tr>

          <tr>
            <td>益田</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">-</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td data-toggle="modal" data-target="#myModal">17:00<br>18:00</td>
            <td>益田</td>
          </tr>

        </tbody>
      </table>
    </div>

  </main>

  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">長野</h4>
          <h4 class="modal-title">2020年6月21日</h4>
        </div>

        <div class="modal-body">
          <p>出勤時間：<input type="time" class=" form-control" id="usr"></p>
          <p>退勤時間：<input type="time" class=" form-control" name="" id=""></p>
          <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">休暇</button>
        </div>

        <div class=" modal-footer">
          <button type="button" class="btn btn-default btn-success" data-dismiss="modal">決定</button>
        </div>

      </div>

    </div>
  </div>

</body>

</html>