<template>
  <v-app>
    <div class="content">
      <create />
      <v-btn
        depressed
        color="error"
        class="mt-2"
        @click="deleteUsers(ids)"
        :disabled="invalid"
      >
        Usuń użytkowników
      </v-btn>
      <v-simple-table>
        <thead>
          <tr>
            <th class="text-left">Id</th>
            <th class="text-left">Imię</th>
            <th class="text-left">Nazwisko</th>
            <th class="text-left">Login</th>
            <th class="text-left">Email</th>
            <th class="text-left">Firma</th>
            <th class="text-left">Eydtuj</th>
            <th class="text-left">Usuń</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td class="text-left">{{ user.id }}</td>
            <td class="text-left">{{ user.name }}</td>
            <td class="text-left">{{ user.surname }}</td>
            <td class="text-left">{{ user.login }}</td>
            <td class="text-left">{{ user.email }}</td>
            <td class="text-left" v-if="user.company">
              {{ user.company.name }}
            </td>
            <td v-else></td>
            <td class="text-left">
              <update :user="user" />
            </td>
            <td class="text-left">
              <v-checkbox
                color="red"
                value="red"
                hide-details
                :on-icon="'mdi-close-box'"
                @click="addRemoveId(user.id)"
              >
              </v-checkbox>
            </td>
          </tr>
        </tbody>
      </v-simple-table>
    </div>
  </v-app>
</template>

<script>
import store from "../../store/index";
import create from "./create.vue";
import update from "./update.vue";

export default {
  components: {
    create: create,
    update: update,
  },
  data() {
    return {
      showDialog: false,
      showUpdateDialog: false,
      id: 0,
      ids: [],
      invalid: true,
    };
  },
  computed: {
    users() {
      return store.getters.getUsers;
    },
  },
  methods: {
    getUsers() {
      store.dispatch("getUsers", this);
    },
    deleteUser(id) {
      store.commit("setUserId", id);
      store.dispatch("deleteUser", this);
      store.dispatch("getUsers", this);
    },
    showCreateForm() {
      if (this.showDialog) {
        this.showDialog = false;
      } else {
        this.showDialog = true;
        store.dispatch("fetchUserInit");
      }
      if (this.showUpdateDialog) {
        this.showUpdateDialog = false;
      }
    },
    showUpdateForm(id) {
      this.showUpdateDialog = true;
      if (this.showDialog) {
        this.showDialog = false;
      }
      store.commit("setUserId", id);
      store.dispatch("getUser", this);
    },
    hideUpdateForm() {
      this.showUpdateDialog = false;
    },
    deleteUsers(ids) {
      store.commit("setUsersIds", ids);
      store.dispatch("deleteUsers", this);
      store.dispatch("getUsers", this);
      this.makeDis();
    },
    makeDis() {
      if (this.ids.length > 0) {
        this.invalid = false;
      } else {
        this.invalid = true;
      }
    },
    addRemoveId(id) {
      if (!this.ids.includes(id)) {
        this.ids.push(id);
      } else {
        const ind = this.ids.indexOf(id);
        this.ids.splice(ind, 1);
      }
      this.makeDis();
    },
  },
  created() {
    this.getUsers();
    this.getCompanies();
  },
};
</script>
<style>
.content {
  margin: 15px auto;
  text-align: center;
}
.link {
  margin: 100px;
}
</style>
