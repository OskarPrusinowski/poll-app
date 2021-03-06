
const urlCampaign = "http://127.0.0.1:8000/main-api/campaigns/";
const urlContatcs = "http://127.0.0.1:8000/main-api/contacts/";

const state = {
    campaign: {
        id: 0,
        name: "",
        comunication_type: "",
        date_registration: null,
        hour_registration: null,
        file_name: "",
        company_id: 0,
        is_contact_list: false,
        date_published: null,
        contacts: [],
        is_anonymizated: false
    },
    campaigns: "",
    file: "",
    company_id: 0,
    camapignsPage: 1,
    campaignsTotal: 5,
    campaignsCount: 0,
    contacts: [],
    contactId: 0
};
const getters = {
    getCampaign: state => state.campaign,
    getCampaignId: state => state.campaign.id,
    getFile: state => state.file,
    getCampaignContacts: state => state.campaign.contacts,
    getCampaignCompanyId: state => state.company_id,
    getCampaigns: state => state.campaigns,
    getCampaignsPage: state => state.camapignsPage,
    getCampaignsTotal: state => state.campaignsTotal,
    getCampaignsCount: state => state.campaignsCount,
    getContacts: state => state.contacts,
    getContactId: state => state.contactId,
    getCampaignFileName: state => state.campaign.file_name,
    getCampaignHourRegistration: state => state.campaign.hour_registration
};
const mutations = {
    setCampaign(state, data) {
        state.campaign = data;
    },
    setCampaignName(state, data) {
        state.campaign.name = data;
    },
    setCampaignId(state, data) {
        state.campaign.id = data;
    },
    setFile(state, data) {
        state.file = data;
    },
    setIsContactList(state, data) {
        state.campaign.is_contact_list = data;
    },
    setCampaigns(state, data) {
        state.campaigns = data;
    },
    setCampaignsCompanyId(state, data) {
        state.company_id = data;
    },
    setCampaignsPage(state, data) {
        state.camapignsPage = data;
    },
    setCampaignsTotal(state, data) {
        state.campaignsTotal = data;
    },
    setCampaignsCount(state, data) {
        state.campaignsCount = data;
    },
    setCampaignComunicationType(state, data) {
        state.campaign.comunication_type = data;
    },
    setCampaignDateRegistration(state, data) {
        state.campaign.date_registration = data;
    },
    setCampaignFileName(state, data) {
        state.campaign.file_name = data;
    },
    setCampaignIsContactList(state, data) {
        state.campaign.is_contact_list = data;
    },
    setCampaignDatePublished(state, data) {
        state.campaign.date_published = data;
    },
    setCampaignContacts(state, data) {
        state.campaign.contacts = data;
    },
    setCampaignIsAnonymizated(state, data) {
        state.campaign.is_anonymizated = data;
    },
    setCampaignHourRegistration(state, data) {
        state.campaign.hour_registration = data;
    },
    setContacts(state, data) {
        state.contacts = data;
    },
    setContactId(state, data) {
        state.contactId = data;
    }
};
const actions = {
    createCampaign(state, VueComponent) {
        VueComponent.$http.post(urlCampaign + "create", { campaign: state.getters.getCampaign }).
            then(response => {
                console.log(response)
            })
    },
    addFile(state, VueComponent) {
        const fd = new FormData();
        fd.append("file", state.getters.getFile)
        fd.append("id", state.getters.getCampaignId)
        VueComponent.$http.post(urlCampaign + "add", fd)
            .then(response => {
                console.log(response);
            })
    },
    importContacts(state, VueComponent) {
        const fd = new FormData();
        fd.append("file", state.getters.getFile)
        fd.append("id", state.getters.getCampaignId)
        VueComponent.$http.post(urlContatcs + "import", fd)
            .then(response => {
                console.log(response);
            })
    },
    releaseCampaign(state, VueComponent) {
        VueComponent.$http.post(urlCampaign + "release", { campaign: state.getters.getCampaign })
            .then(response => {
                console.log(response)
            })
    },
    updateCampaign(state, VueComponent) {
        const id = state.getters.getCampaignId;
        VueComponent.$http.post(urlCampaign + "update/" + id, { campaign: state.getters.getCampaign, id: id })
            .then(response => {
                console.log(response);
            })
    },
    getCampaign(state, VueComponent) {
        const id = state.getters.getCampaignId;
        VueComponent.$http.get(urlCampaign + "show/" + id)
            .then(response => {
                state.commit("setCampaign", response.data.campaign);
            })
    },
    async getHashedCampaign(state, VueComponent) {
        const id = state.getters.getCampaignId;
        await VueComponent.$http.get(urlCampaign + "showHashed/" + id)
            .then(response => {
                state.commit("setCampaign", response.data.campaign);
            })
    },
    getCampaigns(state, VueComponent) {
        const companyId = state.getters.getCampaignCompanyId;
        const page = state.getters.getCampaignsPage;
        const total = state.getters.getCampaignsTotal;
        VueComponent.$http.get(urlCampaign + "list/" + companyId + "?page=" + page + "&total=" + total,)
            .then(response => {
                console.log(response);
                state.commit("setCampaigns", response.data.campaigns);
            })
    },
    getCampaignsCount(state, VueComponent) {
        const companyId = state.getters.getCampaignCompanyId;
        VueComponent.$http.get(urlCampaign + "count/" + companyId)
            .then(response => {
                state.commit("setCampaignsCount", response.data.count);
            })
    },
    deleteCampaign(state, VueComponent) {
        const id = state.getters.getCampaignId;
        VueComponent.$http.delete(urlCampaign + "delete/" + id)
            .then(resposne => {
                console.log(resposne);
            })
    },
    deleteCampaignFile(state, VueComponent) {
        const id = state.getters.getCampaignId;
        VueComponent.$http.delete(urlCampaign + "deleteFile/" + id)
            .then(resposne => {
                console.log(resposne);
            })
    }
    ,
    fetchCampaignInit(state) {
        state.commit("setCampaignName", "");
        state.commit("setCampaignComunicationType", "");
        state.commit("setCampaignDateRegistration", null);
        state.commit("setCampaignHourRegistration", "12:00")
        state.commit("setCampaignFileName", "");
        state.commit("setCampaignIsContactList", false);
        state.commit("setCampaignDatePublished", null);
        state.commit("setCampaignContacts", []);
        state.commit("setCampaignIsAnonymizated", false);
    },
    anonymizate(state, VueComponent) {
        VueComponent.$http.post(urlContatcs + "anonymizate", { contacts: state.getters.getContacts })
            .then(response => {
                console.log(response);
            })
    },
    async getCampaignContacts(state, VueComponent) {
        const id = state.getters.getCampaignId;
        await VueComponent.$http.get(urlCampaign + "contacts/" + id)
            .then(response => {
                state.commit("setContacts", response.data.contacts);
            })
    },
    getCampaignFile(state, VueComponent) {
        const id = state.getters.getCampaignId;
        VueComponent.$http.get(urlCampaign + "getFile/" + id)
            .then(response => {
                state.commit("setFile", response.data);
            })
    },
    readContact(state, VueComponent) {
        const id = state.getters.getContactId;
        VueComponent.$http.post(urlContatcs + "read/" + id)
            .then(response => {
                console.log(response);
            })
    }
};



export default {
    state,
    mutations,
    actions,
    getters
}
