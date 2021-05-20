import Home from './views/Home.vue';

import Hills from './views/hills/Hills.vue';
import ShowHill from './views/hills/ShowHill.vue';

import Users from './views/users/Users.vue';
import ShowUser from './views/users/ShowUser.vue';
import EditUser from './views/users/EditUser.vue';
import MyProfile from './views/users/MyProfile.vue';

import Trips from './views/trips/Trips.vue';
import ShowTrip from './views/trips/ShowTrip.vue';
import EditTrip from './views/trips/EditTrip.vue';
import CreateTrip from './views/trips/CreateTrip.vue';
import Track from './views/trips/Track.vue';

//import Login from './views/Login.vue';
//import Register from './views/Register.vue';



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
        component: MyProfile
    },
    {
        path: '/user/:id',
        name: 'ShowUser',
        component: ShowUser
    },
    {
        path: '/user/:id/edit',
        name: 'EditUser',
        component: EditUser
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
        path: '/trip/:id/edit',
        name: 'EditTrip',
        component: EditTrip
    },
    {
        path: '/trips/create',
        name: 'CreateTrip',
        component: CreateTrip,
        props: true
    },
    {
        path: '/track',
        name: 'Track',
        component: Track,
        props: true
    },
    {
        path: "*",
        name: '404',
        component: PageNotFound
    }
]