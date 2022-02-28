import Vue from 'vue'
import routes from './routes'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import mainVue from './components/mainVue'
import Vuetify from '../plugins/vuetify'

window.Vue = require('vue').default;

Vue.use(VueRouter);
Vue.use(VueResource);



Vue.http.interceptors.push((request) => {
    let token = document.head.querySelector('meta[name="csrf-token"]');
    if (token) {
        request.headers.set("X-CSRF-TOKEN", token.content);
    }
});

const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
    router: new VueRouter(routes),
    components: {
        mainVue
    }
});

