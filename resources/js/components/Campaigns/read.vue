<template>
  <div>
    <pdf
      :src="'http://127.0.0.1:8000/main-api/campaigns/getFile/' + fileName"
    ></pdf>

    <v-btn depressed color="primary" :disabled="readed" @click="submit()">
      Przeczytałem
    </v-btn>
  </div>
</template>

<script>
import store from "../../store/index";
import pdf from "vue-pdf";

export default {
  data() {
    return {
      readed: false,
    };
  },
  components: {
    pdf,
  },
  computed: {
    fileName() {
      return store.getters.getCampaignFileName;
    },
  },
  methods: {
    getFileName() {
      const id = this.$route.params.id;
      store.commit("setCampaign", {});
      store.commit("setCampaignId", id);
      store.dispatch("getCampaign", this);
    },
    submit() {
      this.readed = true;
      const contactId = this.$route.params.contactId;
      store.commit("setContactId", contactId);
      store.dispatch("readContact", this);
    },
  },
  created() {
    this.getFileName();
  },
};
</script>
