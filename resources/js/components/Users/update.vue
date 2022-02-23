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
          <v-card-title> Edytuj użytkownika </v-card-title>
          <v-divider></v-divider>
          <v-col class="ma-0 pb-0 pt-0" md="10">
            <v-text-field
              label="Imie"
              outlined
              v-model="user.name"
              :rules="[rules.required, rules.min, rules.max]"
            ></v-text-field>
          </v-col>
          <v-col class="ma-0 pb-0 pt-0" md="10">
            <v-text-field
              label="Nazwisko"
              outlined
              v-model="user.surname"
              :rules="[rules.required, rules.min, rules.max]"
            ></v-text-field>
          </v-col>
          <v-col class="ma-0 pb-0 pt-0" md="10">
            <v-text-field
              label="Numer telefonu"
              outlined
              v-model="user.phone_number"
              :rules="[rules.required]"
            ></v-text-field>
          </v-col>
          <v-col md="10">
            <v-text-field
              label="Email"
              outlined
              v-model="user.email"
              :rules="[rules.required, rules.min, rules.max, rules.email]"
            ></v-text-field>
          </v-col>
          <v-col class="ma-0 pb-0 pt-0" md="10">
            <v-text-field
              label="Hasło"
              outlined
              :type="show1 ? 'text' : 'password'"
              v-model="user.password"
              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
              :rules="[rules.required, rules.min, rules.max]"
              @click:append="show1 = !show1"
            ></v-text-field>
          </v-col>
          <v-col class="ma-0 pb-0 pt-0" md="10">
            <v-text-field
              label="Potwierdź hasło"
              outlined
              :type="show2 ? 'text' : 'password'"
              v-model="user.password_confirmation"
              :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
              :rules="[
                rules.required,
                rules.min,
                rules.max,
                rules.confirmPassword,
              ]"
              @click:append="show2 = !show2"
            ></v-text-field>
          </v-col>
          <v-col class="ma-0 pb-0 pt-0" md="10">
            <v-select
              v-if="companies"
              v-model="user.company"
              :items="companies"
              item-text="name"
              item-value="id"
              outlined
              label="Firma"
            ></v-select>
          </v-col>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn depressed color="error" type="submit" @click="dialog = false"
              >Anuluj</v-btn
            >
            <v-btn depressed color="primary" @click="submit()"
              >Edytuj użytkownika</v-btn
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
  props: ["user"],
  data() {
    return {
      dialog: false,
      show1: false,
      show2: false,
      rules: {
        required: (value) => !!value || "Wymagane.",
        max: (value) => value.length <= 20 || "Musi zawierać do 20 liter",
        min: (value) => 3 <= value.length || "Musi zawierać od 3 liter",
        phoneNumber: (v) => {
          if (!v.trim()) return true;
          if (!isNaN(parseFloat(v)) && v >= 100000000 && v <= 999999999)
            return true;
          return "Number has to be phone number";
        },
        email: (value) => {
          const pattern =
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return pattern.test(value) || "Nieprawidłowy email";
        },
        confirmPassword: (value) =>
          this.user.password === value || "Hasła się nie zgadzają",
      },
    };
  },
  computed: {
    companies() {
      return store.getters.getCompanies;
    },
  },
  methods: {
    updateUser(user) {
      store.commit("setUser", user);
      store.dispatch("updateUser", this);
      this.dialog = false;
      store.dispatch("getUsers", this);
    },
    getCompanies() {
      store.dispatch("getCompanies", this);
    },
    submit() {
      if (this.$refs.form.validate()) {
        this.updateUser(this.user);
      }
    },
  },
  created() {
    store.dispatch("fetchUserInit");
  },
};
</script>
