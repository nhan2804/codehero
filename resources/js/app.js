
require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router'
import { routes }  from './index';
Vue.use(VueRouter);
Vue.prototype.$scrollToTop = () => window.scrollTo(0,0);
const router = new VueRouter({
    mode: 'hash',
    // mode: 'history',
    routes,
    scrollBehavior() {
        document.getElementById('app').scrollIntoView();
    }
})
const app = new Vue({
    el: '#app',
    router
});
