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
            <button class="btn btn-success" @click="add_user">Edit</button>
          </td>
          <td>
            <button class="btn btn-danger" @click="delete_user(user.id);">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
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
    add_user: function() {
      axios.post("/user_add").then();
      this.get_user();
    },
    delete_user: function(id) {
      axios
        .post("/user_delete", {
          id: id
        })
        .then(res => {
          console.log(res.data.id);
        });
      this.get_user();
    },
    get_user: function() {
      axios.get("/users_get").then(response => (this.users = response.data));
    }
  }
};
</script>