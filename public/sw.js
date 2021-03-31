/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./public/sw-offline.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./public/sw-offline.js":
/*!******************************!*\
  !*** ./public/sw-offline.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

// importScripts('https://storage.googleapis.com/workbox-cdn/releases/5.0.0/workbox-sw.js');
importScripts('https://storage.googleapis.com/workbox-cdn/releases/4.1.1/workbox-sw.js'); // workbox.skipWaiting()
// workbox.clientsClaim()
// workbox.routing.precacheAndRoute()
// fonts
// workbox.recipes.offlineFallback();
// pre-cache pages

workbox.precaching.precacheAndRoute([{
  url: '/hills'
}]);
workbox.routing.registerRoute(new RegExp('https://fonts.*'), workbox.strategies.cacheFirst({
  cacheName: 'fonts',
  plugins: [new workbox.cacheableResponse.Plugin({
    statuses: [0, 200]
  })]
})); // google stuff

workbox.routing.registerRoute(new RegExp('.*(?:googleapis|gstatic).com.*$'), workbox.strategies.networkFirst({
  cacheName: 'google'
})); // static

workbox.routing.registerRoute(new RegExp('.(?:js|css|ico)$'), workbox.strategies.networkFirst({
  cacheName: 'static'
})); // workbox.routing.registerRoute(
//     '/',
//     workbox.strategies.staleWhileRevalidate({
//         cacheName: 'pages'
//     })
// );

workbox.routing.registerRoute(new RegExp('/(.*)hills/(.*)'), workbox.strategies.staleWhileRevalidate({
  cacheName: 'hills'
})); // images

workbox.routing.registerRoute(new RegExp('.(?:jpg|png|gif|svg)$'), workbox.strategies.cacheFirst({
  cacheName: 'images',
  plugins: [new workbox.expiration.Plugin({
    maxEntries: 20,
    purgeOnQuotaError: true
  })]
}));
[{'revision':'ab3a7bd3a5d0e9b0f7921df211bee57b','url':'//css/app.css'},{'revision':'901b5796020205be41bf96f0fe3f1f93','url':'//js/app.js'}];

/***/ })

/******/ });