<template>
  <v-app>
    <div class="links" style="text-align: center">
      <div class="users" style="display: inline-block">
        <router-link to="/user/list">
          <v-btn depressed :disabled="isDisabledUser" @click="disableUser()">
            Użytkownicy
          </v-btn></router-link
        >
      </div>
      <div class="companies" style="display: inline-block">
        <router-link to="/company/list"
          ><v-btn
            depressed
            :disabled="isDisabledCompany"
            @click="disableCompany()"
          >
            Firmy
          </v-btn></router-link
        >
      </div>
    </div>
    <router-view></router-view>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      isDisabledUser: false,
      isDisabledCompany: false,
    };
  },
  methods: {
    disableUser() {
      this.isDisabledUser = true;
      this.isDisabledCompany = false;
    },
    disableCompany() {
      this.isDisabledCompany = true;
      this.isDisabledUser = false;
    },
  },
};
</script>
<style>
a {
  text-decoration: none;
}
</style>
