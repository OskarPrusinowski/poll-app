<template>
  <div>
    <v-simple-table>
      <thead>
        <tr>
          <th class="text-left">Lp</th>
          <th class="text-left">Imię</th>
          <th class="text-left">Typ komunikacji</th>
          <th class="text-left">Termin rejsetracji potwierdzeń</th>
          <th class="text-left">Plik</th>
          <th class="text-left">Lista kontaktów</th>
          <th class="text-left">Data publikacji</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(campaign, index) in company.campaigns" :key="campaign.id">
          <td>{{ index + 1 }}</td>
          <td>{{ campaign.name }}</td>
          <td>{{ campaign.comunication_type }}</td>
          <td>{{ campaign.date_registration }}</td>
          <td v-if="campaign.file_name">{{ campaign.orginal_file_name }}</td>
          <td v-else><add-file :campaign="campaign" /></td>
          <td v-if="campaign.date_published">
            <v-btn depressed disabled> Opublikowane </v-btn>
          </td>
          <td v-else-if="campaign.is_contact_list == 1">
            <import-contacts :action="'Edytuj'" :campaign="campaign" />
          </td>
          <td v-else>
            <import-contacts :action="'Dodaj'" :campaign="campaign" />
          </td>
          <td v-if="campaign.date_published">{{ campaign.date_published }}</td>
          <td v-else>
            <v-btn depressed color="primary" @click="release(campaign)">
              Publikuj
            </v-btn>
          </td>
        </tr>
      </tbody>
    </v-simple-table>

    <create :company="company" />
  </div>
</template>

<script>
import store from "../../store/index";
import create from "./create.vue";
import addFile from "./addFile.vue";
import importContacts from "./importContacts.vue";
import showContacts from "./showContacts.vue";

export default {
  components: {
    create: create,
    addFile: addFile,
    importContacts: importContacts,
    showContacts: showContacts,
  },
  computed: {
    user() {
      return store.getters.getUser;
    },
    company() {
      return store.getters.getCompany;
    },
  },
  methods: {
    async getCompany() {
      await store.dispatch("getActualUser", this);
      store.commit("setCompany", {});
      store.commit("setCompanyId", store.getters.getUserCompanyId);
      store.dispatch("getCompany", this);
    },
    release(campaign) {
      store.commit("setCampaign", campaign);
      store.dispatch("releaseCampaign", this);
    },
  },
  created() {
    this.getCompany();
  },
};
</script>