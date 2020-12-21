var STATIC_CACHE = 'static-cache-v1';
var DYAMIC_CACHE = 'dynamic-cache-v1';


self.addEventListener( 'install', function(event) {
    console.log( 'Installing SW' )

    // event.waitUntil extends the lifetime of the install 
    // event until the passed promise resolves successfully. 
    // If the promise rejects, the installation is considered 
    // a failure and this service worker is abandoned (if an 
    // older version is running, it stays active).
    event.waitUntil(
        caches.open( STATIC_CACHE )
            .then( cache => {
                console.log( 'Precaching app shell' );

                // cache.addAll will reject if any of the resources fail to 
                // cache. This means the service worker will only install if 
                // all of the resources in cache.addAll have been cached.
                return cache.addAll([
                    'js/app.js',
                    'css/app.css',
                    
                ]);
            } )
            .catch( err => {
                console.error( err )
            } )
    )
    
} )



self.addEventListener( 'activate', function(event) {
    // var cacheAllowlist = ['static-cache-v1', 'dynamic-cache-v1'];
    console.log( 'Activating SW' )
    event.waitUntil(
        caches.keys()
            .then( function( keyList ) {

                return Promise.all( keyList.map( key => {
                    if( key !== STATIC_CACHE && key !== DYAMIC_CACHE ) {
                        console.log( 'Removing old cache.', key );
                        return caches.delete(key);
                    }
                } ) )
                // return Promise.all(
                //     cacheNames.map( function( cacheName ) {
                //         if( cacheAllowlist.indexOf( cacheName ) === -1 ) {
                //             return caches.delete( cacheName );
                //         }
                //     } )
                // )
        } )
    )
    return self.clients.claim();
} )



self.addEventListener('fetch', function(event) {


    event.respondWith(
        // try the network
        fetch( event.request )
            .then( res => {
                return caches.open( DYAMIC_CACHE )
                    .then( cache => {
                        // put in cache if success
                        cache.put( event.request.url, res.clone() );
                        return res;
                    } )
            } )
            .catch( err => {
                // fallback to cache
                return caches.match( event.request )
            } )
    )

    // event.respondWith(
    //     caches.match(event.request)
    //         .then(function(response) {
    //             // Cache hit - return response
    //             if (response) {
    //                 return response;
    //             }
    //             return fetch(event.request)
    //                 .then( function( response ) {
    //                     // Check if we receive valid response. Basic indicates request from our origin.
    //                     if( !response || response.status !== 200 || response.type !== 'basic' ) {
    //                         return response;
    //                     }


    //                     // IMPORTANT: Clone the response. A response is a stream
    //                     // and because we want the browser to consume the response
    //                     // as well as the cache consuming the response, we need
    //                     // to clone it so we have two streams.
    //                     var responseToCache = response.clone();

    //                     caches.open( DYNAMIC_CACHE )
    //                         .then( function( cache ) {
                                
    //                             cache.put( event.request, responseToCache );
    //                         } )
    //                         .catch( err => console.log( err ) )
    //                     return response;

    //                 } ) // end of fetch.then function
    //                 .catch( err => {
    //                     console.log( err )
    //                 } )
                    
    //         }
    //     )
    // ); // end of event.respondWith
});


