<template>
  <div class="content">
    <create :company_id="null" />
    <v-simple-table>
      <thead>
        <tr>
          <th class="text-left">Id</th>
          <th class="text-left">Imię</th>
          <th class="text-left">Nazwisko</th>
          <th class="text-left">Numer telefonu</th>
          <th class="text-left">Email</th>
          <th class="text-left">Data utworzenia</th>
          <th class="text-left">Data ostatniego logowania</th>
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
          <td class="text-left">{{ user.phone_number }}</td>
          <td class="text-left">{{ user.email }}</td>
          <td class="text-left">
            {{ moment(user.created_at).format("MMMM Do YYYY, h:mm:ss a") }}
          </td>
          <td class="text-left" v-if="user.last_login">
            {{ moment(user.last_login).format("MMMM Do YYYY, h:mm:ss a") }}
          </td>
          <td v-else></td>
          <td class="text-left" v-if="user.company">
            {{ user.company.name }}
          </td>
          <td v-else></td>
          <td class="text-left">
            <update :user="user" />
          </td>
          <td class="text-left">
            <v-btn color="error" fab small dark @click="deleteUser(user)">
              <v-icon>mdi-trash-can</v-icon>
            </v-btn>
          </td>
        </tr>
      </tbody>
    </v-simple-table>
    <div v-if="length > 1">
      <v-pagination
        v-model="page"
        :length="length"
        :total-visible="7"
        @input="setPage"
      ></v-pagination>
      <v-menu offset-y>
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            dark
            text
            color="primary"
            class="ml-2"
            v-bind="attrs"
            v-on="on"
          >
            {{ itemsPerPage }}
            <v-icon>mdi-chevron-down</v-icon>
          </v-btn>
        </template>
        <v-list>
          <v-list-item
            v-for="(number, index) in itemsPerPageArray"
            :key="index"
            @click="updateItemsPerPage(number)"
          >
            <v-list-item-title>{{ number }}</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </div>
  </div>
</template>

<script>
import store from "../../store/index";
import create from "./create.vue";
import update from "./update.vue";

import moment from "moment";

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
      moment: moment,
      itemsPerPageArray: [5, 8, 10],
      itemsPerPage: 5,
    };
  },
  computed: {
    users() {
      return store.getters.getUsers;
    },
    page() {
      return store.getters.getUsersPage;
    },
    length() {
      return Math.ceil(
        store.getters.getUsersCount / store.getters.getUsersTotal
      );
    },
  },
  methods: {
    getUsers() {
      store.commit("setUsersTotal", this.itemsPerPage);
      store.dispatch("getUsers", this);
    },
    deleteUser(user) {
      store.commit("setUser", user);
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
    setPage(page) {
      store.commit("setUsersPage", page);
      this.getUsers();
    },
    countUsers() {
      store.dispatch("getUsersCount", this);
    },
    updateItemsPerPage(number) {
      this.itemsPerPage = number;
      store.commit("setUsersPage", 1);
      this.getUsers();
    },
  },
  created() {
    this.getUsers();
    this.countUsers();
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
