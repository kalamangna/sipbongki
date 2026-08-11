import './bootstrap';
import '../css/app.css';

import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Alpine.js is now loaded via CDN

// ApexCharts is now loaded via CDN

import TomSelect from "tom-select";
window.TomSelect = TomSelect;
