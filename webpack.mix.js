const mix = require('laravel-mix');

require('laravel-mix-workbox');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').sourceMaps()
    .sass('resources/sass/app.scss', 'public/css')
    // .injectManifest({
    //     swSrc: './resources/js/service-worker.js',
    //     swDest: 'sw.js',
    //     maximumFileSizeToCacheInBytes: 50000000,
        
    // });
