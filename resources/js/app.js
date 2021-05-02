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
        users: []
    },
    mutations: {
        setUser(state, payload) {
            state.loggedUser = payload
        },
        setUsers(state, payload) {
            state.users = payload
        }
    },
    actions: {
        setLoggedUser(state) {
            axios.get('/api/user')
                .then(res => {
                    state.commit('setUser', res.data)
                })
        },
        setUsers(state) {
            axios.get('/api/users')
                .then(res => {
                    state.commit('setUsers', res.data)
                })
        }
    },
    getters: {
        getLoggedUser(state) {
            return state.loggedUser;
        },
        allUsers(state) {
            return state.users;
        }
    }
});

// Create store



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


// const { data } = require('jquery');
// var id, options;
// import 'slick-carousel';

// require('./bootstrap');

// var moment = require('moment');

// var distance = 0;
// var lastCoords = null;

// $('#remove-thumbnail').click(function(e) {
//     if(confirm('Naozaj chcete odstrániť náhľadový obrázok?')) {
//         $('input[name=remove_thumbnail]').val('true')
//         $('input#thumbnail').show()
//         $('img#trip-thumbnail').hide()
//         $(this).hide()
//     }
// })

// /**
//  * REGISTER SERVICE WORKER
//  */
// if ('serviceWorker' in navigator) {
//     window.addEventListener('load', function() {
//         navigator.serviceWorker.register('/serviceWorker.js').then(function(registration) {
//             // Registration was successful
//             console.log('ServiceWorker registration successful with scope: ', registration.scope);
//         }, function(err) {
//             // registration failed :(
//             console.error('ServiceWorker registration failed: ', err);
//         });
//     });
// }


// $( '.floating-btn' ).on( 'click', function() {
//     console.log( 'hop' )
//     console.log( $( '.floating-btn-option' ) )
//     const optionsHeight = $( '.floating-btn-options' ).height() - 62
//     console.log( optionsHeight + 'px' )
//     $( 'body' ).toggleClass( 'floating-options-opened' )
//     $( '.floating-btn-options' ).toggleClass( 'active' )
    
//     if( $('body').hasClass('floating-options-opened') ) {
//         $( this ).css({
//             transform: `translateY(-${optionsHeight}px)`
//         })
//     } else {
//         $( this ).css({
//             transform: `translateY(0)`
//         })
//     }
// } )

// // SLICK
// $('.wishlist-cards').slick({
//     infinite: false,
//     slidesToShow: 1.5,
//     arrows: false,
//     mobileFirst: true,
//     responsive: [
//         {
//             breakpoint: 767,
//             settings: {
//                 slidesToShow: 3
//             }
//         },
//         {
//             breakpoint: 992,
//             settings: {
//                 slidesToShow: 4
//             }
//         },
//         {
//             breakpoint: 1200,
//             settings: {
//                 slidesToShow: 5
//             }
//         }
//     ]
// })

// $('.trip-detail .trip-images').slick({
//     infinite: false,
//     slidesToShow: 1.5,
//     arrows: false,
    
// })
// $('.users').slick({
//     infinite: false,
//     slidesToShow: 2.5,
//     mobileFirst: true,
//     responsive: [
//         {
//             breakpoint: 767,
//             settings: {
//                 slidesToShow: 3
//             }
//         },
//         {
//             breakpoint: 992,
//             settings: {
//                 slidesToShow: 5
//         }
//         }
//     ]
// })



// function startTrip() {
    
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });

//     // POST request to /trips -> store method in Trip Controller gets called
//     return $.ajax({
//         type:'POST',
//         data: { 
//             date: moment().format( 'Y-M-D HH:mm:ss' ),
//             title: 'New trip ' + moment().format( 'Y-M-D HH:mm:ss' ),
//             description: 'Add description',
//             hill: hill_id

//         },
//         url:"/trips",

//         success:function( response ){
//             trip_id = response.trip_id 
//         },
//         error: function( xhr, status, error ) {
//             let err = JSON.parse(xhr.responseText)
//             console.log( err )
//         }
//     });
// }

