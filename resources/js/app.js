/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VueRouter from 'vue-router'

import Vue from 'vue'
import App from './App.vue'
import Home from './views/Home.vue';

import Hills from './views/hills/Hills.vue';
import ShowHill from './views/hills/ShowHill.vue';

import Users from './views/users/Users.vue';
import ShowUser from './views/users/ShowUser.vue';

import Trips from './views/trips/Trips.vue';
import ShowTrip from './views/trips/ShowTrip.vue';


import Login from './views/Login.vue';

import PageNotFound from './views/PageNotFound.vue';





Vue.use(VueRouter)


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


const routes = [
    { 
      path: '/', 
      name: 'Home',
      component: Home 
    },
    { 
        path: '/hills', 
        name: 'Hills',
        component: Hills 
      },
    {
        path: '/users',
        name: 'Users',
        component: Users
    },
    {
        path: '/my-profile',
        name: 'My profile',
        component: ShowUser
    },
    {
      path: '/user/:id',
      name: 'ShowUser',
      component: ShowUser
    },
    {
      path: '/hill/:id',
      name: 'ShowHill',
      component: ShowHill
    },
    {
      path: '/trips',
      name: 'Trips',
      component: Trips
    },
    {
      path: '/trip/:id',
      name: 'ShowTrip',
      component: ShowTrip
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: "*",
      name: '404',
      component: PageNotFound
    }
    
  ]
  const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: 'history'
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
});
