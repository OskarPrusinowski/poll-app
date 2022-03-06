const urlPermissions = "http://127.0.0.1:8000/main-api/permissions/";

const state = {
    usersShow: false,
    usersManage: false,
    companiesShow: false,
    companiesManage: false,
    campaignsShow: false,
    campaignsManage: false,
    contactsShow: false,
    contactsManage: false,
    settingsShow: false,
    settingsManage: false,
    userId: 0
};

const getters = {
    getUsersShow: state => state.usersShow,
    getUsersManage: state => state.usersManage,
    getCompaniesShow: state => state.companiesShow,
    getCompaniesManage: state => state.companiesManage,
    getCampaignsShow: state => state.campaignsShow,
    getCampaignsManage: state => state.campaignsManage,
    getContactsShow: state => state.contactsShow,
    getContactsManage: state => state.contactsManage,
    getSettingsShow: state => state.settingsShow,
    getSettingsManage: state => state.settingsManage,
    getPermissionsUserId: state => state.userId,
    getUserPermissions: state => state
};

const mutations = {
    ///Ustawić jak tam ustawiamy te permissions
    setPermissionsUserId(state, data) {
        state.userId = data;
    },
    setUsersShow(state, data) {
        state.usersShow = data;
    },
    setUsersManage(state, data) {
        state.usersManage = data;
    },
    setCompaniesShow(state, data) {
        state.companiesShow = data;
    },
    setCompaniesManage(state, data) {
        state.companiesManage = data;
    },
    setCampaignsShow(state, data) {
        state.campaignsShow = data;
    },
    setCampaignsManage(state, data) {
        state.campaignsManage = data;
    },
    setContactsShow(state, data) {
        state.contactsShow = data;
    },
    setContactsManage(state, data) {
        state.contactsManage = data;
    },
    setSettingsShow(state, data) {
        state.settingsShow = data;
    },
    setSettingsManage(state, data) {
        state.settingsManage = data;
    },
};

const actions = {
    getUserPermissions(state, VueComponent) {
        const id = state.getters.getPermissionsUserId;
        VueComponent.$http.get(urlPermissions + id)
            .then(response => {

                console.log(response.data.permissions);
                state.dispatch("setUserPermissions", response.data.permissions);
            })
    },
    setUserPermissions(state, permissions) {
        for (var i = 0; i < permissions.length; i++) {
            switch (permissions[i].name) {
                case 'usersShow':
                    state.commit("setUsersShow", true);
                    break;
                case 'usersManage':
                    state.commit("setUsersManage", true);
                    break;
                case 'companiesShow':
                    state.commit("setCompaniesShow", true);
                    break;
                case 'companiesManage':
                    state.commit("setCompaniesManage", true);
                    break;
                case 'campaignsShow':
                    state.commit("setCampaignsShow", true);
                    break;
                case 'campaignsManage':
                    state.commit("setCampaignsManage", true);
                    break;
                case 'contactsShow':
                    state.commit("setContactsShow", true);
                    break;
                case 'contactsManage':
                    state.commit("setContactsManage", true);
                    break;
                case 'settingsShow':
                    state.commit("setSettingsShow", true);
                    break;
                case 'settingsManage':
                    state.commit("setSettingsManage", true);
                    break;
            }
        }
    }
};

export default {
    state,
    mutations,
    actions,
    getters
}
