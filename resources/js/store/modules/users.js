const urlUser = "http://127.0.0.1:8000/main-api/users/";

const state = {
    users: [],
    usersIds: [],
    user: {
        id: 0,
        name: "",
        surname: "",
        login: "",
        email: "",
        password: "",
        password_confirmation: "",
        company_id: null
    },
    ok: true
};

const getters = {
    getUsers: state => state.users,
    getUser: state => state.user,
    getUserId: state => state.user.id,
    getOk: state => state.ok,
    getUsersIds: state => state.usersIds
};

const mutations = {
    setUsers(state, data) {
        state.users = data;
    },
    setUser(state, data) {
        state.user = data;
    },
    setUserId(state, data) {
        state.user.id = data;
    },
    setUserName(state, data) {
        state.user.name = data;
    },
    setUserSurname(state, data) {
        state.user.surname = data;
    },
    setUserLogin(state, data) {
        state.user.login = data;
    },
    setUserEmail(state, data) {
        state.user.email = data;
    },
    setUserPassword(state, data) {
        state.user.password = data;
    },
    setUserPasswordConfirmation(state, data) {
        state.user.password_confirmation = data;
    },
    setUserCompanyId(state,data){
        state.user.company_id = data;
    },
    setUsersIds(state,data){
        state.usersIds=data;
    }
};

const actions = {
    async getUsers(state, VueComponent) {
        VueComponent.$http.get(urlUser + "list")
            .then(response => {
                state.commit("setUsers", response.data.users);
            })
    },
    async createUser(state, VueComponent) {
        VueComponent.$http.post(urlUser + "create", { user: state.getters.getUser })
            .then(response => {
                state.commit("setOk", true);
                console.log(response);
            })
            .catch(error => {
                state.commit("setOk", false);
                console.log(error);
            })
    },
    async deleteUser(state, VueComponent) {
        const id = state.getters.getUserId;
        VueComponent.$http.delete(urlUser + "delete/" + id)
            .then(response => {
                console.log(response);
            })
    },
    async fetchUserInit(state) {
        state.commit("setUserName", "");
        state.commit("setUserSurname", "");
        state.commit("setUserLogin", "");
        state.commit("setUserEmail", "");
        state.commit("setUserPassword", "");
        state.commit("setUserPasswordConfirmation", "");
        state.commit("setUserCompanyId", 0);
    },
    async updateUser(state, VueComponent) {
        const id = state.getters.getUserId;
        VueComponent.$http.put(urlUser + "update/" + id, { user: state.getters.getUser })
            .then(response => {
                state.commit("setOk", true);
                console.log(response)
            })
            .catch(error => {
                console.log(error);
                state.commit("setOk", false);
            })
    },
    getUser(state, VueComponent) {
        const id = state.getters.getUserId;
        VueComponent.$http.get(urlUser + "show/" + id)
            .then(response => {
                state.commit("setUser", response.data.user);
                console.log(response);
            })
            .catch(error => {
                console.log(error);
            })
    },
    deleteUsers(state,VueComponent){
        VueComponent.$http.post(urlUser+"delete",{ids:state.getters.getUsersIds})
        .then(response=>{
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