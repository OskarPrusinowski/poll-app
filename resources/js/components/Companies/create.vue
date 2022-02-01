<template>
  <v-form ref="form">
    <div class="text-center">
      <v-dialog v-model="dialog" max-width="500">
        <template v-slot:activator="{ on, attrs }">
          <v-btn color="blue lighten-8" dark v-bind="attrs" v-on="on">
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
              v-model="company.name"
              :rules="[rules.required, rules.min, rules.max]"
            ></v-text-field>
          </v-col>
          <v-col class="ma-0 pb-0 pt-0" md="10">
            <v-text-field
              label="Skrócona nazwa"
              outlined
              v-model="company.compressed_name"
              :rules="[rules.required, rules.min, rules.max]"
            ></v-text-field>
          </v-col>
          <v-col class="ma-0 pb-0 pt-0" md="10">
            <v-text-field
              label="Opis"
              outlined
              v-model="company.description"
              :rules="[rules.required, rules.min]"
            ></v-text-field>
          </v-col>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn depressed color="error" type="submit" @click="dialog = false"
              >Anuluj</v-btn
            >
            <v-btn depressed color="primary" @click="submit()"
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
  props: ["show"],
  data() {
    return {
      dialog: false,
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
      inputs: [],
    };
  },
  computed: {
    company() {
      return store.getters.getCompany;
    },
  },
  methods: {
    createCompany(company) {
      store.commit("setCompany", company);
      store.dispatch("createCompany", this);
      this.dialog = false;
      store.dispatch("getCompanies", this);
    },
    getCompanies() {
      store.dispatch("getCompanies", this);
    },
    submit() {
      if (this.$refs.form.validate()) {
        this.createCompany(this.company);
      }
    },
  },
  watch: {
    dialog() {
        this.$refs.form.reset()
    }
},
  created() {
    store.dispatch("fetchCompanyInit");
  },
};
</script>
<style>
.example {
  min-width: 350px;
  min-height: 150px;
  background-color: #fff;
  border: 1px solid #ced4da;
  position: absolute;
  top: 19vh;
  left: calc(50vw - 175px);
  padding: 20px;
  text-align: right;
}
.input_row {
  padding: 5px 0;
}
</style>
