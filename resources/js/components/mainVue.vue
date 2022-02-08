<template>
  <v-app>
    <div class="links" style="text-align: center">
       <v-btn
            depressed
            @click="logout()"
            color="primary"
          >
            Wyloguj się
          </v-btn>
      <div class="users" style="display: inline-block">
        <router-link to="/users/list">
          <v-btn depressed :disabled="isDisabledUser" @click="disableUser()">
            Użytkownicy
          </v-btn></router-link
        >
      </div>
      <div class="companies" style="display: inline-block">
        <router-link to="/companies/list"
          ><v-btn
            depressed
            :disabled="isDisabledCompany"
            @click="disableCompany()"
          >
            Firmy
          </v-btn></router-link
        >
        <router-link to="/campaigns/list">
          <v-btn depressed :disabled="isDisabledCampaign" @click="disableCampaign()">
            Kampanie
          </v-btn></router-link
        >
      </div>
    </div>
    <router-view></router-view>
  </v-app>
</template>

<script>
import store from "../store/index"

export default {
  data() {
    return {
      isDisabledUser: false,
      isDisabledCompany: false,
      isDisabledCampaign: false,
    };
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
      this.isDisabledCampaign=false;
    },
    disableCampaign() {
      this.isDisabledCompany = false;
      this.isDisabledUser = false;
      this.isDisabledCampaign=true;
    },
    makeDisPath() {
      const mainPath = this.$route.path.split("/")[1];
      if (mainPath == "users") {
        this.disableUser();
      } else if (mainPath == "companies") {
        this.disableCompany();
      }else if(mainPath =="campaigns"){
          this.disableCampaign();
      }
    },
    logout(){
        console.log(12321)
    }
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
