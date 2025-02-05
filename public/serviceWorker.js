var static = "Carlinx-v2";
var cacheassets = [
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
];

self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open('your-cache-name').then((cache) => {
            return cache.addAll([
                // List of URLs to cache
                '/path/to/resource1',
                '/path/to/resource2',
                // Add your resources here
            ]).catch((error) => {
                console.error('Failed to cache:', error);
            });
        })
    );
});

self.addEventListener('activate', function (event) {    
});

self.addEventListener('fetch', function (event) {
    event.respondWith(
        caches.match(event.request).then(function (response) {
            return response || fetch(event.request)
        })
    );
});