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
            <button class="btn btn-primary">Show</button>
          </td>
          <td>
            <button class="btn btn-success">Edit</button>
          </td>
          <td>
            <button class="btn btn-danger">Delete</button>
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
    axios.get("/users_api").then(response => (this.users = response.data));
  }
};
</script>