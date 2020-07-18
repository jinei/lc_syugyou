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
        <tr>
          <th scope="row">1</th>
          <td>アーネット太郎</td>
          <td>taro@art-net.jp</td>
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
        <tr>
          <th scope="row">2</th>
          <td>アーネット花子</td>
          <td>hanako@art-net.jp</td>
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
        <tr>
          <th scope="row">3</th>
          <td>ランチ太郎</td>
          <td>taro@launch.com</td>
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
export default {};
</script>