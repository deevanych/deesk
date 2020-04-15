require('bootstrap');
require('lodash');

window.axios = require('axios');
window.Vue = require('vue');

Vue.prototype.trans = (key) => {
    return _.get(window.trans, key, key);
};

import VueRouter from 'vue-router';
import IssueList from '../views/components/issues/list';
import ClientList from '../views/components/clients/list';

window.Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'home',
        components: {
            issueList: IssueList,
            clientList: ClientList
        },
    },
    {
        path: '/def',
        name: 'def',
        components: {
            issueList: IssueList,
        },
    },
]

const router = new VueRouter({routes})

const app = new Vue({router}).$mount('#app')
