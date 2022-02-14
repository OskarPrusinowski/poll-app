<template>
  <div class="text-center">
    <v-dialog v-model="dialog" width="500">
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="red lighten-2" dark v-bind="attrs" v-on="on">
          Dodaj plik
        </v-btn>
      </template>

      <v-card>
        <v-card-title class="text-h5 grey lighten-2"> Dodaj plik </v-card-title>

        <v-divider></v-divider>
        <v-file-input
          accept=".pdf"
          label="File input"
          v-model="file"
        ></v-file-input>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="submit(file)"> I accept </v-btn>
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
      file: "",
    };
  },
  methods: {
    submit(file) {
      store.commit("setCampaign", this.campaign);
      store.commit("setFile", file);
      store.dispatch("addFile", this);
      console.log(this.dialog);
      this.dialog = false;
      console.log(this.dialog);
      this.$emit("added");
    },
  },
};
</script>
