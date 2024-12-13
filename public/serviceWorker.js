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

self.addEventListener("install", function (event) {
    console.log("Service Worker : Installed!")

    event.waitUntil(
        // caches.open(static).then(function (cache) {
        //     cache.addAll(cacheassets);
        // }).then(function () {
        //     return self.skipWaiting();
        // })
        (async() => {
            try {
                cache_obj = await caches.open(cache)
                cache_obj.addAll(cacheassets)
            }
            catch{
                console.log("error occured while caching...")
                return self.skipWaiting();
            }
        })()
    );
});
self.addEventListener("activate", function (event) {    
});

self.addEventListener("fetch", function (event) {
    event.respondWith(
        caches.match(event.request).then(function (response) {
            return response || fetch(event.request)
        })
    );
});