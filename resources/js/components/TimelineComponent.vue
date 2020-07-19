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
              @click="show(user,date.day,workings[tempArray.indexOf(String(dates[index].day))])"
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

    <!-- modal -->
    <modal name="add_plan" :draggable="true" :resizable="true">
      <!-- header -->
      <div class="modal-header">
        <button type="button" class="close" @click="hide">&times;</button>
        <h4 class="modal-title" id="modal_name">{{ modalDate }}</h4>
        <h5 class="modal-subtitle" id="modal_day">
          <strong>{{ modalUserName }}</strong>
        </h5>
      </div>

      <!-- body -->
      <div class="modal-body">
        <p>
          出勤時間：
          <input
            type="time"
            v-model="modalStarttime"
            class="form-control"
            id="start"
            name="start"
          />
        </p>
        <p>
          退勤時間：
          <input type="time" v-model="modalEndtime" class="form-control" id="end" name="end" />
        </p>
        <input
          type="button"
          class="btn btn-default btn-danger"
          value="削除"
          name="delete"
          @click="deletePlan"
        />
      </div>

      <!-- footer -->
      <div class="modal-footer">
        <input
          type="button"
          class="btn btn-default btn-success"
          value="作成"
          name="add"
          @click="addPlan"
        />
      </div>
    </modal>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dates: [],
      users: [],
      workings: [],
      selectUser: 0,
      modalWorkingId: null,
      modalDate: "",
      modalDay: null,
      modalUserName: "",
      modalUserId: null,
      modalStarttime: "",
      modalEndtime: ""
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
        .then(response => (this.workings = response.data));
    },
    show: function(user, day, date) {
      const year = this.dates[0].year;
      const month = this.dates[0].month;
      this.modalDay = day;
      if (date != undefined && user.id == date.userid) {
        this.modalStarttime = date.starttime;
        this.modalEndtime = date.endtime;
        this.modalWorkingId = date.id;
      } else {
        this.modalStarttime = "";
        this.modalEndtime = "";
        this.modalWorkingId = null;
      }
      this.modalDate = year + "/" + month + "/" + day;
      this.modalUserId = user.id;
      this.modalUserName = user.name;
      this.$modal.show("add_plan");
    },
    hide: function() {
      this.$modal.hide("add_plan");
    },
    addPlan: function() {
      axios
        .post("/working_add", {
          id: this.modalWorkingId,
          starttime: this.modalStarttime,
          endtime: this.modalEndtime,
          day: this.modalDay,
          userid: this.modalUserId,
          month: this.dates[0].month,
          year: this.dates[0].year
        })
        .then(this.getWorking(this.dates[0], this.hide()));
    },
    deletePlan: function() {
      if (this.modalWorkingId) {
        axios
          .post("/working_delete", {
            id: this.modalWorkingId
          })
          .then(this.getWorking(this.dates[0], this.hide()));
      }
    }
  }
};
</script>