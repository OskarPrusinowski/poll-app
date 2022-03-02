<template>
  <v-form ref="form">
    <div class="text-center">
      <v-dialog v-model="dialog" max-width="500">
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            color="blue lighten-8"
            dark
            v-bind="attrs"
            v-on="on"
            @click="resetValues"
          >
            Stwórz firmę
          </v-btn>
        </template>

        <v-card>
          <v-card-title> Utwórz firmę </v-card-title>
          <v-divider></v-divider>
          <v-col class="ma-0 pb-0 pt-0" md="10">
            <v-text-field
              label="Nazwa"
              outlined
              v-model="name"
              :rules="[rules.required, rules.min, rules.max]"
            ></v-text-field>
          </v-col>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn depressed color="error" type="submit" @click="dialog = false"
              >Anuluj</v-btn
            >
            <v-btn
              depressed
              color="primary"
              @click="submit(name)"
              :loading="loading"
              >Dodaj firmę</v-btn
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
  data() {
    return {
      dialog: false,
      loading: false,
      rules: {
        required: (value) => !!value || "Wymagane.",
        max: (value) => value.length <= 20 || "Musi zawierać do 20 liter",
        min: (value) => 3 <= value.length || "Musi zawierać od 3 liter",
        email: (value) => {
          const pattern =
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return pattern.test(value) || "Nieprawidłowy email";
        },
      },
      name: "",
    };
  },
  computed: {
    company() {
      return store.getters.getCompany;
    },
  },
  methods: {
    async createCompany(name) {
      store.commit("setCompany", {});
      store.commit("setCompanyName", name);
      await store.dispatch("createCompany", this);
      store.dispatch("fetchCompanySettingsInit");
      store.dispatch("createCompanySettings", this);
      store.commit("setCompanySettingsCompanyId", 1);
      this.loading = false;
      this.dialog = false;
      store.dispatch("getCompanies", this);
    },
    getCompanies() {
      store.dispatch("getCompanies", this);
    },
    submit(name) {
      if (this.$refs.form.validate()) {
        this.loading = true;
        this.createCompany(name);
      }
    },
    resetValues() {
      store.dispatch("fetchCompanyInit");
      this.name = "";
    },
  },
  mounted() {
    store.commit("setCompany", {});
    store.dispatch("fetchCompanyInit");
  },
};
</script>
