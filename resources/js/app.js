require('./bootstrap');

import { createApp } from "vue";
import router from './router';
import App from "./App.vue";
import axios from "axios";

createApp(App).use(router,axios).mount('#app');
