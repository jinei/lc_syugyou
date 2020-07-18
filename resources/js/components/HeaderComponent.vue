 <template>
  <header>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand">ホルトガーデン</a>
        </div>

        <ul class="nav navbar-nav">
          <li>
            <router-link v-bind:to="{name: 'timeline.list'}">
              <span>勤務表</span>
            </router-link>
          </li>
        </ul>

        <ul class="nav navbar-nav">
          <li>
            <router-link v-bind:to="{name: 'account.list'}">
              <span>従業員管理</span>
            </router-link>
          </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li>
            <a>
              <span class="glyphicon glyphicon-log-out"></span> Logout
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</template>
 
 <script>
export default {};
</script>