import { precacheAndRoute } from 'workbox-precaching';
import { registerRoute } from 'workbox-routing';
import { NavigationRoute } from 'workbox-routing';
import * as navigationPreload from 'workbox-navigation-preload';
import { NetworkFirst, NetworkOnly, StaleWhileRevalidate, CacheFirst } from 'workbox-strategies';
import { CacheableResponsePlugin } from 'workbox-cacheable-response';
import { ExpirationPlugin } from 'workbox-expiration';
import { openDB } from 'idb';
import { googleFontsCache, imageCache } from 'workbox-recipes';
// import { googleFontsCache } from 'workbox-recipes';


precacheAndRoute(self.__WB_MANIFEST || []);

const DB_VERSION = 2;

const CACHE_NAME = 'offline-html';
const FALLBACK_HTML_URL = '/app-shell';
self.addEventListener('install', async (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => {
                cache.add(FALLBACK_HTML_URL)
                cache.add('/offline')

            })
    );
});

self.addEventListener('activate', function (event) {
    createDB()
    event.waitUntil(
        caches.keys().then(function (cacheNames) {
            return Promise.all(
                cacheNames.filter(function (cacheName) {
                    // Return true if you want to remove this cache,
                    // but remember that caches are shared across
                    // the whole origin
                    // return true
                }).map(function (cacheName) {
                    return caches.delete(cacheName);
                })
            );
        })
    );
});

navigationPreload.enable();
const networkOnly = new NetworkOnly();
const navigationHandler = async (params) => {
    try {
        // Attempt a network request.
        return await networkOnly.handle(params);
    } catch (error) {
        // If it fails, return the cached HTML.
        return caches.match(FALLBACK_HTML_URL, {
            cacheName: CACHE_NAME,
        });
    }
};

registerRoute(
    new NavigationRoute(navigationHandler)
)


imageCache();
googleFontsCache();


// ========
// API 
//=========

const wishlistHandler = new NetworkFirst({
    cacheName: 'wishlist-cache',
});

registerRoute(/(.*)\/api\/wishlist/, args => {
    return wishlistHandler.handle(args).then(response => {

        // if (!response) {
        //   return caches.match('pages/offline.html');
        // } else if (response.status === 404) {
        //   return caches.match('pages/404.html');
        // }
        return response;
    });
});

registerRoute(/(.*)\/api\/users$/, ({ url, event, params }) => {
    return fetch(event.request)
        .then(response => {
            console.log(event.request)
            let clonedResponse = response.clone();
            clonedResponse.json().then(body => {
                openDB('Turista', DB_VERSION).then(db => {
                    body.forEach(user => {
                        db.put('users', {
                            id: user.id,
                            name: user.name,
                            avatar_path: user.avatar_path
                        });
                    });
                });
            });
            return response;
        }).catch(err => {
            return openDB('Turista', DB_VERSION).then(db => {
                return db.transaction('users')
                    .objectStore('users').getAll()
                    .then(values => {
                        console.log(values);
                        return new Response(JSON.stringify(values),
                            {
                                "status": 200,
                                "statusText": "MyCustomResponse!"
                            });
                    })
            });
        });
});


registerRoute(/(.*)\/api\/hills/, ({ url, event, params }) => {
    return fetch(event.request)
        .then(response => {
            let clonedResponse = response.clone();
            clonedResponse.json().then(body => {
                openDB('Turista', DB_VERSION).then(db => {
                    body.forEach(hill => {
                        db.put('hills', {
                            id: hill.id,
                            name: hill.name,
                            height: hill.height,
                            description: hill.description,
                            thumbnail_path: hill.thumbnail_path
                        });
                    });
                });
            });
            return response;
        }).catch(err => {
            return openDB('Turista', DB_VERSION).then(db => {
                return db.transaction('hills')
                    .objectStore('hills').getAll()
                    .then(values => {
                        console.log(values);
                        return new Response(JSON.stringify(values.reverse()),
                            {
                                "status": 200,
                                "statusText": "OK"
                            });
                    })
            });
        });
});


