<template>
  <div class="content" v-if="permissions.companiesShow">
    <create v-if="permissions.companiesManage" @added="addedCompanies" />

    <v-simple-table>
      <thead>
        <tr>
          <th class="text-left">Lp</th>
          <th class="text-left">Imię</th>
          <th class="text-left">Użytkownicy</th>
          <th class="text-left">Eydtuj</th>
          <th class="text-left">Usuń</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(company, index) in companies" :key="company.id">
          <td>{{ index + 1 }}</td>
          <td>{{ company.name }}</td>
          <td>
            <v-btn
              depressed
              color="error"
              class="mt-2"
              @click="goToCompanyUsers(company)"
            >
              Zobacz użytkowników
            </v-btn>
          </td>
          <td class="text-left">
            <change-name
              :company="company"
              v-if="permissions.companiesManage"
            />
          </td>
          <td class="text-left">
            <v-btn
              color="error"
              fab
              small
              dark
              @click="deleteCompany(company)"
              v-if="permissions.companiesManage"
            >
              <v-icon>mdi-trash-can</v-icon>
            </v-btn>
          </td>
        </tr>
      </tbody>
    </v-simple-table>

    <div v-if="length > 1 || itemsPerPage != itemsPerPageArray[0]">
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

import changeName from "./changeName.vue";

export default {
  components: {
    create: create,
    changeName: changeName,
  },
  computed: {
    permissions() {
      return store.getters.getUserPermissions;
    },
    companies() {
      return store.getters.getCompanies;
    },
    page() {
      return store.getters.getCompaniesPage;
    },
    length() {
      return Math.ceil(
        store.getters.getCompaniesCount / store.getters.getCompaniesTotal
      );
    },
  },
  data() {
    return {
      id: 0,
      invalid: true,
      ids: [],
      i: 1,
      itemsPerPageArray: [5, 8, 10],
      itemsPerPage: 5,
    };
  },
  methods: {
    getCompanies() {
      store.commit("setCompaniesTotal", this.itemsPerPage);
      store.dispatch("getCompanies", this);
    },
    deleteCompany(company) {
      store.commit("setCompany", company);
      store.dispatch("deleteCompany", this);
      this.deletedCompany();
    },
    deleteCompanies(ids) {
      store.commit("setCompaniesIds", ids);
      store.dispatch("deleteCompanies", this);
      store.dispatch("getCompanies", this);
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
    goToCompanyUsers(company) {
      store.commit("setCompany", company);
      store.dispatch("getCompany", this);
      this.$router.push("" + company.id);
    },
    setPage(page) {
      store.commit("setCompaniesPage", page);
      this.getCompanies();
    },
    countCompanies() {
      store.dispatch("getCompaniesCount", this);
    },
    updateItemsPerPage(number) {
      this.itemsPerPage = number;
      store.commit("setCompaniesPage", 1);
      this.getCompanies();
    },
    deletedCompany() {
      this.getCompanies();
      this.changeCountCompanies(-1);
    },
    changeCountCompanies(n) {
      store.commit("setCompaniesCount", store.getters.getCompaniesCount + n);
    },
    addedCompanies() {
      this.getCompanies();
      this.changeCountCompanies(1);
    },
  },
  created() {
    this.getCompanies();
    this.countCompanies();
  },
};
</script>
