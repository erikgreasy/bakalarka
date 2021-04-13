import Home from './views/Home.vue';

import Hills from './views/hills/Hills.vue';
import ShowHill from './views/hills/ShowHill.vue';

import Users from './views/users/Users.vue';
import ShowUser from './views/users/ShowUser.vue';

import Trips from './views/trips/Trips.vue';
import ShowTrip from './views/trips/ShowTrip.vue';


import Login from './views/Login.vue';

import PageNotFound from './views/PageNotFound.vue';

export default [
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