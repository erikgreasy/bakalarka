/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import axios from 'axios';
import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'


import App from './App.vue'
import routes from './routes';
// import user from './store/modules/user'

Vue.use(VueRouter)
Vue.use(Vuex);

var store = new Vuex.Store({
    state: {
        loggedUser: {},
        users: [],
        hills: [],
        trips: []
    },
    mutations: {
        setUser(state, payload) {
            state.loggedUser = payload
        },
        setUsers(state, payload) {
            state.users = payload
        },
        setHills(state, payload) {
            state.hills = payload
        },
        setTrips(state, payload) {
            state.trips = payload
        }
    },
    actions: {
        setLoggedUser(state) {
            axios.get('/api/user')
                .then(res => {
                    state.commit('setUser', res.data)
                    console.log('ukladam loggnuteho usera do local storage')
                    localStorage.setItem('loggedUser', JSON.stringify(res.data));
                })
                .catch(err => {
                    let user = JSON.parse( localStorage.getItem('loggedUser') )
                    console.log('gettujem log usera z local storage')
                    console.log(user)
                    state.commit('setUser', user)
                })
        },
        setUsers(state) {
            axios.get('/api/users')
                .then(res => {
                    state.commit('setUsers', res.data)
                })
        },
        setHills(state) {
            axios.get('/api/hills')
                .then(res => {
                    state.commit('setHills', res.data)
                })
        },
        setTrips(state) {
            axios.get('/api/trips')
                .then(res => {
                    state.commit('setTrips', res.data)
                })
        }
    },
    getters: {
        getLoggedUser(state) {
            return state.loggedUser;
        },
        allUsers(state) {
            return state.users;
        },
        allHills(state) {
            return state.hills
        },
        allTrips(state) {
            return state.trips
        }
    }
});



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);


const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: 'history',
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});

/**
 * REGISTER SERVICE WORKER
 */
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/sw.js').then(function(registration) {
            // Registration was successful
            console.log('ServiceWorker registration successful with scope: ', registration.scope);
        }, function(err) {
            // registration failed :(
            console.error('ServiceWorker registration failed: ', err);
        });
    });
} else {
    console.log('service worker not working')
}
