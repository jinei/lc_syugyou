<template>
  <div>
    <div class="selectctrl">
      <!-- 日付選択 -->
      <label for="sel1">年月:</label>
      <select class="form-control">
        <option value>1月</option>
        <option value>2月</option>
      </select>

      <!-- ユーザー選択 -->
      <label for="sel1">ユーザー:</label>
      <select class="form-control" name="user">
        <option value>jinei</option>
      </select>
    </div>

    <!-- 勤怠表 START -->
    <div class="table">
      <table class="table table-striped" border-collapse="collapse">
        <thead>
          <!-- 曜日 -->
          <tr class="active">
            <th>Hallstaff</th>
            <th>曜日</th>
            <th>Hallstaff</th>
          </tr>

          <!-- 日付 -->
          <tr>
            <th>7月</th>
            <th>日付</th>
            <th>7月</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>名前</td>
            <td data-toggle="modal" data-target="#addModal">
              17:00
              <br />22:00
            </td>
            <td>名前</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {};
</script>