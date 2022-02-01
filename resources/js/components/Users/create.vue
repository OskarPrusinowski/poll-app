<template>
  <v-form ref="form">
    <div class="text-center">
      <v-dialog v-model="dialog" max-width="500">
        <template v-slot:activator="{ on, attrs }">
          <v-btn color="blue lighten-8" dark v-bind="attrs" v-on="on">
            Stwórz użytkownika
          </v-btn>
        </template>
        <v-card>
          <v-card-title> Utwórz użytkownika </v-card-title>
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
              label="Login"
              outlined
              v-model="user.login"
              :rules="[rules.required, rules.min, rules.max]"
            ></v-text-field>
          </v-col>
          <v-col md="10">
            <v-text-field
              label="Email"
              outlined
              v-model="user.email"
              :rules="[rules.required, rules.email]"
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
              :rules="[rules.required, rules.min, rules.max,rules.confirmPassword]"
              @click:append="show2 = !show2"
            ></v-text-field>
          </v-col>
          <v-col class="ma-0 pb-0 pt-0" md="10">
            <v-select
              v-if="companies"
              v-model="user.company_id"
              :items="companies"
              item-text="name"
              item-value="id"
              filled
              label="Firma"
            ></v-select>
          </v-col>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn depressed color="error" type="submit" @click="dialog = false"
              >Anuluj</v-btn
            >
            <v-btn depressed color="primary" @click="submit()"
              >Dodaj użytkownika</v-btn
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
      show1: false,
      show2: false,
      rules: {
        required: (value) => !!value || "Wymagane.",
        max: (value) => value.length <= 20 || "Musi zawierać do 20 liter",
        min: (value) => 3 <= value.length || "Musi zawierać od 3 liter",
        email: (value) => {
          const pattern =
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return pattern.test(value) || "Nieprawidłowy email";
        },
        confirmPassword: (value)=> this.user.password === value || "Hasła się nie zgadzają",
      },
    };
  },
  computed: {
    user() {
      return store.getters.getUser;
    },
    companies() {
      return store.getters.getCompanies;
    },
  },
  methods: {
    async createUser(user) {
      store.commit("setUser", user);
      store.dispatch("createUser", this);
      this.dialog=false;
      store.dispatch("getUsers", this);
    },
    getCompanies() {
      store.dispatch("getCompanies", this);
    },
    submit() {
      if (this.$refs.form.validate()) {
        this.createUser(this.user);
      }
    },
  },
  watch: {
    dialog() {
        this.$refs.form.reset()
    }
},
  created() {
    store.dispatch("fetchUserInit");
    this.getCompanies();
  },
};
</script>
<style >
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
.select_comapny {
  width: 184px;
}
</style>
