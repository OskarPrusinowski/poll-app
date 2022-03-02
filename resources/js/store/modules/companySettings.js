const urlCompanySettings = "http://127.0.0.1:8000/main-api/company-settings/";


const state = {
    companySettings: {
        company_id: 0,
        sms_body: "",
        mail_tittle: "",
        mail_body: "",

    }
};
const getters = {
    getCompanySettings: state => state.companySettings,
    getCompanySettingsCompanyId: state => state.companySettings.company_id,
};
const mutations = {
    setCompanySettings(state, data) {
        state.companySettings = data;
    },
    setCompanySettingsCompanyId(state, data) {
        state.companySettings.company_id = data;
    },
    setCompanySettingsCompanySmsBody(state, data) {
        state.companySettings.sms_body = data;
    },
    setCompanySettingsCompanyMailTittle(state, data) {
        state.companySettings.mail_tittle = data;
    },
    setCompanySettingsCompanyMailBody(state, data) {
        state.companySettings.mail_body = data;
    },
};
const actions = {
    getCompanySettings(state, VueComponent) {
        const id = state.getters.getCompanySettingsCompanyId;
        VueComponent.$http.get(urlCompanySettings + "show/" + id)
            .then(response => {
                state.commit("setCompanySettings", response.data.companySettings);
            })
    },
    createCompanySettings(state, VueComponent) {
        VueComponent.$http.post(urlCompanySettings + "create", { companySettings: state.getters.getCompanySettings })
            .then(response => {
                console.log(response);
            })
    },
    fetchCompanySettingsInit(state) {
        state.commit("setCompanySettingsCompanyId", 0);
        state.commit("setCompanySettingsCompanySmsBody", "");
        state.commit("setCompanySettingsCompanyMailTittle", "");
        state.commit("setCompanySettingsCompanyMailBody", "");
    },
    updateCompanySettings(state, VueComponent) {
        const id = state.getters.getCompanySettingsCompanyId;
        VueComponent.$http.put(urlCompanySettings + "update/" + id, { companySettings: state.getters.getCompanySettings })
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
