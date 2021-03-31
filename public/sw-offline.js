// importScripts('https://storage.googleapis.com/workbox-cdn/releases/5.0.0/workbox-sw.js');
importScripts('https://storage.googleapis.com/workbox-cdn/releases/4.1.1/workbox-sw.js');


// workbox.skipWaiting()
// workbox.clientsClaim()
// workbox.routing.precacheAndRoute()
// fonts

// workbox.recipes.offlineFallback();

// pre-cache pages
workbox.precaching.precacheAndRoute([
    {url: '/hills'},
])

const FALLBACK_HTML_URL = '/offline.html';


workbox.routing.registerRoute(
    new RegExp('https://fonts.*'),
    workbox.strategies.cacheFirst({
        cacheName: 'fonts',
        plugins: [
            new workbox.cacheableResponse.Plugin({
                statuses: [0, 200]
            })
        ]
    })
)
 
// google stuff
workbox.routing.registerRoute(
    new RegExp('.*(?:googleapis|gstatic).com.*$'),
    workbox.strategies.networkFirst({
        cacheName: 'google'
    })
)
 
// static
workbox.routing.registerRoute(
    new RegExp('.(?:js|css|ico)$'),
    workbox.strategies.networkFirst({
        cacheName: 'static'
    }),
)

// workbox.routing.registerRoute(
//     '/',
//     workbox.strategies.staleWhileRevalidate({
//         cacheName: 'pages'
//     })
// );
  

workbox.routing.registerRoute(
    new RegExp('/(.*)hills/(.*)'),
    workbox.strategies.staleWhileRevalidate({
        cacheName: 'hills'
    })
);
   
 
// images
workbox.routing.registerRoute(
    new RegExp('.(?:jpg|png|gif|svg)$'),
    workbox.strategies.cacheFirst({
        cacheName: 'images',
        plugins: [
            new workbox.expiration.Plugin({
                maxEntries: 20,
                purgeOnQuotaError: true,
            })
        ]
    })
)

self.__WB_MANIFEST
