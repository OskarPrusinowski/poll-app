<template>
  <v-form ref="form">
    <div class="text-center">
      <v-dialog v-model="dialog" max-width="500">
        <template v-slot:activator="{ on, attrs }">
          <v-btn color="blue lighten-8" dark v-bind="attrs" v-on="on">
            <v-icon dark> mdi-pencil </v-icon>
          </v-btn>
        </template>
        <v-card>
          <v-card-title> Edytuj nazwę </v-card-title>
          <v-divider></v-divider>
          <v-col class="ma-0 pb-0 pt-0" md="10">
            <v-text-field
              label="Nazwa"
              outlined
              v-model="company.name"
              :rules="[rules.required, rules.min, rules.max]"
            ></v-text-field>
          </v-col>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn depressed color="error" type="submit" @click="dialog = false"
              >Anuluj</v-btn
            >
            <v-btn depressed color="primary" @click="submit()"
              >Zmień nazwę</v-btn
            >
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div></v-form
  >
</template>

<script>
import store from "../../store/index";
export default {
  props: ["company"],
  data() {
    return {
      dialog: false,
      rules: {
        required: (value) => !!value || "Wymagane.",
        max: (value) => value.length <= 20 || "Musi zawierać do 20 liter",
        min: (value) => 3 <= value.length || "Musi zawierać od 3 liter",
      },
    };
  },
  methods: {
    async updateCompany(company) {
      store.commit("setCompany", company);
      store.dispatch("updateCompany", this);
      this.dialog = false;
      store.dispatch("getCompanies", this);
    },
    getCompanies() {
      store.dispatch("getCompanies", this);
    },
    submit() {
      if (this.$refs.form.validate()) {
        this.updateCompany(this.company);
      }
    },
    hide() {
      this.dialog = false;
      store.dispatch("getCompanies", this);
    },
  },
};
</script>
