const CACHE_NAME = "Carlinx-v2";
const CACHE_ASSETS = [
  "/splash.html",
  "/landing.html",
  "/signin.html",
  "/profile.html",
  "/assets/css/style.css",
  "/assets/js/app.js",
  "/assets/js/color-scheme.js",
  "/assets/js/jquery-3.33.111.min.js",
  "/assets/js/jquery.cookie.js",
  "/assets/js/main.js",
  "/assets/js/popper.min.js",
  "/assets/js/pwa-services.js",
  // Add favicon assets
  "/assets/img/favicon16.png",
  "/assets/img/favicon32.png"
];

self.addEventListener("install", function (event) {
    console.log("Service Worker: Installing...");

    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                console.log("Service Worker: Caching Files");
                return cache.addAll(CACHE_ASSETS);
            })
            .then(() => self.skipWaiting())
            .catch(error => {
                console.error("Service Worker: Caching failed", error);
            })
    );
});

self.addEventListener("activate", function (event) {
    console.log("Service Worker: Activated");
    
    // Clean up old caches
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cache => {
                    if (cache !== CACHE_NAME) {
                        console.log('Service Worker: Clearing Old Cache');
                        return caches.delete(cache);
                    }
                })
            );
        })
    );
});

self.addEventListener("fetch", function (event) {
    event.respondWith(
        caches.match(event.request)
            .then(function (response) {
                // Return cached version or fetch new
                return response || fetch(event.request)
                    .then(response => {
                        // Make copy of response
                        const responseClone = response.clone();
                        // Open cache
                        caches.open(CACHE_NAME)
                            .then(cache => {
                                // Add response to cache
                                cache.put(event.request, responseClone);
                            });
                        return response;
                    })
                    .catch(() => {
                        // If both fail, show a generic fallback:
                        return caches.match('/offline.html');
                    });
            })
    );
});