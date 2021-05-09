import { precacheAndRoute } from 'workbox-precaching';
import { registerRoute } from 'workbox-routing';
import { NavigationRoute } from 'workbox-routing';
import * as navigationPreload from 'workbox-navigation-preload';
import {NetworkFirst, NetworkOnly, StaleWhileRevalidate, CacheFirst} from 'workbox-strategies';
import {CacheableResponsePlugin} from 'workbox-cacheable-response';
import {ExpirationPlugin} from 'workbox-expiration';
import { openDB } from 'idb';


precacheAndRoute(self.__WB_MANIFEST || []);


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

self.addEventListener('activate', function(event) {
  createDB()
	event.waitUntil(
    caches.keys().then(function(cacheNames) {
      return Promise.all(
        cacheNames.filter(function(cacheName) {
          // Return true if you want to remove this cache,
          // but remember that caches are shared across
          // the whole origin
          // return true
        }).map(function(cacheName) {
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

// Cache the Google Fonts stylesheets with a stale-while-revalidate strategy.
registerRoute(
  	({url}) => url.origin === 'https://fonts.googleapis.com',
  	new StaleWhileRevalidate({
    	cacheName: 'google-fonts-stylesheets',
  	})
);

// Cache the underlying font files with a cache-first strategy for 1 year.
registerRoute(
  ({url}) => url.origin === 'https://fonts.gstatic.com',
  new CacheFirst({
    cacheName: 'google-fonts-webfonts',
    plugins: [
      new CacheableResponsePlugin({
        statuses: [0, 200],
      }),
      new ExpirationPlugin({
        maxAgeSeconds: 60 * 60 * 24 * 365,
        maxEntries: 30,
      }),
    ],
  })
);



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

registerRoute(/(.*)\/api\/users/, ({url, event, params}) => {
    return fetch(event.request)
        .then(response => {
            let clonedResponse = response.clone();
            clonedResponse.json().then( body => {
                openDB('Turista', 1).then(db => {
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
            return openDB('Turista', 1).then( db => {
				return db.transaction('users')
                         .objectStore('users').getAll()
                         .then(values => {
							console.log(values);
							return new Response(JSON.stringify(values), 
							  { "status" : 200 , 
							  "statusText" : "MyCustomResponse!" });
						 })
            });
        });
});


registerRoute(/(.*)\/api\/hills/, ({url, event, params}) => {
  return fetch(event.request)
      .then(response => {
          let clonedResponse = response.clone();
          clonedResponse.json().then( body => {
              openDB('Turista', 1).then(db => {
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
          return openDB('Turista', 1).then( db => {
      return db.transaction('hills')
                       .objectStore('hills').getAll()
                       .then(values => {
            console.log(values);
            return new Response(JSON.stringify(values), 
              { "status" : 200 , 
              "statusText" : "MyCustomResponse!" });
           })
          });
      });
});


registerRoute(/(.*)\/api\/hill\/[0-9]+$/, ({url, event, params}) => {
  return fetch(event.request)
      .then(response => {
        
          return response;
      }).catch(err => {
          return openDB('Turista', 1).then( db => {

            // Get hill id from url
            let splitted = url.pathname.split('/')
            let hillId = parseInt( splitted[splitted.length-1] )
            console.log('id hory')
            console.log(hillId)
            return db.transaction('hills')
              .objectStore('hills').get(hillId)
              .then(values => {
                console.log('id hory znovu')
                console.log(hillId)
                console.log('vraciam tuto krasku na /hill/')
                console.log(values)
                return new Response(JSON.stringify(values), 
                  { "status" : 200 , 
                  "statusText" : "MyCustomResponse!" });
              })
          });
      });
});

// TODO
registerRoute(/(.*)\/api\/user\/[0-9]+$/, ({url, event, params}) => {
    return fetch(event.request)
        .then(response => {
            let clonedResponse = response.clone();
            clonedResponse.json().then( body => {
                openDB('Turista', 1).then(db => {
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
          return openDB('Turista', 1).then( db => {
            // Get hill id from url
            let splitted = url.pathname.split('/')
            let userId = parseInt( splitted[splitted.length-1] )
            console.log('user cislo' + userId)

            return db.transaction('users')
              .objectStore('users').get(userId)
              .then(values => {
                console.log('dostal som z idb usera')
                console.log(values)
                return new Response(JSON.stringify({data: values}), 
                  { "status" : 200 , 
                  "statusText" : "MyCustomResponse!" });
              })
          });
        });
});

// registerRoute(/(.*)\/api\/user/, ({url, event, params}) => {
//   return fetch(event.request)
//         .then(response => {
//             let clonedResponse = response.clone();
//             clonedResponse.json().then( body => {
//               console.log('Toto mam fetchnute na userovi:')
//               console.log(body);

//               if( body ) {
//                 console.log('ukladam to local storage lognuteho usera')
//                 localStorage.setItem('loggedUser', body);
//               } else {
//                 console.log('zla odpoved, nemam log usera')

//                 localStorage.removeItem('loggedUser');
//               }
//             });
//             return response;
//         }).catch(err => {
//           let loggedUser = localStorage.getItem('loggedUser')
//           if( loggedUser ) {
//             return new Response( loggedUser );
//           } else {
//             return new Response(null, {
//               "status": 404
//             });
//           }
//             // return openDB('Turista', 1).then( db => {
//             //   return db.transaction('users')
//             //                   .objectStore('users').get('users', )
//             //                   .then(values => {
//             //         return new Response(JSON.stringify(values), 
//             //           { "status" : 200 , 
//             //           "statusText" : "MyCustomResponse!" });
//             //       })
//             //   });
//         });
// });

async function createDB() {
	const db = await openDB('Turista', 1, {
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
		},
	});
}