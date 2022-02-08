<template>
  <div class="content">
    <create />
    
    <v-simple-table>
      <thead>
        <tr>
          <th class="text-left">Lp</th>
          <th class="text-left">Imię</th>
          <th class="text-left">Skrócona nazwa</th>
          <th class="text-left">Opis</th>
          <th class="text-left">Użytkownicy</th>
          <th class="text-left">Eydtuj</th>
          <th class="text-left">Usuń</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(company,index) in companies" :key="company.id">
          <td>{{ index+1 }}</td>
          <td>{{ company.name }}</td>
          <td>{{ company.compressed_name }}</td>
          <td>{{ company.description }}</td>
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
            <change-name :company="company"/>
          </td>
          <td class="text-left">
            <v-btn
              color="error"
              fab
              small
              dark
              @click="deleteCompany(company)"
            >
              <v-icon>mdi-trash-can</v-icon>
            </v-btn>
          </td>
        </tr>
      </tbody>
    </v-simple-table>
  </div>
</template>

<script>
import store from "../../store/index";
import create from "./create.vue";

import changeName from "./changeName.vue"

export default {
  components: {
    create: create,
    changeName:changeName
  },
  computed: {
    companies() {
      return store.getters.getCompanies;
    },
  },
  data() {
    return {
      id: 0,
      invalid: true,
      ids: [],
      i:1
    };
  },
  methods: {
    getCompanies() {
      store.dispatch("getCompanies", this);
    },
    deleteCompany(company) {
      store.commit("setCompany", company);
      store.dispatch("deleteCompany", this);
      store.dispatch("getCompanies", this);
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
    goToCompanyUsers(company){
        store.commit("setCompany",company);
        store.dispatch("getCompany",this);
        this.$router.push(""+company.id);
    }
  },
  created() {
    this.getCompanies();
  },
};
</script>