// var trip_id;
// let interval;
// var startTime;
// $('#startTrip').on( 'click', function() {
//     $(this).hide()
//     $('#stopTrip').show()
//     startTrip()
//         .then( response => {
//             console.log( response )
//             trip_id = response.trip_id;
//             startTime = new Date();

//             var intervalID = window.setInterval(trackTime, 1000);
//             id = navigator.geolocation.watchPosition(success, error, options);
        
//     } )
//         .catch( error => {
//             $('#stopTrip').hide()

//             alert( 'error occured' )

//         } )
// } )

// Notification.requestPermission().then(function(result) {
//     console.log(result);
// });
// // var notification = new Notification('kerestapo', { body: 'body' });

// function trackTime() {
//     var timeNow = new Date();

//     var secondsPassed = parseInt( (timeNow - startTime) / 1000 );
//     var hours = parseInt( secondsPassed / 3600 ).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping:false});
//     secondsPassed -= parseInt( hours * 3600 );
//     var minutes = parseInt( secondsPassed / 60 ).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping:false});
//     secondsPassed -= parseInt( minutes * 60 )
//     var seconds = secondsPassed.toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping:false});
//     $( '.time .time-tracker' ).html(`${hours}:${minutes}:${seconds}`)
// }

// $('#stopTrip').on( 'click', function() {
//     console.log( 'trip ended' )
//     $(this).hide()
    
//     // clearInterval( interval )
//     navigator.geolocation.clearWatch( id )
//     $.ajax({
//         type: 'POST',
//         data: {
//             trip_id: trip_id, 
//             duration: parseInt(new Date() - startTime) / 1000,
//             distance: distance
//         },

//         url: "/trips/" + trip_id + "/end-trip",
//         success: function() {
//             alert('success')
//         },
//         error: function() {
//             alert('error')
//         }

//     })
//     // alert(parseInt(new Date() - startTime) / 1000 + 'sekund' )

//     window.location.replace("/trips/" + trip_id);
// } )


// function degreesToRadians(degrees) {
//     return degrees * Math.PI / 180;
// }

// function countDistance(lat1, lon1, lat2, lon2) {
//     var earthRadiusKm = 6371;
//     var dLat = degreesToRadians(lat2-lat1);
//     var dLon = degreesToRadians(lon2-lon1);

//     lat1 = degreesToRadians(lat1);
//     lat2 = degreesToRadians(lat2);

//     var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
//             Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
//     var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
//     return earthRadiusKm * c;
// }

// function success(pos) {
//     var crd = pos.coords;
//     var speed = crd.speed;
//     var speedHTML = $('.speed h3');
//     var distanceHTML = $('.distance h3');
//     // distance += 10;
//     if(lastCoords) {
//         distance += countDistance( lastCoords.latitude, lastCoords.longitude, crd.latitude, crd.longitude )
//         // distance += 5;
//     }
//     lastCoords = crd;
//     console.log( `last coords: ${lastCoords}` )


//     if( !speed ) {
//         speed = 0;
//     } else {
//         // get speed in KM/H
//         speed = speed * (8/15);
//     }
    
//     speedHTML.text(parseFloat(speed).toFixed(1))
//     distanceHTML.text( parseFloat(distance).toFixed(2) );

//     console.log( trip_id )
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     $.ajax({
//         type:'POST',
//         data: { 
//             trip_id: trip_id, 
//             lat : crd.latitude, 
//             long : crd.longitude,
//             speed : speed
//         },
//         // url:"{{ route('ajaxRequest.post') }}",
//         url:"/hills/"+ hill_id +"/track",

//         success:function(){
//             console.log( { trip_id: trip_id, lat : crd.latitude, long : crd.longitude } );
//         },
//         error: function( xhr, status, error ) {
//             let err = JSON.parse(xhr.responseText)
//             console.log( err )
//         }
//     });
// }
