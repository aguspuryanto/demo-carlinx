'use strict'

// Fungsi untuk mendaftarkan service worker
async function registerServiceWorker() {
    if ('serviceWorker' in navigator) {
        try {
            const registration = await navigator.serviceWorker.register('./serviceWorker.js', {
                scope: './'
            });
            console.log('Service worker berhasil didaftarkan:', registration);
        } catch (error) {
            console.error('Gagal mendaftarkan service worker:', error);
        }
    }
}

// Daftarkan service worker saat halaman dimuat
window.addEventListener('load', registerServiceWorker);

// Handle event ketika app diinstall
window.addEventListener('appinstalled', () => {
    const toastInstall = document.getElementById('toastinstall');
    if (toastInstall) {
        toastInstall.style.display = 'none';
    }
});

// Cek apakah app dalam mode fullscreen
const checkDisplayMode = () => {
    const toastInstall = $('#toastinstall');
    if (window.matchMedia('(display-mode: fullscreen)').matches) {
        toastInstall.fadeOut();
    } else {
        toastInstall.fadeIn();
    }
};

// Monitor perubahan display mode
window.matchMedia('(display-mode: fullscreen)').addEventListener('change', checkDisplayMode);
checkDisplayMode(); // Cek status awal
