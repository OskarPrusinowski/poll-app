<template>
  <v-row>
    <v-col cols="12" sm="6">
      <v-card class="mx-auto" height="600" max-width="600">
        <v-card-text
          class="font-weight-medium mt-12 text-center text-subtitle-1"
        >
          Sms
          <v-divider></v-divider>
          <v-textarea
            filled
            name="input-7-4"
            label="Body"
            v-model="settings.sms_body"
            @focus="anythingChanged = false"
          ></v-textarea>
        </v-card-text>
      </v-card>
    </v-col>

    <v-col cols="12" sm="6">
      <v-card class="mx-auto" height="600" max-width="600">
        <v-card-text
          class="font-weight-medium mt-12 text-center text-subtitle-1"
        >
          Mail
          <v-divider></v-divider>
          <v-textarea
            filled
            name="input-7-4"
            label="Tittle"
            rows="2"
            v-model="settings.mail_tittle"
          ></v-textarea>
          <v-textarea
            filled
            name="input-7-4"
            label="Body"
            v-model="settings.mail_body"
          ></v-textarea>
        </v-card-text>
      </v-card>

      <v-btn
        depressed
        color="primary"
        :disabled="anythingChanged"
        @click="updateCompanySettings()"
      >
        Zapisz zmiany
      </v-btn>
    </v-col>
  </v-row>
</template>
<script>
import store from "../../store/index";

export default {
  data() {
    return {
      anythingChanged: true,
    };
  },
  computed: {
    settings() {
      return store.getters.getCompanySettings;
    },
    smsBody() {
      return store.getters.getCompanySettingsSmsBody;
    },
    mailTittle() {
      return store.getters.getCompanySettingsMailTittle;
    },
    mailBody() {
      return store.getters.getCompanySettingsMailBody;
    },
  },
  methods: {
    async getCompanySettings() {
      await store.dispatch("getActualUser", this);
      store.commit(
        "setCompanySettingsCompanyId",
        store.getters.getUserCompanyId
      );
      store.dispatch("getCompanySettings", this);
    },
    updateCompanySettings() {
      console.log(this.settings);
      store.dispatch("updateCompanySettings", this);
    },
  },
  created() {
    this.getCompanySettings();
  },
};
</script>
