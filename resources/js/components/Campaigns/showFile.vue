<template>
  <div class="text-center">
    <v-dialog v-model="dialog" width="500">
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="red lighten-2"
          dark
          v-bind="attrs"
          v-on="on"
          @click="getFile(campaign)"
        >
          Zobacz {{ campaign.orginal_file_name }}
        </v-btn>
      </template>

      <v-card>
        <v-card-title class="text-h5 grey lighten-2">
          Privacy Policy
        </v-card-title>

        <v-card-text>
          {{ campaign }}
          <embed src="" type="application/pdf" width="200px" height="600px">
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="dialog = false"> I accept </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
import store from "../../store/index";

export default {
  props: ["campaign"],
  data() {
    return {
      dialog: false,
    };
  },
  methods: {
    getFile(campaign) {
      store.commit("setCampaign", campaign);
      console.log(store.getters.getCampaign);
    },
  },
};
</script>
