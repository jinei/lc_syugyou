<template>
  <div style="text-align:center;">
    <div class="form-group">
      <label for="usr">ユーザー名:</label>
      <br />
      <input v-model="name" type="text" class="form-control" id="usr" />
    </div>

    <div class="form-group">
      <label for="usr">メールアドレス:</label>
      <br />
      <input v-model="email" type="text" class="form-control" id="email" />
    </div>

    <div class="form-group">
      <label for="usr">パスワード:</label>
      <br />
      <input v-model="password" type="password" class="form-control" id="pw" />
    </div>

    <p>
      <button
        type="button"
        class="btn btn-warning"
        style="margin-top:2vh;width:10vw;"
        @click="create_user"
      >作成</button>
    </p>

    <router-link v-bind:to="{name: 'account.list'}">
      <button type="button" class="btn btn-primary">
        <span class="glyphicon glyphicon-circle-arrow-left"></span> 戻る
      </button>
    </router-link>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: null,
      email: null,
      password: null
    };
  },
  mounted() {},
  methods: {
    create_user: function() {
      axios.post("/user_create", {
        name: this.name,
        email: this.email,
        password: this.password
      });
      alert("succes");
      this.$router.push("/account_list");
    }
  }
};
</script>