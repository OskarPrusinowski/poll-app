<template>
  <v-app>
    <v-card class="pa-8">
      <div class="links" style="text-align: center">
        <v-btn depressed @click="logout()" color="primary"> Wyloguj się </v-btn>
        <div
          class="users"
          style="display: inline-block"
          v-if="permissions.usersShow"
        >
          <router-link to="/users/list">
            <v-btn depressed :disabled="isDisabledUser" @click="disableUser()">
              Użytkownicy
            </v-btn></router-link
          >
        </div>
        <div class="companies" style="display: inline-block">
          <router-link to="/companies/list" v-if="permissions.companiesShow"
            ><v-btn
              depressed
              :disabled="isDisabledCompany"
              @click="disableCompany()"
            >
              Firmy
            </v-btn></router-link
          >
          <router-link to="/campaigns/list" v-if="permissions.campaignsShow">
            <v-btn
              depressed
              :disabled="isDisabledCampaign"
              @click="disableCampaign()"
            >
              Kampanie
            </v-btn></router-link
          >
          <router-link
            to="/campaigns/settings"
            v-if="permissions.campaignsShow"
          >
            <v-btn depressed> Ustawienia </v-btn></router-link
          >
        </div>
      </div></v-card
    >
    <router-view></router-view>
  </v-app>
</template>

<script>
import store from "../store/index";

export default {
  data() {
    return {
      isDisabledUser: false,
      isDisabledCompany: false,
      isDisabledCampaign: false,
    };
  },
  computed: {
    permissions() {
      return store.getters.getUserPermissions;
    },
  },
  methods: {
    disableUser() {
      this.isDisabledUser = true;
      this.isDisabledCompany = false;
      this.isDisabledCampaign = false;
    },
    disableCompany() {
      this.isDisabledCompany = true;
      this.isDisabledUser = false;
      this.isDisabledCampaign = false;
    },
    disableCampaign() {
      this.isDisabledCompany = false;
      this.isDisabledUser = false;
      this.isDisabledCampaign = true;
    },
    makeDisPath() {
      const mainPath = this.$route.path.split("/")[1];
      if (mainPath == "users") {
        this.disableUser();
      } else if (mainPath == "companies") {
        this.disableCompany();
      } else if (mainPath == "campaigns") {
        this.disableCampaign();
      }
    },
    logout() {
      this.$http.post("http://127.0.0.1:8000/logout").then((response) => {
        console.log(response);
      });
      store.dispatch("getActualUser", this);
      store.dispatch("logoutUser", this);
      window.location.reload();
    },
    getToken() {
      store.commit("setUserId", 1);
      store.dispatch("getUserToken", this);
    },
    async getUserPermissions() {
      await store.dispatch("getActualUser", this);
      store.commit("setPermissionsUserId", store.getters.getUser.id);
      store.dispatch("getUserPermissions", this);
    },
  },
  async beforeCreate() {
    await store.dispatch("getActualUser", this);
    store.commit("setPermissionsUserId", store.getters.getUser.id);
    store.dispatch("getUserPermissions", this);
  },
  created() {
    this.makeDisPath();
  },
};
</script>
<style>
a {
  text-decoration: none;
}
</style>
