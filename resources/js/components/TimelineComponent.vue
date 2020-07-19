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
            <th v-for="date in dates" :key="date.id">{{date.week}}</th>
            <th>Hallstaff</th>
          </tr>

          <!-- 日付 -->
          <tr>
            <th>7月</th>
            <th v-for="date in dates" :key="date.id">{{date.day}}</th>
            <th>7月</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>{{ user.name }}</td>
            <td v-for="date in dates" :key="date.id">
              17:00
              <br />22:00
            </td>
            <td>{{ user.name }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dates: [],
      users: []
    };
  },
  mounted() {
    this.getDate();
    this.getUser();
  },
  methods: {
    getDate: function() {
      axios
        .get("/date_get")
        .then(
          response => (
            (this.dates = response.data.date), console.log(this.dates)
          )
        );
    },
    getUser: function() {
      axios.get("/users_get").then(response => (this.users = response.data));
    }
  }
};
</script>