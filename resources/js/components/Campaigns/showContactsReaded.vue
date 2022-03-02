<template>
  <div class="text-center">
    <v-dialog v-model="dialog" width="500">
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="red lighten-2"
          dark
          v-bind="attrs"
          v-on="on"
          @click="getCampaign()"
        >
          Zobacz listę kontaktów
        </v-btn>
      </template>
      <v-card>
        <v-card-title class="text-h5 grey lighten-2">
          Lista kontaktów
        </v-card-title>
        <v-divider></v-divider>
        <v-card-text style="height: 35vh" v-if="contacts.length != 0">
          <v-layout column style="height: 45vh"
            ><v-flex md6 style="overflow: auto">
              <v-simple-table>
                <thead>
                  <tr>
                    <td>Id</td>
                    <td v-if="isMail">Mail</td>
                    <td v-else>Numer telefonu</td>
                    <td>Czy przeczytane</td>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(contact, index) in contacts" :key="contact.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ contact.name }}</td>
                    <td v-if="contact.is_readed">Tak</td>
                    <td v-else>Nie</td>
                  </tr>
                </tbody>
              </v-simple-table>
            </v-flex>
          </v-layout>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="dialog = false"> I accept </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import store from "../../store/index";

export default {
  props: ["campaign"],
  data() {
    return {
      dialog: false,
      file: "",
    };
  },
  computed: {
    contacts() {
      if (store.getters.getCampaignContacts) {
        return store.getters.getCampaignContacts;
      }
      return [];
    },
    isMail() {
      if (this.campaign.is_contact_list) {
        return Boolean(this.contacts[0].email);
      }
      return false;
    },
  },
  methods: {
    async getCampaign() {
      console.log(this.campaign);
      store.commit("setCampaign", this.campaign);
      await store.dispatch("getCampaign", this);
      this.campaign = store.getters.getCampaign;
      console.log(store.getters.getCampaign);
    },
  },
};
</script>
