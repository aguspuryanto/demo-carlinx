'use strict'
/* PWA services worker register */
// if ("serviceWorker" in navigator) {
//     window.addEventListener("load", function (event) {
//         navigator.serviceWorker
//             .register("././serviceWorker.js", {
//                 scope: './'
//             })
//             .then(reg => console.log("service worker registered"))
//             .catch(err => console.log("service worker not registered"));
//     });
// }

var BASE_URL = '<?= base_url() ?>';
if ('serviceWorker' in navigator && navigator.onLine) {
    navigator.serviceWorker.register( BASE_URL + 'serviceWorker.js')
    .then((reg) => {
        console.log('Registrasi service worker Berhasil', reg);
    }, (err) => {
        console.error('Registrasi service worker Gagal', err);
    });
}

window.addEventListener("appinstalled", function (event) {
    //app.logEvent("a2hs", "Installed");
    document.getElementById('toastinstall').style.display = 'none';
});


if (window.matchMedia('(display-mode: fullscreen)').matches) {
    $('#toastinstall').fadeOut()
} else {
    $('#toastinstall').fadeIn()
}
