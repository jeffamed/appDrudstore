require('./bootstrap');

import { createApp } from "vue";
import router from './router';
import App from "./App.vue";
import axios from "axios";
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

createApp(App).use(router,axios,VueSweetalert2).mount('#app');
