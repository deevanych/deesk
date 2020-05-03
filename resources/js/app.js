import Vue from 'vue';
import VueRouter from 'vue-router';
import VueI18n from 'vue-i18n';
import vueHeadFul from 'vue-headful';
import Skeleton from 'vue-loading-skeleton';
import VuePerfectScrollbar from 'vue-perfect-scrollbar';

import jquery from 'jquery';

window.$ = window.jQuery = jquery;

require('summernote');
require('bootstrap');
require('lodash');

import '../js/common';

import Summernote from '../views/app/summernote';

//app
import App from '../views/app/layout/app';
// home
import Home from '../views/app/index';
// header
import HeaderApp from '../views/app/layout/header';
// issues
import IssueShow from '../views/app/issues/show';
// login
import Login from '../views/app/auth/login';

window.axios = require('axios');
window.Vue = require('vue');
window.toastr = require('toastr');
window.header = {};

Vue.config.productionTip = false;

if (localStorage.getItem('_token')) {
    axios.defaults.headers.common['Authorization'] = localStorage.getItem('_token');
    window.userId = localStorage.getItem('user_id');
}

axios.interceptors.response.use(function (response) {
    return response
}, function (error) {
    if (error.response.status === 401 && router.currentRoute.name !== 'login') {
        router.push({name: 'login'});
    }
})

const defaultImpl = VueI18n.prototype.getChoiceIndex;

/**
 * @param choice {number} a choice index given by the input to $tc: `$tc('path.to.rule', choiceIndex)`
 * @param choicesLength {number} an overall amount of available choices
 * @returns number final choice index to select plural word by
 **/
VueI18n.prototype.getChoiceIndex = function (choice, choicesLength) {
    // this === VueI18n instance, so the locale property also exists here
    if (this.locale !== 'ru') {
        // proceed to the default implementation
        return defaultImpl.apply(this, arguments)
    }

    if (choice === 0) {
        return 0;
    }

    const teen = choice > 10 && choice < 20;
    const endsWithOne = choice % 10 === 1;

    if (!teen && endsWithOne) {
        return 1;
    }

    if (!teen && choice % 10 >= 2 && choice % 10 <= 4) {
        return 2;
    }

    return (choicesLength < 4) ? 2 : 3;
};

window.Vue.use(VueRouter);
window.Vue.use(VueI18n);
window.Vue.use(Skeleton)

Vue.component('header-app', HeaderApp);
Vue.component('vue-headful', vueHeadFul);
Vue.component('summernote', Summernote);
Vue.component('perfect', VuePerfectScrollbar);

const routes = [
    {
        path: '/',
        components: {
            default: App,
        },
        children: [
            {
                path: '/',
                name: 'home',
                components: {
                    default: Home,
                },
            },
            {
                path: '/issues/:id',
                name: 'issues',
                components: {
                    default: IssueShow,
                },
            },
            {
                path: '/users/:id',
                name: 'users',
                components: {
                    default: Home,
                },
            },
            {
                path: '/organizations/:id',
                name: 'organizations',
                components: {
                    default: Home
                },
            },
        ]
    },
    {
        path: '/login',
        name: 'login',
        components: {
            default: Login
        },
    },
    {
        path: '/logout',
        name: 'logout',
        beforeEnter: (to, from, next) => {
            localStorage.clear();
            axios.defaults.headers.common['Authorization'] = null;
            next({name: 'login'});
        }
    }
];

function isAuthenticated() {
    return false;
}

const messages = {
    ru: {
        message: {
            issuesCount: 'Нет заявок | {n} заявка | {n} заявки | {n} заявок',
        }
    },
};

// Create VueI18n instance with options
const i18n = new VueI18n({
    locale: 'ru', // set locale
    messages, // set locale messages
});

const router = new VueRouter({routes, mode: 'history'});

router.beforeEach((to, from, next) => {
    window.header.loading = true;
    next();
});

const app = new Vue({
    router,
    i18n
}).$mount('#app');
