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

// home
import Home from '../views/app/index';
// header
import HeaderApp from '../views/app/layout/header';
// issues
import IssueShow from '../views/app/issues/show';

window.axios = require('axios');
window.Vue = require('vue');
window.toastr = require('toastr');
window.header = {};

Vue.config.productionTip = false;

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
        name: 'home',
        meta: {
            title: 'Главная'
        },
        components: {
            default: Home,
        }
    },
    {
        path: '/users/:id',
        name: 'users',
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
        path: '/organizations/:id',
        name: 'organizations',
        components: {
            organizationShow: Home
        },
    },
];

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
    next()
});

const app = new Vue({
    router,
    i18n
}).$mount('#app');
