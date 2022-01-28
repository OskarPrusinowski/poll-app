import Vue from 'vue'
import Vuex from 'vuex'


Vue.use(Vuex);

const urlUser="http://127.0.0.1:8000/api/user/";
const urlCompany="http://127.0.0.1:8000/api/company/";

export default new Vuex.Store({
    state:{
        users:[],
        user:{
            id:0,
            name:"",
            surname:"",
            login:"",
            email:"",
            password:"",
            password_confirmation:"",
            company_id:0
        },
        companies:[],
        company:{
            id:0,
            name:"",
            compressed_name:"",
            description:""
        },
        ok:true
    },
    mutations:{
        setUsers(state,data){
            state.users=data;
        },
        setUser(state,data){
            state.user=data;
        },
        setUserId(state,data){
            state.user.id=data;
        },
        setUserName(state,data){
            state.user.name=data;
        },
        setUserSurname(state,data){
            state.user.surname=data;
        },
        setUserLogin(state,data){
            state.user.login=data;
        },
        setUserEmail(state,data){
            state.user.email=data;
        },
        setUserPassword(state,data){
            state.user.password=data;
        },
        setUserPasswordConfirmation(state,data){
            state.user.password_confirmation=data;
        },
        setCompanies(state,data){
            state.companies=data;
        },
        setCompany(state,data){
            state.company=data;
        },
        setCompanyId(state,data){
            state.company.id=data;
        },
        setCompanyName(state,data){
            state.company.name=data;
        },
        setCompanyCompressedName(state,data){
            state.company.compressed_name=data;
        },
        setCompanyDescription(state,data){
            state.company.description=data;
        },
        setOk(state,data){
            state.ok=data;
        }
    },
    actions:{
        async getUsers(state,VueComponent){
            VueComponent.$http.get(urlUser+"list")
            .then(response=>{
                state.commit("setUsers",response.data.users);
            })
        },
        async createUser(state,VueComponent){
            VueComponent.$http.post(urlUser+"create",{user:state.getters.getUser})
            .then(response=>{
                state.commit("setOk",true);
                console.log(response);
            })
            .catch(error=>{
                state.commit("setOk",false);
                console.log(error);
            })
        },
        async deleteUser(state,VueComponent){
            const id=state.getters.getUserId;
            VueComponent.$http.delete(urlUser+"delete/"+id)
            .then(response=>{
                console.log(response);
            })
        },
        async fetchUserInit(state){
            state.commit("setUserName","");
            state.commit("setUserSurname","");
            state.commit("setUserLogin","");
            state.commit("setUserEmail","");
            state.commit("setUserPassword","");
            state.commit("setUserPasswordConfirmation","");
        },
        async getCompanies(state,VueComponent){
            VueComponent.$http.get(urlCompany+"list")
            .then(response=>{
                state.commit("setCompanies",response.data.companies);
            })
        },
        async createCompany(state,VueComponent){
            VueComponent.$http.post(urlCompany+"create",{company:state.getters.getCompany})
            .then(response=>{
                console.log(response);
                state.commit("setOk",true);
            })
            .catch(error=>{
                console.log(error);
                state.commit("setOk",false);
            })
        },
        async deleteCompany(state,VueComponent){
            const id=state.getters.getCompanyId;
            VueComponent.$http.delete(urlCompany+"delete/"+id)
            .then(response=>{
                console.log(response);
            })
        },
        async fetchCompanyInit(state){
            state.commit("setCompanyName","");
            state.commit("setCompanyCompressedName","");
            state.commit("setCompanyDescription","");
        },
        async updateUser(state,VueComponent){
            const id=state.getters.getUserId;
            VueComponent.$http.put(urlUser+"update/"+id,{user:state.getters.getUser})
            .then(response=>{
                state.commit("setOk",true);
                console.log(response)
            })
            .catch(error=>{
                console.log(error);
                state.commit("setOk",false);
            })
        },
        getUser(state,VueComponent){
        const id =state.getters.getUserId;
        VueComponent.$http.get(urlUser+"show/"+id)
        .then(response=>{
            state.commit("setUser",response.data.user);
            console.log(response);
        })
        .catch(error=>{
            console.log(error);
        })
        },
        getCompany(state,VueComponent){
            const id=state.getters.getCompanyId;
            VueComponent.$http.get(urlCompany+"show/"+id)
            .then(response=>{
                state.commit("setCompany",response.data.company);
                console.log(response);
            })
        },
        updateCompany(state,VueComponent){
            const id = state.getters.getCompanyId;
            VueComponent.$http.put(urlCompany+"update/"+id,{company:state.getters.getCompany})
            .then(response=>{
                console.log(response);
                state.commit("setOk",true);
            })
            .catch(error=>{
                console.log(error);
                state.commit("setOk",false);
            })
        }
    },
    getters:{
        getUsers : state=>state.users,
        getUser : state=>state.user,
        getUserId : state=>state.user.id,
        getCompanies : state=>state.companies,
        getCompany : state=>state.company,
        getCompanyId : state=>state.company.id,
        getCompanyName : state=>state.company.name,
        getCompanyCompressedName : state=>state.company.compressed_name,
        getCompanyDescription : state=>state.company.description,
        getOk : state=>state.ok,
    }
})
