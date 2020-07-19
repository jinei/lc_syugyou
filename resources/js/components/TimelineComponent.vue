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
      <select class="form-control" name="user" v-model="selectUser">
        <option value="0">全て</option>
        <option v-for="user in users" :key="user.id" v-bind:value="user.id">{{ user.name }}</option>
      </select>
    </div>

    <!-- 勤怠表 -->
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
          <tr v-for="user in users" :key="user.id" v-if="selectUser==0 || user.id==selectUser">
            <td>{{ user.name }}</td>
            <td
              v-for="(date,index) in dates"
              :key="date.id"
              data-toggle="modal"
              data-target="#addModal"
            >
              <span style="display:none;">{{ tempArray = workings.map(item => item.day) }}</span>

              <span
                v-if="tempArray.includes(String(dates[index].day)) && workings[tempArray.indexOf(String(dates[index].day))].userid == user.id"
              >
                {{workings[tempArray.indexOf(String(dates[index].day))].starttime}}
                <br />
                {{workings[tempArray.indexOf(String(dates[index].day))].endtime}}
              </span>
              <span v-else>-</span>
            </td>
            <td>{{ user.name }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- MODAL START -->
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
            <input type="hidden" id="userid" name="userid" />
            <input type="hidden" id="year" name="year" />
            <input type="hidden" id="month" name="month" />
            <input type="hidden" id="day" name="day" />
            <input type="hidden" id="workingid" name="workingid" />
            <input name="key" type="hidden" value />
            <p>
              出勤時間：
              <input type="time" class="form-control" id="start" name="start" />
            </p>
            <p>
              退勤時間：
              <input type="time" class="form-control" id="end" name="end" />
            </p>
            <input
              type="submit"
              class="btn btn-default btn-danger"
              value="削除"
              name="delete"
              onclick="form.key.value='delete'"
            />
          </div>

          <!-- footer -->
          <div class="modal-footer">
            <input
              type="submit"
              class="btn btn-default btn-success"
              value="作成"
              name="add"
              onclick="form.key.value='add'"
            />
          </div>
        </div>
      </div>
    </div>
    <!-- MODAL END -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      dates: [],
      users: [],
      workings: [],
      selectUser: 0
    };
  },
  mounted() {
    this.getDate(0);
    this.getUser();
  },
  methods: {
    getDate: function(flag) {
      axios
        .post("/date_get", {
          flag: flag,
          now: this.dates[0]
        })
        .then(
          response => (
            (this.dates = response.data.date), this.getWorking(this.dates[0])
          )
        );
    },
    getUser: function() {
      axios.get("/users_get").then(response => (this.users = response.data));
    },
    getWorking: function(date) {
      axios
        .post("/working_get", {
          date: date
        })
        .then(
          response => (
            (this.workings = response.data), console.log(this.workings)
          )
        );
    }
  }
};
</script>