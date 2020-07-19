<template>
  <div style="text-align:center;">
    <h4 style="margin-bottom:5vh;">
      <strong>アカウント編集</strong>
    </h4>
    <div class="form-group">
      <label for="pwd">ID:</label>
      <br />
      <input type="number" class="form-control" id="id" v-model="users.id" readonly />
    </div>

    <div class="form-group">
      <label for="usr">ユーザー名:</label>
      <br />
      <input type="text" class="form-control" id="usr" v-model="users.name" />
    </div>

    <div class="form-group">
      <label for="usr">メールアドレス:</label>
      <br />
      <input type="text" class="form-control" id="usr" v-model="users.email" readonly />
    </div>

    <p>
      <button
        type="button"
        class="btn btn-success"
        style="margin-top:2vh;width:10vw;"
        @click="update_user"
      >更新</button>
    </p>

    <router-link v-bind:to="{name: 'account.list'}">
      <button type="button" class="btn btn-default">
        <span class="glyphicon glyphicon-circle-arrow-left"></span> 戻る
      </button>
    </router-link>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users: []
    };
  },
  mounted() {
    this.get_user();
  },
  methods: {
    get_user: function() {
      axios
        .get("/users_show", {
          params: {
            id: this.$route.params.value
          }
        })
        .then(response => (this.users = response.data));
    },
    update_user: function() {
      axios.post("/user_edit", {
        id: this.users.id,
        name: this.users.name,
        emai: this.users.email
      });
      alert("succes");
      this.$router.push("/account_list");
    }
  }
};
</script>