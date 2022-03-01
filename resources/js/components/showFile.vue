<template>
  <div>
    <v-btn depressed color="primary" @click="submit()"> Przeczytałem </v-btn>
    <pdf
      :src="'http://127.0.0.1:8000/main-api/campaigns/getFile/' + fileName"
    ></pdf>
  </div>
</template>

<script>
import store from "../store/index";
import pdf from "vue-pdf";

export default {
  data() {
    return {
      readed: true,
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
      //const id = this.$route.params.id;
      const id = this.$route.params.id;
      store.commit("setCampaign", {});
      store.commit("setCampaignId", id);
      store.dispatch("getHashedCampaign", this);
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