registerRoute(/(.*)\/api\/hill\/[0-9]+$/, ({ url, event, params }) => {
    return fetch(event.request)
        .then(response => {
            let clonedResponse = response.clone();
            clonedResponse.json().then(body => {
                openDB('Turista', DB_VERSION).then(db => {
                    console.log(body)
                    var hill = body.data;
                    db.put('hills', {
                        id: hill.id,
                        name: hill.name,
                        height: hill.height,
                        description: hill.description,
                        thumbnail_path: hill.thumbnail_path,
                        favoriteOrder: hill.favoriteOrder,
                        trips: hill.trips
                    });
                });
            });

            return response;
        }).catch(err => {
            return openDB('Turista', DB_VERSION).then(db => {

                // Get hill id from url
                let splitted = url.pathname.split('/')
                let hillId = parseInt(splitted[splitted.length - 1])

                return db.transaction('hills')
                    .objectStore('hills').get(hillId)
                    .then(values => {
                        // console.log('id hory znovu')
                        // console.log(hillId)
                        // console.log('vraciam tuto krasku na /hill/')
                        // console.log(values)
                        return new Response(JSON.stringify({data: values}),
                            {
                                "status": 200,
                                "statusText": "OK"
                            });
                    })
            });
        });
});

registerRoute(/(.*)\/api\/trips/, ({ url, event, params }) => {
    return fetch(event.request)
        .then(response => {
            let clonedResponse = response.clone();
            clonedResponse.json().then(body => {
                openDB('Turista', DB_VERSION).then(db => {
                    console.log(body)
                    body.data.forEach(trip => {
                        db.put('trips', {
                            id: trip.id,
                            title: trip.title,
                            date: trip.date,
                            distance: trip.distance,
                            duration: trip.duration,
                            description: trip.description,
                            thumbnail_path: trip.thumbnail_path,
                        });
                    });
                });
            });
            return response;
        }).catch(err => {
            return openDB('Turista', DB_VERSION).then(db => {
                return db.transaction('trips')
                    .objectStore('trips').getAll()
                    .then(values => {
                        console.log(values);
                        return new Response(JSON.stringify({data: values.reverse() }),
                            {
                                "status": 200,
                                "statusText": "OK"
                            });
                    })
            });
        });
});




// SINGLE
registerRoute(/(.*)\/api\/user\/[0-9]+$/, ({ url, event, params }) => {
    return fetch(event.request)
        .then(response => {
            let clonedResponse = response.clone();
            clonedResponse.json().then(body => {
                openDB('Turista', DB_VERSION).then(db => {
                    var user = body.data;
                    db.put('users', {
                        id: user.id,
                        name: user.name,
                        avatar_path: user.avatar_path
                    });
                });
            });
            return response;
        }).catch(err => {
            return openDB('Turista', DB_VERSION).then(db => {
                // Get hill id from url
                let splitted = url.pathname.split('/')
                let userId = parseInt(splitted[splitted.length - 1])
                // console.log('user cislo' + userId)

                return db.transaction('users')
                    .objectStore('users').get(userId)
                    .then(values => {
                        // console.log('dostal som z idb usera')
                        // console.log(values)
                        return new Response(JSON.stringify({ data: values }),
                            {
                                "status": 200,
                                "statusText": "OK"
                            });
                    })
            });
        });
});



// SINGLE
registerRoute(/(.*)\/api\/trip\/[0-9]+$/, ({ url, event, params }) => {
    return fetch(event.request)
        .then(response => {
            let clonedResponse = response.clone();
            clonedResponse.json().then(body => {
                openDB('Turista', DB_VERSION).then(db => {
                    console.log(body)
                    var trip = body;
                    db.put('trips', {
                        id: trip.id,
                        title: trip.title,
                        date: trip.date,
                        distance: trip.distance,
                        duration: trip.duration,
                        description: trip.description,
                        thumbnail_path: trip.thumbnail_path,
                        user: trip.user,
                        hill: trip.hill
                    });
                });
            });
            return response;
        }).catch(err => {
            return openDB('Turista', DB_VERSION).then(db => {
                // Get hill id from url
                let splitted = url.pathname.split('/')
                let tripId = parseInt(splitted[splitted.length - 1])
                // console.log('user cislo' + userId)

                return db.transaction('trips')
                    .objectStore('trips').get(tripId)
                    .then(values => {
                        console.log('dostal som z idb trip')
                        // console.log(values)
                        return new Response(JSON.stringify(values),
                            {
                                "status": 200,
                                "statusText": "OK"
                            });
                    })
            });
        });
});


async function createDB() {
    const db = await openDB('Turista', DB_VERSION, {
        upgrade(db) {
            // Create a store of objects
            db.createObjectStore('users', {
                // The 'id' property of the object will be the key.
                keyPath: 'id',
            });
            db.createObjectStore('hills', {
                // The 'id' property of the object will be the key.
                keyPath: 'id',
            });
            db.createObjectStore('trips', {
                // The 'id' property of the object will be the key.
                keyPath: 'id',
            });
        },
    });
}


registerDefaultHandler(new StaleWhileRevalidate());