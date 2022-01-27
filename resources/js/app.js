import Vue from 'vue'
import routes from './routes'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'

window.Vue = require('vue').default;

Vue.use(VueRouter);
Vue.use(VueResource);

const app = new Vue({
    el: '#app',
    router:new VueRouter(routes)
});
