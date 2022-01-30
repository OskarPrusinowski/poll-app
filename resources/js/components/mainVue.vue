<template>
  <div>
    <div class="links" style="text-align: center">
      <div class="users" style="display: inline-block">
        <router-link to="/user/list">Użytkownicy</router-link>
      </div>
      <div class="companies" style="display: inline-block">
        <router-link to="/company/list">Firmy</router-link>
      </div>
    </div>
    <router-view></router-view>
  </div>
</template>

<script>
export default {};
</script>
