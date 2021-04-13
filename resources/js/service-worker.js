import { precacheAndRoute } from 'workbox-precaching';
import { registerRoute } from 'workbox-routing';
import { NavigationRoute } from 'workbox-routing';
import { NetworkFirst } from 'workbox-strategies';
import * as navigationPreload from 'workbox-navigation-preload';
import {NetworkOnly} from 'workbox-strategies';

precacheAndRoute(self.__WB_MANIFEST || []);


const CACHE_NAME = 'offline-html';
const FALLBACK_HTML_URL = '/app-shell';
self.addEventListener('install', async (event) => {
    event.waitUntil(
      caches.open(CACHE_NAME)
        .then((cache) => cache.add(FALLBACK_HTML_URL))
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

