<template>
  <div class="text-center">
    <v-dialog v-model="dialog" width="500">
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="red lighten-2"
          dark
          v-bind="attrs"
          v-on="on"
          @click="open()"
        >
          Wybierz firmę
        </v-btn>
      </template>

      <v-card>
        <v-card-title class="text-h5 grey lighten-2">
          Wybierz firmę
        </v-card-title>

        <v-card-text>
          <v-select
            v-model="a"
            :items="companies"
            menu-props="auto"
            label="Select"
            hide-details
            single-line
            item-text="name"
            item-value="id"
          ></v-select>
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
  computed: {
    companies() {
      return store.getters.getCompanies;
    },
  },
  data() {
    return {
      dialog: false,
      a: 0,
    };
  },
  methods: {
    async getCompanies() {
      await store.dispatch("getCompaniesCount", this);
      store.commit("setCompaniesTotal", store.getters.getCompaniesCount);
      store.dispatch("getCompanies", this);
    },
    open() {
      this.dialog = true;
      this.getCompanies();
    },
  },
};
</script>
