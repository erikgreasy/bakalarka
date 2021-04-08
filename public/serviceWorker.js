var STATIC_CACHE = 'static-cache-v3';
var DYNAMIC_CACHE = 'dynamic-cache';
var AVATARS_CACHE = 'avatars';
var UPLOADS_CACHE = 'uploads';

var allowedCaches = [
    STATIC_CACHE,
    DYNAMIC_CACHE,
    AVATARS_CACHE,
    UPLOADS_CACHE
]

const staticFiles = [
    'css/app.css',
    'js/app.js',
    'js/manifest.json',
    '/images/default.png',
    '/images/image-placeholder.png',
    '/images/mountain-bg.jpg',
    '/images/offline.png',
    '/offline',
    'icon/maskable_icon_x192.png',
    'favicon.ico',
];


self.addEventListener('install', event => {
    console.log('Service worker installing...');

    // Add a call to skipWaiting here
    event.waitUntil(
        caches.open(STATIC_CACHE)
        .then(cache => {
            return cache.addAll(staticFiles);
        })
    );
});

  
self.addEventListener('activate', event => {
        // delete any caches that aren't in expectedCaches
        // which will get rid of static-v1
        event.waitUntil(
        caches.keys().then(keys => Promise.all(
            keys.map(key => {
            if (!allowedCaches.includes(key)) {
                return caches.delete(key);
            }
            })
        )).then(() => {
            console.log('V2 now ready to handle fetches!');
        })
    );
});

self.addEventListener('fetch', event => {
    // Parse the URL:
    var requestURL = new URL(event.request.url);
    if (requestURL.origin == location.origin) {
        if(event.request.method == 'GET') {

        // AVATARS 
        if (new RegExp('\/(.*)storage\/avatars\/(.*).(?:jpg|jpeg|png|gif|svg)$').test(requestURL)) {

            event.respondWith(
                caches.open(AVATARS_CACHE)
                .then(cache => {

                    return cache.match(requestURL)
                    .then(response => {
                        if(response) {
                            return response;
                        }
                        return fetch(requestURL)
                        .then(res => {
                            cache.put(requestURL, res.clone());
                            return res;
                        })
                        .catch(err => {
                            return caches.match('/images/placeholder.png');
                        })
                    })
                })
             
            )
            
        } else if(new RegExp('\/(.*)storage\/uploads\/(.*).(?:jpg|jpeg|png|gif|svg)$').test(requestURL)) {
            event.respondWith(
                caches.open(UPLOADS_CACHE)
                .then(cache => {

                    return cache.match(requestURL)
                    .then(response => {
                        if(response) {
                            return response;
                        }
                        return fetch(requestURL)
                        .then(res => {
                            cache.put(requestURL, res.clone());
                            return res;
                        })
                        .catch(err => {
                            return caches.match('/storage/uploads/default.png');
                        })
                    })
                })
            )
             
        }else {
            // var networkDataReceived = false;

            // var networkUpdate = fetch( event.request ).then( res => {
            //     networkDataReceived = true;
            //     console.log('update page network')
            // } )


            // caches.match(event.request).then(res => {
            //     if( res ) {
            //         if( !networkDataReceived ) {
            //             console.log('update page cache')
            //         }
            //         return res;
            //     }

            // }).catch(err => {
            //     return networkUpdate;
            // })

            // evt.respondWith(fromCache(evt.request));

            event.respondWith(
                
                caches.match(event.request)
                    .then(response => {

                        if (response) {
                            console.log('Found ', event.request.url, ' in cache');
                            return response;
                        }

                        console.log(event.request)

                        return caches.open( DYNAMIC_CACHE ).then(cache => {
                            return cache.keys().then(keys => {
                                return fetch(event.request).then(res => {
                                    cache.put( event.request, res.clone() )
                                    return res;
                                })
                            })
                        })

                    }).catch(error => {

                        // Respond with custom offline page
                        return caches.match('/offline');
                    })
                );

            event.waitUntil(
                caches.open(STATIC_CACHE).then(cache => {
                    cache.match(event.request).then(res => {
                        if(res) {
                            console.log(event.request.url + ' found in static cache')
                            return;
                        }

                    })

                    update( event.request, DYNAMIC_CACHE );
                    // caches.open(DYNAMIC_CACHE).then(cache => {
                    //     return cache.match(event.request).then(res => {
                    //         if(res) {
                    //             return fetch(event.request).then(res => {
                    //                 return cache.put(event.request, res);
                    //             })
                    //         }
                    //     })
                    // })
                    // fetch(event.request).then(res => {
                    //     return cache.put(event.request, res)
                    // })
                    // .catch(err => {
                    //     console.log(err)
                    // })
                })
            )
       
    


    
            // event.respondWith(fromCache(event.request));
            // event.waitUntil(update(event.request));
        
        }
    } // END request GET
    } // END location origin
});


// function fromCache(request) {
//     return caches.open(STATIC_CACHE).then(function (cache) {
//         return cache.match(request).then(function (matching) {
//                 return matching

            
//         }).catch(err => {
//             return cache.match('/offline')
//         })
//     });
// }


function update(request, cache_name) {
    caches.open(cache_name).then(cache => {
        return cache.match(request).then(res => {
            if(res) {
                return fetch(request).then(res => {
                    return cache.put(request, res);
                })
                .catch(err => {
                    console.error(request.url + ' err in update')
                })
            }
        })
    })
}