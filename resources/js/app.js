import Vue from 'vue';
import VueRouter from 'vue-router';
import VueI18n from 'vue-i18n';
import VueHeadFul from 'vue-headful';
import Skeleton from 'vue-loading-skeleton';
import VuePerfectScrollbar from 'vue-perfect-scrollbar';
import Select2 from 'select2';
import Vuelidate from 'vuelidate';

import jquery from 'jquery';
import lottie from 'lottie-web';
import '../js/common';

// components
import Summernote from '../views/app/components/summernote';
import SelectComponent from '../views/app/components/select2';

//app
import App from '../views/app/layout/app';
// home
import Home from '../views/app/index';
// header
import HeaderApp from '../views/app/layout/header';
// issues
import IssueShow from '../views/app/issues/show';
import IssueCreate from '../views/app/issues/create';
// login
import Login from '../views/app/auth/login';
// settings
import Settings from '../views/app/settings/index';
// clients
import Clients from '../views/app/clients/index';
// organizations
import Organizations from '../views/app/organizations/show';

window.$ = window.jQuery = jquery;
lottie.setQuality('low');

require('summernote');
require('bootstrap');
require('lodash');

window.axios = require('axios');
window.Vue = require('vue');
window.toastr = require('toastr');
window.lottie = lottie;
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
window.Vue.use(Skeleton);
window.Vue.use(Vuelidate);

Vue.component('header-app', HeaderApp);
Vue.component('vue-headful', VueHeadFul);
Vue.component('summernote', Summernote);
Vue.component('perfect', VuePerfectScrollbar);
Vue.component('select2', SelectComponent);

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
                path: '/issues/create',
                name: 'issues.create',
                components: {
                    default: IssueCreate,
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
                name: 'organizations.show',
                components: {
                    default: Organizations,
                },
                // redirect: {
                //     name: 'organizations.activity'
                // },
                // children: [
                //     {
                //         path: '/organizations/:id/contacts',
                //         name: 'organizations.contacts',
                //         components: {
                //             default: () => import('../views/app/organizations/components/contacts'),
                //         },
                //     },
                //     {
                //         path: '/organizations/:id/issues',
                //         name: 'organizations.issues',
                //         components: {
                //             default: () => import('../views/app/organizations/components/issues'),
                //         },
                //     },
                //     {
                //         path: '/organizations/:id/activity',
                //         name: 'organizations.activity',
                //         components: {
                //             default: () => import('../views/app/organizations/components/activity'),
                //         },
                //     },
                //     {
                //         path: '/organizations/:id/objects',
                //         name: 'organizations.objects',
                //         components: {
                //             default: () => import('../views/app/organizations/components/objects'),
                //         },
                //     },
                // ],
            },
            {
                path: '/clients',
                name: 'clients',
                components: {
                    default: Clients
                },
                redirect: {
                    name: 'clients.organizations'
                },
                children: [
                    {
                        path: '/clients/organizations',
                        name: 'clients.organizations',
                        components: {
                            default: () => import('../views/app/clients/organizations'),
                        },
                    },
                ],
            },
            {
                path: '/settings',
                name: 'settings',
                components: {
                    default: Settings
                },
                redirect: {
                    name: 'settings.issues.types'
                },
                children: [
                    {
                        path: '/settings/types',
                        name: 'settings.issues.types',
                        components: {
                            default: () => import('../views/app/settings/issues/types'),
                        },
                    },
                    {
                        path: '/settings/priorities',
                        name: 'settings.issues.priorities',
                        components: {
                            default: () => import('../views/app/settings/issues/priorities'),
                        },
                    },
                    {
                        path: '/settings/statuses',
                        name: 'settings.issues.statuses',
                        components: {
                            default: () => import('../views/app/settings/issues/statuses'),
                        },
                    },
                    {
                        path: '/settings/rules',
                        name: 'settings.issues.rules',
                        components: {
                            default: () => import('../views/app/settings/issues/rules'),
                        },
                    },
                ],
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
            axios.get('/api/v1/logout')
                .then(function (response) {
                    if (response.data.status) {
                        localStorage.clear();
                        axios.defaults.headers.common['Authorization'] = null;
                        next({name: 'login'});
                    }
                });
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
