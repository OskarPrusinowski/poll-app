import { Store } from "vuex";

const urlCampaign = "http://127.0.0.1:8000/main-api/campaigns/";
const urlContatcs = "http://127.0.0.1:8000/main-api/contacts/";

const state={
    campaign:{
        id:0,
        name:"",
        comunication_type:"",
        date_registration:0,
        file_name:"",
        company_id:0,
        is_contact_list:false,
        date_published:0,
        contacts:[]
    },
    file:""
};
const getters={
    getCampaign: state=>state.campaign,
    getCampaignId: state=>state.campaign.id,
    getFile: state=>state.file,
    getCampaignContacts: state=>state.campaign.contacts
};
const mutations={
    setCampaign(state, data) {
        state.campaign = data;
    },
    setCampaignId(state,data){
        state.campaign.id=data;
    },
    setFile(state,data){
        state.file=data;
    },
    setIsContactList(state,data){
        state.campaign.is_contact_list=data;
    }
};
const actions={
    createCampaign(state,VueComponent){
        VueComponent.$http.post(urlCampaign+"create",{campaign:state.getters.getCampaign}).
        then(response=>{
            console.log(response)
        })
    },
    addFile(state,VueComponent){
        const fd = new FormData();
        fd.append("file",state.getters.getFile)
        fd.append("id",state.getters.getCampaignId)
        VueComponent.$http.post(urlCampaign+"add",fd)
        .then(response=>{
            console.log(response);
        })
    },
    importContacts(state,VueComponent){
        const fd = new FormData();
        fd.append("file",state.getters.getFile)
        fd.append("id",state.getters.getCampaignId)
        VueComponent.$http.post(urlContatcs+"import",fd)
        .then(response=>{
            console.log(response);
        })
    },
    releaseCampaign(state,VueComponent){
        VueComponent.$http.post(urlCampaign+"release",{campaign:state.getters.getCampaign})
        .then(response=>{
            console.log(response)
        })
    },
    updateCampaign(state,VueComponent){
        const id = state.getters.getCampaignId;
        VueComponent.$http.post(urlCampaign+"update/"+id,{campaign:state.getters.getCampaign,id:id})
        .then(response=>{
            console.log(response);
        })
    },
    getCompaign(state,VueComponent){
        const id= state.getters.getCampaignId;
        VueComponent.$http.get(urlCampaign+"show/"+id)
        .then(response=>{
            state.commit("setCampaign",response.data.campaign);
            console.log(response.data.campaign);
        })
    }
};


export default {
    state,
    mutations,
    actions,
    getters
}
