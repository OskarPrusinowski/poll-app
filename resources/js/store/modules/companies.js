const urlCompany = "http://127.0.0.1:8000/main-api/companies/";

const state = {
    companies: [],
    companiesIds:[],
    company: {
        id: 0,
        name: "",
        compressed_name: "",
        description: ""
    },
};

const getters = {
    getCompanies: state => state.companies,
    getCompaniesIds: state => state.companiesIds,
    getCompany: state => state.company,
    getCompanyId: state => state.company.id,
    getCompanyName: state => state.company.name,
    getCompanyCompressedName: state => state.company.compressed_name,
    getCompanyDescription: state => state.company.description,
    getOk: state => state.ok,
};

const mutations = {
    setCompanies(state, data) {
        state.companies = data;
    },
    setCompany(state, data) {
        state.company = data;
    },
    setCompanyId(state, data) {
        state.company.id = data;
    },
    setCompanyName(state, data) {
        state.company.name = data;
    },
    setCompanyCompressedName(state, data) {
        state.company.compressed_name = data;
    },
    setCompanyDescription(state, data) {
        state.company.description = data;
    },
    setCompaniesIds(state,data){
        state.companiesIds=data;
    }
};

const actions = {
    async getCompanies(state, VueComponent) {
        VueComponent.$http.get(urlCompany + "list")
            .then(response => {
                state.commit("setCompanies", response.data.companies);
                console.log(response.data.companies)
            })
    },
    async createCompany(state, VueComponent) {
        VueComponent.$http.post(urlCompany + "create", { company: state.getters.getCompany })
            .then(response => {
                console.log(response);
                state.commit("setOk", true);
            })
            .catch(error => {
                console.log(error);
                state.commit("setOk", false);
            })
    },
    async deleteCompany(state, VueComponent) {
        const id = state.getters.getCompanyId;
        VueComponent.$http.delete(urlCompany + "delete/" + id)
            .then(response => {
                console.log(response);
            })
    },
    async fetchCompanyInit(state) {
        state.commit("setCompanyName", "");
        state.commit("setCompanyCompressedName", "");
        state.commit("setCompanyDescription", "");
    },
    getCompany(state, VueComponent) {
        const id = state.getters.getCompanyId;
        VueComponent.$http.get(urlCompany + "show/" + id)
            .then(response => {
                state.commit("setCompany", response.data.company);
                console.log(response);
            })
    },
    updateCompany(state, VueComponent) {
        const id = state.getters.getCompanyId;
        VueComponent.$http.put(urlCompany + "update/" + id, { company: state.getters.getCompany })
            .then(response => {
                console.log(response);
                state.commit("setOk", true);
            })
            .catch(error => {
                console.log(error);
                state.commit("setOk", false);
            })
    },
    deleteCompanies(state,VueComponent){
        VueComponent.$http.post(urlCompany+"delete",{ids:state.getters.getCompaniesIds})
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
