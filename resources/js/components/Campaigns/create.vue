<template>
  <v-form ref="form">
    <div class="text-center">
      <v-dialog v-model="dialog" max-width="500">
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            color="blue lighten-8"
            dark
            v-bind="attrs"
            v-on="on"
            @click="resetValues"
          >
            Stwórz kampanię
          </v-btn>
        </template>

        <v-card>
          <v-card-title> Utwórz kampanię </v-card-title>
          <v-divider></v-divider>

          <v-col class="ma-0 pb-0 pt-0" md="10">
            <v-text-field
              label="Nazwa"
              outlined
              v-model="campaign.name"
              :rules="[rules.required, rules.min, rules.max]"
            ></v-text-field>
          </v-col>
          <v-col class="ma-0 pb-0 pt-0" md="10">
            <v-radio-group
              v-model="campaign.comunication_type"
              row
              label="Typ komunikacji"
              :rules="[rules.required]"
            >
              <v-radio label="Email" value="email"></v-radio>
              <v-radio label="Numer telefonu" value="phone"></v-radio
            ></v-radio-group>
          </v-col>
          <v-col class="ma-0 pb-0 pt-2" md="10">
            <v-row justify="center">
              <legend
                class="v-label theme--light"
                style="left: 0px; right: auto; position: relative"
              >
                Termin rejsetracji potwierdzeń
              </legend>
              <v-date-picker v-model="picker"></v-date-picker>
            </v-row>
            <v-row justify="center">
              <v-time-picker
                format="24hr"
                v-model="campaign.hour_registration"
              ></v-time-picker>
            </v-row>
          </v-col>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn depressed color="error" type="submit" @click="dialog = false"
              >Anuluj</v-btn
            >
            <v-btn
              depressed
              color="primary"
              @click="submit()"
              :loading="loading"
              >Dodaj kampanię</v-btn
            >
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div></v-form
  >
</template>

<script>
import store from "../../store/index";

export default {
  props: ["company_id"],
  data() {
    return {
      dialog: false,
      loading: false,
      rules: {
        required: (value) => !!value || "Wymagane.",
        max: (value) => value.length <= 20 || "Musi zawierać do 20 liter",
        min: (value) => 3 <= value.length || "Musi zawierać od 3 liter",
      },
      picker: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
    };
  },
  computed: {
    campaign() {
      return store.getters.getCampaign;
    },
  },
  methods: {
    async createCampaign(campaign) {
      campaign.date_registration = this.picker;
      campaign.company_id = this.company_id;
      store.commit("setCampaign", campaign);
      await store.dispatch("createCampaign", this);
      this.loading = false;
      this.dialog = false;
      this.$emit("added");
    },
    submit() {
      if (this.$refs.form.validate()) {
        this.loading = true;
        this.createCampaign(this.campaign);
      }
    },
    resetValues() {
      store.dispatch("fetchCampaignInit");
      this.picker = new Date(
        Date.now() - new Date().getTimezoneOffset() * 60000
      )
        .toISOString()
        .substr(0, 10);
    },
  },
  watch: {
    dialog() {
      this.$refs.form.reset();
    },
  },
};
</script>
