<template>
  <div class="container">
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
          <th scope="row">{{ users[0].id }}</th>
          <th>{{ users[0].name }}</th>
          <th>{{ users[0].email }}</th>
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