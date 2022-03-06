<template>
  <div>
    <div>
      <v-btn depressed color="primary" :disabled="readed" @click="submit()">
        Przeczytałem
      </v-btn>
    </div>
    <pdf
      :src="src"
      v-for="i in numPages"
      :key="i"
      :page="i"
      style="margin-left: auto; margin-right: auto; width: 52%"
    ></pdf>
  </div>
</template>

<script>
import store from "../../store/index";
import pdf from "vue-pdf";

export default {
  data() {
    return {
      readed: false,
      src: "",
      numPages: undefined,
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
    async getFileName() {
      const id = this.$route.params.id;
      store.commit("setCampaign", {});
      store.commit("setCampaignId", id);
      await store.dispatch("getHashedCampaign", this);
      console.log(store.getters.getCampaign);
    },
    submit() {
      this.readed = true;
      const contactId = this.$route.params.contactId;
      store.commit("setContactId", contactId);
      store.dispatch("readContact", this);
    },
  },
  async created() {
    await this.getFileName();
    var loadingTask = pdf.createLoadingTask(
      "http://127.0.0.1:8000/main-api/campaigns/getFile/" + this.fileName
    );
    this.src = loadingTask;
    this.src.promise.then((pdf) => {
      this.numPages = pdf.numPages;
    });
  },
};
</script>
