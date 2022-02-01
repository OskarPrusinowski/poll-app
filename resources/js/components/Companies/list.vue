<template>
  <div class="content">
    <create />
    <v-btn
      depressed
      color="error"
      class="mt-2"
      @click="deleteCompanies(ids)"
      :disabled="invalid"
    >
      Usuń użytkowników
    </v-btn>
    <v-simple-table>
      <thead>
        <tr>
          <th class="text-left">Id</th>
          <th class="text-left">Imię</th>
          <th class="text-left">Skrócona nazwa</th>
          <th class="text-left">Opis</th>
          <th class="text-left">Eydtuj</th>
          <th class="text-left">Usuń</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="company in companies" :key="company.id">
          <td>{{ company.id }}</td>
          <td>{{ company.name }}</td>
          <td>{{ company.compressed_name }}</td>
          <td>{{ company.description }}</td>
          <td class="text-left">
            <update :company="company" />
          </td>
          <td class="text-left">
            <v-checkbox
              color="red"
              value="red"
              hide-details
              :on-icon="'mdi-close-box'"
              @click="addRemoveId(company.id)"
            >
            </v-checkbox>
          </td>
        </tr>
      </tbody>
    </v-simple-table>
  </div>
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
  computed: {
    companies() {
      return store.getters.getCompanies;
    },
  },
  data() {
    return {
      showDialog: false,
      showUpdateDialog: false,
      id: 0,
      invalid:true,
      ids:[]
    };
  },
  methods: {
    getCompanies() {
      store.dispatch("getCompanies", this);
    },
    deleteCompany(id) {
      store.commit("setCompanyId", id);
      store.dispatch("deleteCompany", this);
      store.dispatch("getCompanies", this);
    },
    showCreateForm() {
      if (this.showUpdateDialog) {
        this.showUpdateDialog = false;
      }
      if (this.showDialog) {
        this.showDialog = false;
      } else {
        this.showDialog = true;
        store.dispatch("fetchCompanyInit");
      }
    },
    showUpdateForm(id) {
      this.showUpdateDialog = true;

      if (this.showDialog) {
        this.showDialog = false;
      }
      store.commit("setCompanyId", id);
      store.dispatch("getCompany", this);
    },
    hideUpdateForm() {
      this.showUpdateDialog = false;
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
  },
  created() {
    this.getCompanies();
  },
};
</script>
