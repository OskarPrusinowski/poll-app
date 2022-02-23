const urlUser = "http://127.0.0.1:8000/main-api/users/";
const urlAuthUser = "http://127.0.0.1:8000/user";

const state = {
    users: [],
    usersIds: [],
    user: {
        id: 0,
        name: "",
        surname: "",
        phone_number: 0,
        email: "",
        password: "",
        password_confirmation: "",
        company_id: null,
        role_id: null,
    },
    ok: true,
    dialog: true,
    usersPage: 1,
    usersTotal: 5,
    usersCount: 0
};

const getters = {
    getUsers: state => state.users,
    getUser: state => state.user,
    getUserId: state => state.user.id,
    getUsersIds: state => state.usersIds,
    getDialog: state => state.dialog,
    getUserCompanyId: state => state.user.company_id,
    getUserRoleId: state => state.user.role_id,
    getUsersPage: state => state.usersPage,
    getUsersTotal: state => state.usersTotal,
    getUsersCount: state => state.usersCount
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
    setUserEmail(state, data) {
        state.user.email = data;
    },
    setUserPassword(state, data) {
        state.user.password = data;
    },
    setUserPasswordConfirmation(state, data) {
        state.user.password_confirmation = data;
    },
    setUserCompanyId(state, data) {
        state.user.company_id = data;
    },
    setUserRoleId(state, data) {
        state.user.role_id = data;
    },
    setUsersIds(state, data) {
        state.usersIds = data;
    },
    setUserPhoneNumber(state, data) {
        state.phone_number = data;
    },
    setDialog(state, data) {
        state.dialog = data;
    },
    setUsersPage(state, data) {
        state.usersPage = data;
    },
    setUsersTotal(state, data) {
        state.usersTotal = data;
    },
    setUsersCount(state, data) {
        state.usersCount = data;
    }
};

const actions = {
    async getUsers(state, VueComponent) {
        const page = state.getters.getUsersPage;
        const total = state.getters.getUsersTotal;
        VueComponent.$http.get(urlUser + "list?page=" + page + "&total=" + total)
            .then(response => {
                state.commit("setUsers", response.data.users);
            })
    },
    async createUser(state, VueComponent) {
        await VueComponent.$http.post(urlUser + "create", { user: state.getters.getUser })
            .then(response => {
                state.commit("setOk", true);
            })

        //const response = await VueComponent.$http.post(urlUser + "create", { user: state.getters.getUser })

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
        state.commit("setUserPhoneNumber", 0);
        state.commit("setUserEmail", "");
        state.commit("setUserPassword", "");
        state.commit("setUserPasswordConfirmation", "");
        state.commit("setUserCompanyId", 0);
        state.commit("setUserRoleId", null);
    },
    async updateUser(state, VueComponent) {
        const id = state.getters.getUserId;
        VueComponent.$http.put(urlUser + "update/" + id, { user: state.getters.getUser })
            .then(response => {
                console.log(response)
            })
            .catch(error => {
                console.log(error);
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
    deleteUsers(state, VueComponent) {
        VueComponent.$http.post(urlUser + "delete", { ids: state.getters.getUsersIds })
            .then(response => {
                console.log(response);
            })
    },
    async getActualUser(state, VueComponent) {
        await VueComponent.$http.get(urlAuthUser)
            .then(response => {
                state.commit("setUser", response.body);
            })
    },
    logoutUser(state, VueComponent) {
        VueComponent.$http.post(urlUser + "logout", { user: state.getters.getUser })
            .then(response => {
                console.log(response);
            })
    },
    getUsersCount(state, VueComponent) {
        VueComponent.$http.get(urlUser + "count")
            .then(response => {
                state.commit("setUsersCount", response.data.count)
            })
    }
};

export default {
    state,
    mutations,
    actions,
    getters
}
