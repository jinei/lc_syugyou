<template>
  <div class="container">
    <h4 style="margin-bottom:5vh;text-align:center;">
      <strong>アカウント詳細</strong>
    </h4>

    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th scope="col">id</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">{{ users.id }}</th>
          <th>{{ users.name }}</th>
          <th>{{ users.email }}</th>
        </tr>
      </tbody>
    </table>
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
    }
  }
};
</script>