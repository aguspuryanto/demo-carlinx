'use strict'

// Fungsi untuk mendaftarkan service worker
async function registerServiceWorker() {
    if (!('serviceWorker' in navigator)) {
        console.log('Service Worker tidak didukung di browser ini');
        return;
    }

    try {
        const registration = await navigator.serviceWorker.register('/serviceWorker.js', {
            scope: '/'
        });
        console.log('Service worker berhasil didaftarkan:', registration.scope);
    } catch (error) {
        console.error('Gagal mendaftarkan service worker:', error);
    }
}

// Fungsi untuk menangani toast install
const handleInstallPrompt = () => {
    const toastInstall = document.getElementById('toastinstall');
    if (!toastInstall) return;

    // Cek mode tampilan
    const isFullscreen = window.matchMedia('(display-mode: fullscreen)').matches;
    $(toastInstall)[isFullscreen ? 'fadeOut' : 'fadeIn']();
};

// Inisialisasi
document.addEventListener('DOMContentLoaded', () => {
    // Daftarkan service worker
    registerServiceWorker();
    
    // Setup event listeners
    window.addEventListener('appinstalled', () => {
        const toastInstall = document.getElementById('toastinstall');
        if (toastInstall) {
            toastInstall.style.display = 'none';
        }
    });

    // Monitor perubahan display mode
    const displayModeMedia = window.matchMedia('(display-mode: fullscreen)');
    displayModeMedia.addEventListener('change', handleInstallPrompt);
    
    // Cek status awal
    handleInstallPrompt();
});
