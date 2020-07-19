import VueRouter from 'vue-router';
import HeaderComponent from "./components/HeaderComponent";
import AccountComponent from "./components/AccountComponent";
import timelineComponent from "./components/timelineComponent";
import AccountShowComponent from "./components/AccountShowComponent";
import AccountEditComponent from "./components/AccountEditComponent";
import AccountCreateComponent from "./components/AccountCreateComponent";

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('header-component', HeaderComponent);

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/account_list',
            name: 'account.list',
            component: AccountComponent
        },
        {
            path: '/timeline_list',
            name: 'timeline.list',
            component: timelineComponent
        },
        {
            path: '/account_show/:value',
            name: 'account.show',
            component: AccountShowComponent
        },
        {
            path: '/account_edit/:value',
            name: 'account.edit',
            component: AccountEditComponent
        },
        {
            path: '/account_create',
            name: 'account.create',
            component: AccountCreateComponent
        },
    ]
});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
};
