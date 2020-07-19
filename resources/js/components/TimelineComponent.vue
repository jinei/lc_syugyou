<template>
  <div>
    <div class="selectctrl">
      <!-- 日付指定 -->
      <div style="font-size:1.3em;margin-bottom:2vh;">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true" @click="getDate(-1)"></span>
        <strong>{{ dates[0].year }}/{{ dates[0].month }}</strong>
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" @click="getDate(1)"></span>
      </div>
      <!-- ユーザー選択 -->
      <select class="form-control" name="user">
        <option value>全て</option>
        <option v-for="user in users" :key="user.id">{{ user.name }}</option>
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
            <th>{{ dates[0].month }}月</th>
            <th v-for="date in dates" :key="date.id">{{date.day}}</th>
            <th>{{ dates[0].month }}月</th>
          </tr>
        </thead>

        <!-- 勤怠情報 -->
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
    this.getDate(0);
    this.getUser(0);
  },
  methods: {
    getDate: function(flag) {
      axios
        .post("/date_get", {
          flag: flag,
          now: this.dates[0]
        })
        .then(response => (this.dates = response.data.date));
    },
    getUser: function(flag) {
      if (flag == 0) {
        axios.get("/users_get").then(response => (this.users = response.data));
      } else {
        axios
          .post("/users_show", {
            id: flag
          })
          .then(
            response => ((this.users = response.data), console.log(this.users))
          );
      }
    }
  }
};
</script>