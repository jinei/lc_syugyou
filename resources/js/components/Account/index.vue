<template>
  <div class="container">
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Show</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user,key) in users" :key="key">
          <th scope="row">{{ user.id }}</th>
          <th>{{ user.name }}</th>
          <th>{{ user.email }}</th>
          <td>
            <router-link v-bind:to="{name: 'account.show',params: { value: user.id }}">
              <button class="btn btn-primary">Show</button>
            </router-link>
          </td>
          <td>
            <router-link v-bind:to="{name: 'account.edit',params: { value: user.id }}">
              <button class="btn btn-success">Edit</button>
            </router-link>
          </td>
          <td>
            <button class="btn btn-danger" @click="deleteUser(user.id);">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
    <router-link v-bind:to="{name: 'account.create'}">
      <button type="button" class="btn btn-warning">
        <span class="glyphicon glyphicon-user"></span>追加
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
    this.getUser();
  },
  methods: {
    deleteUser: function(id) {
      var result = window.confirm("削除しますか？");
      if (result) {
        axios.post("/user_delete", {
          id: id
        });
        this.getUser();
      }
    },
    getUser: function() {
      axios.get("/users_get").then(response => (this.users = response.data));
    }
  }
};
</script>