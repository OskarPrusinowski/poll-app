import Vue from 'vue'
import Vuex from 'vuex'
import users from './modules/users'
import companies from './modules/companies'
import campaigns from './modules/campaigns'

Vue.use(Vuex);


export default new Vuex.Store({
    modules:{
        users,
        companies,
        campaigns
    }
})
