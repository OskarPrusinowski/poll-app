<template>
  <div v-show="show" class="example">
    <div class="input_row">
      <label for="name">Nazwa</label>
      <input type="text" name="name" v-model="user.name" />
    </div>
    <div class="input_row">
      <label for="surname">Nazwisko</label>
      <input type="text" name="surname" v-model="user.surname" />
    </div>
    <div class="input_row">
      <label for="login">Login</label>
      <input type="text" name="login" v-model="user.login" />
    </div>
    <div class="input_row">
      <label for="email">Email</label>
      <input type="email" name="email" v-model="user.email" />
    </div>
    <div class="input_row">
      <label for="password">Hasło</label>
      <input type="password" name="password" v-model="user.password" />
    </div>
    <div class="input_row">
      <label for="password_confirmation">Potwierdź hasło</label>
      <input
        type="password"
        name="password_confirmation"
        v-model="user.password_confirmation"
      />
    </div>
    <div class="input_row">
      <label for="company">Firma</label>
      <select name="company" v-model="user.company_id" class="select_comapny">
        <option value="null">Brak</option>
        <option
          v-for="company in companies"
          :key="company.id"
          :value="company.id"
        >
          {{ company.name }}
        </option>
      </select>
    </div>
    <button type="submit" @click="$emit('hide')">Anuluj</button>
    <button type="submit" @click="createUser(user)">Dodaj użytkownika</button>
  </div>
</template>

<script>
import store from "../../store/index";
export default {
  props: ["show"],
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
      setTimeout(() => {
        if (store.getters.getOk) {
          store.dispatch("fetchUserInit");
          this.$emit("hide");
          store.dispatch("getUsers", this);
        }
      }, 300);
    },
    getCompanies() {
      store.dispatch("getCompanies", this);
    },
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
