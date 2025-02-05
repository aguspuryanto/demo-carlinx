'use strict';

/* PWA services worker register */
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function () {
        navigator.serviceWorker
            .register('../../serviceWorker.js', {
                scope: './'
            })
            .then((reg) => console.log('Service worker registered:', reg))
            .catch((err) => console.error('Service worker registration failed:', err));
    });
}

window.addEventListener('appinstalled', function () {
    // Optionally log the installation event
    console.log('App installed');
    document.getElementById('toastinstall').style.display = 'none';
});

// Handle display mode changes
function updateToastVisibility() {
    if (window.matchMedia('(display-mode: fullscreen)').matches) {
        $('#toastinstall').fadeOut();
    } else {
        $('#toastinstall').fadeIn();
    }
}

// Initial check on load
updateToastVisibility();

// Add listener for changes in display mode
window.matchMedia('(display-mode: fullscreen)').addEventListener('change', updateToastVisibility);