<template>
  <div class="content">
    <create :company_id="company_id" @added="changedAmountCampaigns" />
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
          <th class="text-left">Anonimizuj kontakty</th>
          <th class="text-left">Usuń kampanię</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(campaign, index) in campaigns" :key="campaign.id">
          <td>{{ index + 1 }}</td>
          <td>{{ campaign.name }}</td>
          <td>{{ campaign.comunication_type }}</td>
          <td>{{ campaign.date_registration }}</td>
          <td v-if="campaign.file_name">
            <show-file :campaign="campaign" />
            <v-btn
              color="error"
              fab
              small
              dark
              :disabled="campaign.date_published"
              @click="deleteFile(campaign)"
            >
              <v-icon>mdi-trash-can</v-icon>
            </v-btn>
          </td>
          <td v-else>
            <add-file :campaign="campaign" @added="getCampaigns" />
          </td>
          <td v-if="campaign.date_published">
            <showContactsReaded :campaign="campaign" />
          </td>
          <td v-else-if="campaign.is_contact_list == 1">
            <import-contacts
              :action="'Edytuj'"
              :campaign="campaign"
              @added="getCampaigns"
            />
          </td>
          <td v-else>
            <import-contacts
              :action="'Dodaj'"
              :campaign="campaign"
              @added="getCampaigns"
            />
          </td>
          <td v-if="campaign.date_published">{{ campaign.date_published }}</td>
          <td v-else>
            <v-btn depressed color="primary" @click="release(campaign)">
              Publikuj
            </v-btn>
          </td>
          <td class="text-left">
            <v-btn
              color="primary"
              fab
              small
              dark
              :disabled="
                campaign.date_published != null || campaign.is_anonymizated == 1
              "
              @click="anonymizate(campaign)"
            >
              <v-icon>mdi-account</v-icon>
            </v-btn>
          </td>
          <td class="text-left">
            <v-btn
              color="error"
              fab
              small
              dark
              :disabled="campaign.date_published"
              @click="deleteCampaign(campaign)"
            >
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
import addFile from "./addFile.vue";
import importContacts from "./importContacts.vue";
import showContacts from "./showContacts.vue";
import showFile from "./showFile.vue";
import showContactsReaded from "./showContactsReaded.vue";

export default {
  data() {
    return {
      itemsPerPageArray: [5, 8, 10],
      itemsPerPage: 5,
    };
  },
  components: {
    create: create,
    addFile: addFile,
    importContacts: importContacts,
    showContacts: showContacts,
    showFile: showFile,
    showContactsReaded: showContactsReaded,
  },
  computed: {
    user() {
      return store.getters.getUser;
    },
    company_id() {
      return store.getters.getUserCompanyId;
    },
    campaigns() {
      return store.getters.getCampaigns;
    },
    page() {
      return store.getters.getCampaignsPage;
    },
    length() {
      return Math.ceil(
        store.getters.getCampaignsCount / store.getters.getCampaignsTotal
      );
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
      this.getCampaigns();
    },
    async getCampaigns() {
      store.commit("setCampaignsTotal", this.itemsPerPage);
      await store.dispatch("getActualUser", this);
      store.commit("setCampaignsCompanyId", store.getters.getUserCompanyId);
      store.dispatch("getCampaigns", this);
    },
    setPage(page) {
      store.commit("setCampaignsPage", page);
      this.getCampaigns();
    },
    countCampaigns() {
      store.dispatch("getCampaignsCount", this);
    },
    async deleteCampaign(campaign) {
      store.commit("setCampaign", campaign);
      await store.dispatch("deleteCampaign", this);
      this.changedAmountCampaigns();
    },
    async deleteFile(campaign) {
      store.commit("setCampaign", campaign);
      await store.dispatch("deleteCampaignFile", this);
      this.getCampaigns();
    },
    async anonymizate(campaign) {
      store.commit("setCampaign", campaign);
      await store.dispatch("getCampaignContacts", this);
      store.commit("setCampaignIsAnonymizated", 1);
      await store.dispatch("anonymizate", this);
      store.dispatch("updateCampaign", this);
    },
    changedAmountCampaigns() {
      this.getCampaigns();
      this.countCampaigns();
    },
    updateItemsPerPage(number) {
      this.itemsPerPage = number;
      store.commit("setCampaignsPage", 1);
      this.getCampaigns();
    },
  },
  async created() {
    this.getCompany();
    await this.getCampaigns();
    this.countCampaigns();
  },
};
</script>
