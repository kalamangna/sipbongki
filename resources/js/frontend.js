/**
 * Frontend JS — Public Pages
 * Menggunakan Alpine.js (sudah di-bundle via devDependencies)
 * TIDAK menggunakan Bootstrap JS (khusus backend)
 */
import axios from 'axios';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Alpine.start();
